<?php
/**
 * Node - Класс узла графа
 */
class Node
{
    public ?int $val = null;
    /** @var Node[]|null  */
    public ?array $neighbors = null;

    public function __construct(int $val = 0)
    {
        $this->val = $val;
        $this->neighbors = [];
    }
}

/**
 * $node - Ссылка на узел в связном неориентированном графе.
 * Задача состоит в том, чтобы сформировать клон графа $node.
 * Клонированный граф $node — это то, что нам нужно вернуть.
 */
class Solution
{
    protected array $visited = []; // буфер с уже посещенными узлами графа.
    private array $printBuf = []; // для удобного вывода результата.

    public function cloneGraph(?Node $node): ?Node
    {
        $this->printBuf = [];

        return $node ? $this->dfs($node) : $node;
    }

    private function dfs(Node $node): Node
    {
        // если узел уже есть в буфере посещений, то возвращаем его не клонируя.
        if(isset($this->visited[$node->val])) {
            // буфер для вывода результата (не имеет отношения к алгоритму).
            if (!isset($this->printBuf[$node->val])) {
                $this->printBuf[$node->val] = array_map(static fn (Node $n) => $n->val, $node->neighbors);
            }

            return $this->visited[$node->val];
        }

        $copy = new Node($node->val); // клонируем узел.
        $this->visited[$node->val] = $copy; // добавляем копию узла в буфер посещений.

        // перебираем соседей узла, клонируя новый узел для каждого, если его еще нет в буфере посещений.
        foreach($node->neighbors as $nei) {
            $copy->neighbors[] = $this->dfs($nei);
        }

        return $copy;
    }

    public function printBuf(): array // выводим клонированный граф.
    {
        return $this->printBuf;
    }
}

$node1 = new Node(1);
$node2 = new Node(2);
$node3 = new Node(3);
$node4 = new Node(4);
$node1->neighbors[] = $node2;
$node1->neighbors[] = $node4;
$node2->neighbors[] = $node1;
$node2->neighbors[] = $node3;
$node3->neighbors[] = $node2;
$node3->neighbors[] = $node4;
$node4->neighbors[] = $node1;
$node4->neighbors[] = $node3;

($solution = new Solution())->cloneGraph($node1);
var_dump($solution->printBuf());

// output: array(4) {
//   [1] => array(2) {
//     [0] => int(2)
//     [1] => int(4)
//   }
//   [2] => array(2) {
//     [0] => int(1)
//     [1] => int(3)
//   }
//   [3] => array(2) {
//     [0] => int(2)
//     [1] => int(4)
//   }
//   [4] => array(2) {
//     [0] => int(1)
//     [1] => int(3)
//   }
// }
//
// (1) --------> (2)    (1)--(2)                 () - новый узел
// /|\            |           |---[1]            [] - уже есть в буфере посещений
//  |             |           |---(3)
//  |            \|/               |---[2]
// (4) <-------- (3)               |---(4)
//                                      |---[1]
//                                      |---[3]  исследуем граф в глубину (DFS)
//                    <-(1)--(2)--(3)--(4) <-|
