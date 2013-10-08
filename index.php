<?php

require_once('petrovich/Petrovich.php');

use petrovich\Petrovich;

$run = microtime();
$run_memory = memory_get_usage ();

$petrovich = new Petrovich();
$fio = explode(' ',$_REQUEST['fio']);

echo '<br /><strong>Дательный (Кому? Чему?):</strong><br />';
echo $petrovich->firstname($fio[1],Petrovich::CASE_GENITIVE).'<br />';
echo $petrovich->middlename($fio[2],Petrovich::CASE_GENITIVE).'<br />';
echo $petrovich->lastname($fio[0],Petrovich::CASE_GENITIVE).'<br />';
$first_end = microtime();

echo '<br /><strong>Родительный (Кого? Чего?):</strong><br />';
echo $petrovich->firstname($fio[1],Petrovich::CASE_DATIVE).'<br />';
echo $petrovich->middlename($fio[2],Petrovich::CASE_DATIVE).'<br />';
echo $petrovich->lastname($fio[0],Petrovich::CASE_DATIVE).'<br />';

echo '<br /><strong>Предложный (О ком? О чём?):</strong><br />';
echo $petrovich->firstname($fio[1],Petrovich::CASE_PREPOSITIONAL).'<br />';
echo $petrovich->middlename($fio[2],Petrovich::CASE_PREPOSITIONAL).'<br />';
echo $petrovich->lastname($fio[0],Petrovich::CASE_PREPOSITIONAL).'<br />';

echo '<br /><strong>Винительный (Кого? Что?):</strong><br />';
echo $petrovich->firstname($fio[1],Petrovich::CASE_ACCUSATIVE).'<br />';
echo $petrovich->middlename($fio[2],Petrovich::CASE_ACCUSATIVE).'<br />';
echo $petrovich->lastname($fio[0],Petrovich::CASE_ACCUSATIVE).'<br />';

echo '<br /><strong>Творительный (Кем? Чем?):</strong><br />';
echo $petrovich->firstname($fio[1],Petrovich::CASE_INSTRUMENTAL).'<br />';
echo $petrovich->middlename($fio[2],Petrovich::CASE_INSTRUMENTAL).'<br />';
echo $petrovich->lastname($fio[0],Petrovich::CASE_INSTRUMENTAL).'<br />';

$last_end = microtime();
$end_memory = memory_get_usage();

echo '<br />Время одного преобразования ФИО: '.($first_end-$run);
echo '<br />Время всех преобразований ФИО: '.($last_end-$run);
echo '<br />Память: '.($end_memory-$run_memory)/(1024*1024);