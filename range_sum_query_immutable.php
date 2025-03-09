<?php
/**
 * $nums - целочисленный массив.
 * Задача состоит в том, чтобы вычислить сумму элементов $nums между индексами $left и $right включительно.
 */
class NumArray
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

    public function sumRange(int $left, int $right): int
    {
        return $this->prefix[$right] - $this->prefix[$left - 1];
    }
}

var_dump(
    (new NumArray([1, 2, 3, 4, 5, 6]))->sumRange(1, 3)
);

// output: int(9)
