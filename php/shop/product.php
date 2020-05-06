<?php

session_start();

# ���i�ڍ׃y�[�W
require_once("./common.php");
require_once("Smarty/Smarty.class.php");
$smarty = new Smarty;

$title = "Nozama.co.jp";
$id = $_GET["id"];

if(!$id){
  die("�����ȃA�N�Z�X");
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cartin"])){
  $cart = new MyCart();
  if(!$cart->exist($id)){
    $cart->add($id);
  }else{
    $cart->add_num($id);
  }
}

$db = new MyDB("localhost", "root");
$product_array = $db->get_product($id);
if($product_array){
  $product_array = make_product_detail($product_array);
  $clm0 = $product_array[0];
  $clm1 = $product_array[1];
}else{
  die("�����ȃA�N�Z�X");
}

$smarty->assign("button_a_url", $page_cart);
$smarty->assign("button_a_str", "�J�[�g�m�F");

$smarty->assign("button_b_flg", true);
$smarty->assign("button_b_value", $_GET["id"]);
$smarty->assign("button_b_url", $_SERVER["REQUEST_URI"]);
$smarty->assign("button_b_str", "�J�[�g�ɓ����");

$smarty->assign("title", $title);
$smarty->assign("url_top", $page_list);
$smarty->assign("clm0", $clm0);
$smarty->assign("clm1", $clm1);

$smarty->display("template.tpl");
?>