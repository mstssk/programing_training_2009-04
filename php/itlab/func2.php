<?php

function sansho(&$var){
  $var = "�Q�Ǝ�";
}

$str = "�ϐ�<br>";
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