<?php
/**
 * $heights - целочисленный массив содержащий высоты столбцов гистограммы.
 * Задача состоит в том, чтобы рассчитать площадь наибольшего прямоугольника в гистограмме, где ширина каждого столбца равна 1.
 * Площадь наибольшего прямоугольника в гистограмме — это то, что нам нужно вернуть.
 */
class Solution
{
    public function largestRectangleArea(array $heights): int
    {
        // длина массива высот.
        $heightsLength = count($heights);
        // максимальная площадь, которую мы получим при прохождении по столбикам.
        $maxArea = 0;
        // стек для хранения индексов столбиков.
        $stack = new SplStack();

        // $i <= $heightsLength - один дополнительный искусственный столбик ($i === $heightsLength) с высотой 0.
        // Чтобы опустошить стек, когда достигнем последней высоты.
        for ($i = 0; $i <= $heightsLength; $i++) {
            // 0 - высота искусственного столбика в конце массива высот.
            $currHeight = $i === $heightsLength ? 0 : $heights[$i];

            // проходим по массиву высот до тех пор, пока стек не станет пустым, а текущая высота не станет меньше высоты в стеке.
            // когда мы сталкиваемся с высотой, меньшей предыдущей, мы можем сформировать из нее прямоугольник.
            while ($stack->count() && $currHeight < $heights[$stack->top()]) {
                $top = $stack->pop();
                // - 1, потому что мы находимся на текущей позиции столбца, который ниже предыдущего. А мы считаем только столбцы с нарастающей высотой.
                $width = $stack->isEmpty() ? $i : $i - $stack->top() - 1;
                $area = $heights[$top] * $width;
                $maxArea = max($maxArea, $area);
            }

            $stack->push($i);
        }

        return $maxArea;
    }
}

var_dump(
    (new Solution())->largestRectangleArea([2, 1, 5, 6, 2, 3])
);

// output: int(10) площадь прямоугольника столбцов со значениями 5 и 6
