<?php
/*
 * 为了后期维护以及扩展方便，以及index.php文件的简洁性，把启动时就要加载的程序通天翼放在此文件中引入
 *
 *
 * */
$GLOBALS['_beginTime'] = microtime(true);

define('MEMORY_LIMIT_ON', function_exists('memory_get_usage'));
if(MEMORY_LIMIT_ON) $GLOBALS['_startUseMems'] = memory_get_usage();

// 系统信息
if (version_compare ( PHP_VERSION, '5.5.0', '<' )) {
    ini_set ('magic_quotes_runtime', 0);
    define ('MAGIC_QUOTES_GPC', get_magic_quotes_gpc () ? True : False );
} else {
    define ('MAGIC_QUOTES_GPC', false);
}

require_once 'Core.php';
\Core\Core::start();

