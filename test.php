<?php
echo substr_replace('huevos','x',-2,-2);
$word = 'monsieurs';
$letter = 's';

$pos = stripos($word, $letter);
echo $pos;
if($pos != false){
	echo substr_replace($word, $letter, $pos, 0);
}