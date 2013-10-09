![Petrovich](petrovich.png)

Склонение падежей русских имён, фамилий и отчеств. Вы задаёте начальное имя
в именительном падеже, а получаете в нужном вам.

Портированная версия https://github.com/rocsci/petrovich с ruby на php

#Пример
http://iguffi.ru/petrovich/

#Установка

Загрузить папку petrovich на сервер.

#Использование

```php
require_once('petrovich/Petrovich.php');

use petrovich\Petrovich;

$petrovich = new Petrovich();
$fio = explode(' ',$_REQUEST['fio']);// Баженов Михаил Александрович

echo '<br /><strong>Дательный (Кому? Чему?):</strong><br />';
echo $petrovich->firstname($fio[1],Petrovich::CASE_GENITIVE).'<br />';
echo $petrovich->middlename($fio[2],Petrovich::CASE_GENITIVE).'<br />';
echo $petrovich->lastname($fio[0],Petrovich::CASE_GENITIVE).'<br />';
```
Названия суффиксов для методов образованы от английских названий
соответствующих падежей. Полный список поддерживаемых падежей приведён
в таблице ниже.

| Суффикс метода | Падеж        | Характеризующий вопрос |
|----------------|--------------|------------------------|
| CASE_GENITIVE  | родительный  | Кого? Чего?            |
| CASE_DATIVE    | дательный    | Кому? Чему?            |
| CASE_ACCUSATIVE| винительный  | Кого? Что?             |
| CASE_INSTRUMENTAL   | творительный | Кем? Чем?              |
| CASE_PREPOSITIONAL  | предложный   | О ком? О чём?          |

Лицензия MIT
