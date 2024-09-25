<?php

class Solution
{
    public function twoSum(array $numbers, int $target): ?array
    {
        $l = 0;
        $r = count($numbers) - 1;

        while ($l < $r) {
            $num = $numbers[$l] + $numbers[$r];

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
