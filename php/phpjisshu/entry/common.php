<?php

# ファイルパス
$input_filepath= "./input.php";
$conf_filepath = "./conf.php";
$end_filepath  = "./end.php";

require_once("./InputData.php");


/*

  # 文字列長チェック
	function check_str_len($str){
	  $len = strlen($str);
	  if($len <= 255 && $len > 0){
		  return true;
		}else{
		  return false;
		}
	}

  # フリガナちぇっく
	# カタカナのみ（sjis前提）
  function check_phonetic($in_phonetic){
	
	  #if(preg_match('/[!-\}]/', $in_phonetic)){
		#  echo "[!-\}]";
		#  return false;
		#}
		if(preg_match("/[^ァ-ヶ　 ]/", $in_phonetic) ){
		  #echo '[^ァ-ヶ　 ]';
		  return false;
		}else{
		  return true;
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
	
	# 講座選択チェック
	function check_course_select($in_couse){
	  if($in_couse == null){
		  return false;
		}
		if(count($in_couse) >= 1){
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

*/
	
	# 曜日の漢字取得
	function get_week_day_char($date){
	  $day = date("w", $date);
		switch($day){
		  case 0: return "日";
		  case 1: return "月";
		  case 2: return "火";
		  case 3: return "水";
		  case 4: return "木";
		  case 5: return "金";
		  case 6: return "土";
		}
	}
	
	
	## 関数定義
  function create_optiontag($start, $end, $selected = -1, $str_format = "%d", $top_novalue_flg = TRUE){
  $str = "";
  ## 入力値のチェック：整数かどうか
  if(!is_int($start) || !is_int($end)){
    return "ERROR:Function create_optiontag : argments is not integer.";
  }
  ## 1番目にダミー表示のものを付加
  if($top_novalue_flg){
    $str .= "<option value=\"-1\"></option>";
  }
  for($i = $start; $i <= $end; $i++){
    if($i == intval($selected)){
      $str .= "<option value=\"${i}\" selected=\"selected\">" . sprintf($str_format, $i) . "</option>";
    }else{
      $str .= "<option value=\"${i}\">" . sprintf($str_format, $i) . "</option>";
    }
  }
  return $str;
}


?>