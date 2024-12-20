<?php
/**
 * TreeNode - Класс узла бинарного дерева
 */
class TreeNode
{
    public ?int $val = null;
    public ?TreeNode $left = null;
    public ?TreeNode $right = null;

    public function __construct(int $val = 0, ?TreeNode $left = null, ?TreeNode $right = null)
    {
        $this->val = $val;
        $this->left = $left;
        $this->right = $right;
    }
}

/**
 * $root - Корень бинарного дерева поиска (BST). $k - целое число, наименьшее значение (индекс с 1) среди узлов дерева.
 * Задача состоит в том, чтобы найти $k-е наименьшее значение среди узлов дерева. (используя обход InOrder: left -> root -> right)
 * Значение узла дерева, являющееся $k-м наименьшим значением — это то, что нам нужно вернуть.
 */
class Solution
{
    public function kthSmallest(TreeNode $root, int $k): ?int
    {
        // используем стек для хранения узлов в дереве.
        // решение основано на свойстве BST, где значение каждого узла больше всех значений в его левом поддереве и меньше всех значений в его правом поддереве.
        $stack = new SplStack();

        // проходим по дереву, пока не найдем $k-й элемент.
        while (true) {
            // проходим левое поддерево до тех пор, пока не останется ни одного левого потомка.
            while ($root) {
                $stack[] = $root;
                $root = $root->left;
            }

            // если $k больше размера дерева, то возвращаем NULL.
            if ($stack->isEmpty()) {
                return null;
            }

            // получаем узел из стека
            $root = $stack->pop();

            // уменьшаем количество элементов, которые необходимо найти
            $k--;

            // если нашли k-й наименьший элемент, возвращаем его.
            if ($k === 0) {
                return $root->val;
            }

            // обходим правое поддерево
            $root = $root->right;
        }
    }
}

$treeNode1 = new TreeNode(5);
$treeNode2 = new TreeNode(3);
$treeNode3 = new TreeNode(6);
$treeNode4 = new TreeNode(2);
$treeNode5 = new TreeNode(4);
$treeNode6 = new TreeNode(1);

$treeNode1->left = $treeNode2;
$treeNode1->right = $treeNode3;
$treeNode2->left = $treeNode4;
$treeNode2->right = $treeNode5;
$treeNode4->left = $treeNode6;

var_dump(
    (new Solution())->kthSmallest($treeNode1, 3)
);

// output: int(3)
// 1 <- 2 <- |3 | <- 4 <- 5 <- 6
// k1   k2   |k3|   k4   k5   k6
