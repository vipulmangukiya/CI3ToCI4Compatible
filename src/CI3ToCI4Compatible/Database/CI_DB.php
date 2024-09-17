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

namespace Durva\CI3ToCI4Compatible\Database;

class CI_DB extends CI_DB_query_builder
{
    /**
     * Insert ID
     *
     * @return  int
     */
    public function insert_id(): int
    {
        return $this->db->insertID();
    }

    /**
     * Affected Rows
     *
     * @return  int
     */
    public function affected_rows(): int
    {
        return $this->db->affectedRows();
    }
}
