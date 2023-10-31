<?php

namespace Tests\Structures;

use App\Structures\CustomList;
use PHPUnit\Framework\TestCase;

class CustomListTest extends TestCase
{
    private array $numbers = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
    private CustomList $customList;
    public function setUp(): void
    {
        parent::setUp();
        $this->customList = new CustomList();
    }

    private function fillList(): void
    {
        foreach ($this->numbers as $number) {
            $this->customList->push($number);
        }
    }

    public function testGetList(): void
    {
        $this->assertEmpty($this->customList->getList());
        $this->fillList();

        $this->assertEquals($this->numbers, $this->customList->getList());
    }

    public function testGetListLength(): void
    {
        $this->assertEmpty($this->customList->getList());
        $this->fillList();

        $this->assertCount($this->customList->getListLength(), $this->customList->getList());
    }

    public function testGetReturnValueByAddress(): void
    {
        $this->assertEmpty($this->customList->getList());
        $address = $this->numbers[\random_int(0, count($this->numbers) - 1)];
        $needle = $this->numbers[$address];

        $this->fillList();

        $foundValue = $this->customList->get($address);
        $this->assertEquals($needle, $foundValue);
    }

    public function testPushAddValueToListEnd(): void
    {
        $newLastValue = 'test';
        $this->assertEmpty($this->customList->getList());

        $this->fillList();
        $this->assertNotEquals($newLastValue, $this->customList->get($this->customList->getListLength() - 1));

        $this->customList->push($newLastValue);
        $this->assertEquals($newLastValue, $this->customList->get($this->customList->getListLength() - 1));
    }

    public function testPopRemoveValueFromListEnd(): void
    {
        $this->assertEmpty($this->customList->getList());
        $this->fillList();

        $this->assertCount($this->customList->getListLength(), $this->numbers);
        $currentLastValue = $this->customList->get($this->customList->getListLength() - 1);
        $this->assertEquals($currentLastValue, $this->customList->get($this->customList->getListLength() - 1));

        $this->customList->pop();
        $this->assertNotEquals($currentLastValue, $this->customList->get($this->customList->getListLength() - 1));
        $this->assertNotCount($this->customList->getListLength(), $this->numbers);
    }

    public function testUnshiftAddValueToListStart(): void
    {
        $this->assertEmpty($this->customList->getList());
        $this->fillList();
        $newFirstValue = 'test';

        $this->fillList();
        $this->assertNotEquals($newFirstValue, $this->customList->get(0));

        $this->customList->unshift($newFirstValue);
        $this->assertEquals($newFirstValue, $this->customList->get(0));
    }

    public function testShiftRemoveValueFromListStart(): void
    {
        $this->assertEmpty($this->customList->getList());
        $this->fillList();

        $this->assertCount($this->customList->getListLength(), $this->numbers);
        $currentFirstValue = $this->customList->get(0);
        $this->assertEquals($currentFirstValue, $this->customList->get(0));

        $this->customList->shift();
        $this->assertNotEquals($currentFirstValue, $this->customList->get(0));
        $this->assertNotCount($this->customList->getListLength(), $this->numbers);
    }
}
