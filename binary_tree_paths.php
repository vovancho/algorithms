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
 * $root - Корень бинарного дерева.
 * Задача состоит в том, чтобы сформировать все пути бинарного дерева $root от корня до листьев (PreOrder: root -> left -> right) в любом порядке.
 * Массив строк путей бинарного дерева $root — это то, что нам нужно вернуть.
 */
class Solution
{
    public function binaryTreePaths(?TreeNode $root): array
    {
        if (!$root) {
            return [];
        }

        if (!$root->left && !$root->right) {
            // лист - узел, не имеющий дочерних узлов.
            return [$root->val];
        }

        // делаем рекурсивный вызов для левого поддерева
        $left = $this->binaryTreePaths($root->left);
        // делаем рекурсивный вызов для правого поддерева
        $right = $this->binaryTreePaths($root->right);

        // объединяем корневое значение с каждым путем в левом поддереве.
        $result = [];
        foreach ($left as $path) {
            $result[] = $root->val . '->' . $path;
        }

        // объединяем корневое значение с каждым путем в правом поддереве.
        foreach ($right as $path) {
            $result[] = $root->val . '->' . $path;
        }

        return $result;
    }
}

$treeNode1 = new TreeNode(1);
$treeNode2 = new TreeNode(2);
$treeNode3 = new TreeNode(3);
$treeNode4 = new TreeNode(5);
$treeNode1->left = $treeNode2;
$treeNode1->right = $treeNode3;
$treeNode2->right = $treeNode4;

var_dump(
    (new Solution())->binaryTreePaths($treeNode1)
);

// output: array(2) {
//   [0] => string(7) "1->2->5"
//   [1] => string(4) "1->3"
// }
//
// iteration1 = 2->5
// iteration2 = 1-> . "2->5", 1->3
