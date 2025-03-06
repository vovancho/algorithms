<?php

class Solution
{
    public function isPalindrome(string $s): bool
    {
        $s = strtolower(str_replace(" ", "", preg_replace( '/[^a-z0-9 ]/i', '', $s)));
        // Метод двух указателей
        $right = strlen($s) - 1;
        $left = 0;

        while ($right > $left) {
            if ($s[$right] != $s[$left]) {
                return false;
            }
            $left++;
            $right--;
        }

        return true;
    }
}

var_dump(
    (new Solution)->isPalindrome('A man, a plan, a canal: Panama')
);

// output: bool(true)
// "amanaplanacanalpanama" - является полиндромом
