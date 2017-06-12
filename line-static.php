<?php
/* 
 * @descripe 线性表-静态链表
 */

class Node {
	public $data;
	public $cursor;
	public function __construct($data = null, $cursor = null) {
		$this->data = $data;
		$this->cursor = $cursor;
	}
}

class StaticList {

	// 静态链表的下标并不像普通数组那样代表书序，而是每一个元素的cursor代表着顺序
	// 比如要找到第二个元素，并不是下标为2的元素，而是第一个元素的cursor，这个cursor代表着第二个元素的下标值

	const MAXSIZE=100;
	public $list = [];
	private static $instance = null;

	private function __construct() {}

	private function __clone() {}

	static public function getInstance() {
		if(is_null(self::$instance) || !isset(self::$instance)) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	// 找到备用链表的第一个元素
	public function molloc_lls() {
		// 第0个元素的游标值指向备用链表的第一个元素下标
		$first = $this->list[0]->cursor; 
		// 第0个元素的游标值
		if($first) {
			$this->list[0]->cursor = $this->list[$first]->cursor;
			return $first;
		}
		return 0;
	}

	// 在第i个元素之前插入
	public function listInsert($i, $e){
		// 首先找到备用的第一个元素，将值放到这个位置，再用游标去控制它的逻辑位置
		$first = $this->molloc_lls();
		if($first) {
			//指向最后一个元素，最后一个元素的cursor指向了有元素链表的第一个值的下标，由第一个元素慢慢地递推，直到找到第i个元素之前的元素下标
			$k = self::MAXSIZE - 1; 
			// 接着要找到第i个元素之前的那个元素的下标值，这个元素的cursor要指向我们刚刚放在备用链表的元素的位置
			for($m=0;$m<$i - 1;$m++ ) {
				// 比如在3之前插入一个，遍历两次，第一次找到第一个，第二次找到第二个元素的下标值
				$k = $this->list[$k]->cursor;
			}
			$this->list[$first]->data = $e;
			$this->list[$first]->cursor = $this->list[$k]->cursor;
			$this->list[$k]->cursor = $first;
			return true;
		}
		return false;
	}

	// 删除第i个元素
	public function listDelete($i, &$e) {
		// 这个i并不是数组的下标的i,而是第i个cursor代表的元素
		// 只需要将i之前的元素的cursor指向i后一个元素的下标
		// i之前的元素的下标
		$k = self::MAXSIZE - 1;
		for($m =0;$m < $i - 1;$m++) {
			$k = $this->list[$k]->cursor;
		}
		// 第i个元素的下标
		$next = $this->list[$k]->cursor;
		// i之前的元素的cursor指向i后面元素的下标
		$this->list[$k]->cursor = $this->list[$next]->cursor;
		$e = $this->list[$next]->data;
		// 让数组第一个元素指向该元素
		$this->free_lls($next);
	}	

	// 重置备用链表
	public function free_lls($k){
		// 将下标为k的元素，放到备用链表的第一个
		// 先将原来的第一个备用链表元素的下标赋给第k个元素的cursor
		$this->list[$k]->cursor = $this->list[0]->cursor;
		// 再将第一个元素的cursor指向下标k
		$this->list[0]->cursor = $k;
	}

	// 初始化静态链表
	public function initList() {
		for($i = 0; $i < self::MAXSIZE - 1;$i++) {
			$node = new Node(null,$i+1);
			$this->list[$i] = $node;
		}
		$this->list[self::MAXSIZE - 1] = new Node(null,0);
	}
}

$list = StaticList::getInstance(); 
$list->initList();
$list->listInsert(5,'helloworld');
var_export($list);