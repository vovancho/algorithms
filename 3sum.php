<?php
/**
 * $nums - целочисленный массив.
 * Задача состоит в том, чтобы вернуть все триплеты [$nums[i], $nums[j], $nums[k]] такие,
 *   что i !== j, i !== k и j !== k, и $nums[i] + $nums[j] + $nums[k] === 0.
 */
class Solution
{
    /**
     * @param int[] $nums
     *
     * @return int[][]
     */
    public function threeSum(array $nums): array
    {
        $result = [];
        $n = count($nums);
        sort($nums);

        for ($i = 0; $i < $n - 2; $i++) {
            // пропускаем дубликаты и первый элемент
            if ($i > 0 && $nums[$i] === $nums[$i - 1]) {
                continue;
            }

            $left = $i + 1;
            $right = $n - 1;
            $target = 0 - $nums[$i];

            while ($left < $right) {
                $sum = $nums[$left] + $nums[$right];
                if ($sum === $target) {
                    $result[] = [$nums[$i], $nums[$left], $nums[$right]];

                    // пропускаем дубликаты для 2-го и 3-го элементов
                    while ($left < $right && $nums[$left] === $nums[$left + 1]) {
                        $left++;
                    }
                    while ($left < $right && $nums[$right] === $nums[$right - 1]) {
                        $right--;
                    }

                    $left++;
                    $right--;
                } else {
                    $sum < $target ? $left++ : $right--;
                }
            }
        }

        return $result;
    }
}

var_dump(
    (new Solution())->threeSum([-1, 0, 1, 2, -1, -4])
);

// output: array(2) {
//  [0] =>
//    array(3) {
//      [0] => int(-1)
//      [1] => int(-1)
//      [2] => int(2)
//    }
//    [1] =>
//    array(3) {
//      [0] => int(-1)
//      [1] => int(0)
//      [2] => int(1)
//    }
//  }
