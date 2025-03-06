<?php

class Solution
{
    public function sortArray(array $nums): array
    {
        $result = [];
        while (count($nums) !== 0) {
            $min = null;
            $minIdx = null;

            foreach ($nums as $idx => $num) {
                if ($min === null || $num < $min) {
                    $min = $num;
                    $minIdx = $idx;
                }
            }

            $result[] = $min;
            // убираем элемент $min из массива
            array_splice($nums, $minIdx, 1);
        }

        return $result;
    }
}

var_dump(
    (new Solution())->sortArray([5, 2, 3, 1])
);

// output: array(4) {
//   [0] => int(1)
//   [1] => int(2)
//   [2] => int(3)
//   [3] => int(5)
// }
