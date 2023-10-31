<?php

namespace Tests\Structures;

use App\Structures\HashTable;
use PHPUnit\Framework\TestCase;

class HashTableTest extends TestCase
{
    private HashTable $hashTable;

    private $data = [
        'name' => 'Test',
        'age' => '20',
    ];
    public function setUp(): void
    {
        parent::setUp();
        $this->hashTable = new HashTable();
    }

    /**
     * @return void
     */
    private function fillHashTable(): void
    {
        foreach ($this->data as $key => $value) {
            $this->hashTable->set($key, $value);
        }
    }

    public function testGetTable(): void
    {
        $this->assertEmpty($this->hashTable->getTable());
        $this->fillHashTable();

        $this->assertNotEmpty($this->hashTable->getTable());

        $result = $this->hashTable->getTable();
        $this->assertIsArray($result);

        foreach (array_keys($this->data) as $arrayKey) {
            $this->assertArrayHasKey($this->hashTable->hashKey($arrayKey), $result);
        }
    }

    public function testGetReturnValueByKey(): void
    {
        $this->assertEmpty($this->hashTable->getTable());
        $this->fillHashTable();

        $name = $this->hashTable->get('name');
        $age = $this->hashTable->get('age');

        $this->assertEquals($this->data['name'], $name);
        $this->assertEquals($this->data['age'], $age);
    }

    public function testSetValueByKey(): void
    {
        $this->assertEmpty($this->hashTable->getTable());
        $this->assertNull($this->hashTable->get('name'));
        $this->assertNull($this->hashTable->get('age'));

        $this->hashTable->set('name', $this->data['name']);
        $this->assertNotNull($this->hashTable->get('name'));
        $this->assertEquals($this->data['name'], $this->hashTable->get('name'));

        $this->hashTable->set('age', $this->data['age']);
        $this->assertNotNull($this->hashTable->get('age'));
        $this->assertEquals($this->data['age'], $this->hashTable->get('age'));
    }

    public function testDeleteValueByKey(): void
    {
        $this->assertEmpty($this->hashTable->getTable());
        $this->fillHashTable();
        $this->assertNotNull($this->hashTable->get('name'));
        $this->assertNotNull($this->hashTable->get('age'));

        $this->hashTable->delete('age');
        $this->assertNull($this->hashTable->get('age'));
        $this->assertNotNull($this->hashTable->get('name'));
    }
}
