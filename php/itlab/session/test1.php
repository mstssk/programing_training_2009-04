<?php
session_start();

$self = "./" . basename($_SERVER["SCRIPT_NAME"]);

if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["button"])){
  $inputedtext = $_POST["inputtext"] . " ‚Æ‚¢‚¤•¶š—ñ‚ğƒZƒbƒVƒ‡ƒ“‚É•Û‘¶";
  $_SESSION["text"] = $_POST["inputtext"];
}

echo <<<_HERE_
<html><body>
<form action="$self" method="POST">
<input type="text" name="inputtext" />
<input type="submit" name="button" value="submit" />
</form>
$inputedtext
</body></html>
_HERE_;
?>