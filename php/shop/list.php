<?php
# 商品一覧トップページ
require_once("./common.php");
require_once("Smarty/Smarty.class.php");
$smarty = new Smarty;

$title = "Nozama.co.jp";

$db = new MyDB("localhost", "root");
$product_array = $db->get_list();
$product_array = make_product_list($product_array);
$clm0 = $product_array[0];
$clm1 = $product_array[1];


$smarty->assign("button_a_url", $page_cart);
$smarty->assign("button_a_str", "カート確認");

$smarty->assign("title", $title);
$smarty->assign("url_top", $page_list);
$smarty->assign("clm0", $clm0);
$smarty->assign("clm1", $clm1);

$smarty->display("template.tpl");
?>