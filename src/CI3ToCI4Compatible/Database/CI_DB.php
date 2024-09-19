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
    
    /**
	 * LIMIT
	 *
	 * @param	int	$value	LIMIT value
	 * @param	int	$offset	OFFSET value
	 * @return	CI_DB_query_builder
	 */
    public function limit($value, $offset = 0)
	{
		is_null($value) OR $this->qb_limit = (int) $value;
		empty($offset) OR $this->qb_offset = (int) $offset;

		return $this;
	}
    
    /**
	 * Escape LIKE String
	 *
	 * Calls the individual driver for platform
	 * specific escaping for LIKE conditions
	 *
	 * @param	string|string[]
	 * @return	mixed
	 */
    public function escape_like_str($str)
	{
		return $this->escape_str($str, TRUE);
	}
    /**
	 * Platform-dependent string escape
	 *
	 * @param	string
	 * @return	string
	 */
    protected function escape_str($str)
	{
		return str_replace("'", "''", remove_invisible_characters($str, FALSE));
	}
}
