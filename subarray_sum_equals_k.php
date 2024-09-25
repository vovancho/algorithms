<?php
/**
 * $nums состоит только из двоичных цифр (0 и 1).
 * Задача состоит в том, чтобы найти непрерывный подмассив, в котором количество 0 и 1 одинаково, и этот подмассив должен быть самым длинным из всех таких подмассивов в данном массиве.
 * Длина этого подмассива — это то, что нам нужно вернуть.
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

    /**
     * @param int $k
     *
     * @return int
     */
    public function subarraySum(int $k): int
    {
        $map = [0 => 1];
        $count = 0;

        foreach ($this->prefix as $sum) {
            $count += $map[$sum - $k] ?? 0;

            $map[$sum] = ($map[$sum] ?? 0) + 1;
        }

        return $count;
    }
}

var_dump(
    (new Solution([1, 2, 3]))->subarraySum(3)
);

// output: int(2)
