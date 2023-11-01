<?php

namespace Tests\structures;

use App\Structures\Queue;
use PHPUnit\Framework\TestCase;

class QueueTest extends TestCase
{

    private Queue $queue;
    private array $numbers = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

    protected function setUp(): void
    {
        parent::setUp();
        $this->queue = new Queue();
    }

    private function fillQueue(): void
    {
        foreach ($this->numbers as $number) {
            $this->queue->enequeue($number);
        }
    }

    public function testGetQueue(): void
    {
        $this->assertEmpty($this->queue->getQueue());
        $this->fillQueue();
        $this->assertNotEmpty($this->queue->getQueue());
        $this->assertEquals($this->numbers, $this->queue->getQueue());
    }

    public function testGetQueueLength(): void
    {
        $this->assertEmpty($this->queue->getQueue());
        $this->fillQueue();
        $this->assertNotEmpty($this->queue->getQueue());
        $this->assertEquals(count($this->numbers), $this->queue->getQueueLength());
    }

    public function testPeekReturnsFirstValueFromQueue(): void
    {
        $this->assertEmpty($this->queue->getQueue());
        $this->fillQueue();
        $this->assertEquals($this->numbers[0], $this->queue->peek());

        $testValue = 'new first value';
        $this->queue->enequeue($testValue);
        $this->assertEquals($testValue, $this->queue->getQueue()[$this->queue->getQueueLength() - 1]);
    }

    public function testEnequeueMethod(): void
    {
        $testValue = 'test';

        $this->assertEmpty($this->queue->getQueue());
        $this->queue->enequeue($testValue);
        $this->assertNotEmpty($this->queue->getQueue());
        $this->assertContains($testValue, $this->queue->getQueue());
    }

    public function testEnequeueMethodAddValueToQueueEnd(): void
    {
        $testValue = 'test';

        $this->assertEmpty($this->queue->getQueue());
        $this->fillQueue();
        $this->assertEquals($this->numbers, $this->queue->getQueue());

        $this->queue->enequeue($testValue);
        $this->assertEquals($testValue, $this->queue->getQueue()[$this->queue->getQueueLength() - 1]);
    }

    public function testDequeueMethod(): void
    {
        $this->assertEmpty($this->queue->getQueue());
        $this->fillQueue();

        $firstQueueValue = $this->queue->getQueue()[0];
        $dequeuedValue = $this->queue->dequeue();

        $this->assertEquals($firstQueueValue, $dequeuedValue);
        $this->assertEquals(count($this->numbers) -1, $this->queue->getQueueLength());
    }

    public function testPeekMethod():void
    {
        $this->assertEmpty($this->queue->getQueue());
        $this->fillQueue();

        $firstQueueValue = $this->queue->getQueue()[0];
        $peekResult = $this->queue->peek();

        $this->assertEquals($firstQueueValue, $peekResult);
        $this->assertEquals(count($this->numbers), $this->queue->getQueueLength());
    }

    public function testIsEmptyMethod(): void
    {
        $this->assertEmpty($this->queue->getQueue());
        $this->assertTrue($this->queue->isEmpty());

        $this->queue->enequeue(1);

        $this->assertNotEmpty($this->queue->getQueue());
        $this->assertFalse($this->queue->isEmpty());
    }
}