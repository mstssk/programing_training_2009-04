<html><body>
<?php

# # # #  POST  # # # #
if($_SERVER["REQUEST_METHOD"] == "POST"){
  echo "POST<br>";
  if(isset($_POST["submit"])){
    $text = htmlspecialchars($_POST["kname"], ENT_QUOTES);
    $pass = htmlspecialchars($_POST["pass"], ENT_QUOTES);
    
    if(strlen($text) == 0){
      echo "text�������͂ł��B";
    }else{
      echo "text��$text&nbsp;�Ɠ��͂���܂���";
    }
  
  }

}

# # # #  GET  # # # #

if($_SERVER["REQUEST_METHOD"] == "GET"){
  echo "GET<br>";
  if(isset($_GET["submit"])){
    $text = htmlspecialchars($_GET["kname"], ENT_QUOTES);
    $pass = htmlspecialchars($_GET["pass"], ENT_QUOTES);
    
    if(strlen($text) == 0){
      echo "text�������͂ł��B";
    }else{
      echo "text��$text&nbsp;�Ɠ��͂���܂���";
    }
  
  }

}


?>
</body></html>