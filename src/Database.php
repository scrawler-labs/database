<?php

namespace Scrawler;
use Scrawler\Arca\Database as ArcaDatabase;
use Scrawler\Arca\Connection;
class Database
{

    private ArcaDatabase $db;

    public function connect($connectionParams = null)
    {
        if (is_null($connectionParams)) {
            if (class_exists("\Scrawler\App")) {
                $connectionParams = \Scrawler\App::engine()->config()->get("database");
            }else{
                throw new \Exception("Database connection parameters not provided");
            }
        }
        $connection = new Connection($connectionParams);
        $this->db = new ArcaDatabase($connection);
        return $this->db;
    }

    public function __call($function, $args)
    {
        if (is_null($this->db)) {
            throw new \Exception("Database connection not established please use db()->connect()");
        }
        return $this->db->$function(...$args);
    }

}