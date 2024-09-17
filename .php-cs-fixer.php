<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude([
            '.github',
            'build',
            'docs',
            'tests',
            'vendor',
    ])
    ->notPath('psalm_autoload.php')
    ->in(__DIR__);

$header = 'Copyright (c) 2024 Vipul Mangukiya

For the full copyright and license information, please view
the LICENSE.md file that was distributed with this source code.

@see https://github.com/vipulmangukiya/CI3ToCI4Compatible';

$config = new PhpCsFixer\Config();
return $config->setRules([
        'header_comment' => [
            'header' => $header,
            'comment_type' => 'comment',
            'location' => 'after_declare_strict'
        ]
    ])
    ->setFinder($finder);
