<?php

function getQQ(array $encode){
	static $decode = '';
	$count = count($encode);
	if ($count == 1) {$decode.=$encode[0];return;}
	$left = [];
	foreach ($encode as $index => $code) {
		if($index == $count - 1) {
			array_unshift($left, $code);
			break;
		}
		if($index%2 == 0) 
			$decode .= $code;
		else 
			array_push($left, $code);

	}
	getQQ($left);
	return $decode;
}

class queue{
	public $head;
	public $tail;
	// public $size;
	public $list = [];

	public function __construct(){
		// $this->size = $size;
		$this->head = 1;
		$this->tail = 1;
	}

	public function enqueue($e){
		// if(($this->tail + 1) % $this->size) return;
		$this->list[$this->tail] = $e;
		$this->tail++;
	}

	public function dequeue(&$e){
		// if($this->tail == $this->head) return;
		$e = $this->list[$this->head];
		$this->head++;
	}

	public function getQQ(){
		while($this->head != $this->tail) {
			$this->dequeue($e);echo $e;
			if($this->head == $this->tail) return;
			$this->enqueue($this->list[$this->head]);
			$this->head++;
		}
	}

	public function init($str){
		for($i=0;$i<strlen($str);$i++) {
			$this->enqueue($str{$i});
		}
	}
}

// $queue = new queue();
// $queue->init('631758924');
// $queue->getQQ();
// echo getQQ([6,3,1,7,5,8,9,2,4]);

function jungle($str){
	if($str === strrev($str)) return true;
	return false;
}


class stack{
	public $list = [];
	public $top = -1;

	public function enstack($e){
		$this->list[++$this->top] = $e;
		// $this->top++;
	}

	public function destack(&$e){
		$e = $this->list[$this->top--];
		// $this->top--;
	}

	public function jungle($str){
		$options = ['(' => ')','{' => '}','[' => ']'];
		for($i=0;$i<strlen($str);$i++){
			if(in_array($str{$i},array_keys($options))) {
				$this->enstack($str{$i});
			} else {
				if($this->top < 0) return false;
				$this->destack($e);
				if($options[$e] != $str{$i}) return false;
			}
		}
		return true;
	}
}

$stack = new stack();
// var_dump($stack->jungle('(({}[])))'));


function game(array $a1,array $a2){
	$cards = [];
	$current = 'a1';
	while(count($a1) > 0 && count($a2) > 0) {
		$card = array_shift($$current);

		if(in_array($card, $cards)) {
			$index = array_search($card, $cards);
			$gets = array_slice($cards,0,$index+1);
			array_unshift($gets, $card);
			$$current = array_merge($$current,$gets);var_export($$current);
		} else {
			array_unshift($cards, $card);
		}

		$current = $current == 'a1' ?  'a2' : 'a1';
	}
	return [$a1,$a2];
}

// var_export(game([2,4,3],[4,3,5]));