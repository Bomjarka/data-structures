<?php

namespace App\Structures;

class CustomStack
{
    private array $list;

    private int $length;

    public function __construct()
    {
        $this->list = [];
        $this->length = 0;
    }

    public function getStack(): array
    {
        return $this->list;
    }

    public function getStackLength(): int
    {
        return $this->length;
    }

    public function push(mixed $value): void
    {
        $this->length++;
        $this->list[] = $value;
    }

    public function pop()
    {
        if (!$this->isEmpty()) {
            $this->length--;
        }

        return array_pop($this->list);
    }

    public function peek()
    {
        return $this->list[$this->length - 1];
    }

    public function isEmpty(): bool
    {
        return $this->length === 0;
    }


}