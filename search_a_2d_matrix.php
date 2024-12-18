<?php
/**
 * $matrix - отсортированная матрица целых чисел. $target - искомое значение в матрице.
 * Задача состоит в том, чтобы найти целевое значение $target в матрице $matrix, используя эффективный метод. (Бинарный поиск)
 * Содержит ли матрица $matrix искомое значение $target (true/false) — это то, что нам нужно вернуть.
 */
class Solution
{
    public function searchMatrix(array $matrix, int $target): bool
    {
        $lenColumn = count($matrix);
        $lenRow = count($matrix[0]);

        // идем по рядам матрицы
        for ($y = 0; $y < $lenColumn; $y++) {
            $leftX = 0;
            $rightX = $lenRow - 1;

            // выполняем бинарный поиск
            while ($leftX <= $rightX) {
                // определяем индекс середины ряда матрицы
                $middleX = floor(($leftX + $rightX) / 2);
                $value = $matrix[$y][$middleX];

                // если нашли, то возвращаем результат
                if ($value === $target) {
                    return true;
                }

                // если текущее значение в матрице меньше целевого значения, то целевое значение находится в правой части ряда
                if ($value < $target) {
                    $leftX = $middleX + 1;
                } else { // в противном случае целевое значение находится в левой части ряда
                    $rightX = $middleX - 1;
                }
            }
        }

        return false;
    }
}

var_dump(
    (new Solution())->searchMatrix([
        [ 1,  4,  7, 11, 15],
        [ 2,  5,  8, 12, 19],
        [ 3,  6,  9, 16, 22],
        [10, 13, 14, 17, 24],
        [18, 21, 23, 26, 30]
    ], 5)
);

// output: bool(true)
// [ 1,  4,  7, 11, 15] y0
//  -l-     -m-     -r-
// [ 1,  4]<- r = m - 1
//  -l- -r-
//      -m-
//     [ 4]
// [ 2,  5,  8, 12, 19] y1
//  -l-     -m-     -r-
// [ 2,  5]<- r = m - 1
//  -l- -r-
//      -m-
//     [ 5]
//       ^
