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
use function in_array;
use function ucfirst;

class LibraryResolver
{
    use InSubDir;

    /** @var string */
    private $ci3LibraryNamespace = 'Durva\CI3ToCI4Compatible\Library';

    /** @var string[] */
    private $ci3Libraries = [
        'cache',
        'email',
        'encryption',
        'form_validation',
        'image_lib',
        'pagination',
        'parser',
        'session',
        'upload',
        'user_agent',
    ];

    /** @var string */
    private $prefix = 'CI_';

    /** @var string */
    private $userLibraryNamespace = 'App\Libraries';

    public function resolve(string $library): string
    {
        $classname = $this->resolveCI3Library($library);

        if ($classname === null) {
            $classname = $this->resolveUserLibrary($library);
        }

        return $classname;
    }

    private function resolveCI3Library(string $library): ?string
    {
        $classname = $this->prefix . ucfirst($library);
        if (in_array($library, $this->ci3Libraries, true)) {
            return $this->ci3LibraryNamespace . '\\' . $classname;
        }

        return null;
    }

    private function resolveUserLibrary(string $library): string
    {
        if ($this->inSubDir($library)) {
            $parts = explode('/', $library);

            foreach ($parts as $key => $part) {
                $parts[$key] = ucfirst($part);
            }

            return $this->userLibraryNamespace . '\\' . implode('\\', $parts);
        }

        return $this->userLibraryNamespace . '\\' . ucfirst($library);
    }
}
