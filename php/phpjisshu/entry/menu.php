<?php

require "./common.php";

$self_filepath = "./" . basename($_SERVER["SCRIPT_NAME"]);

echo <<<_HERE_
<?xml version="1.0" encoding="Shift_JIS"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="refresh" content="10;url=$input_filepath" />
<title>IT-Lab. �u���\����</title>
</head>
<body>
<div style="text-align:center;">
<h1>���j���[</h1>
<p>�u�u���\���݁v�{�^���������Ă��������B</p>
<p>���̂܂�10�b���ƁA�u���\���݉�ʂ֎����I�ɑJ�ڂ��܂��B</p>
<input type="button" style="width:10em;" value="�u���\����" onclick="location.href='$input_filepath'" />
</div>
</body>
</html>
_HERE_;

?>