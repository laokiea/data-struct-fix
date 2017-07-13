<?php

/* 
 * @descripe 顺序栈
 */

class Stack {
	public $list = [];
	public $top = -1;
	public $maxSize;

	public function __construct($maxSize = 10) {
		$this->maxSize = $maxSize;
	}

	public function stackInsert($e) {
		if($this->top == $this->maxSize - 1) 
			trigger_error("溢出",E_USER_ERROR);
		$this->top++;
		$this->list[$this->top] = $e; 
		return true;
	}

	public function stackDelete(&$e) {
		if($this->top == -1)
			trigger_error("空栈",E_USER_ERROR);
		$e = $this->list[$this->top];
		$this->top--;
		return true;
	}
}

/* 
 * @descripe 两栈共享空间 用一个数组表示两个顺序栈，通常用于两个栈有相反的需求关系。
 */

class DoubleStack {
	public $list = [];
	public $top1 = -1;
	public $top2;
	public $maxSize;

	public function __construct($maxSize = 10) {
		$this->maxSize = $this->top2 = $maxSize;
	} 

	public function dblStackInsert($e, $flag = 1) {
		if($this->top1 + 1 == $this->top2)
			trigger_error("溢出",E_USER_ERROR);
		if($flag == 1) {
			$this->list[++$this->top1] = $e
		}
		else{
			$this->list[--$this->top2] = $e;
		}
		return true;
	}

	public function dblStackDelete($flag = 1, &$e) {
		if($flag == 1) {
			if($this->top1 == -1) trigger_error("空栈",E_USER_ERROR); 
			$e = $this->list[$this->top1--];
		} else {
			if($this->top2 == $this->maxSize) trigger_error("空栈",E_USER_ERROR); 
			$e = $this->list[$this->top2++];
		}
	}
}


// $stack = new Stack(10);
// $str = 'helloworld';
// for($i=0;$i<strlen($str);$i++) {
// 	$stack->stackInsert($str{$i});
// }
// $stack->stackDelete($e);
// // echo $e;
