<?php
/**
 * $nums - целочисленный массив, отсортированный по возрастанию.
 * Задача состоит в том, чтобы найти два числа, которые в сумме дают определенное целевое число.
 * Индексы этих чисел — это то, что нам нужно вернуть.
 */
class Solution
{
    /**
     * @param int[] $nums
     *
     * @return int[]|null
     */
    public function twoSum(array $nums, int $target): ?array
    {
        $l = 0;
        $r = count($nums) - 1;

        while ($l < $r) {
            $num = $nums[$l] + $nums[$r];

            if ($num === $target) {
                return [$l + 1, $r + 1];
            }

            $num > $target ? $r-- : $l++;
        }

        return null;
    }
}

var_dump(
    (new Solution())->twoSum([2, 3, 4], 6)
);

// output: array(2) {
//   [0] => int(1)
//   [1] => int(3)
// }
