<?php

session_start();

# カートページ
require_once("./common.php");
require_once("Smarty/Smarty.class.php");
$smarty = new Smarty;

$title = "Nozama.co.jp";

$cart = new MyCart();
$products = $cart->get();
$clm0 = array();
$clm1 = array();
if(!is_array($products) || $products == null){
  $clm0 = array("カートの中身はありません");
}else{
  $db = new MyDB("localhost", "root");
  foreach($products as $id){
    $product = $db->get_product($id);
    $anchor = make_link_anchor("./product.php?id=" . $id , $product["name"]);
	array_push($clm0, $anchor);
	$num = $cart->get_num($id);
	array_push($clm1, $num . "個");
  }
}
$smarty->assign("button_a_url", $page_conf);
$smarty->assign("button_a_str", "購入ページ");

$smarty->assign("title", $title);
$smarty->assign("url_top", $page_list);
$smarty->assign("clm0", $clm0);
$smarty->assign("clm1", $clm1);

$smarty->display("template.tpl");
?>