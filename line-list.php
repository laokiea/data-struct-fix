<?php
/* 
 * @descripe 线性表-链式存储
 */
class Node {
	public $data;
	public $next;

	/* Node对象 next属性是下一个Node对象*/
	public function __construct($data, $next) {
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

	/* 构造一个链表 */
	/*@param $num 线性表的大小 */
	public function createList($num) {
		if($num > self::MAXLENGTH) 
			return false;
		for($i = 1;$i <= $num;$i++) {
			$data = $i;
			$node = new Node($data,$this->next); // 第一个实例化的node是链表的最后一个，next是null		
			$this->next = $node;	 // $this->next起一个承载作用，记住上一个Node对象
		}
	}

	public function createListTail($num) {
		
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
}

$list = LinkList::getInstance();
$list->createList(5);