<?php

class HashTable
{
    public array $table;
    private int $size;

    public function __construct(int $size)
    {
        $this->size = $size;
        $this->table = array_fill(0, $size, null);
    }

    private function primaryHash(int $key): int
    {
        // Простая хеш-функция для создания коллизий
        return $key % $this->size;
    }

    private function secondaryHash(int $key): int
    {
        // Вторичная хеш-функция
        return 1 + $key % $this->size;
    }

    public function insert(int $key, string $value): void
    {
        $index = $this->primaryHash($key);
        $stepSize = $this->secondaryHash($key);

        while ($this->table[$index] !== null && $this->table[$index][0] !== $key) {
            $index = ($index + $stepSize);
            var_dump($key . ' ind ' . $index);
        }


        $this->table[$index] = [$key, $value];
    }

    public function find(int $key): ?string
    {
        $index = $this->primaryHash($key);
        $stepSize = $this->secondaryHash($key);

        while ($this->table[$index] !== null) {
            if ($this->table[$index][0] === $key) {
                return $this->table[$index][1];
            }

            $index = ($index + $stepSize);
        }

        return null;
    }
}

// Пример использования
$hashTable = new HashTable(3); // уменьшаем размер таблицы для увеличения вероятности коллизий

// Эти ключи должны вызвать коллизию
$hashTable->insert(3, 'val3');
$hashTable->insert(6, 'val6'); // эти ключи имеют одинаковый остаток от деления на 3
$hashTable->insert(9, 'val9'); // эти ключи имеют одинаковый остаток от деления на 3

echo "Значение для 3: " . $hashTable->find(3) . PHP_EOL; // выводит: val3
echo "Значение для 6: " . $hashTable->find(6) . PHP_EOL; // выводит: val6
echo "Значение для 9: " . $hashTable->find(9) . PHP_EOL; // выводит: val9

// [
//     0 => [3, 'val3'], # hash func: 3 % 3 === 0 (primary)                                          |(0)
//     1 => [6, 'val6'], # hash func: 6 % 3 === 0 (primary), 1 + 6 % 3 === 1 (secondary)             | 0 + 1 = (1)
//     2 => [9, 'val9'], # hash func: 9 % 3 === 0 (primary), 1 + 9 % 3 === 1 (secondary) | 0 + 1 = 1 | 1 + 1 = (2)
// ]
