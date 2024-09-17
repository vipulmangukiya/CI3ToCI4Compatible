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

namespace Vipul\CI3ToCI4Compatible\Test\TestCase;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\FeatureTestTrait;
use Vipul\CI3ToCI4Compatible\Test\Traits\FeatureTest;
use Vipul\CI3ToCI4Compatible\Test\Traits\ResetInstance;
use Vipul\CI3ToCI4Compatible\Test\Traits\SessionTest;
use Kenjis\PhpUnitHelper\TestDouble;

class FeatureTestCase extends CIUnitTestCase
{
    use ResetInstance;
    use FeatureTest;
    use SessionTest;
    use TestDouble;
    use FeatureTestTrait;
    use DatabaseTestTrait;

    /**
     * Should run db migration?
     *
     * @var bool
     */
    protected $migrate = false;
}
