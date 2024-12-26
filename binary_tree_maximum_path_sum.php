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
 *
 */
class Solution
{
    public function maxPathSum(TreeNode $root): int
    {
        $max = PHP_INT_MIN;
        $this->DFS($root, $max);

        return $max;
    }

    private function DFS(?TreeNode $root, int &$max): int
    {
        if (!$root) {
            return 0;
        }

        // т.к. сумма отрицательных чисел только делает сумму меньше, то отрицательные суммы не рассматриваем.
        $maxL = max($this->DFS($root->left, $max), 0);
        $maxAfterMaxL = $max;
        $maxR = max($this->DFS($root->right, $max), 0);
        $maxAfterMaxR = $max;

        $maxBranch = $root->val + $maxL + $maxR;
        $max = max($max, $maxBranch);

        var_dump(json_encode([
            '$maxL' => $maxL,
            '$maxR' => $maxR,
            '$root->val' => $root->val,
            '$maxBranch' => $maxBranch,
            '$maxAfterMaxL' => $maxAfterMaxL,
            '$maxAfterMaxR' => $maxAfterMaxR,
            '$max' => $max,
            'return' => $root->val + max($maxL, $maxR),
        ]));

        return $root->val + max($maxL, $maxR);
    }
}

$treeNode1 = new TreeNode(-10);
$treeNode2 = new TreeNode(9);
$treeNode3 = new TreeNode(20);
$treeNode4 = new TreeNode(15);
$treeNode5 = new TreeNode(7);

$treeNode1->left = $treeNode2;
$treeNode1->right = $treeNode3;
$treeNode3->left = $treeNode4;
$treeNode3->right = $treeNode5;

var_dump(
    (new Solution())->maxPathSum($treeNode1)
);

// output: int(42)
// (9) -- (15) -- (7) -- (20) --------------------- (-10)
//                        |---(15) max                |---(9)
//                        |---(7)                     |---(20) 20 + 15 = 35 max
//                        = 20 + 15 + 7 = 42 [max]         |---(15) max
//                                                         |---(7)
//                                                         = 9 + -10 + 20 + 15 = 34 [max]
//
// max(9,  15,     7,     42,                         34) = 42
// -----------------------------------------------------------
