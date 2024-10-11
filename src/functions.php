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

if (!function_exists('db')) {
    function db(): Scrawler\Database
    {
        static $db;
        if (is_null($db)) {
            $db = new Scrawler\Database();
        }
        // @codeCoverageIgnoreStart
        if (class_exists("\Scrawler\App")) {
            if (!Scrawler\App::engine()->has('db')) {
                Scrawler\App::engine()->register('db', $db);
            }

            return Scrawler\App::engine()->db();
        }

        // @codeCoverageIgnoreEnd
        return $db;
    }
}

if (!function_exists('model')) {
    /**
     * @return Scrawler\Arca\Model
     */
    function model(string $model)
    {
        // @codeCoverageIgnoreStart
        if (class_exists("\Scrawler\App")) {
            return Scrawler\App::engine()->db()->create($model);
        }

        // @codeCoverageIgnoreEnd
        return db()->create($model);
    }
}

if (!function_exists('table_exists')) {
    /**
     * @return bool
     */
    function table_exists(string $table): mixed
    {
        return db()->tableExists($table);
    }
}

if (!function_exists('tables_exist')) {
    /**
     * @param array<string> $tables
     *
     * @return bool
     */
    function tables_exist(array $tables): mixed
    {
        return db()->tablesExist($tables);
    }
}
