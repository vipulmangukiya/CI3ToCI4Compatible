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

namespace Durva\CI3ToCI4Compatible\Test\Traits;

use Config\Services;
use Durva\CI3ToCI4Compatible\Core\CI_Controller;
use Durva\CI3ToCI4Compatible\Core\CoreLoader;

use function get_instance;

/**
 * @internal
 */
trait ResetInstance
{
    /** @var string */
    protected $controllerClass = 'App\Controllers\MY_Controller';

    /** @var CI_Controller */
    protected $CI;

    /**
     * Reset CodeIgniter instance and assign new CodeIgniter instance as $this->CI
     */
    public function resetInstance(bool $useMyController = false): void
    {
        new CoreLoader();

        $this->createCodeIgniterInstance($useMyController);
        $this->CI =& get_instance();
    }

    /**
     * Reset Services
     */
    public function resetServices(bool $initAutoloader = true): void
    {
        Services::reset($initAutoloader);

        // Reload routes
        require APPPATH . 'Config/Routes.php';
    }

    public function createCodeIgniterInstance(
        bool $useMyController = false
    ): CI_Controller {
        if ($useMyController) {
            return new $this->controllerClass();
        }

        return new CI_Controller();
    }
}
