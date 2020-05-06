<?php

session_start();

$session = &$_SESSION["cart"];

if($session == null){
  echo "ƒJ[ƒg‹ó";
}else{
foreach($session as $key => $value){
  echo "$key : $value<br>";
}
}

$_SESSION["cart"] = null;

?>