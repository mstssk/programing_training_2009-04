<?php

$var = 0;

function fun1(){
  $var = 1;
}
function fun2(){
  $GLOBALS['var'] = 2;
}


fun1(); echo $var;
fun2(); echo $var;


?>