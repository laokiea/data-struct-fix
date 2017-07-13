<?php
$input = trim(fgets(STDIN));

if(preg_match("/[^\d\+\-\*\/\(\)]/", $input, $matches)) {
	trigger_error("error input",E_USER_ERROR);
}

$options = [
	'+' => 0,
	'-' => 0,
	'*' => 1,
	'/' => 1,
	'(' => 2,
	')' => 0,
];
$result = '';
$stack = [];
// $chars = str_split($input);

for($i=0;$i<strlen($input);$i++) {
	if( !in_array($input{$i}, array_keys($options)) ) $result .= $input{$i};
	else {
		if(!empty($stack) && $options[$input{$i}] <= $options[end($stack)] ) {
			reset($stack);
			if( $input{$i} == ')' ) {
				foreach($stack as $v) {
					if($v == '(') break;
					$result .= $v;
				}
			} else {
				foreach($stack as $v) {
					if($options[$input{$i}] <= $options[$v]) $result .= $v;
				}
			}
	    }
	    $stack[] = $input{$i};
    }
}
echo str_replace(['(',')'], '', $result);