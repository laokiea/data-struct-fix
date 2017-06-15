<?php

/* 
 * @descripe 栈的链式存储结构
 */
// 同单链表类似，每一个节点都有指向下一个节点的指针域，但是不同于单链表的是，栈只能是top(栈顶)位置的元素在变化，
// 换句话说，栈的插入和删除都是针对固定的位置，不像单链表，只要位置合理，可以是任意的位置。


class Node {
	public $data;
	public $next; // 可以理解成指针，其实还是Node对象
	public function __construct($data = null,$next = null) {
		$this->data = $data;
		$this->next = $next;
	}
}

class StackStructList {
	public $top;
	public $next = null;
	private static $instance = null;

	private function __construct(){}

	private function __clone(){}

	public static function getInstance(){
		if( is_null(self::$instance) || !isset(self::$instance) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	// 理论上size是无限大的
	// 结构类似: 5->{4,{3,{2,{1,null}}}}，不能使用尾插法的结构，是因为不能让最后插入的元素指向null，1->{2,{3,{4,{5,null}}}}，此时5是最后一个插入的元素
	public function initStackStauct($maxsize = 10) {
		for($i=0;$i<$maxsize;$i++) {
			$node = new Node($i,$this->next);
			$this->next = $node;
		}
		// 让栈顶的对象赋值给top
		$this->top = $node;
	}

	public function stackStructInsert($e) {
		$node = new Node($e);
		$node->next = $this->top;
		$this->top = $node;
	}

	public function stackStructDelete(&$e) {
		$e = $this->top->data;
		$this->top = $this->top->next;
	}


}

$ssl = StackStructList::getInstance();
$ssl->initStackStauct(5);
$ssl->stackStructInsert(5);
$ssl->stackStructDelete($e);
var_export($ssl);