<?php
require_once("Smarty/Smarty.class.php");
$smarty = new Smarty;

$title = "Nozama.co.jp";
$logo = $title;

$button_a = "�J�[�g�ɓ����";

$smarty->assign("title", $title);
$smarty->assign("buton_a", $button_a);

$smarty->display("template.tpl");

?>