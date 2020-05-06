<?php
session_start();

$temp = $_SESSION["text"];

echo <<<_HERE_
<html><body>
セッションから呼び出した文字列<br />
$temp
</body></html>
_HERE_;

?>