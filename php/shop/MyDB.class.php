<?php
class MyDB{

  private $con;
  private $table = "catalog";
  private $dbname = "shop";

  function __construct($domain, $username, $pass = ""){
    $this->con = mysql_connect($domain, $username, $pass);
 	mysql_select_db($this->dbname, $this->con);
  }

  # �S���i�̏���2�����z��ŕԂ��B
  function get_list(){
    $array = array();
	$query = "select * from $this->table";
    $result = mysql_query($query, $this->con);
	if(!$result){
	  die(mysql_error());
	}
	while($row = mysql_fetch_array($result)){
	  array_push($array, $row);
	}
	return $array;
  }

  # id�ɂ��w��̏��i�̗�ЂƂ�Ԃ��B�i�z��j
  function get_product($product_id){
    $result = mysql_query("select * from $this->table where id = $product_id", $this->con);
	if($result == null){
	  return false;
	}
    $result = mysql_fetch_array($result);
	return $result;
  }
  
  # id�ɂ��w��̏��i�̍݌ɐ����ЂƂ��炷�B�����̔@����^�U�l�ŕԂ�
  function product_decrement($product_id, $num = 1){
    $result = mysql_query("update $this->table set quantity = quantity - $num where id = $product_id", $this->con);
    if($result){
	  return true;
	}else{
	  return false;
	}
  }

}

?>