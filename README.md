# Prefix Sum
_(Префиксные суммы)_

Prefix Sum включает предварительную обработку массива для создания нового массива, где каждый элемент в индексе i представляет сумму массива от начала до i.
Это позволяет выполнять эффективные запросы сумм на подмассивах.

Используйте этот шаблон, когда вам необходимо выполнить несколько запросов суммирования для подмассива или вычислить кумулятивные суммы.

## Проблема
Для заданного массива nums определить сумму элементов в определенном диапазоне [i, j].

```
Input: nums = [1, 2, 3, 4, 5, 6], i = 1, j = 3

Output: 9
```

## Объяснение
1. Предварительно обработайте массив A для создания массива префиксной суммы: `P = [1, 3, 6, 10, 15, 21]`.
2. Чтобы найти сумму между индексами i и j, используйте формулу: `P[j] - P[i-1]`.

### Range Sum Query - Immutable
[Интервальные суммы](https://leetcode.com/problems/range-sum-query-immutable/description/)

```php
/**
 * $nums состоит только из двоичных цифр (0 и 1).
 * Задача состоит в том, чтобы найти непрерывный подмассив, в котором количество 0 и 1 одинаково, и этот подмассив должен быть самым длинным из всех таких подмассивов в данном массиве.
 * Длина этого подмассива — это то, что нам нужно вернуть.
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
```

### Contiguous Array
[Непрерывный массив](https://leetcode.com/problems/contiguous-array/description/)

```php
/**
 * $nums состоит только из двоичных цифр (0 и 1).
 * Задача состоит в том, чтобы найти непрерывный подмассив, в котором количество 0 и 1 одинаково, и этот подмассив должен быть самым длинным из всех таких подмассивов в данном массиве.
 * Длина этого подмассива — это то, что нам нужно вернуть.
 */
class Solution
{
    /**
     * @param int[] $nums
     *
     * @return int
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
```

### Subarray Sum Equals K
[Поиск всех подходящих под-сум](https://leetcode.com/problems/subarray-sum-equals-k/description/)

```php
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
```

# Two Pointers
_(Метод двух указателей)_

Метод «Два указателя» подразумевает использование двух указателей для итерации по массиву или списку, часто используется для поиска пар или элементов, соответствующих определенным критериям.

Используйте этот шаблон при работе с отсортированными массивами или списками, где вам нужно найти пары, удовлетворяющие определенному условию.

## Проблема
Для заданного отсортированного массива nums найти два числа, которые в сумме дают целевое значение.

```
Input: nums = [1, 2, 3, 4, 6], target = 6

Output: [1, 3] // 2 + 4 = 6
```

## Объяснение
1. Инициализируйте два указателя, один в начале (слева) и один в конце (справа) массива.
2. Проверьте сумму элементов по двум указателям:
   - Если сумма равна цели, верните индексы.
   - Если сумма меньше цели, переместите левый указатель вправо.
   - Если сумма больше цели, переместите правый указатель влево.

### Two Sum II - Input Array is Sorted
[Метод двух указателей для отсортированного массива](https://leetcode.com/problems/two-sum-ii-input-array-is-sorted/description/)

```php
class Solution {


    function twoSum($numbers, $target) {
        $l = 0;
        $r = count($numbers) - 1;
        while($l < $r)
        {
            $num = $numbers[$l] + $numbers[$r];
            if($num === $target) return [$l+1,$r+1];
            elseif($num > $target) $r--;
            else $l++;
        }

    }
}
```


# Sliding Window
# Fast & Slow Pointers
# LinkedList In-place Reversal
# Monotonic Stack
# Top ‘K’ Elements
# Overlapping Intervals
# Modified Binary Search
# Binary Tree Traversal
# Depth-First Search (DFS)
# Breadth-First Search (BFS)
# Matrix Traversal
# Backtracking
# Dynamic Programming Patterns