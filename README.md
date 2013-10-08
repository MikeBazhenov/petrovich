![Petrovich](petrovich.png)

Склонение падежей русских имён, фамилий и отчеств. Вы задаёте начальное имя
в именительном падеже, а получаете в нужном вам.

Портированная версия https://github.com/rocsci/petrovich с ruby на php

#Установка

Установить php-yaml http://www.php.net/manual/ru/yaml.installation.php
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

Лицензия MIT
