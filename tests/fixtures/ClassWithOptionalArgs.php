<?php

namespace Keven\Instantiator\Tests\Fixtures;

class ClassWithOptionalArgs
{
    public function __construct(string $foo, int $bar = 2, array $baz = [])
    {
        $this->foo = $foo;
        $this->bar = $bar;
        $this->baz = $baz;
    }
}