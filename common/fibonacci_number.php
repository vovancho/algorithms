<?php

class Solution
{
    public function fib(int $n): int
    {
        # solution 2 : DP bottom-up approach - Tabulation (5 ms)
        $f[0] = 0;
        $f[1] = 1;

        for ($i = 2; $i <= $n; $i++) {
            $f[$i] = $f[$i - 1] + $f[$i - 2];
            var_dump($f[$i - 1], $f[$i - 2], $f[$i], 'end');
        }

        return $f[$n];
    }
}

var_dump(
    (new Solution())->fib(7)
);

// output: int(13)
// $f[0] = 0
// $f[1] = 1
// $f[2] = 0 + 1 = 1
// $f[3] = 1 + 1 = 2
// $f[4] = 1 + 2 = 3
// $f[5] = 2 + 3 = 5
// $f[6] = 3 + 5 = 8
// $f[7] = 5 + 8 = 13
