<?php

namespace App\Structures;

class Queue
{
    private array $list;

    private int $length;

    public function __construct()
    {
        $this->list = [];
        $this->length = 0;
    }

    /**
     * @return array
     */
    public function getQueue(): array
    {
        return $this->list;
    }

    /**
     * @return int
     */
    public function getQueueLength(): int
    {
        return $this->length;
    }

    public function isEmpty(): bool
    {
        return $this->length === 0;
    }

    /**
     * @param mixed $value
     * @return void
     */
    public function enequeue(mixed $value): void
    {
        $this->length++;
        $this->list[] = $value;
    }

    /**
     * @return mixed|null
     */
    public function dequeue(): mixed
    {
        if (!$this->isEmpty()) {
            $this->length--;
        }

        return array_shift($this->list);
    }

    public function peek()
    {
        return $this->list[0];
    }
}