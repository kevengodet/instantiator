<?php

namespace Keven\Instantiator\Tests\Fixtures;

class ClassWithOnlyRequiredArgs
{
    public function __construct(string $foo, int $bar)
    {
        $this->foo = $foo;
        $this->bar = $bar;
    }
}