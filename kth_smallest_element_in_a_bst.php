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
    public function kthSmallest(TreeNode $root, int $k): int
    {
        $stack = [];

        // Iterate until we find the kth smallest element
        while (true) {
            // Traverse left subtree until there is no left child
            while ($root) {
                $stack[] = $root;
                $root = $root->left;
            }

            // Get the node from the stack
            $root = array_pop($stack);

            // Decrease the count of elements to be found
            $k--;

            // If we have found the kth smallest element, return it
            if ($k === 0) {
                return $root->val;
            }

            // Traverse right subtree
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
