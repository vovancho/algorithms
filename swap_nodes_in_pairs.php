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
        // создаем фиктивный узел $dummy и соединяем его с головой списка $head. (это позволит обработать пограничные случаи при замене первой пары)
        $dummy = new ListNode(0);
        $dummy->next = $head;
        // инициализируем указатель $cur на фиктивный узел $dummy для обхода связанного списка
        $cur = $dummy;

        // используем цикл while для итерации по списку, пока не останется хотя бы два узла для замены
        while ($cur->next !== null && $cur->next->next !== null) {
            // определяем первый ($first) и второй ($second) узлы в паре, которые нужно поменять местами
            $first = $cur->next;
            $second = $cur->next->next;

            // меняем местами узлы, изменив указатели next
            $first->next = $second->next;
            $second->next = $first;
            // обновляем $cur->next, чтобы он указывал на второй ($second) узел в паре
            $cur->next = $second;

            // перемещаем указатель $cur на следующую пару, установив его на исходный первый ($first) узел
            $cur = $first;
        }

        // возвращаем $dummy->next в качестве нового заголовка измененного связанного списка
        return $dummy->next;
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
