<?php

session_start();

# ���i�ڍ׃y�[�W
require_once("./common.php");
require_once("Smarty/Smarty.class.php");
$smarty = new Smarty;

$title = "Nozama.co.jp";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["conf"])){
  $cart = new MyCart();
  $products = $cart->get();
  $db = new MyDB("localhost", "root");

  foreach($products as $id){
    $db->product_decrement($id, $cart->get_num($id));
  }

  $cart->clr();

  $smarty->assign("button_a_url", $page_list);
  $smarty->assign("button_a_str", "�g�b�v�y�[�W��");

  $smarty->assign("title", $title);
  $smarty->assign("url_top", $page_list);
  
  $smarty->display("template3.tpl");

}else{
  echo "�s���ȃA�N�Z�X";
}

?>