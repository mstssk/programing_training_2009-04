<?php
session_start();

$temp = $_SESSION["text"];

echo <<<_HERE_
<html><body>
�Z�b�V��������Ăяo����������<br />
$temp
</body></html>
_HERE_;

?>