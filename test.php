<?php
/**
 * Created by PhpStorm.
 * User: a6y
 * Date: 30.09.15
 * Time: 17:41
 */

require 'src/autoload.php';

$old_robots = new \Parser\Xbb_RobotsTxt('http://test.comfplus.ru/');
var_dump($old_robots->allow('/'));
var_dump($old_robots->allow('/asdasdasdas/'));