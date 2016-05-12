<?php
/**
 * Created by PhpStorm.
 * User: zjien
 * Date: 4/18/16
 * Time: 2:44 PM
 */


error_reporting ( E_ERROR );
//调试用
ini_set ( 'display_errors', true );
error_reporting ( E_ALL );
//set_time_limit ( 0 );

date_default_timezone_set ( 'PRC' );
if (version_compare ( PHP_VERSION, '5.5.0', '<' ))
    die ( 'Your PHP Version is ' . PHP_VERSION . ', But WeiPHP require PHP > 5.5.0 !' );
define('ROOT', dirname(__DIR__));//zero目录
define('DS', DIRECTORY_SEPARATOR);

require_once ROOT.DS.'Core'.DS.'bootstrap.php';