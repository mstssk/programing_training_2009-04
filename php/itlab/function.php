<?php

function func_double($var){
  
  if(is_int($var)){
    return $var * 2;
  }elseif(is_string($var)){
    return $var . $var;
  }elseif(is_bool($var)){
    return $var && $var;
  }
  
}


echo func_double(hoge);


?>