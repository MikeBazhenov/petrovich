<?php
    require_once('../petrovich/Petrovich.php');
    use petrovich\Petrovich;

    $petrovich = new Petrovich();
    if(!empty($_REQUEST['fio']))
        $fio = explode(' ',$_REQUEST['fio']);
    else {
        $fio[] = 'Баженов';
        $fio[] = 'Михаил';
        $fio[] = 'Александрович';
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Petrovich на PHP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link href="css/bootstrap-theme.min.css" rel="stylesheet"/>
    <link href="css/style.css" rel="stylesheet"/>
    <link href="google-code-prettify/prettify.css" rel="stylesheet"/>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="container">
        <div class="header">
            <ul class="nav nav-pills pull-right">
                <li class="active"><a href="/">Главная</a></li>
                <li><a href="https://github.com/rocsci/petrovich">Petrovich на Ruby</a></li>
                <li><a href="https://github.com/MikeBazhenov/petrovich">Petrovich на PHP</a></li>
            </ul>
            <h3 class="text-muted">Petrovich на PHP</h3>
        </div>

        <div class="jumbotron">
            <h1><img src="image/petrovich.png"/></h1>
            <p class="lead">Склонение падежей русских имён, фамилий и отчеств. Вы задаёте начальное имя в именительном падеже, а получаете в нужном вам.</p>
            <p><a class="btn btn-lg btn-success" href="https://github.com/MikeBazhenov/petrovich" target="_blank">Смотреть на Github</a></p>
        </div>

        <div class="row marketing">
            <form class="form" method="POST">
                <h2 class="form-heading">Просклоняйте!</h2>
                <input type="text" class="form-control" name="fio" placeholder="Баженов Михаил Александрович" value="<?php if(isset($_REQUEST['fio'])) echo $_REQUEST['fio']; ?>">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Поехали!</button>
            </form>
            <div class="container">
                <div class="col-lg-6">
                    <h4>Родительный (Кого? Чего?)</h4>
                    <p><?php echo $petrovich->firstname($fio[1],Petrovich::CASE_DATIVE); ?></p>
                    <p><?php echo $petrovich->middlename($fio[2],Petrovich::CASE_DATIVE); ?></p>
                    <p><?php echo $petrovich->lastname($fio[0],Petrovich::CASE_DATIVE); ?></p>

                    <h4>Дательный (Кому? Чему?)</h4>
                    <p><?php echo $petrovich->firstname($fio[1],Petrovich::CASE_GENITIVE); ?></p>
                    <p><?php echo $petrovich->middlename($fio[2],Petrovich::CASE_GENITIVE); ?></p>
                    <p><?php echo $petrovich->lastname($fio[0],Petrovich::CASE_GENITIVE); ?></p>

                    <h4>Винительный (Кого? Что?)</h4>
                    <p><?php echo $petrovich->firstname($fio[1],Petrovich::CASE_ACCUSATIVE); ?></p>
                    <p><?php echo $petrovich->middlename($fio[2],Petrovich::CASE_ACCUSATIVE); ?></p>
                    <p><?php echo $petrovich->lastname($fio[0],Petrovich::CASE_ACCUSATIVE); ?></p>
                </div>
                <div class="col-lg-6">
                    <h4>Творительный (Кем? Чем?)</h4>
                    <p><?php echo $petrovich->firstname($fio[1],Petrovich::CASE_INSTRUMENTAL); ?></p>
                    <p><?php echo $petrovich->middlename($fio[2],Petrovich::CASE_INSTRUMENTAL); ?></p>
                    <p><?php echo $petrovich->lastname($fio[0],Petrovich::CASE_INSTRUMENTAL); ?></p>

                    <h4>Предложный (О ком? О чём?)</h4>
                    <p><?php echo $petrovich->firstname($fio[1],Petrovich::CASE_PREPOSITIONAL); ?></p>
                    <p><?php echo $petrovich->middlename($fio[2],Petrovich::CASE_PREPOSITIONAL); ?></p>
                    <p><?php echo $petrovich->lastname($fio[0],Petrovich::CASE_PREPOSITIONAL); ?></p>

                    <h4>Установка</h4>
                    <p>Загрузить папку petrovich на сервер.</p>
                </div>
            </div>
            <div class="help-block">
                <h4>Как использовать</h4>
                <pre class="prettyprint linenums languague-php">
require_once('petrovich/Petrovich.php');
use petrovich\Petrovich;

$petrovich = new Petrovich();

$petrovich->firstname('<?php echo $fio[1] ?>',Petrovich::CASE_GENITIVE);
$petrovich->lastname('<?php echo $fio[0] ?>',Petrovich::CASE_GENITIVE);
$petrovich->middlename('<?php echo $fio[2] ?>',Petrovich::CASE_GENITIVE);
                </pre>
            </div>
        </div>

        <div class="footer">
            <p>© 2013</p>
        </div>

    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="google-code-prettify/prettify.js"></script>
    <script type="text/javascript">
        $(window).load(function(){
            $(function(){
                var $window = $(window)
                window.prettyPrint && prettyPrint()
            })
        });
    </script>
</body>
</html>