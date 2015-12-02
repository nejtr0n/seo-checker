<?php
/**
 * Created by PhpStorm.
 * User: a6y
 * Date: 21.08.15
 * Time: 13:46
 */
/**
 * Compare sites
 */
require_once 'src/autoload.php';
$checker = new \Parser\Checker();
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Сравнитель сайтов</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="src/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" media="all" />
        <link href="src/twbs/bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet" media="all" />
        <link href="css/main.css" rel="stylesheet" media="all" />
    </head>
    <body>
        <div id="wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default setup1">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h3>Данные</h3>
                                        <p>
                                            <img src="img/csv.png" />
                                        </p>
                                    </div>
                                    <div class="col-sm-6">
                                        <h3>Зачем этот инструмент</h3>
                                        <p>Инструмент предназначен для автоматической проверки корректности переноса сайта с
                                            одного движка на другой, или при других больших доработках влияющих на структуру сайта.
                                            Используйте его всегда при подобных задачах, он поможет избежать проблем "забывчивости переноса
                                            каких то страниц", проблем корректности переноса оптимизации страниц, проблем корректности обработки 301 редиректов.
                                        </p>
                                        <p>
                                            Какие данные нужны
                                            <ul>
                                                <li>Необходимо что бы одновременно были доступны из интернета версия сайта после переноса и версия сайта до переноса.</li>
                                                <li>Делаем Список ссылок со старой версии сайта в виде показанном слева. А домен подставляем у этих ссылок тот где сейчас лежит сайт новой версии. Сделать можно, например, через XENU и заливаем их в проверяльщик.</li>
                                                <li>Указываем домен старого сайта в настройках.</li>
                                            </ul>
                                        </p>
                                        <p>
                                        Как это работает<br/>
                                        Проверяльщик смотрит есть ли по адресам указанных в файле загруженном в систему страницы на новой версии сайта. Если есть,
                                            то проверяет соответствие выбранных параметров (title, h1, text) на сайте который указан в качестве старого сайта. Если
                                            страница на новом сайте доступна через 301 редирект по ссылке старого сайта, то проверяльщик корректно проверит ее параметры.
                                        </p>
                                    </div>
                                </div>
                                <form class="file-form ajax-form" method="POST" action="ajax_csvfile.php">
                                    <div class="form-group">
                                        <label for="csvfile">Фаил с проверяемыми страницами (csv)</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="file" id="csvfile" name="csvfile" class="file-input"  title="выбрать файл для загрузки">
                                    </div>
                                    <button type="submit" class="btn btn-default">начать проверку по загруженному файлу</button>
                                </form>
                            </div>
                        </div>
                        <div class="panel panel-default setup2">
                            <div class="panel-body">
                                <h2>Настройка</h2>
                                    <form class="compare-form ajax-form" method="POST" action="ajax_compare.php">
                                        <div class="form-group">
                                            <label for="filters">Фильтры:</label>
                                            <?foreach ($checker->getFilters() as $name => $obj):?>
                                                <label class="checkbox-inline"><input name='filters[]' type="checkbox" value="<?=$name?>"><?=$name?></label>
                                            <?endforeach;?>
                                        </div>
                                        <div class="form-inline">
                                            <div class="form-group domain-group">
                                                <input type="text" data-toggle="tooltip" data-placement="bottom" title="Допустимые форматы ввода: domain.com, www.domain.com, http://domain.com, https://www.domain.com" class="form-control input-domain" id="old_url" name="old_url" placeholder="Старый домен" value="">
                                                <select class="form-control" name="old_encoding">
                                                    <option value="UTF-8">UTF-8</option>
                                                    <option value="windows-1251">windows-1251</option>
                                                </select>
                                            </div>
                                            <p class="text-success">Старый домен указывается лишь для того, чтобы отсечь все внешние ссылки. В запрос идут ссылки из выгрузки</p>
                                        </div>
                                        <div class="form-inline">
                                            <div class="form-group domain-group">
                                                <input type="text" data-toggle="tooltip" data-placement="bottom" title="Допустимые форматы ввода: domain.com, www.domain.com, http://domain.com, https://www.domain.com" class="form-control input-domain" id="new_url" name="new_url" placeholder="Новый домен" value="">
                                                <select class="form-control" name="new_encoding">
                                                    <option>UTF-8</option>
                                                    <option>windows-1251</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="threads" name="threads" placeholder="Количество потоков (по умолчанию 10)" value="10">
                                        </div>
                                        <button type="submit" class="btn btn-success btn-large">Сравнить</button>
                                        <a href="index.php" role="button" class="btn btn-default btn-large">Начало</a>
                                    </form>
                            </div>
                        </div>
                    </div>
                    <!-- result -->
                    <div class="col-md-12">
                        <p class="result"></p>
                    </div>
                </div>
            </div>
        </div>
        <div id="preloader">
            <div id="status">&nbsp;</div>
            <div id="status-info">
                <span class="info">

                </span>
            </div>
        </div>
        <!-- Js -->
        <script type="text/javascript" src="src/components/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="src/components/jquery/jquery-migrate.min.js"></script>
        <script type="text/javascript" src="src/components/jquery/jquery-migrate.min.js"></script>
        <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
        <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/additional-methods.min.js"></script>
        <script type="text/javascript" src="http://malsup.github.com/jquery.form.js"></script>
        <script type="text/javascript" src="src/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.file-input.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
    </body>
</html>
