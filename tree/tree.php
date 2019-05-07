<?php

/*
 * 1 根据二叉树的前序中序遍历构造树形结构
 * 2 后续遍历二叉树
 */
class Node {

    public $value;
    public $right;
    public $left;

    public function __construct () {
    }
}

function tailOrder($root){
    $stack = array();
    $outStack = array();
    array_push($stack,$root);
    while(!empty($stack)){
        $center_node=array_pop($stack);
        array_push($outStack,$center_node);//最先压入根节点，最后输出
        if($center_node->left!=null){
            array_push($stack,$center_node->left);
        }
        if($center_node->right!=null){
            array_push($stack,$center_node->right);
        }
    }
    while(!empty($outStack)){
        $center_node=array_pop($outStack);
        echo $center_node->value.' ';
    }
}

function createTree($inOrder, $preOrder, $length) {
    if ($length == 0) {
        return null;
    }
    $root = new Node();
    $first = substr($inOrder, 0, 1);;
    $root->value = $first;
    $rootIndex = 0;
    for (;$rootIndex < $length; $rootIndex++) {
        if (substr($inOrder, $rootIndex, 1) == substr($preOrder, 0, 1)) {
            break;
        }
    }
    //根据中序遍历切出左右子树集合
    $inOrder   = str_replace($first, "", $inOrder);
    //前序遍历右子树集合
    $root->left  = createTree($inOrder, substr($preOrder, 0, $rootIndex), $rootIndex);
    $root->right = createTree(substr($inOrder, $rootIndex, $length - ($rootIndex + 1)), substr($preOrder, $rootIndex + 1, $length - ($rootIndex + 1)), $length - ($rootIndex + 1));
    return $root;
}



$inOrder  = "ABDCEF";
$preOrder = "DBAECF";

$root = createTree($inOrder, $preOrder, 6);
//echo print_r($root, true); exit;

tailOrder($root);
