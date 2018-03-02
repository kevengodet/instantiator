<?php

namespace Keven\Instantiator;

use Keven\Instantiator\Exception\ConstructorIsNotPublic;
use Keven\Instantiator\Exception\ArgumentIsRequired;

final class Instantiator
{
    public function instantiate(string $className, array $args = [])
    {
        $params = [];
        $class = new \ReflectionClass($className);

        if (!$constructor = $class->getConstructor()) {
            return $class->newInstanceWithoutConstructor();
        }

        if (!$constructor->isPublic()) {
            throw ConstructorIsNotPublic::fromClassName($className);
        }

        foreach($constructor->getParameters() as $param) {
            /* @var $param \ReflectionParameter */

            if (isset($args[$param->getName()])) {
                $params[] = $args[$param->getName()];
            } else {
                if (!$param->allowsNull() && !$param->isOptional()) {
                    throw ArgumentIsRequired::fromClassAndArgumentNames($className, $param->getName());
                }
                $params[] = $param->isDefaultValueAvailable() ? $param->getDefaultValue() : null;
            }
        }

        return $class->newInstanceArgs($params);
    }
}
