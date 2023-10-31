<?php

namespace App\Structures;

class HashTable
{
    private array $memory;

    public function __construct()
    {
        $this->memory = [];
    }

    /**
     * @return array
     */
    public function getTable(): array
    {
        return $this->memory;
    }

    /**
     * @param string $key
     * @return int
     */
    public function hashKey(string $key): int
    {
        $hash = 0;
        foreach (str_split($key) as $value) {
            $code = ord($value);
            $hash = (($hash << 5) - $hash) + $code | 0;
        }

        return $hash;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key): mixed
    {
        $address = $this->hashKey($key);

        return $this->memory[$address];
    }

    /**
     * @param $key
     * @param $value
     * @return void
     */
    public function set($key, $value): void
    {
        $address = $this->hashKey($key);

        $this->memory[$address] = $value;
    }

    /**
     * @param $key
     * @return void
     */
    public function delete($key): void
    {
        $address = $this->hashKey($key);

        unset($this->memory[$address]);
    }
}
