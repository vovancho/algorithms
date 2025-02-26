<?php

class HashTable
{
    private array $buckets;
    private int $size;

    public function __construct(int $size)
    {
        $this->size = $size;
        $this->buckets = array_fill(0, $size, null);
    }

    public function insert(int $key, string $value): void
    {
        $index = $this->hash($key);
        $this->buckets[$index] = $this->buckets[$index] ?? [];

        foreach ($this->buckets[$index] as [$kvPairKey, &$vPairValue]) {
            if ($kvPairKey === $key) {
                $vPairValue = $value;
                return;
            }
        }

        $this->buckets[$index][] = [$key, $value];
    }

    public function find(int $key): ?string
    {
        $index = $this->hash($key);

        if (!isset($this->buckets[$index])) {
            return null;
        }

        foreach ($this->buckets[$index] as [$kvPairKey, $vPairValue]) {
            if ($kvPairKey === $key) {
                return $vPairValue;
            }
        }

        return null;
    }

    private function hash(int $key): int
    {
        return $key % $this->size;
    }
}

$hashTable = new HashTable(3); // уменьшаем размер таблицы для увеличения вероятности коллизий

// вставляем ключи, которые вызывают коллизии: 3 % 3 = 0, 6 % 3 = 0
$hashTable->insert(3, 'val3');
$hashTable->insert(6, 'val6'); // эти ключи имеют одинаковый остаток от деления на 3

echo 'Значение для 3: ' . $hashTable->find(3) . PHP_EOL; // выводит: val3
echo 'Значение для 6: ' . $hashTable->find(6) . PHP_EOL; // выводит: val6

// [
// # hash func: 3 % 3 === 0, 6 % 3 === 0
//     0 => [[3, 'val3'], [6, 'val6']], // идем по цепочке и сравниваем переданный ключ с первым элементом в значении списка
//     1 => null,
//     2 => null,
// ]
