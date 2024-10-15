<?php
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
