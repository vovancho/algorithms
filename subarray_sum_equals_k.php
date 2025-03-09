<?php
/**
 * $nums - целочисленный массив. $k - целое число.
 * Задача состоит в том, чтобы вернуть общее количество подмассивов, сумма которых равна $k.
 * Количество подмассивов, сумма которых равна $k — это то, что нам нужно вернуть.
 */
class Solution
{
    private array $prefix;

    /**
     * @param int[] $nums
     */
    public function __construct(array $nums)
    {
        $prefix = [reset($nums)];
        for($i = 1; $i < count($nums); $i++) {
            $prefix[] = $prefix[$i - 1] + $nums[$i];
        }
        $this->prefix = $prefix;
    }

    public function subarraySum(int $k): int
    {
        $map = [0 => 1];
        $count = 0;

        foreach ($this->prefix as $sum) {
            $count += $map[$sum - $k] ?? 0;

            $map[$sum] = ($map[$sum] ?? 0) + 1;

            var_dump($map, $count);
        }

        return $count;
    }
}

var_dump(
    (new Solution([1, 2, 3]))->subarraySum(3)
);

// output: int(2)
// sum([1, 2]) = 3, sum([3]) = 3 => count([[1, 2], [3]]) = 2
