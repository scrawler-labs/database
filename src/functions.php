<?php

if (!function_exists("db")) {
    function db($connectionParams = null)
    {
        static $db;
        if (is_null($db)) {
            $db = new \Scrawler\Database();
        }
        if(class_exists("\Scrawler\App")){
            if(!\Scrawler\App::engine()->has('db')){
                \Scrawler\App::engine()->register("db", $db);
            }
            return \Scrawler\App::engine()->db();
        }
        return $db;
    }
}

if (!function_exists('model')) {
    function model($model)
    {
        if(class_exists("\Scrawler\App")){
        return \Scrawler\App\Scrawler::engine()->db()->create($model);
        }
        return db()->create($model);
    }
}