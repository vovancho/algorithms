<?php
/**
 * $nums - целочисленный массив. $k - целое число.
 * Задача состоит в том, чтобы вычислить $k наиболее часто встречающийся элементов в массиве.
 * $k наиболее часто встречающийся элементов — это то, что нам нужно вернуть.
 */
class Solution
{
    public function topKFrequent(array $nums, int $k): array
    {
        // инициализируем кучу с сохранением минимального элемента наверху.
        $minHeap = new SplMinHeap();
        $hash = [];

        // формируем карту частотности элементов в массиве [элемент => частотность]
        for ($i = 0; $i < count($nums); $i++) {
            $hash[$nums[$i]] = isset($hash[$nums[$i]]) ? ++$hash[$nums[$i]] : 1;
        }

        foreach ($hash as $element => $frequent) {
            // наполняем кучу кортежем [0 => частота, 1 => элемент] из карты частотности
            $minHeap->insert([$frequent, $element]);

            // убираем из кучи значения больше $k-того элемента.
            // в SplMinHeap при извлечении элементы удаляются в отсортированном порядке по минимальному значению (частоте $frequent).
            if ($minHeap->count() > $k) {
                $minHeap->extract();
            }
        }

        // формируем массив $k наиболее часто встречающийся элементов
        for ($i = 0; $i < $k; $i++) {
            // в куче кортеж [0 => частота, 1 => элемент], извлекаем элементы
            $ans[] = $minHeap->extract()[1];
        }

        return $ans;
    }
}

var_dump(
    (new Solution())->topKFrequent([1, 1, 1, 2, 2, 3], 2)
);

// output: array(2) {
//   [0] => int(2)
//   [1] => int(1)
// }
// k: 1 => 3 раза
// k: 2 => 2 раза ___<== [1, 2]
// k: 3 => 1 раз
