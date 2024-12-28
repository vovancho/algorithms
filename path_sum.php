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

class Solution
{
    public function pathSum(TreeNode $root, int $targetSum): array
    {
        $s = new SplStack();
        $s->push([$root, 0, []]);

        $results = [];

        while (!$s->isEmpty()) {
            [$node, $parentSum, $parentPath] = $s->pop();

            if ($node === null) {
                continue;
            }

            $sum = $parentSum + $node->val;
            $parentPath[] = $node->val;

            if ($node->left === null && $node->right === null && $sum === $targetSum) {
                $results[] = $parentPath;
            }

            $s->push([$node->right, $sum, $parentPath]);
            $s->push([$node->left, $sum, $parentPath]);
        }

        return $results;
    }
}

$treeNode1 = new TreeNode(5);
$treeNode2 = new TreeNode(4);
$treeNode3 = new TreeNode(8);
$treeNode4 = new TreeNode(11);
$treeNode5 = new TreeNode(7);
$treeNode6 = new TreeNode(2);
$treeNode7 = new TreeNode(13);
$treeNode8 = new TreeNode(4);
$treeNode9 = new TreeNode(5);
$treeNode10 = new TreeNode(1);

$treeNode1->left = $treeNode2;
$treeNode1->right = $treeNode3;
$treeNode2->left = $treeNode4;
$treeNode4->left = $treeNode5;
$treeNode4->right = $treeNode6;
$treeNode3->left = $treeNode6;
$treeNode3->right = $treeNode8;
$treeNode8->left = $treeNode9;
$treeNode8->right = $treeNode10;

var_dump(
    (new Solution())->pathSum($treeNode1, 22)
);

// output: array(2) {
//   [0] => array(4) {
//     [0] => int(5)
//     [1] => int(4)
//     [2] => int(11)
//     [3] => int(2)
//   }
//   [1] => array(4) {
//     [0] => int(5)
//     [1] => int(8)
//     [2] => int(4)
//     [3] => int(5)
//   }
// }
