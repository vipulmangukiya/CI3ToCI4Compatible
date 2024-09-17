<?php

declare(strict_types=1);

/*
 * Copyright (c) 2024 Vipul Mangukiya
 *
 * For the full copyright and license information, please view
 * the LICENSE.md file that was distributed with this source code.
 *
 * @see https://github.com/vipulmangukiya/CI3ToCI4Compatible
 */

namespace Vipul\CI3ToCI4Compatible\Core\Loader;

use Config\Database;
use Vipul\CI3ToCI4Compatible\Database\CI_DB;
use Vipul\CI3ToCI4Compatible\Database\CI_DB_forge;

class DatabaseLoader
{
    /** @var ControllerPropertyInjector */
    private $injector;

    /** @var CI_DB */
    private $db;

    /** @var CI_DB_forge */
    private $dbforge;

    public function __construct(ControllerPropertyInjector $injector)
    {
        $this->injector = $injector;
    }

    public function load($params = '', $return = false, $query_builder = null)
    {
        if (
            $return === false && $query_builder === null
            && isset($this->db)
        ) {
            return false;
        }

        if ($params === '') {
            $params = null;
        }

        if ($return) {
            $connection = Database::connect($params, false);

            return new CI_DB($connection);
        }

        if ($this->db === null) {
            $connection = Database::connect($params, false);
            $this->db = new CI_DB($connection);
            $this->injector->inject('db', $this->db);

            return $this->db;
        }

        return false;
    }

    public function loadDbForge(?object $db, bool $return): CI_DB_forge
    {
        if ($return) {
            return new CI_DB_forge($db);
        }

        if ($this->dbforge === null) {
            $this->dbforge = new CI_DB_forge();
            $this->injector->inject('dbforge', $this->dbforge);
        }

        return $this->dbforge;
    }
}
