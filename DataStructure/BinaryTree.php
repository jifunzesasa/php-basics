<?php

class Node {
    public $data;
    public $left;
    public $right;
    
    public function __construct($data) {
        $this->data = $data;
        $this->left = null;
        $this->right = null;
    }
}

class BinaryTree {
    private $root;
    
    public function __construct() {
        $this->root = null;
    }
    
    public function insert($data) {
        $newNode = new Node($data);
        
        if ($this->root === null) {
            $this->root = $newNode;
        } else {
            $this->insertNode($newNode, $this->root);
        }
    }
    
    private function insertNode($newNode, &$subTree) {
        if ($subTree === null) {
            $subTree = $newNode;
        } else if ($newNode->data < $subTree->data) {
            $this->insertNode($newNode, $subTree->left);
        } else {
            $this->insertNode($newNode, $subTree->right);
        }
    }
    
    public function search($data) {
        return $this->searchNode($data, $this->root);
    }
    
    private function searchNode($data, $subTree) {
        if ($subTree === null || $subTree->data === $data) {
            return $subTree;
        } else if ($data < $subTree->data) {
            return $this->searchNode($data, $subTree->left);
        } else {
            return $this->searchNode($data, $subTree->right);
        }
    }
    
    public function inOrderTraversal() {
        $this->inOrder($this->root);
    }
    
    private function inOrder($subTree) {
        if ($subTree !== null) {
            $this->inOrder($subTree->left);
            echo $subTree->data . " ";
            $this->inOrder($subTree->right);
        }
    }
    
    public function preOrderTraversal() {
        $this->preOrder($this->root);
    }
    
    private function preOrder($subTree) {
        if ($subTree !== null) {
            echo $subTree->data . " ";
            $this->preOrder($subTree->left);
            $this->preOrder($subTree->right);
        }
    }
    
    public function postOrderTraversal() {
        $this->postOrder($this->root);
    }
    
    private function postOrder($subTree) {
        if ($subTree !== null) {
            $this->postOrder($subTree->left);
            $this->postOrder($subTree->right);
            echo $subTree->data . " ";
        }
    }

    public function getRoot() {
        return $this->root;
    }
}

// interface Tree {
//     public function insert($data);
//     public function search($data);
//     public function inOrderTraversal();
//     public function preOrderTraversal();
//     public function postOrderTraversal();
// }
// interface TreePrinter {    
//     public function printTree();
// }


class TreePrinter {
    private $binaryTree;
    
    public function __construct($binaryTree) {
        $this->binaryTree = $binaryTree;
    }
    
    public function printTree() {
        $this->printNode($this->binaryTree->getRoot(), "", true);
    }
    
    private function printNode($node, $prefix, $isLeft) {
        if ($node === null) {
            return;
        }
        
        echo $prefix;
        
        $connector = ($isLeft) ? "├──" : "└──";
        echo $connector;
        
        echo $node->data . PHP_EOL;
        
        $newPrefix = ($isLeft) ? $prefix . "│   " : $prefix . "    ";
        
        $this->printNode($node->left, $newPrefix, true);
        $this->printNode($node->right, $newPrefix, false);
    }
}

// FancyPrinter
class FancyPrinter {
    private $binaryTree;
    
    public function __construct($binaryTree) {
        $this->binaryTree = $binaryTree;
    }
    
    public function printPyramid() {
        $root = $this->binaryTree->getRoot();
        if ($root === null) {
            return;
        }
        
        $height = $this->getTreeHeight($root);
        $maxNodeWidth = $this->getNodeWidth($root);
        
        $this->printPyramidHelper($root, $height, $maxNodeWidth);
    }
    
    private function getTreeHeight($node) {
        if ($node === null) {
            return 0;
        }
        
        $leftHeight = $this->getTreeHeight($node->left);
        $rightHeight = $this->getTreeHeight($node->right);
        
        return max($leftHeight, $rightHeight) + 1;
    }
    
    private function getNodeWidth($node) {
        if ($node === null) {
            return 0;
        }
        
        $dataWidth = strlen((string)$node->data);
        $leftWidth = $this->getNodeWidth($node->left);
        $rightWidth = $this->getNodeWidth($node->right);
        
        return max($dataWidth, $leftWidth, $rightWidth);
    }
    
    private function printPyramidHelper($node, $currentLevel, $maxNodeWidth) {
        if ($node === null || $currentLevel <= 0) {
            return;
        }
        
        $numSpaces = $maxNodeWidth * pow(2, $currentLevel - 1);
        
        $this->printSpaces($numSpaces);
        echo str_pad($node->data, $maxNodeWidth, " ", STR_PAD_BOTH);
        $this->printSpaces($numSpaces);
        
        if ($currentLevel > 1) {
            echo str_repeat(" ", $maxNodeWidth);
            $this->printSpaces($numSpaces - 1);
            echo "/";
            $this->printSpaces($numSpaces - 1);
            echo str_repeat(" ", $maxNodeWidth);
            echo PHP_EOL;
            
            echo str_repeat(" ", $maxNodeWidth - 1);
            echo "/";
            echo str_repeat(" ", $numSpaces * 2 - 1);
            echo "\\";
            echo str_repeat(" ", $maxNodeWidth - 1);
            echo PHP_EOL;
        }
        
        $this->printPyramidHelper($node->left, $currentLevel - 1, $maxNodeWidth);
        $this->printPyramidHelper($node->right, $currentLevel - 1, $maxNodeWidth);
    }
    
    private function printSpaces($numSpaces) {
        echo str_repeat(" ", $numSpaces);
    }
}


// Example usage
$tree = new BinaryTree();
$tree->insert(8);
$tree->insert(3);
$tree->insert(10);
$tree->insert(1);
$tree->insert(6);
$tree->insert(14);
$tree->insert(4);
$tree->insert(7);
$tree->insert(13);
$tree->insert(9);


// $tree->inOrderTraversal(); // Output: 1 3 6 8 10 14
// $tree->preOrderTraversal(); // Output: 8 3 1 6 10 14
// $tree->postOrderTraversal(); // Output: 1 6 3 14 10 8

// $searchedNode = $tree->search(6);
// if ($searchedNode !== null) {
//     echo "Node found: " . $searchedNode->data; // Output: Node found: 6
// } else {
//     echo "Node not found.";
// }


echo PHP_EOL;
echo PHP_EOL;

$printer = new TreePrinter($tree);
$printer->printTree();

// $printer = new FancyPrinter($tree);
// $printer->printPyramid();