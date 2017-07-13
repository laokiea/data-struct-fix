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

// $list = LinkList::getInstance();
// $list->createListTail(5);
// echo $list->getELem(3);
// $list->listInsert(3,3.5);
// $list->ListDelete(2,$e);
// echo $e;
// $list->clearList();
// var_export(get_defined_vars());


/***************************************************************************************************************************************************/


// 一个类表示单链表
class LineStruct{
	public $data;
	public $next;

	public function  __construct($data = null, $next = null){
		$this->data = $data;
		$this->next = $next;
	}
}

function createListHead(LineStruct &$linelist,$initSize = 5){ 
	for($i = 1; $i <= $initSize; $i++) {
		$node = new LineStruct($i);
		$node->next = $linelist->next;
		$linelist->next = $node;
	}
}

function createListTail(LineStruct &$linelist,$initSize = 5) {
	$tail = $linelist;
	for($i = 1; $i <= $initSize; $i++) { 
		$node = new LineStruct($i);
		$node->next = $tail->next;
		$tail->next = $node;
		$tail = $node;
	}
}

// $i之后的位置插入
function listInsert(LineStruct &$linelist, $i, $e) {
	// 第一个结点
	$p = $linelist->next;
	$j = 1;
	while ($p && $j < $i) {
		$p = $p->next;
		$j++;
	}
	// 此时p指向第i个元素
	$node = new LineStruct($e);
	$node->next = $p->next;
	$p->next = $node;
}

// 删除第i个结点
function listDelete(LineStruct &$linelist, $i) {
	// 第一个结点
	$p = $linelist->next;
	$j = 1;
	while ($p && $j < $i-1) {
		$p = $p->next;
		$j++;
	}
	// 此时$p是i-1的位置,$n是第n个位置
	$n = $p->next;
	$p->next = $n->next;
}

// $ = new LineStruct('');// 头结点 指向第一个结点
// createListHead($linelist,5);
// createListTail($linelist,5);
// listInster($linelist,3,'hello');
// listDelete($linelist,2);
// var_export($linelist);


/* 关于单链表的部分习题 */
// 1. 逆序构造单链表: 使链表结构是6->5->4->3->2->1
// 使用头插法即可
// 头结点
$linelist = new LineStruct('');
createListHead($linelist,6);
// var_export($linelist);

// 2. 链表反转: 假设有链表6->5->4->3->2->1,反转链表成为1->2->3->4->5->6
function reverse(LineStruct $linelist) {
	// 第一个结点
	$pre = null;
	$leftNodes = $linelist->next;	
	while($leftNodes) {
		$temp = $leftNodes->next;
		$leftNodes->next = $pre;
		$pre = $leftNodes;
		$leftNodes = $temp;
	}
	$headNode = new LineStruct('',$pre);
	return $headNode;
}
// var_export(reverse($linelist));


// 3. 链表升序排序
function asc_sort($beginNode, $endNode) {
	if($beginNode == $endNode || $beginNode->next == null) return;
	$base = $beginNode->data;
	$i = $begin;
	$j = $begin->next;
}
asc_sort($linelist->next,null);