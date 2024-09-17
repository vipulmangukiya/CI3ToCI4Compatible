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

use CodeIgniter\View\Parser;
use Config\Services;

class CI_Parser
{
    /** @var Parser */
    private $parser;

    /**
     * @return  void
     */
    public function __construct(?string $viewPath = null)
    {
        $this->parser = Services::parser($viewPath, null, false);
    }

    /**
     * Parse a template
     *
     * Parses pseudo-variables contained in the specified template view,
     * replacing them with the data in the second param
     *
     * @param   string
     * @param   array
     * @param   bool
     *
     * @return  string
     */
    public function parse($template, $data, $return = false)
    {
        $output = $this->parser->setData($data)->render($template);

        if ($return) {
            return $output;
        }

        echo $output;
    }

    /**
     * Parse a String
     *
     * Parses pseudo-variables contained in the specified string,
     * replacing them with the data in the second param
     *
     * @param   string
     * @param   array
     * @param   bool
     *
     * @return  string
     */
    public function parse_string($template, $data, $return = false)
    {
        $output = $this->parser->setData($data)->renderString($template);

        if ($return) {
            return $output;
        }

        echo $output;
    }

    /**
     * Set the left/right variable delimiters
     *
     * @param   string
     * @param   string
     *
     * @return  void
     */
    public function set_delimiters($l = '{', $r = '}')
    {
        $this->parser->setDelimiters($l, $r);
    }
}
