<?php
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
