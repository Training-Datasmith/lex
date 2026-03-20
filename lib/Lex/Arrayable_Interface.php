<?php

declare (strict_types=1);
namespace Lex;

/**
 * Part of the Lex Template Parser.
 *
 * @author     PyroCMS Team
 * @license    MIT License
 * @copyright  2011 - 2014 PyroCMS
 */
interface Arrayable_Interface
{
    /**
     * Convert the object to an array
     *
     * @return array
     */
    public function to_array();
}