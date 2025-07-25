<?php
use PHPUnit\Framework\TestCase;

class TestHelloWorld extends TestCase
{
    public function testHelloWorld()
    {
        $this->assertEquals('Hello, World!', 'Hello, World!');
    }
}