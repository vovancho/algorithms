<?php
/**
 * $nums - повернутый отсортированный целочисленный массив. (повернутый - смещенный индекс). $target - значение массива $nums.
 * Задача состоит в том, чтобы найти индекс значения $target или -1, если не найдено, в массиве $nums, используя бинарный поиск O(log n).
 * Индекс искомого значения $target в массиве $nums — это то, что нам нужно вернуть.
 */
class Solution
{
    public function search(array $nums, int $target): int
    {
        $left = 0;
        $right = count($nums) - 1;

        // выполняем бинарный поиск
        while ($left <= $right) {
            // определяем индекс середины массива
            $middle = floor(($left + $right) / 2);

            // если нашли, то возвращаем результат
            if ($target === $nums[$middle]) {
                return $middle;
            }

            // если левая часть отсортирована
            if ($nums[$left] <= $nums[$middle]) {
                // если левая часть содержит целевое значение
                if ($nums[$left] <= $target && $target < $nums[$middle]) {
                    $right = $middle - 1;
                } else { // если левая часть не содержит целевое значение
                    $left = $middle + 1;
                }
            } else { // если правая часть отсортирована
                // если правая часть содержит целевое значение
                if ($nums[$middle] < $target && $nums[$middle] <= $nums[$right]) {
                    $left = $middle + 1;
                } else { // если правая часть не содержит целевое значение
                    $right = $middle - 1;
                }
            }
        }

        return -1;
    }
}

var_dump(
    (new Solution())->search([4, 5, 6, 7, 0, 1, 2], 0)
);

// output: int(4)
// [4, 5, 6, 7, 0, 1, 2]
// -l-      -m-      -r-
// l = m + 1 ->[0, 1, 2]
//             -l--m--r-
//             [0]<- r = m - 1
// [0, 1, 2, 3, 4, 5, 6] pos
//              ^
//          target pos
