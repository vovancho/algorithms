<?php
/**
 * $nums - повернутый отсортированный целочисленный массив. (повернутый - смещенный индекс).
 * Задача состоит в том, чтобы найти минимальный элемент в массиве $nums, используя бинарный поиск O(log n).
 * Значение минимального элемента массива $nums — это то, что нам нужно вернуть.
 */
class Solution
{
    public function findMin(array $nums): int
    {
        $left = 0;
        $right = count($nums) - 1;

        // выполняем бинарный поиск
        while ($left < $right) {
            // определяем индекс середины массива
            $middle = floor(($left + $right) / 2);

            // если элемент в середине больше крайнего правого элемента, то минимальный элемент находится в правой части массива.
            if ($nums[$middle] > $nums[$right]) {
                $left = $middle + 1;
            } else { // в противном случае минимальный элемент находится в левой части массива.
                $right = $middle;
            }
        }

        // возвращаем минимальный элемент.
        return $nums[$left];
    }
}

var_dump(
    (new Solution())->findMin([3, 4, 5, 1, 2])
);

// output: int(1)
//    [3, 4, 5, 1, 2]
//    -l-   -m-   -r-
// l = m + 1 ->[1, 2]
//             -l--r-
//             -m-
//             [1] r = m
//              ^
