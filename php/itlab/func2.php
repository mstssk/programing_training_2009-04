<?php

function sansho(&$var){
  $var = "参照私";
}

$str = "変数<br>";
echo "before : $str";

sansho($str);

echo "after : $str";


echo "<br>################<br>";

function kahen(){
  return "kahen--";
}

$str = "kahen";
echo $str();

?> 