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