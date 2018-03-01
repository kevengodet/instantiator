<?php

namespace Keven\Instantiator\Exception;

final class ArgumentIsRequired extends \BadMethodCallException implements InstantiatorException
{
    static public function fromClassAndArgumentNames(string $className, string $argument): ArgumentIsRequired
    {
        return new self("Argument '$argument' is required to instantiate class '$className'.");
    }
}
