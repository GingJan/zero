<?php
/**
 * Created by PhpStorm.
 * User: zjien
 * Date: 5/4/16
 * Time: 1:22 PM
 */

var_dump('$_SERVER[DOCUMENT_ROOT]:当前运行脚本所在的文档根目录。在服务器配置文件中定义。',$_SERVER['DOCUMENT_ROOT']);//当前运行脚本所在的文档根目录。在服务器配置文件中定义。
var_dump('$_SERVER[SCRIPT_FILENAME]:当前执行脚本的绝对路径。',$_SERVER['SCRIPT_FILENAME']);//当前执行脚本的绝对路径
var_dump('$_SERVER[SCRIPT_NAME]:包含当前脚本的路径。这在页面需要指向自己时非常有用.',$_SERVER['SCRIPT_NAME']);
var_dump('__FILE__:文件的完整路径和文件名[绝对路径]。如果用在被包含文件中，则返回被包含的文件名。',__FILE__);
var_dump('__DIR__:等价于dirname(__FILE__)文件所在的目录。如果用在被包括文件中，则返回被包括的文件所在的目录。',__DIR__);
var_dump('等价于dirname($path):给出一个包含有指向一个文件的全路径的字符串，本函数返回去掉文件名后的目录名。 ',dirname('../../Config/config.php'));
var_dump('等价于dirname($path):给出一个包含有指向一个文件的全路径的字符串，本函数返回去掉文件名后的目录名。 ',dirname('../../Config'));
var_dump('等价于realpath(file):返回规范化的绝对路径名。""',realpath('../../Config/config.php'));
var_dump('等价于realpath(file):返回规范化的绝对路径名。""',realpath('../../Config'));