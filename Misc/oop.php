<?php

class MyList{
    private $list = [];
    function &getList(){
        return $this->list;
    }
    function add($item){
        $this->list[] = $item;
    }
}

$list = new MyList();
$list->add(1);
$list->add(2);

$arr = &$list->getList();
$arr[] = 3;
$arr[] = 4;

print_r($list->getList());
