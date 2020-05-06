<?php

function sansho(&$var){
  $var = "ŽQÆŽ„";
}

$str = "•Ï”<br>";
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