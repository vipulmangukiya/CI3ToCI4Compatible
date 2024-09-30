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

namespace Durva\CI3ToCI4Compatible\Core;

class CI_URI
{
    /**
	 * Fetch URI Segment
	 *
	 * @see		CI_URI::$segments
	 * @param	int		$n		Index
	 * @param	mixed		$no_result	What to return if the segment index is not found
	 * @return	mixed
	 */
	public function segment($n, $no_result = NULL)
	{   
        $segments = service('uri')->getSegments();
		return isset($segments[$n]) ? $segments[$n] : $no_result;
	}
}
