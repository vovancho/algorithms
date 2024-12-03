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

    public function output(): array
    {
        $list = $this;
        $result = [$list->val];
        while ($list->next) {
            $list = $list->next;
            $result[] = $list->val;
        }

        return $result;
    }
}

/**
 * $head - связанный список.
 * Задача состоит в том, чтобы перевернуть связанный список $head.
 * Перевернутый связанный список — это то, что нам нужно вернуть.
 */
class Solution
{
    public function reverseList(ListNode $head): ListNode
    {
        if ($head->next === null) {
            return $head;
        }

        $current = $head;
        $prev = null;
        // идем по связанному списку и переворачиваем узлы
        while ($current) {
            $originalNext = $current->next;
            $current->next = $prev; // в манере lock-step мы реверсируем текущий узел, указав его на предыдущий, прежде чем перейти к следующему узлу.

            $prev = $current; // $prev всегда указывает на предыдущий узел, который мы обработали
            $current = $originalNext;
        }

        return $prev;
    }
}

// [1, 2, 3, 4, 5]
$listNode0 = new ListNode(1);
$listNode1 = new ListNode(2);
$listNode2 = new ListNode(3);
$listNode3 = new ListNode(4);
$listNode4 = new ListNode(5);

$listNode0->next = $listNode1;
$listNode1->next = $listNode2;
$listNode2->next = $listNode3;
$listNode3->next = $listNode4;

var_dump(
    (new Solution())->reverseList($listNode0)->output()
);

// output: array(5) {
//   [0] => int(5)
//   [1] => int(4)
//   [2] => int(3)
//   [3] => int(2)
//   [4] => int(1)
// }
