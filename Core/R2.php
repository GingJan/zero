<?php

class router
{
    public function getrouter($types = 1)//url模式
    {
        //提取.php文件后的路径，并且去掉/
        if (isset($_server['path_info'])) {//path_info返回index.php/path/to/others中php执行文件后面的路径，如这里的 /path/to/others ，注意前面的/
            $query_string = substr(str_replace(array('.html', '.htm', '.asp', '//'), '', $_server['path_info']), 1);//提取出 path/to/others
        } else {
            $query_string = str_replace($_server['script_name'], '', $_server['php_self']);
        }


        if ($types == 1) {
            // 第一种类型以/分隔
            $temp = explode('/', $query_string);
        } elseif ($types == 2) {
            $temp = explode('-', $query_string);
        } elseif ($types == 3) {//?controller=test类型
            return array('controller' => $_GET['controller']);
        }

        if (empty($temp[0])) {//如果没指定控制器，默认indexController
            return array('controller' => 'index', 'method' => 'index');
        }
        if (empty($temp[1])) {//默认方法
            $temp[] = 'index';
        }
        // 去除空项
        $url = [];
        foreach ($temp as $val) {
            if ($val) {
                $url[] = $val;
            }
        }

        list($controller, $method) = $url;//把数组对应的元素按次序放入变量中
        //有参数的情况
        $params = array();
        if (count($url) > 2) {
            array_shift($url);//出队，即把controller弹出
            array_shift($url);//出队，即把method弹出
            $params = $url;//获取参数
        }

        return
            array(
                "controller" => $controller,
                "method" => $method,
                "params" => $params,
            );
    }
}




/*
 * 调用
 <?php
$url = new route();
$url->getrouter(1);
print_r($url);

 */
?>