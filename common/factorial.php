<?php
class Solution
{
    public function factorial(int $n): int
    {
        $r = 1;
        for ($i = 2; $i <= $n; $i++) {
            $r *= $i;
        }

        return $r;
    }
}

var_dump(
    (new Solution())->factorial(5)
);

// output: int(120)
// 1 * 2 * 3 * 4 * 5 = 120
