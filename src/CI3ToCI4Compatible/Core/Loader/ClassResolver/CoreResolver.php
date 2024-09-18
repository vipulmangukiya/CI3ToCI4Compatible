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

namespace Durva\CI3ToCI4Compatible\Core\Loader\ClassResolver;

class CoreResolver
{
    /** @var string */
    private $ci3CoreNamespace = 'Durva\CI3ToCI4Compatible\Core';

    /** @var string */
    private $prefix = 'CI_';

    public function resolve(string $class): string
    {
        return $this->ci3CoreNamespace . '\\' . $this->prefix . $class;
    }
}
