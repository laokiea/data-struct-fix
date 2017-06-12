<?php
/* 
 * @descripe 线性表-链式存储
 */
class Node {
	public $data;
	public $next;

	/* Node对象 next属性是下一个Node对象*/
	public function __construct($data = null, $next = null) {
		$this->data = $data;
		$this->next = $next;
	}
}

class LinkList {

	CONST MAXLENGTH = 10; 
	static private $instance;

	public $next;

	private function __construct() {}

	private function __clone() {}

	static public function getInstance() {
		if(is_null(self::$instance) ||!isset(self::$instance)) {
			self::$instance = new self();
		}
		self::$instance->init();
		return self::$instance;
	}

	public function init() {
		$this->next = null;
	}

	/* 构造一个链表 整表创建 */
	/*@param $num 线性表的大小 */
	public function createListHead($num) {
		if($num > self::MAXLENGTH) 
			return false;
		for($i = 1;$i <= $num;$i++) {
			$data = $i;
			$node = new Node($data,$this->next); // 第一个实例化的node是链表的最后一个，next是null		
			$this->next = $node;	 // $this->next起一个承载作用，记住上一个Node对象
		}
	}

	public function createListTail($num) {
		$tail = $this;
		for($i = 0;$i<$num;$i++) {
			$data = $i;
			$node = new Node($data, null);
			$tail->next = $node;
			$tail = $node;
		}
	}	

	/* 获取第i个元素 */
	public function getELem($i) {
		if($i < 1 || $i > self::MAXLENGTH)
			return false;	
		$j = 1;
		$next = $this->next; // 是第一个node对象
		while($next && $j < $i) {
			$next = $next->next;
			$j++;
		}
		if(!$next || $j > $i) 
			return false;
		return $next->data;
	}

	/* 获取链表长度 */
	// public function listLength() {
	// 	$count = 0;
	// 	$next = $this->next;
	// 	while($next) {
	// 		$next = $next->next;
	// 		$count++;
	// 	}
	// 	return $count;
	// }

	/* 第i个位置插入元素 */
	public function listInsert($i, $data) {
		if($i < 1 || $i > self::MAXLENGTH)
			return false;	
		$j = 1;
		$next = $this->next;
		while($next && $j < $i) {
			$next = $next->next;
			$j++;
		}
		if(!$next || $j > $i) 
			return false;
		$node = new Node($data);
		$node->next = $next->next;
		$next->next = $node;
	}

	/* 删除第i个元素 */
	public function ListDelete($i, &$e) {
		if($i < 1 || $i > self::MAXLENGTH)
			return false;	
		$j = 1;
		$next = $this->next;
		while ($next && $j < ($i - 1)) {
			$next = $next->next;
			$j++;
		}
		$q = $next->next;
		$p = $q->next;
		$next->next = $p;
		$e = $q->data;
	}

	/* 整表删除 */
	public function clearList() {
		$p = $this->next;
		while($p) {
			$node = $p->next;
			unset($p);
			$p = $node;
		}
	}
}

$list = LinkList::getInstance();
$list->createListTail(5);
// echo $list->getELem(3);
// $list->listInsert(3,3.5);
// $list->ListDelete(2,$e);
// echo $e;
$list->clearList();
// var_export(get_defined_vars());