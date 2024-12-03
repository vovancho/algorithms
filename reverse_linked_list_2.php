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
 * $head - связанный список. $left - позиция, с которой нужно перевернуть список $head. $right - позиция, до которой нужно перевернуть список $head.
 * Задача состоит в том, чтобы перевернуть связанный список с позиции $left до позиции $right.
 * Связанный список с перевернутыми подсписком в позиции с $left до $right — это то, что нам нужно вернуть.
 */
class Solution
{
    public function reverseBetween(ListNode $head, int $left, int $right): ListNode
    {
        if ($left === $right) {
            return $head;
        }

        // создаем фиктивный узел $dummy и соединяем его с головой списка $head. (это позволит обработать пограничные случаи)
        $dummy = new ListNode(0);
        $dummy->next = $head;
        $prev = $dummy;

        // обходим список, пока не достигнем узла, предшествующему узлу на позиции $left.
        for ($i = 0; $i < $left - 1; $i++) {
            $prev = $prev->next;
        }

        // первый узел в подсписке [$left..$right]
        $current = $prev->next;

        // проходим по подсписку [$left..$right] и меняем узлы местами
        for ($i = 0; $i < $right - $left; $i++) {
            // меняем порядок узлов подсписка с помощью $prev и $current.
            $originalNext = $current->next;
            $current->next = $originalNext->next;
            $originalNext->next = $prev->next;
            $prev->next = $originalNext;
        }

        return $dummy->next;
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
    (new Solution())->reverseBetween($listNode0, 2, 4)->output()
);

// output: array(5) {
//   [0] => int(1)
//   [1] => int(4)
//   [2] => int(3)
//   [3] => int(2)
//   [4] => int(5)
// }
