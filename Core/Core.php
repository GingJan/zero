<?php
/**
 * Created by PhpStorm.
 * User: zjien
 * Date: 4/18/16
 * Time: 5:43 PM
 */

namespace Core;

class Core {

    static public function start() {
        //第三个参数为true，spl_autoload_register()会将第一个参数（函数）添加到 autoload函数队列 之首，默认下spl_autoload()函数是队首元素【ps：原本是__autoload()函数，但是因为使用了spl_autoload_register，所以被spl_autoload()取代了】
        spl_autoload_register([static::class, 'autoload'], true, true);
        register_shutdown_function([static::class, 'shutdown']);
    }

    public static function autoload($class) {
        $class_file = str_replace('\\', '/', $class) . '.php';
        if(file_exists($class_file)) {
            require_once (ROOT . '/' . $class_file);
        }
    }

    public static function shutdown() {

    }

    public function


}
