<?php

/* 
 * @descripe 循环队列
 */

 // $queue = new splQueue();
 // $queue->enqueue('hello'); 
 // echo $queue->dequeue();

// 当队满时， rear=front,但这个条件是必要不充分条件。因为，当队列为空时，rear也等于front，
// 所以保持队列任何时候都有一个空元素，当rear指向最后一个空元素时，即为队满
// 所以如果一个队列的长度(对应的数组)设定为5，那么这个队列只能放四个元素，留一个空位置判断队满的情况
class QueueSeq {
	private $list = [];
	private $front = 0;
	private $rear = 0;
	const MAXSIZE = 5;

	public function enqueue($e) {
		// 判断满队列
		if( ($this->rear + 1) % self::MAXSIZE == $this->front) 
			trigger_error("full queue",E_USER_ERROR);
		$this->list[$this->rear] = $e;
		$this->rear == ++$this->rear % self::MAXSIZE;
		return true;
	}

	public function dequeue(&$e) {
		// 判断空队列
		if($this->front == $this->rear)
			trigger_error("empty queue",E_USER_ERROR);
		$e = $this->list[$this->front];
		$this->front = ++$this->front % self::MAXSIZE;
		return true;
	}
}

$queue = new QueueSeq();
$str = 'hell';
for ($i=0; $i < strlen($str); $i++) { 
	$queue->enqueue($str{$i});
}

var_dump($queue);