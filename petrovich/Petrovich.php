<?php

namespace petrovich;

use ErrorException;

class Petrovich {

    const CASE_DATIVE = 0; //родительный
    const CASE_GENITIVE = 1; //дательный
    const CASE_ACCUSATIVE = 2; //винительный
    const CASE_INSTRUMENTAL = 3; //творительный
    const CASE_PREPOSITIONAL = 4; //предложный
	
    private $_rules; //Правила

    private $_lastname; //Шарыпов
    private $_firstname; //Пётр
    private $_middlename; //Александрович
    private $_gender; //Пол male/мужской female/женски

    /**
     * Конструтор класса Петрович
     * загружаем правила из файла rules.js
     */
    function __construct() {

        $rules_path = __DIR__.'/rules.js';

        $rules_resourse = fopen($rules_path, 'r');

        if($rules_resourse == false)
            throw new ErrorException('Rules file not found.');

        $rules_array = fread($rules_resourse,filesize($rules_path));

        fclose($rules_resourse);

        $this->_rules = get_object_vars(json_decode($rules_array));
    }

    /**
     * Задаём имя и слоняем его
     *
     * @param $firstname
     * @param $case
     * @return bool|string
     * @throws \ErrorException
     */
    public function firstname($firstname,$case) {
        if(empty($firstname))
            throw new ErrorException('Firstname cannot be empty.');

        $this->_firstname = $firstname;
        return $this->inflect($this->_firstname,$case,__FUNCTION__);
    }

    /**
     * Задём отчество и склоняем его
     *
     * @param $middlename
     * @param $case
     * @return bool|string
     * @throws \ErrorException
     */
    public function middlename($middlename,$case) {
        if(empty($middlename))
            throw new ErrorException('Middlename cannot be empty.');

        $this->_middlename = $middlename;
        return $this->inflect($this->_middlename,$case,__FUNCTION__);
    }

    /**
     * Задаём фамилию и слоняем её
     *
     * @param $lastname
     * @param $case
     * @return bool|string
     * @throws \ErrorException
     */
    public function lastname($lastname,$case) {
        if(empty($lastname))
            throw new ErrorException('Lastname cannot be empty.');

        $this->_lastname = $lastname;
        return $this->inflect($this->_lastname,$case,__FUNCTION__);
    }

    /**
     * Функция проверяет заданное имя,фамилию или отчество на исключение
     * и склоняет
     *
     * @param $name
     * @param $case
     * @param $type
     * @return bool|string
     */
    private function inflect($name,$case,$type) {

        if(($exception = $this->checkException($name,$case,$type)) !== false)
            return $exception;

        //если двойное имя или фамилия или отчество
        if(substr_count($name,'-') > 0) {
            $names_arr = explode('-',$name);
            $result = '';

            foreach($names_arr as $arr_name) {
                $result .= $this->findInRules($arr_name,$case,$type).'-';
            }
            return substr($result,0,strlen($result)-1);
        } else {
            return $this->findInRules($name,$case,$type);
        }
    }

    /**
     * Поиск в массиве правил
     *
     * @param $name
     * @param $case
     * @param $type
     * @return string
     */
    private function findInRules($name,$case,$type) {
        foreach($this->_rules[$type]->suffixes as $rule) {
            foreach($rule->test as $last_char) {
                $last_name_char = substr($name,strlen($name)-strlen($last_char),strlen($last_char));
                if($last_char == $last_name_char) {
                    if($rule->mods[$case] == '.')
                        continue;

                    if($this->_gender == 'androgynous' || $this->gender == null)
                        $this->_gender = $rule->gender;

                    return $this->applyRule($rule->mods,$name,$case);
                }
            }
        }
        return $name;
    }

    /**
     * Проверка на совпадение в исключениях
     *
     * @param $name
     * @param $case
     * @param $type
     * @return bool|string
     */
    private function checkException($name,$case,$type) {
        if(!isset($this->_rules[$type]->exceptions))
            return false;

        $lower_name = strtolower($name);

        foreach($this->_rules[$type]->exceptions as $rule) {
            if(array_search($lower_name,$rule->test) !== false) {
                return $this->applyRule($rule->mods,$name,$case);
            }
        }
        return false;
    }

    /**
     * Склоняем заданное слово
     *
     * @param $mods
     * @param $name
     * @param $case
     * @return string
     */
    private function applyRule($mods,$name,$case) {
        $result = substr($name,0,strlen($name)-substr_count($mods[$case],'-'));
        $result .= str_replace('-','',$mods[$case]);
        return $result;
    }

    /**
     * Возвращает пол который возможно был определён при поиске в правилах
     * @return string
     */
    public function getGender() {
        switch($this->_gender) {
            case 'male':
                return 'мужской';
            case 'female':
                return 'женский';
            case 'androgynous':
                return 'не определён';
        }
    }
}