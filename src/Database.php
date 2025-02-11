<?php
/*
 * This file is part of the Scrawler package.
 *
 * (c) Pranjal Pandey <its.pranjalpandey@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Scrawler;

use Scrawler\Arca\Database as ArcaDatabase;
use Scrawler\Arca\Factory\DatabaseFactory;
use Scrawler\Arca\Model;

/**
 * Class Database.
 *
 * @mixin ArcaDatabase
 */
class Database
{
    private ?ArcaDatabase $db = null;

    /**
     * @param array<mixed> $connectionParams
     *
     * @throws \Exception
     */
    public function connect(array $connectionParams = []): Database
    {
        // @codeCoverageIgnoreStart
        if (class_exists("\Scrawler\App")) {
            $connectionParams = App::engine()->config()->get('database');
            $factory = new DatabaseFactory(App::engine()->container());
        } else {
            $factory = new DatabaseFactory();
            if ([] === $connectionParams) {
                throw new \Exception('Database connection parameters not provided');
            }
        }
        // @codeCoverageIgnoreEnd
        $this->db = $factory->build($connectionParams);

        return $this;
    }

    /**
     * @throws \Exception
     */
    public function saveRequest(string|Model $model): string|int
    {
        if (function_exists('request')) {
            if (is_string($model)) {
                $model = $this->create($model);
            }
            foreach (request()->all() as $key => $value) {
                if ('csrf' != $key) {
                    $model->$key = $value;
                }
            }

            return $model->save();
        } else {
            // @codeCoverageIgnoreStart
            throw new \Exception("scrawler\http is required to use this function");
            // @codeCoverageIgnoreEnd
        }
    }

    /**
     * @throws \Exception
     */
    public function bindRequest(string|Model $model): Model
    {
        if (function_exists('app')) {
            if (is_string($model)) {
                $model = $this->create($model);
            }
            foreach (app()->request()->all() as $key => $value) {
                if ('csrf' != $key) {
                    $model->$key = $value;
                }
            }

            return $model;
        } else {
            // @codeCoverageIgnoreStart
            throw new \Exception("scrawler\scrawler is required to use this function");
            // @codeCoverageIgnoreEnd
        }
    }

    /**
     * @param array<mixed> $args
     *
     * @throws \Exception
     */
    public function __call(string $function, array $args): mixed
    {
        if (is_null($this->db)) {
            throw new \Exception('Database connection not established please use db()->connect()');
        }

        return $this->db->$function(...$args);
    }
}
