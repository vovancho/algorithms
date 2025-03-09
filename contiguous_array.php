<?php
/**
 * $nums состоит только из двоичных цифр (0 и 1).
 * Задача состоит в том, чтобы найти непрерывный подмассив, в котором количество 0 и 1 одинаково, и этот подмассив должен быть самым длинным из всех таких подмассивов в данном массиве.
 * Длина этого подмассива — это то, что нам нужно вернуть.
 */
class Solution
{
    /**
     * @param int[] $nums
     */
    public function findMaxLength(array $nums): int
    {
        $map = [0 => -1];
        $total = 0;
        $maxCount = 0;

        foreach ($nums as $i => $val) {
            $val === 1 ? $total++ : $total--;

            if (isset($map[$total])) {
                $maxCount = max($i - $map[$total], $maxCount);
            } else {
                $map[$total] = $i;
            }
        }

        return $maxCount;
    }
}

var_dump(
    (new Solution())->findMaxLength([0, 1, 0, 1, 1, 0, 0])
);

// output: int(6)
