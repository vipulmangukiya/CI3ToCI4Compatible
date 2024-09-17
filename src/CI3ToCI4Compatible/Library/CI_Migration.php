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

use CodeIgniter\Database\Forge;
use CodeIgniter\Database\Migration;
use Durva\CI3ToCI4Compatible\Database\CI_DB;
use Durva\CI3ToCI4Compatible\Database\CI_DB_forge;

abstract class CI_Migration extends Migration
{
    /** @var CI_DB */
    protected $db_;

    /** @var CI_DB_forge */
    protected $dbforge;

    public function __construct(?Forge $forge = null)
    {
        parent::__construct($forge);

        $this->db_ = new CI_DB($this->db);
        $this->dbforge = new CI_DB_forge();
    }
}
