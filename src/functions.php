<?php
declare(strict_types=1);

if (!function_exists("db")) {
    /**
     * @return \Scrawler\Database
     */
    function db(): \Scrawler\Database
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
    /**
     * @param string $model
     * @return \Scrawler\Arca\Model
     */
    function model(string $model)
    {
        if(class_exists("\Scrawler\App")){
        return \Scrawler\App::engine()->db()->create($model);
        }
        return db()->create($model);
    }
}

if (!function_exists('table_exists')) {
    /**
     * @param string $table
     * @return bool
     */
    function table_exists(string $table): mixed
    {
       
        return db()->tableExists($table);
    }
}

if (!function_exists('table_exists')) {
    /**
     * @param array<string> $tables
     * @return bool
     */
    function tables_exist(array $tables): mixed
    {
       
        return db()->tablesExist($tables);
    }
}