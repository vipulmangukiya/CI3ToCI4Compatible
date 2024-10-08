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

use CodeIgniter\HTTP\UserAgent;
use Config\Services;

class CI_User_agent
{
    /** @var UserAgent */
    private $agent;

    /**
     * Constructor
     *
     * Sets the User Agent and runs the compilation routine
     *
     * @return  void
     */
    public function __construct()
    {
        $request = Services::request();
        $this->agent = $request->getUserAgent();
    }

    /**
     * Is Mobile
     *
     * @param   string $key
     *
     * @return  bool
     */
    public function is_mobile(?string $key = null): bool
    {
        return $this->agent->isMobile($key);
    }
}
