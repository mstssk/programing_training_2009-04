<?php
session_start();
class MyCart{

  private $cart;
  private $nums; # idをキーにした連想配列として動作

  function __construct(){
    $this->cart = &$_SESSION["cart"];
    if(!is_array($this->cart)){
	  $this->cart = array();
    }

	$this->nums = &$_SESSION["nums"];
    if(!is_array($this->nums)){
	  $this->nums = array();
    }
  }

  # カートの中身配列で返す
  function get(){
    return $this->cart;
  }

  # idを指定して個数を取得
  function get_num($id){
    return $this->nums[$id];
  }

  # 商品がカートに入っているかどうか
  function exist($id){
    foreach($this->cart as $value){
	  if($id == $value){
	    return true;
	  }
	}
	return false;
  }

  # カートに加える
  function add($product_id, $num = 1){
    array_push($this->cart, $product_id);
	$this->nums[$product_id] = $num;
  }
  
  function add_num($product_id, $num = 1){
    $this->nums[$product_id] += $num;
  }
  
  # カートから取り除く
  function del($product_id){
    foreach($this->cart as $key => $value){
	  if($value == $product_id){
        unset($this->cart[$key]);
        unset($this->nums[$value]);
        break;
      }
    }
  }

  # カートの中身をすべて消す
  function clr(){
    $this->cart = null;
	$this->nums = null;
    unset($this->cart);
    unset($this->nums);
  }

}
?>