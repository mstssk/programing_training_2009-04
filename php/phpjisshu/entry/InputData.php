<?php
class InputData{

  public $name;
  public $phonetic;
	public $mail;
	public $sex;
  public $birth_year;
  public $birth_month;
  public $birth_day;
  public $phone;
  public $checks = array();
  public $notes;

  public $error_msgs = null;

  function load($input){
  	# POSTされた値を読み込み
	  $this->name        = htmlspecialchars($input["name"], ENT_QUOTES);
	  $this->phonetic    = htmlspecialchars($input["phonetic"], ENT_QUOTES);
		$this->mail        = htmlspecialchars($input["mail"], ENT_QUOTES);
		$this->sex         = $input["sex"];
	  $this->birth_year  = intval($input["birth_year"]);
	  $this->birth_month = intval($input["birth_month"]);
	  $this->birth_day   = intval($input["birth_day"]);
		$this->phone       = intval($input["phone"]);
	  $this->checks      = $input["checks"];
		$this->notes       = htmlspecialchars($input["notes"]);
		
		if($this->sex == null){
		  $this->sex = 3;
		}
		
		$this->loadedFlg = true;
		$this->error_msgs = null;
	}

  function delChecked($key){
	  unset($this->checks["$key"]);
	}

  # エラーチェック
  function errorCheck(){
    #「お名前」
    if($this->name == null){
      $this->error_msgs .= "「お名前」は必須入力です。<br />";
    }
    #「フリガナ」
    if($this->phonetic == null){
      $this->error_msgs .= "「フリガナ」は必須入力です。<br />";
    }
		# メールアドレス
		if($this->mail == null){
      $this->error_msgs .= "「メールアドレス」は必須入力です。<br />";
		}elseif(!$this->check_mail_addr($this->mail)){
      $this->error_msgs .= "「メールアドレス」が不正です。<br />";
		}
    # 「生年月日」
    if($this->birth_year <= 0 || $this->birth_month <= 0 || $this->birth_day <= 0){
      $this->error_msgs .= "「生年月日」は必須入力です。<br />";
    }
		# 電話番号
		if(!$this->check_phone_num($this->phone)){
		  $this->error_msgs .= "「電話番号」は数字で入力してください。<br />";
		}
		# 希望講座
		if(!count($this->checks)){
		  $this->error_msgs .= "「希望講座」は必須項目です。";
		}
	}

  # メールアドレス形式チェック
  function check_mail_addr($in_mail){
		$wsp           = '[\x20\x09]';
		$vchar         = '[\x21-\x7e]';
		$quoted_pair   = "\\\\(?:$vchar|$wsp)";
		$qtext         = '[\x21\x23-\x5b\x5d-\x7e]';
		$qcontent      = "(?:$qtext|$quoted_pair)";
		$quoted_string = "\"$qcontent*\"";
		$atext         = '[a-zA-Z0-9!#$%&\'*+\-\/\=?^_`{|}~]';
		$dot_atom_text = "$atext+(?:[.]$atext+)*";
		$dot_atom      = $dot_atom_text;
		$local_part    = "(?:$dot_atom|$quoted_string)";
		$domain        = $dot_atom;
		$addr_spec     = "${local_part}[@]$domain";
		if(preg_match("/\A$addr_spec\z/", $in_mail)){
		  return true;
		}else{
		  return false;
		}
	}
	
	
	# 電話番号チェック
	# 数字以外はfalse
	function check_phone_num($in_phone){
	  if(preg_match("/[^\d]/", $in_phone)){
	    return false;
	  }else{
	    return true;
	  }
	}


  # データをhiddenなinputタグに入れた文字列を返す
  function get_data_hidden(){
	  $str .= "<input type=\"hidden\" name=\"name\" value=\"$this->name\">";
	  $str .= "<input type=\"hidden\" name=\"phonetic\" value=\"$this->phonetic\">";
	  $str .= "<input type=\"hidden\" name=\"mail\" value=\"$this->mail\">";
	  $str .= "<input type=\"hidden\" name=\"sex\" value=\"$this->sex\">";
	  $str .= "<input type=\"hidden\" name=\"birth_year\" value=\"$this->birth_year\">";
	  $str .= "<input type=\"hidden\" name=\"birth_month\" value=\"$this->birth_month\">";
	  $str .= "<input type=\"hidden\" name=\"birth_day\" value=\"$this->birth_day\">";
	  $str .= "<input type=\"hidden\" name=\"phone\" value=\"$this->phone\">";
		foreach($this->checks as $key => $value){
		  $str .= "<input type=\"hidden\" name=\"checks[]\" value=\"$value\">";
		}
		$str .= "<input type=\"hidden\" name=\"notes\" value=\"$this->notes\">";

    return $str;
	}

  # mysqlへの insert文用の文字列を返す。
	function get_data_quoted_str_4applicationtable(){
  	$birthday = $this->birth_year."-".$this->birth_month."-".$this->birth_day;
	  $str = "'$this->name','$this->phonetic','$this->mail',$this->sex,'$birthday','$this->phone','$this->notes'";
	  return $str;
	}


}

?>