<?php

namespace Gdtf\Utils;

class DmxValue
{
    private int $value;
    private int $bits;

    public function __construct(string $value)
    {
        $this->value = (int) explode('/', $value)[0];
        $this->bits = (int) explode('/', $value)[1];
    }

    public function getValue()      { return $this->value; }
    public function getResolution() { return $this->bits; }
}