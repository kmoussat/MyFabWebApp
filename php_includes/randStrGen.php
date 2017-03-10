<?php
function randStrGen($len){
	$result = "";
    $chars = "abcdefghijklmnopqrstuvwxyz01234567891111111";
    $charArray = str_split($chars);
    for($i = 0; $i < $len; $i++){
	    $randItem = array_rand($charArray);
	    $result .= "".$charArray[$randItem];
    }
    return $result;
}
?>