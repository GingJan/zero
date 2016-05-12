<?php
/**
 * Created by PhpStorm.
 * User: zjien
 * Date: 4/18/16
 * Time: 3:32 PM
 */
namespace Core;

class Router {

    protected $path;

    public function __construct() {
        $this->path = trim($_SERVER['REQUEST_URI'], '/');
    }

    public function filter() {
        $uri = trim($this->path);
        $uri_array = explode('/', $uri);
        $count = count($uri_array);
        return $count;
//        var_dump($this->path);
//        var_dump($uri);
//        var_dump($uri_array[0]);

    }
}