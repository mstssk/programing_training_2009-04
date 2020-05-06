<?php

require_once("./MyDB.class.php");
require_once("./MyCart.class.php");

$page_list = "./list.php";
$page_prod = "./product.php";
$page_cart = "./cart.php";
$page_conf = "./conf.php";
$page_end  = "./end.php";

$name_db    = "shop";
$name_table = "product_catalog";
$db_user    = "root";
$db_pass    = "";

  function make_link_anchor($url, $str){
    return "<a href=\"$url\">$str</a>";
  }

  # 二次元配列で返す
  function make_product_list($product_list){
    $name  = array("商品名");
    $price = array("価格");
    foreach($product_list as $row){
      $anchor = make_link_anchor("./product.php?id=" . $row["id"] , $row["name"]);
      array_push($name , $anchor);
      array_push($price, $row["price"]);
    }
	return array($name, $price);
  }
  
  # 二次元配列で返す
  function make_product_detail($row){
    $clm0 = array("商品名","メーカー","価格","発売日","在庫数","説明");
	$clm1 = array($row["name"],$row["maker"],$row["price"],$row["releace"],$row["quantity"],$row["comment"]);
	return array($clm0, $clm1);
  }

?>