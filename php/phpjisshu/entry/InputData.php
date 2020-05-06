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
  	# POST���ꂽ�l��ǂݍ���
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

  # �G���[�`�F�b�N
  function errorCheck(){
    #�u�����O�v
    if($this->name == null){
      $this->error_msgs .= "�u�����O�v�͕K�{���͂ł��B<br />";
    }
    #�u�t���K�i�v
    if($this->phonetic == null){
      $this->error_msgs .= "�u�t���K�i�v�͕K�{���͂ł��B<br />";
    }
		# ���[���A�h���X
		if($this->mail == null){
      $this->error_msgs .= "�u���[���A�h���X�v�͕K�{���͂ł��B<br />";
		}elseif(!$this->check_mail_addr($this->mail)){
      $this->error_msgs .= "�u���[���A�h���X�v���s���ł��B<br />";
		}
    # �u���N�����v
    if($this->birth_year <= 0 || $this->birth_month <= 0 || $this->birth_day <= 0){
      $this->error_msgs .= "�u���N�����v�͕K�{���͂ł��B<br />";
    }
		# �d�b�ԍ�
		if(!$this->check_phone_num($this->phone)){
		  $this->error_msgs .= "�u�d�b�ԍ��v�͐����œ��͂��Ă��������B<br />";
		}
		# ��]�u��
		if(!count($this->checks)){
		  $this->error_msgs .= "�u��]�u���v�͕K�{���ڂł��B";
		}
	}

  # ���[���A�h���X�`���`�F�b�N
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
	
	
	# �d�b�ԍ��`�F�b�N
	# �����ȊO��false
	function check_phone_num($in_phone){
	  if(preg_match("/[^\d]/", $in_phone)){
	    return false;
	  }else{
	    return true;
	  }
	}


  # �f�[�^��hidden��input�^�O�ɓ��ꂽ�������Ԃ�
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

  # mysql�ւ� insert���p�̕������Ԃ��B
	function get_data_quoted_str_4applicationtable(){
  	$birthday = $this->birth_year."-".$this->birth_month."-".$this->birth_day;
	  $str = "'$this->name','$this->phonetic','$this->mail',$this->sex,'$birthday','$this->phone','$this->notes'";
	  return $str;
	}


}

?>