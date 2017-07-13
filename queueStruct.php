<?php

/* 
 * @descripe 链式队列
 */

class Node{
	public $data;
	public $next;
	public function __construct($data = null, $next = null){
		$this->data = $data;
		$this->next = $next;
	}
}

class QueueLinkList{
	private $front;
	private $rear;

	// 不管是队列还是栈都是在固定位置操作数据的插入和删除
	public function enqueue($e){
		$node = new Node($e);
		$this->rear->next = $node;
		$this->rear = $node;
		return true;
	}

	// 出队
	public function dequeue(&$e){
		if($this->front === $this->rear) 
			trigger_error("empty queue",E_USER_ERROR);
		$node = $this->front->next;
		$e = $node->data;
		$this->front->next = $node->next;
		// 置空队列
		if($this->rear === $node) $this->rear == $this->front;
		return true;
	}

	// 初始化
	public function initQueue(){
		$this->front = $this->rear = new Node();
	}
}

$queue = new QueueLinkList();
$queue->initQueue();
$queue->enqueue('hello');
$queue->enqueue('world');
$queue->enqueue('达到');
$queue->dequeue($e);
echo $e;
$queue->dequeue($e);
echo $e;
