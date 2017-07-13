<?php

interface sort{
	public function sort(array $array);
}

class BubbleSort implements sort{
	// O(n2)
	// public function sort(array $array){
	// 	$count = count($array);
	// 	if($count <= 1) return $array;

	// 	for($i=0;$i<$count;$i++) {
	// 		for($j=$i+1;$j<$count;$j++) {
	// 			if($array[$i] > $array[$j]) {
	// 				$temp = $array[$i];
	// 				$array[$i] = $array[$j];
	// 				$array[$j] = $temp;
	// 			}
	// 		}
	// 	}
	// 	return $array;
	// }

	public function sort(array $array) {
		$count = count($array);
		// O(N2)
		for($i = 1;$i< $count;$i++) {
			for($j=0;$j<$count-$i;$j++) {
				if($array[$j] > $array[$j+1]) {
					$temp = $array[$j];
					$array[$j] = $array[$j+1];
					$array[$j+1] = $temp;
				}
			}
		}
		return $array;
	}
}


class fastSort implements sort {

	public function sort(array $array) {
		if(count($array) < 2) return $array;
		$base = $array[0];
		$left = $right = [];
		for($i=1;$i<count($array);$i++) {
			if($array[$i] <= $base) $left[] = $array[$i];
			if($array[$i] > $base) $right[] = $array[$i];
		}
		$left = $this->sort($left);
		$right = $this->sort($right);
		return array_merge($left,(array)$base,$right);
	}

	public function getBreakIndex(array $array) {
	    $count = count($array);
	    $i = 0;
	    $j = $count-1;
		$baseNum = 0;
		$base = $array[$baseNum];

		while($i!=$j) {
			// $change = false;z
			while($array[$j] > $base) {
				if(--$j == $baseNum) {
					$base = $array[++$baseNum];
					$i=$baseNum;
					$j = $count - 1;
					continue 2;	
				}
				if($j == $i) {
					$t = $array[$i];
					$array[$i] = $array[$baseNum];
					$array[$baseNum] = $t;
					break 2;
				}
			}

			// 如果上个while结束，说明找到了$j位置处小于base
			while($array[$i] <= $base) {
				// 如果$i和$j相遇
				if(++$i == $j) {
					$t = $array[$i];
					$array[$i] = $array[$baseNum];
					$array[$baseNum] = $t;
					break 2;
				}
			}

			// 如果上个while结束，说明找到了$i位置处大于base，$i和$j交换
			$t = $array[$i];
			$array[$i] = $array[$j];
			$array[$j] = $t;
			// $change  = true;
		}
		return [$array, $i];
	}
}

$bs = new BubbleSort();
$fs = new fastSort();
// print_r( $bs->sort([3,4,7,2,8,1,10]) );
print_r( $fs->getBreakIndex([5,7,9,10,8,11,15]) );