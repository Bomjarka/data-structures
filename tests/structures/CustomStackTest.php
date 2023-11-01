<?php

namespace Tests\Structures;

use App\Structures\CustomStack;
use PHPUnit\Framework\TestCase;

class CustomStackTest extends TestCase
{
    private CustomStack $customStack;

    private array $numbers = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

    public function setUp(): void
    {
        parent::setUp();
        $this->customStack = new CustomStack();
    }

    private function fillStack(): void
    {
        foreach ($this->numbers as $number) {
            $this->customStack->push($number);
        }
    }

    public function testGetStack(): void
    {
        $this->assertEmpty($this->customStack->getStack());
        $this->fillStack();
        $this->assertNotEmpty($this->customStack->getStack());
        $this->assertEquals($this->numbers, $this->customStack->getStack());
    }

    public function testGetStackLength(): void
    {
        $this->assertEmpty($this->customStack->getStack());
        $this->fillStack();
        $this->assertNotEmpty($this->customStack->getStack());
        $this->assertEquals(count($this->numbers), $this->customStack->getStackLength());
    }

    public function testPeekReturnsLastValueFromStack(): void
    {
        $this->assertEmpty($this->customStack->getStack());
        $this->fillStack();
        $this->assertEquals(end($this->numbers), $this->customStack->peek());

        $testValue = 'new last value';
        $this->customStack->push($testValue);
        $this->assertEquals($testValue, $this->customStack->peek());
    }

    public function testPushMethod(): void
    {
        $testValue = 'test';

        $this->assertEmpty($this->customStack->getStack());
        $this->customStack->push($testValue);
        $this->assertNotEmpty($this->customStack->getStack());
        $this->assertContains($testValue, $this->customStack->getStack());
    }

    public function testPushMethodAddValueToStackEnd(): void
    {
        $testValue = 'test';

        $this->assertEmpty($this->customStack->getStack());
        $this->fillStack();
        $this->assertEquals($this->numbers, $this->customStack->getStack());

        $this->customStack->push($testValue);
        $this->assertEquals($testValue, $this->customStack->getStack()[$this->customStack->getStackLength() - 1]);
    }

    public function testPopMethod(): void
    {
        $this->assertEmpty($this->customStack->getStack());
        $this->fillStack();

        $lastStackValue = $this->customStack->getStack()[$this->customStack->getStackLength() - 1];
        $poppedValue = $this->customStack->pop();

        $this->assertEquals($lastStackValue, $poppedValue);
        $this->assertEquals(count($this->numbers) -1, $this->customStack->getStackLength());
    }

    public function testPeekMethod():void
    {
        $this->assertEmpty($this->customStack->getStack());
        $this->fillStack();

        $lastStackValue = $this->customStack->getStack()[$this->customStack->getStackLength() - 1];
        $peekResult = $this->customStack->peek();

        $this->assertEquals($lastStackValue, $peekResult);
        $this->assertEquals(count($this->numbers), $this->customStack->getStackLength());
    }

    public function testIsEmptyMethod(): void
    {
        $this->assertEmpty($this->customStack->getStack());
        $this->assertTrue($this->customStack->isEmpty());

        $this->customStack->push(1);

        $this->assertNotEmpty($this->customStack->getStack());
        $this->assertFalse($this->customStack->isEmpty());
    }
}
