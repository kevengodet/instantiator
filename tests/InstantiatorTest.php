<?php

namespace Keven\Instantiator\Tests;

use Keven\Instantiator\Instantiator;
use Keven\Instantiator\Tests\Fixtures\ClassWithoutConstructor;
use Keven\Instantiator\Tests\Fixtures\ClassWithZeroArg;
use Keven\Instantiator\Tests\Fixtures\ClassWithPrivateConstructor;
use Keven\Instantiator\Tests\Fixtures\ClassWithOnlyRequiredArgs;
use Keven\Instantiator\Tests\Fixtures\ClassWithOptionalArgs;

require_once __DIR__.'/fixtures/ClassWithoutConstructor.php';
require_once __DIR__.'/fixtures/ClassWithZeroArg.php';
require_once __DIR__.'/fixtures/ClassWithPrivateConstructor.php';
require_once __DIR__.'/fixtures/ClassWithOnlyRequiredArgs.php';
require_once __DIR__.'/fixtures/ClassWithOptionalArgs.php';

class InstantiatorTest extends \PHPUnit\Framework\TestCase
{
    function testNoConstructor()
    {
        $obj1 = (new Instantiator)->instantiate(ClassWithoutConstructor::class);
        $this->assertInstanceOf(ClassWithoutConstructor::class, $obj1);

        $obj2 = (new Instantiator)->instantiate(ClassWithoutConstructor::class, ['a' => 'b']);
        $this->assertInstanceOf(ClassWithoutConstructor::class, $obj2);
    }

    function testZeroArg()
    {
        $obj1 = (new Instantiator)->instantiate(ClassWithZeroArg::class);
        $this->assertInstanceOf(ClassWithZeroArg::class, $obj1);

        $obj2 = (new Instantiator)->instantiate(ClassWithZeroArg::class, ['a' => 'b']);
        $this->assertInstanceOf(ClassWithZeroArg::class, $obj2);
    }

    /** @expectedException \Keven\Instantiator\Exception\ConstructorIsNotPublic */
    function testPrivateConstructor()
    {
        (new Instantiator)->instantiate(ClassWithPrivateConstructor::class);
    }

    function testOnlyRequiredArgs()
    {
        $obj = (new Instantiator)->instantiate(ClassWithOnlyRequiredArgs::class, ['foo' => 'a', 'bar' => 2]);
        $this->assertInstanceOf(ClassWithOnlyRequiredArgs::class, $obj);
        $this->assertEquals('a', $obj->foo);
        $this->assertEquals(2, $obj->bar);
    }

    /** @expectedException \Keven\Instantiator\Exception\ArgumentIsRequired */
    function testMissingArguments()
    {
        (new Instantiator)->instantiate(ClassWithOnlyRequiredArgs::class);
    }

    function testDefaultValues()
    {
        $obj1 = (new Instantiator)->instantiate(ClassWithOptionalArgs::class, ['foo' => 'a', 'bar' => 3, 'baz' => [1, 2]]);
        $this->assertInstanceOf(ClassWithOptionalArgs::class, $obj1);
        $this->assertEquals('a', $obj1->foo);
        $this->assertEquals(3, $obj1->bar);
        $this->assertEquals([1, 2], $obj1->baz);

        $obj2 = (new Instantiator)->instantiate(ClassWithOptionalArgs::class, ['foo' => 'a', 'baz' => [1, 2]]);
        $this->assertInstanceOf(ClassWithOptionalArgs::class, $obj2);
        $this->assertEquals('a', $obj2->foo);
        $this->assertEquals(2, $obj2->bar);
        $this->assertEquals([1, 2], $obj2->baz);

        $obj3 = (new Instantiator)->instantiate(ClassWithOptionalArgs::class, ['foo' => 'a', 'bar' => 3]);
        $this->assertInstanceOf(ClassWithOptionalArgs::class, $obj3);
        $this->assertEquals('a', $obj3->foo);
        $this->assertEquals(3, $obj3->bar);
        $this->assertEquals([], $obj3->baz);

        $obj4 = (new Instantiator)->instantiate(ClassWithOptionalArgs::class, ['foo' => 'a']);
        $this->assertInstanceOf(ClassWithOptionalArgs::class, $obj4);
        $this->assertEquals('a', $obj4->foo);
        $this->assertEquals(2, $obj4->bar);
        $this->assertEquals([], $obj4->baz);
    }
}
