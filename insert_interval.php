<?php
/**
 * $intervals - отсортированный в порядке возрастания массив не перекрывающихся интервалов, где интервал является массивом с левой и правой границей.
 * $newInterval - массив интервала с левой и правой границей.
 * Задача состоит в том, чтобы вставить $newInterval в $intervals так, чтобы $intervals также не имел перекрывающихся интервалов (при необходимости перекрывающиеся интервалы могут быть объединены).
 * Массив $intervals после вставки $newInterval — это то, что нам нужно вернуть.
 */
class Solution
{
    public function insert(array $intervals, array $newInterval): array
    {
        $result = [];

        // курсор-индекс по интервалам $intervals
        $i = 0;

        // получаем не перекрывающиеся интервалы $intervals до $newInterval
        while ($i < count($intervals) && $intervals[$i][1] < $newInterval[0]) {
            $result[] = $intervals[$i];
            $i++;
        }

        // объединяем перекрывающиеся интервалы
        while ($i < count($intervals) && $intervals[$i][0] <= $newInterval[1]) {
            $newInterval[0] = min($newInterval[0], $intervals[$i][0]);
            $newInterval[1] = max($newInterval[1], $intervals[$i][1]);
            $i++;
        }

        // получаем объединенный перекрывающийся интервал
        $result[] = $newInterval;

        // получаем не перекрывающиеся интервалы $intervals после $newInterval
        while ($i < count($intervals)) {
            $result[] = $intervals[$i];
            $i++;
        }

        return $result;
    }
}

var_dump(
    (new Solution())->insert([[1, 2], [3, 5], [6, 7], [8, 10], [12, 16]], [4, 8])
);

// output: array(3) {
//   [0] => array(2) {
//     [0] => int(1)
//     [1] => int(2)
//   }
//   [1] => array(2) {
//     [0] => int(3)
//     [1] => int(10)
//   }
//   [2] => array(2) {
//     [0] => int(12)
//     [1] => int(16)
//   }
// }
