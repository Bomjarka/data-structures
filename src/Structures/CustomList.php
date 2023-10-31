<?php
declare(strict_types=1);

namespace App\Structures;

class CustomList
{
    private array $memory;
    private int $length ;
    public function __construct()
    {
        $this->memory = [1];
        $this->length = 0;
    }

    /**
     * @return array
     */
    public function getList(): array
    {
        return $this->memory;
    }

    /**
     * @return int
     */
    public function getListLength(): int
    {
        return $this->length;
    }

    /**
     * @param int $address
     * @return mixed
     */
    public function get(int $address): mixed
    {
        return $this->memory[$address];
    }

    /**
     * @param mixed $value
     * @return int
     */
    public function push(mixed $value): int
    {
        $this->memory[$this->length] = $value;
        $valAddress = $this->length;
        $this->length++;

        return $valAddress;
    }

    /**
     * @return mixed|void
     */
    public function pop()
    {
        if ($this->length === 0) {
            return;
        }
        $lastIndex = $this->length - 1;
        $value = $this->memory[$lastIndex];
        unset($this->memory[$lastIndex]);
        $this->length--;

        return $value;
    }

    /**
     * @param mixed $value
     * @return void
     */
    public function unshift(mixed $value): void
    {
        $prev = $value;

        for ($address = 0; $address < $this->length; $address++) {
            $current = $this->memory[$address];
            $this->memory[$address] = $prev;
            $prev = $current;
        }

        $this->memory[$this->length] = $prev;
        $this->length++;
    }

    /**
     * @return void
     */
    public function shift()
    {
        if ($this->length === 0) {
            return;
        }

        for ($address = 0; $address < $this->length - 1; $address++) {
            $this->memory[$address] = $this->memory[$address + 1];
        }

        unset($this->memory[$this->length - 1]);
        $this->length--;
    }
}

