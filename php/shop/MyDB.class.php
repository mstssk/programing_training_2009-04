<?php
class MyDB{

  private $con;
  private $table = "catalog";
  private $dbname = "shop";

  function __construct($domain, $username, $pass = ""){
    $this->con = mysql_connect($domain, $username, $pass);
 	mysql_select_db($this->dbname, $this->con);
  }

  # 全商品の情報を2次元配列で返す。
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

  # idによる指定の商品の列ひとつを返す。（配列）
  function get_product($product_id){
    $result = mysql_query("select * from $this->table where id = $product_id", $this->con);
	if($result == null){
	  return false;
	}
    $result = mysql_fetch_array($result);
	return $result;
  }
  
  # idによる指定の商品の在庫数をひとつ減らす。成功の如何を真偽値で返す
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