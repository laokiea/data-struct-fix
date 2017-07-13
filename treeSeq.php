<?php

/* 
 * @descripe 树的顺序存储
 */

// 1 双亲表示法
// 每一个结点都有一个指针指向双亲。
class Node{
	public function $data;
	public function $parent;
}

class treeList{
	private $list = [];
}