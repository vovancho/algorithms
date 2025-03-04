<?php
/**
 * $nums1 - целочисленный массив, который является подмножеством целочисленного массива $nums2.
 * Задача состоит в том, чтобы определить следующий больший элемент в $nums2 для каждого элемента $nums1. Если большего элемента нет, то вернуть -1.
 * Массив следующих больших элементов для массива $nums1 — это то, что нам нужно вернуть.
 */
class Solution
{
    public function nextGreaterElement(array $nums1, array $nums2): array
    {
        // используем стек, чтобы отслеживать элементы, для которых мы еще не нашли следующий больший элемент.
        $stack = new SplStack();

        // проходим $nums2 в обратном порядке
        for ($i = count($nums2) - 1; $i >= 0; $i--) {
            while ($stack->count() && $nums2[$i] >= $stack->top()) {
                // для каждого элемента в $nums2 мы извлекаем из стека элементы, которые меньше текущего элемента (так как они больше не могут быть «следующим большим» элементом).
                $stack->pop();
            }

            // сохраняем результат в карте $ans, где ключом является элемент, а значением — его следующий больший элемент.
            // элемент, оставшийся в стеке (если таковой имеется), будет следующим большим элементом для текущего элемента.
            // если стек пуст, следующего большего элемента нет, поэтому мы сохраняем -1.
            $ans[$nums2[$i]] = $stack->count() ? $stack->top() : -1;

            $stack[] = $nums2[$i];
        }

        // после обработки $nums2 мы просто сопоставляем каждый элемент в $nums1 с результатом, сохраненным в карте.
        for ($i = 0; $i < count($nums1); $i++) {
            $nums1[$i] = $ans[$nums1[$i]];
        }

        return $nums1;
    }
}

var_dump(
    (new Solution())->nextGreaterElement([4, 1, 2], [1, 3, 4, 2])
);

// output: array(3) {
//   [0] => int(-1)    4 => больше нет элемента в [1,3,4,2]
//   [1] => int(3)     1 => 3 больше в [1,3,4,2]
//   [2] => int(-1)    2 => конец массива
// }
