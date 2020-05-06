<?php

session_start();

# 購入確認ページ
require_once("./common.php");
require_once("Smarty/Smarty.class.php");
$smarty = new Smarty;

$title = "Nozama.co.jp";
$button_b_flg = true;

$cart = new MyCart();
$products = $cart->get();
$clm0 = array();
$clm1 = array();
if(!is_array($products) || $products == null){
  $clm0 = array("カートの中身はありません");
  $button_b_flg = false;
}else{
  $db = new MyDB("localhost", "root");
  foreach($products as $id){
    $product = $db->get_product($id);
    $anchor = make_link_anchor("./product.php?id=" . $id , $product["name"]);
	array_push($clm0, $anchor);
	$price = $product["price"] * $cart->get_num($id) . "（" . $product["price"] ."x". $cart->get_num($id). "個）";
	array_push($clm1, $price);
	$bill += $price;
  }
}
$smarty->assign("button_a_url", $page_cart);
$smarty->assign("button_a_str", "カートへ戻る");


$bill = "合計 : " . $bill;
$smarty->assign("bill", $bill);

$smarty->assign("button_b_flg", $button_b_flg);
$smarty->assign("button_b_url", $page_end);
$smarty->assign("button_b_str", "購入確定");

$smarty->assign("title", $title);
$smarty->assign("url_top", $page_list);
$smarty->assign("clm0", $clm0);
$smarty->assign("clm1", $clm1);

$smarty->display("template2.tpl");
?>