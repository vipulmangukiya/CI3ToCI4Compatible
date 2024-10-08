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

use Durva\CI3ToCI4Compatible\Core\Loader\InSubDir;

use function explode;
use function implode;
use function strlen;
use function substr;
use function ucfirst;

class ModelResolver
{
    use InSubDir;

    /** @var string */
    private $namespace = 'App\\Models';

    public function resolve(string $model): string
    {
        if ($this->isFQCN($model)) {
            return $model;
        }

        if ($this->inSubDir($model)) {
            $parts = explode('/', $model);

            foreach ($parts as $key => $part) {
                $parts[$key] = ucfirst($part);
            }

            return $this->namespace . '\\' . implode('\\', $parts);
        }

        return $this->namespace . '\\' . ucfirst($model);
    }

    private function isFQCN(string $model): bool
    {
        if (substr($model, 0, strlen($this->namespace)) === $this->namespace) {
            return true;
        }

        return false;
    }
}
