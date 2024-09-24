# Prefix Sum
_(Префиксные суммы)_

Prefix Sum включает предварительную обработку массива для создания нового массива, где каждый элемент в индексе iпредставляет сумму массива от начала до i.
Это позволяет выполнять эффективные запросы сумм на подмассивах.

Используйте этот шаблон, когда вам необходимо выполнить несколько запросов суммирования для подмассива или вычислить кумулятивные суммы.

## Проблема
Для заданного массива nums ответьте на несколько запросов о сумме элементов в определенном диапазоне [i, j].

```
Input: nums = [1, 2, 3, 4, 5, 6], i = 1, j = 3

Output: 9
```

## Объяснение
1. Предварительно обработайте массив A для создания массива префиксной суммы: `P = [1, 3, 6, 10, 15, 21]`.
2. Чтобы найти сумму между индексами i и j, используйте формулу: `P[j] - P[i-1]`.

### Range Sum Query - Immutable
(Интервальные суммы)

```php
class NumArray {
    private array $prefix;
    
    /**
     * @param int[] $nums
     */
    function __construct(array $nums)
    {
        $prefix = [reset($nums)];
        for($i = 1; $i < count($nums); $i++) {
            $prefix[] = $prefix[$i - 1] + $nums[$i];
        }
        $this->prefix = $prefix;
    }
  
    function sumRange(int $left, int $right): int
    {
        return $this->prefix[$right] - $this->prefix[$left - 1];
    }
}

/**
 * Your NumArray object will be instantiated and called as such:
 * $obj = new NumArray($nums);
 * $ret_1 = $obj->sumRange($left, $right);
 */
```

# Two Pointers
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