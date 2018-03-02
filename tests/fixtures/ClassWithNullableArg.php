<?php

namespace Keven\Instantiator\Tests\Fixtures;

class ClassWithNullableArg
{
    public function __construct(string $foo, ?int $bar)
    {
        $this->foo = $foo;
        $this->bar = $bar;
    }
}