<?php
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
