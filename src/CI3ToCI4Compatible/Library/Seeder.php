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

namespace Durva\CI3ToCI4Compatible\Library;

use CodeIgniter\Database\BaseConnection;
use CodeIgniter\Database\Seeder as CI4Seeder;
use Config\Database;
use Durva\CI3ToCI4Compatible\Database\CI_DB;
use Durva\CI3ToCI4Compatible\Database\CI_DB_forge;

use function array_map;
use function is_array;
use function is_string;
use function rtrim;

/**
 * Seeder
 *
 * based on Seeder in ci-phpunit-test
 *  <https://github.com/kenjis/ci-phpunit-test/blob/master/application/libraries/Seeder.php>
 *  and extends CI4's Seeder.
 */
abstract class Seeder extends CI4Seeder
{
    /** @var CI_DB */
    protected $db_;

    /** @var CI_DB_forge */
    protected $dbforge;

    /** @var array */
    protected $depends = [];

    /** @var string */
    protected $seedPath_;

    public function __construct(Database $config, ?BaseConnection $db = null)
    {
        parent::__construct($config, $db);

        $this->db_ = new CI_DB($this->db);
        $this->dbforge = new CI_DB_forge();
    }

    /**
     * Set path for seeder files
     *
     * @param string $path
     */
    public function setPath_(string $path)
    {
        $this->seedPath_ = rtrim($path, '/') . '/';
    }

    /**
     * Run another seeder
     *
     * @param string $seeder           Seeder classname
     * @param bool   $callDependencies
     */
    public function call_(string $seeder, bool $callDependencies = true): void
    {
        if ($this->seedPath_ === null) {
            $this->seedPath_ = APPPATH . 'Database/Seeds/';
        }

        $obj = $this->loadSeeder($seeder);
        if ($callDependencies === true && $obj instanceof Seeder) {
            $obj->callDependencies($this->seedPath_);
        }

        $obj->run();
    }

    /**
     * Get Seeder instance
     */
    protected function loadSeeder(string $seeder): Seeder
    {
        $file = $this->seedPath_ . $seeder . '.php';
        require_once $file;

        $seederClassname = 'App\\Database\\Seeds\\' . $seeder;

        return new $seederClassname($this->config);
    }

    /**
     * Call dependency seeders
     */
    protected function callDependencies(string $seedPath): void
    {
        foreach ($this->depends as $path => $seeders) {
            $this->seedPath_ = $seedPath;
            if (is_string($path)) {
                $this->setPath_($path);
            }

            $this->callDependency($seeders);
        }

        $this->setPath_($seedPath);
    }

    /**
     * Call dependency seeder
     *
     * @param string|array $seederName
     */
    protected function callDependency($seederName): void
    {
        if (is_array($seederName)) {
            array_map([$this, 'callDependency'], $seederName);

            return;
        }

        $seeder = $this->loadSeeder($seederName);
        if (is_string($this->seedPath_)) {
            $seeder->setPath_($this->seedPath_);
        }

        $seeder->call_($seederName, true);
    }
}
