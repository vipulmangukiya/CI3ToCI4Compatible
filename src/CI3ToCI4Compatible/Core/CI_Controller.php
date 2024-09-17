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

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Durva\CI3ToCI4Compatible\Internal\DebugLog;
use Psr\Log\LoggerInterface;

/**
 * @property CI_Input $input
 */
#[\AllowDynamicProperties]
class CI_Controller extends BaseController
{
    /** @var CI_Controller */
    private static $instance;

    /** @var CI_Loader */
    public $load;

    public function __construct()
    {
        $message = 'Creating Controller "' . static::class . '"';
        DebugLog::log(__METHOD__, $message);

        self::$instance =& $this;

        $this->load = new CI_Loader();
        $this->load->setController($this);

        $this->autoloadLibraries();
        $this->autoloadHelpers();
    }

    private function autoloadLibraries()
    {
        if (! isset($this->libraries)) {
            return;
        }

        foreach ($this->libraries as $library) {
            if ($library === 'database') {
                $this->load->database();

                continue;
            }

            $this->load->library($library);
        }
    }

    private function autoloadHelpers()
    {
        $this->load->helper($this->helpers);
    }

    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ): void {
        parent::initController($request, $response, $logger);
    }

    public static function &get_instance(): CI_Controller
    {
        // In case when called without instantiation
        if (self::$instance === null) {
            new CI_Controller();
        }

        return self::$instance;
    }
}
