<?php


class SlidingWindow
{
    public function execute(array $nums): array
    {
        $l = 0; // правый указатель
        $r = 0; // левый указатель

        while ($r < count($nums)) {
            $val = $nums[$r];

            if ($val < 4) {
                $l++; // сдвигаем окно
            }

            $r++; // увеличиваем размер окна
        }

        return array_slice($nums, $l, $r);
    }
}

//var_dump(
//    (new SlidingWindow())->execute([2, 3, 4, 5, 6]) // [2], [3], [4], [4, 5], [4, 5, 6]
//);

class FastSlowPointers
{
    public function execute(array $nums): array
    {
        $slow = $nums[0];
        $fast = $nums[0];

        do {
            $slow = $nums[$slow]; // медленный указатель перемещается на один шаг
            $fast = $nums[$nums[$fast]]; // быстрый указатель перемещается на два шага

            var_dump(sprintf('%d - %d', $slow, $fast));
        } while ($slow !== $fast);

        return [];
    }
}

//var_dump(
//    (new FastSlowPointers())->execute([4, 3, 1, 2, 0])
//);

class TwoPointers
{
    public function execute(array $nums): ?array
    {
        $l = 0;
        $r = count($nums) - 1;
        $result = [];

        while ($l <= $r) {
            $result[] = sprintf('%d - %d', $nums[$l], $nums[$r]);

            $l++;
            $r--;
        }

        return $result;
    }
}

//var_dump(
//    (new TwoPointers())->execute([2, 3, 4]) // ["2 - 4", "3 - 3"]
//);


class Palindrome
{
    public function execute(string $text): bool
    {
        $l = 0;
        $r = strlen($text) - 1;

        while ($l < $r) {
            if ($text[$l] !== $text[$r]) {
                return false;
            }

            $l++;
            $r--;
        }

        return true;
    }
}

//var_dump(
//    (new Palindrome())->execute('adtsstda')
//);

class BinarySearch
{
    public function execute(array $nums, int $n): ?int
    {
        $l = 0;
        $r = count($nums) - 1;

        // выполняем бинарный поиск
        while ($l <= $r) {
            // определяем индекс середины массива
            $middle = floor(($l + $r) / 2);

            // если нашли, то возвращаем результат
            if ($n === $nums[$middle]) {
                return $middle;
            }

            // если текущее значение меньше целевого значения, то целевое значение находится в правой части
            if ($nums[$middle] < $n) {
                $l = $middle + 1;
            } else {
                $r = $middle - 1;
            }
        }

        return null;
    }
}

//var_dump(
//    (new BinarySearch())->execute([0, 1, 2, 3, 4, 5], 4)
//);


class Fibonacci
{
    public function execute(int $n): int
    {
        $fib[0] = 0;
        $fib[1] = 1;

        for ($i = 2; $i <= $n; $i++) {
            $fib[$i] = $fib[$i - 2] + $fib[$i - 1];
        }

        return $fib[$n];
    }
}

//var_dump(
//    (new Fibonacci())->execute(7)
//);

class Factorial
{
    public function execute(int $n): int
    {
        $fact = 1;
        for ($i = 1; $i <= $n; $i++) {
            $fact *= $i;
        }

        return $fact;
    }
}

//var_dump(
//    (new Factorial())->execute(5)
//);

class Sort
{
    public function execute(array $nums): array
    {
        $result = [];

        while (count($nums) > 0) {
            $min = null;
            $minInd = null;

            foreach ($nums as $inx => $num) {
                if ($min === null || $num < $min) {
                    $min = $num;
                    $minInd = $inx;
                }
            }

            $result[] = $min;
            array_splice($nums, $minInd, 1);
        }

        return $result;
    }
}

//var_dump(
//    (new Sort())->execute([4, 3, 1, 2, 0])
//);









































