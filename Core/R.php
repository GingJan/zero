<?php

define('CONTROLLER_DIR', './Controller/');//存放controller的物理目录路径
$APP_PATH= str_replace($_SERVER['DOCUMENT_ROOT'], '', __FILE__);//去掉当前文件的根目录，得到以本应用的开头的路径
$SE_STRING=str_replace($APP_PATH, '', $_SERVER['REQUEST_URI']);    //计算出index.php后面的字段 如appname/index.php/controller/method/id/3，这里就是/controller/method/id/3
$SE_STRING=trim($SE_STRING,'/');
//echo $SE_STRING.'<br>';
//这里需要对$SE_STRING进行过滤处理。
$ary_url=array(
    'controller'=>'index',//controller默认indexController
    'method'=>'index',//默认index方法
    'params'=>array()//默认无参数
);
//var_dump($ary_url);
$ary_se=explode('/', $SE_STRING);//拆成['controller', 'method', 'params']
$se_count=count($ary_se);//多少段

//路由控制
if($se_count==1 && $ary_se[0]!='' ){//只有一段也就controller
    $ary_url['controller']=$ary_se[0];

}else if($se_count>1){//计算后面的参数，key-value
    $ary_url['controller']=$ary_se[0];
    $ary_url['method']=$ary_se[1];
    if($se_count>2 && $se_count%2!=0){ //取模运算，判断是否偶数，否则没有形成key-value形式
        die('参数错误');
    }else{
        for($i=2;$i < $se_count;$i=$i+2){//处理controller/method/后面的全部key-value对
            $ary_kv_hash=array(strtolower($ary_se[$i])=>$ary_se[$i+1]);//取出url中的key和value对，并组成数组
            $ary_url['params']=array_merge($ary_url['params'],$ary_kv_hash);//把参数数组全部合并到params中
        }
    }
}


$controller=$ary_url['controller'];
$controller_file=CONTROLLER_DIR.$controller.'.class.php';//找出控制器的对应物理文件路径
//echo $controller_file;
$method_name=$ary_url['method'];
if(file_exists($controller_file)){
    include($controller_file);
    $ControllerObj=new $controller();    //实例化控制器

    if(!method_exists($ControllerObj, $method_name)){
        die('方法不存在');
    }else{
        if(is_callable(array($ControllerObj, $method_name))){    //该方法是否能被调用
            //var_dump($ary_url[pramers]);
            $get_return=$ControllerObj->$method_name($ary_url['params']);    //执行a方法,并把key-value参数的数组传过去
            if(!is_null($get_return)){ //返回值不为空
                var_dump($get_return);
            }
        }else{
            die('该方法不能被调用');
        }
    }
}
else
{
    die('控制器文件不存在');
}

