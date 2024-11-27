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
 * $nums - целочисленный массив.
 * Задача состоит в том, чтобы вычислить сумму элементов $nums между индексами $left и $right включительно.
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
/**
 * $nums - целочисленный массив, отсортированный по возрастанию.
 * Задача состоит в том, чтобы найти два числа, которые в сумме дают определенное целевое число.
 * Индексы этих чисел — это то, что нам нужно вернуть.
 */
class Solution
{
    /**
     * @param int[] $nums
     *
     * @return int[]|null
     */
    public function twoSum(array $nums, int $target): ?array
    {
        $l = 0;
        $r = count($nums) - 1;

        while ($l < $r) {
            $num = $nums[$l] + $nums[$r];

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
```

### 3Sum
[Задача о трех суммах](https://leetcode.com/problems/3sum/description/)

```php
/**
 * $nums - целочисленный массив.
 * Задача состоит в том, чтобы вернуть все триплеты [$nums[i], $nums[j], $nums[k]] такие,
 *   что i !== j, i !== k и j !== k, и $nums[i] + $nums[j] + $nums[k] === 0.
 */
class Solution
{
    /**
     * @param int[] $nums
     *
     * @return int[][]
     */
    public function threeSum(array $nums): array
    {
        $result = [];
        $n = count($nums);
        sort($nums);

        for ($i = 0; $i < $n - 2; $i++) {
            // пропускаем дубликаты и первый элемент
            if ($i > 0 && $nums[$i] === $nums[$i - 1]) {
                continue;
            }

            $left = $i + 1;
            $right = $n - 1;
            $target = 0 - $nums[$i];

            while ($left < $right) {
                $sum = $nums[$left] + $nums[$right];
                if ($sum === $target) {
                    $result[] = [$nums[$i], $nums[$left], $nums[$right]];

                    // пропускаем дубликаты для 2-го и 3-го элементов
                    while ($left < $right && $nums[$left] === $nums[$left + 1]) {
                        $left++;
                    }
                    while ($left < $right && $nums[$right] === $nums[$right - 1]) {
                        $right--;
                    }

                    $left++;
                    $right--;
                } else {
                    $sum < $target ? $left++ : $right--;
                }
            }
        }

        return $result;
    }
}

var_dump(
    (new Solution())->threeSum([-1, 0, 1, 2, -1, -4])
);

// output: array(2) {
//  [0] =>
//    array(3) {
//      [0] => int(-1)
//      [1] => int(-1)
//      [2] => int(2)
//    }
//    [1] =>
//    array(3) {
//      [0] => int(-1)
//      [1] => int(0)
//      [2] => int(1)
//    }
//  }
```

### Container With Most Water
[Контейнер с наибольшим количеством воды](https://leetcode.com/problems/container-with-most-water/description/)

![container_with_most_water](project/question_11.jpg)

```php
/**
 * $height - целочисленный массив.
 * Задача состоит в том, чтобы найти две линии, которые вместе с осью x образуют контейнер, так что контейнер содержит больше всего воды.
 * Максимальное количество воды, которое может хранить контейнер — это то, что нам нужно вернуть.
 */
class Solution
{
    /**
     * @param int[] $height
     */
    public function maxArea(array $height): int
    {
        $count = count($height);
        $r = 0;
        $i = 0;
        $j = $count - 1;

        while ($i < $count - 1) {
            // Если мы начнем с линий на противоположных концах и движемся внутрь,
            // единственный возможный момент, когда площадь может быть больше, — это когда высота увеличивается,
            // поскольку ширина будет непрерывно уменьшаться.
            if ($height[$i] <= $height[$j]) {
                $t = $height[$i] * ($j - $i); // площадь контейнера
                $i++;
            } else {
                $t = $height[$j] * ($j - $i); // площадь контейнера
                $j--;
            }

            if ($t > $r) {
                $r = $t;
            }
        }

        return $r;
    }
}

var_dump(
    (new Solution())->maxArea([1, 8, 6, 2, 5, 4, 8, 3, 7])
);

// output: int(49)
```

# Sliding Window
_(Скользящее окно)_

Шаблон скользящего окна используется для поиска подмассива или подстроки, удовлетворяющей определенному условию, оптимизируя временную сложность путем поддержания окна элементов.

Используйте этот шаблон при решении задач, связанных с непрерывными подмассивами или подстроками.

## Проблема
Найти максимальную сумму подмассива размера k.

```
Input: nums = [2, 1, 5, 1, 3, 2], k = 3

Output: 9 // [.., 5 + 1 + 3, ..]
```

## Объяснение

1. Начните с суммы первых k элементов.
2. Сдвиньте окно на один элемент за раз, вычитая элемент, который выходит за пределы окна, и добавляя новый элемент.
3. Отслеживайте максимальную полученную сумму.

### Maximum Average Subarray I
[Максимальное среднее значение подмассива](https://leetcode.com/problems/maximum-average-subarray-i/description/)

```php
/**
 * $nums - целочисленный массив.
 * Задача состоит в том, чтобы найти непрерывный подмассив, длина которого равна $k, имеющий максимальное среднее значение.
 * Максимальное среднее значение подмассива — это то, что нам нужно вернуть.
 */
class Solution
{
    /**
     * @param int[] $nums
     */
    public function findMaxAverage(array $nums, int $k): float
    {
        $sum = 0;
        $count = count($nums);

        // Изначально окно начинается с начала массива и перемещается на k - 1 элемент,
        // вычисляя среднее значение для первых k элементов.
        for ($i = 0; $i < $k; $i++) {
            $sum += $nums[$i];
        }
        $res = $sum;

        // Второй цикл начинается с элемента k и смещается вправо.
        // По мере перемещения окна элемент, покидающий окно (самый левый), вычитается из суммы,
        // а новый элемент, входящий в окно, добавляется к сумме.
        for ($i = $k; $i < $count; $i++) {
            $sum += $nums[$i] - $nums[$i - $k];
            if ($sum > $res) {
                $res = $sum;
            }
        }

        // вычисляем среднее значение
        return $res / $k;
    }
}

var_dump(
    (new Solution())->findMaxAverage([1, 12, -5, -6, 50, 3], 4)
);

// output: double(12.75)
// (12 - 5 - 6 + 50) / 4 = 12.75
```

### Longest Substring Without Repeating Characters
[Длина самой длинной подстроки без повторяющихся символов](https://leetcode.com/problems/longest-substring-without-repeating-characters/description/)

```php
/**
 * $s - строка.
 * Задача состоит в том, чтобы найти длину самой длинной подстроки без повторяющихся символов.
 * Длина самой длинной подстроки без повторяющихся символов — это то, что нам нужно вернуть.
 */
class Solution
{
    public function lengthOfLongestSubstring(string $s): int
    {
        if (strlen($s) === 0) {
            return 0;
        }
        if (strlen($s) === 1) {
            return 1;
        }

        $chars = str_split($s);

        $i = 0; // правый указатель
        $j = 0; // левый указатель
        $max = 0;
        $seen = []; // хэш-набор

        while ($i < count($chars)) {
            $c = $chars[$i];

            // Если символ уже присутствует в наборе, это означает, что вам нужно переместить скользящее окно на 1,
            // перед этим вам нужно удалить все символы, которые находятся перед символом,
            // который уже присутствовал в окне ранее.
            while (isset($seen[$c])) {
                unset($seen[$chars[$j]]);
                $j++;
            }

            $seen[$chars[$i]] = true;

            $max = max($i - $j + 1, $max);
            $i++;
        }

        return $max;
    }
}

var_dump(
    (new Solution())->lengthOfLongestSubstring('abcabcbb')
);

// output: int(3)
```

### Minimum Window Substring
[Минимальная подстрока окна](https://leetcode.com/problems/minimum-window-substring/description/)

```php
/**
 * $s - строка, $t - строка.
 * Задача состоит в том, чтобы найти минимальную подстроку в строке $s, в которой содержится каждый символ из строки $t.
 * Минимальная подстрока — это то, что нам нужно вернуть.
 */
class Solution
{
    public function minWindow(string $s, string $t): string
    {
        $hashMap = []; // хэш-набор
        $checker = [];
        foreach (str_split($t) as $val) {
            $hashMap[$val] = isset($hashMap[$val]) ? $hashMap[$val] + 1 : 1;
            $checker[$val] = 0;
        }

        $resultMin = strlen($s);
        $idxPairs = [];
        $have = 0;
        $left = $right = 0;

        while ($right < strlen($s)) {
            $letter = $s[$right];
            if (isset($hashMap[$letter])) {
                $checker[$letter] += 1;
                if ($checker[$letter] <= $hashMap[$letter]) {
                    $have++;
                }
            }
            while ($have === strlen($t)) {
                $len = $right - $left + 1;
                if ($len <= $resultMin) {
                    $resultMin = $len;
                    $idxPairs['left'] = $left;
                    $idxPairs['right'] = $right;
                }

                if (isset($hashMap[$s[$left]]) && $checker[$s[$left]] > 0) {
                    if ($checker[$s[$left]] <= $hashMap[$s[$left]]) {
                        $have--;
                    }
                    $checker[$s[$left]] -= 1;
                }
                $left++;
            }
            $right++;
        }

        if (empty($idxPairs)) {
            return '';
        }

        $result = '';
        while ($idxPairs['left'] <= $idxPairs['right']) {
            $result .= $s[$idxPairs['left']];
            $idxPairs['left']++;
        }
        return $result;
    }
}

var_dump(
    (new Solution())->minWindow('ADOBECODEBANC', 'ABC')
);

// output: string(4) "BANC"
// ADOBECODE[BANC]
//           BA C => (ABC)
```

# Fast & Slow Pointers
_(Быстрые и медленные указатели)_

Шаблон «Быстрые и медленные указатели (Черепаха и Заяц)» используется для обнаружения циклов в связанных списках и других подобных структурах.

## Проблема

Определить, есть ли цикл в связанном списке.

## Объяснение

1. Инициализируйте два указателя, один из которых перемещается на один шаг за раз (медленно), а другой перемещается на два шага за раз (быстро).
2. Если есть цикл, быстрый указатель в конечном итоге встретится с медленным указателем.
3. Если быстрый указатель достигает конца списка, цикла нет.

### Linked List Cycle
[Цикл связанного списка](https://leetcode.com/problems/linked-list-cycle/description/)

```php
/**
 * ListNode - Класс связанного списка
 */
class ListNode
{
    public ?ListNode $next = null;
    
    public function __construct(public int $val = 0)
    {
    }
}

/**
 * $head - связанный список.
 * Задача состоит в том, чтобы найти цикл в связанном списке.
 * Наличие цикла — это то, что нам нужно вернуть.
 */
class Solution
{
    public function hasCycle(ListNode $head): bool
    {
        $slowPointer = $fastPointer = $head;
        while ($fastPointer !== null && $fastPointer->next !== null) {
            $slowPointer = $slowPointer->next; // медленный указатель перемещается на один шаг
            $fastPointer = $fastPointer->next->next; // быстрый указатель перемещается на два шага

            // если есть цикл, быстрый указатель в конечном итоге встретится с медленным указателем
            if ($slowPointer === $fastPointer) {
                return true;
            }
        }

        // если быстрый указатель достигает конца списка, цикла нет
        return false;
    }
}

$listNode0 = new ListNode(3);
$listNode1 = new ListNode(2);
$listNode2 = new ListNode(0);
$listNode3 = new ListNode(-4);

$listNode0->next = $listNode1;
$listNode1->next = $listNode2;
$listNode2->next = $listNode3;
$listNode3->next = $listNode2;

// $listNode0 - связанный список [3 -> 2 -> 0 -> -4]
//                               [     ^_________/ ]

var_dump(
    (new Solution())->hasCycle($listNode0)
);

// output: bool(true)
```

### Happy Number
[Счастливое число](https://leetcode.com/problems/happy-number/description/)

```php
/**
 * $n - целочисленное число.
 * Задача состоит в том, чтобы определить, является ли число $n - счастливым.
 * Является ли число $n счастливым — это то, что нам нужно вернуть.
 *
 * Счастливое число - число, у которого сумма квадратов его цифр возвращает 1. (в цикле для каждого результата)
 */
class Solution
{
    public function isHappy(int $n): bool
    {
        $slow = $fast = $n;
        do {
            $slow = $this->powerSum($slow); // медленный указатель перемещается на один шаг
            $fast = $this->powerSum($this->powerSum($fast)); // быстрый указатель перемещается на два шага
        } while ($fast !== 1 && $fast !== $slow); // если есть цикл, быстрый указатель в конечном итоге встретится с медленным указателем

        // если быстрый указатель равен 1, число счастливое
        // если указатели равны, то число несчастливое
        return $fast === 1;
    }

    /**
     * Вычисляем сумму квадратов цифр числа
     */
    private function powerSum(int $s): int
    {
        $digits = str_split($s);
        $res = 0;

        foreach ($digits as $digit){
            $res += $digit ** 2;
        }

        return $res;
    }
}

var_dump(
    (new Solution())->isHappy(19)
);

// output: bool(true)
// 1 ** 2 + 9 ** 2 = 1 + 81 = 82 (slow 1 шаг) | 1 ** 2 + 9 ** 2 = 1 + 81 = 82   => 8 ** 2 + 2 ** 2 = 64 + 4 = 68            (fast 2 шага)
// ^        ^                 --                ^        ^                 --      ^        ^                 --
// 8 ** 2 + 2 ** 2 = 64 + 4 = 68 (slow 1 шаг) | 6 ** 2 + 8 ** 2 = 36 + 64 = 100 => 1 ** 2 + 0 ** 2 + 0 ** 2 = 1 + 0 + 0 = 1 (fast 2 шага)
// ^        ^                 --                ^        ^                  ---    ^        ^        ^                    -
```

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