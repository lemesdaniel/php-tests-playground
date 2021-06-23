<?php

namespace Training;

use PHPUnit\Framework\TestCase;

class HelloTest extends TestCase
{
    public function testHello()
    {
        $hello = new Hello('Fernando');
        parent::assertEquals('Hello, Fernando!', $hello->getMessage());
    }
}
