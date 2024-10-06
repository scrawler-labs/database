<?php
declare(strict_types=1);

namespace Scrawler;
use Scrawler\Arca\Database as ArcaDatabase;
use Scrawler\Arca\Connection;

/**
 * Class Database
 * @package Scrawler
 * @mixin ArcaDatabase
 */
class Database
{

    /**
     * @var ArcaDatabase|null
     */
    private ArcaDatabase|null $db = null;



    /**
     * @param array<mixed>|null $connectionParams
     * @return Database
     * @throws \Exception
     */
    public function connect(array $connectionParams = null): Database
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
        return $this;
    }

    /**
     * 
     * @param string $function
     * @param array<mixed> $args
     * @return mixed
     * @throws \Exception
     */
    public function __call(string $function,array $args)
    {
        if (is_null($this->db)) {
            throw new \Exception("Database connection not established please use db()->connect()");
        }
        return $this->db->$function(...$args);
    }



}