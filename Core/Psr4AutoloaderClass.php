<?php
/**
 * Created by PhpStorm.
 * User: zjien
 * Date: 4/18/16
 * Time: 5:43 PM
 */

namespace Core;

class Psr4AutoloaderClass {

    protected $prefixes = [];//用来装载命名空间对应的文件路径

    //注册自动加载函数到SPL autoloader栈
    public function register() {
        spl_autoload_register([$this, 'loadClass']);
    }

    //给对应的命名空间添加对应的文件路径映射
    public function addNamespace($prefix, $base_dir, $prepend = false) {
        //格式化命名空间
        //   \Test\Fish\   ->    Test\Fish\
        $prefix = trim($prefix, '\\').'\\';

        //给base目录格式化，加上/到尾, DIRECTORY_SEPARATOR常量：win下是\，*nux下是/
        // test/fish/ 或 test/fish\ 都统一转化为 test/fish/
        $base_dir = rtrim($base_dir, DIRECTORY_SEPARATOR).'/';//rtrim删除字符串末尾空白或其他

        //初始化命名空间前缀数组
        if( isset($this->prefixes[$prefix]) === false ) {
            $this->prefixes[$prefix] = [];
        }

        //保留命名空间前缀的base目录
        $prepend?
            array_unshift($this->prefixes[$prefix], $base_dir) : array_push($this->prefixes[$prefix], $base_dir);
    }

    //根据给出的类名（一般前面会有一段命名空间）加载对应的类文件
    public function loadClass($class) {
        $prefix = $class;

        //迭代循环寻找命名空间与对应的文件路径
        while(false !== $pos = strrops($prefix, '\\')) {

            //把命名空间分割成两部分
            //1、类的命名空间的前部分，这里保留了\
            $prefix = substr($class, 0, $pos + 1);
            //2、类命名空间的后部分，也就是相对的类名
            $relative_class = substr($class, $pos + 1);

            //根据类的命名空间前缀 和 类名 加载对应的文件
            $mapped_file = $this->loadMappedFile($prefix, $relative_class);
            if($mapped_file) {
                return $mapped_file;
            }

            //移除命名空间尾部的\ 便于下次循环的strrpos
            $prefix = rtrim($prefix, '\\');
        }

        //找不到对应的文件
        return false;
    }

    //根据命名空间 和 类名加载对应的文件
    protected function loadMappedFile($prefix, $relative_class) {
        //该命名空间在数组中是否存有对应的 基文件路径 映射？
        if(isset($this->prefixes[$prefix]) === false) {
            return false;
        }

        //根据该命名空间找出对应的文件路径/目录
        foreach($this->prefixes[$prefix] as $base_dir) {
            //使用对应的文件路径替换相应的命名空间，用目录分隔符/替换命名空间\分隔符，然后给对应的类名加上.php后缀成为一个对应的类文件
            $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

            //如果对应的文件存在，则引入
            if($this->requireFile($file)) {
                return $file;
            }
        }

        //找不到对应的文件
        return false;
    }

    //判断文件是否存在并且引入
    protected function requireFile($file) {
        if(file_exists($file)) {
            require_once $file;
            return true;
        }
        return false;
    }

}
