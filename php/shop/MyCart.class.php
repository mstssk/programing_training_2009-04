<?php
session_start();
class MyCart{

  private $cart;
  private $nums; # id���L�[�ɂ����A�z�z��Ƃ��ē���

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

  # �J�[�g�̒��g�z��ŕԂ�
  function get(){
    return $this->cart;
  }

  # id���w�肵�Č����擾
  function get_num($id){
    return $this->nums[$id];
  }

  # ���i���J�[�g�ɓ����Ă��邩�ǂ���
  function exist($id){
    foreach($this->cart as $value){
	  if($id == $value){
	    return true;
	  }
	}
	return false;
  }

  # �J�[�g�ɉ�����
  function add($product_id, $num = 1){
    array_push($this->cart, $product_id);
	$this->nums[$product_id] = $num;
  }
  
  function add_num($product_id, $num = 1){
    $this->nums[$product_id] += $num;
  }
  
  # �J�[�g�����菜��
  function del($product_id){
    foreach($this->cart as $key => $value){
	  if($value == $product_id){
        unset($this->cart[$key]);
        unset($this->nums[$value]);
        break;
      }
    }
  }

  # �J�[�g�̒��g�����ׂď���
  function clr(){
    $this->cart = null;
	$this->nums = null;
    unset($this->cart);
    unset($this->nums);
  }

}
?>