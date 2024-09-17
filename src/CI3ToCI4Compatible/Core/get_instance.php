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

use Vipul\CI3ToCI4Compatible\Core\CI_Controller;

function &get_instance(): CI_Controller
{
    return CI_Controller::get_instance();
}