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
class Arrayable_Object_Example implements Arrayable_Interface
{
    /**
     * Attributes
     *
     * @var array
     */
    private $attributes = ['foo' => 'bar'];
    /**
     * Define how the object will be converted to an array
     *
     * @return array
     */
    public function to_array()
    {
        return $this->attributes;
    }
}