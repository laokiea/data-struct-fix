<?php

/**
 * KMP匹配算法
 */
function getNext($str){
	$i = 0;
	$j = -1;
	$next = [];
	$next[$i] = $j;
	while($i < strlen($str)-1) {
		if($j == -1 || $str{$i} == $str{$j}) {
			$j++;
			$i++;
			if($str{$i} != $str{$j}) {
				$next[$i] = $j;
			} else {
				$next[$i] = $next[$j];
			}
		} else {
			$j = $next[$j];
		}
	}
	return $next;
}

function kmp($S,$T) {
	$next = getNext($T);
	$i = 0;
	$j = 0;
	while($i < strlen($S) && $j < strlen($T)) {
		if($j == -1 || $S{$i} == $T{$j}) {
			$j++;
			$i++;
		} else {
			$j = $next[$j];
		}
	}

	if($j == strlen($T)) return $i - $j;
	return -1;
}

echo kmp('abcdabcd','bcda');