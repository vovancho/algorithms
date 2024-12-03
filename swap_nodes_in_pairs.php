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
 * Задача состоит в том, чтобы поменять местами каждые два соседних узла списка $head.
 * Связанный список с измененными узлами — это то, что нам нужно вернуть.
 */
class Solution
{
    public function swapPairs(ListNode $head): ListNode
    {
        if ($head->next === null) {
            return $head;
        }

        $home = $head->next;
        $end = $head;

        while ($head && $head->next) {
            // Действия по переворачиванию пар узлов
            $aux = $head->next;
            $end->next = $aux;
            $head->next = $aux->next;
            $aux->next = $head;

            var_dump($home->output());

            // Действия по обновлению указателей
            $end = $head;
            $head = $head->next;
        }

        // мы возвращаем указатель дома
        return $home;
    }
}

// [1, 2, 3, 4]
$listNode0 = new ListNode(1);
$listNode1 = new ListNode(2);
$listNode2 = new ListNode(3);
$listNode3 = new ListNode(4);

$listNode0->next = $listNode1;
$listNode1->next = $listNode2;
$listNode2->next = $listNode3;

var_dump(
    (new Solution())->swapPairs($listNode0)->output()
);

// output: array(5) {
//   [0] => int(2)         [1, 2, 3, 4]
//   [1] => int(1)            /     /
//   [2] => int(4)           /     /
//   [3] => int(3)         [2, 1, 4, 3]
// }
