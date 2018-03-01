<?php

namespace Keven\Instantiator\Exception;

final class ConstructorIsNotPublic extends \BadMethodCallException implements InstantiatorException
{
    static public function fromClassName(string $className): ConstructorIsNotPublic
    {
        return new self("Constructor of class '$className' is not public.");
    }
}
