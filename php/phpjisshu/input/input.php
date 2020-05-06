<?php

# �t�@�C���p�X
$self_filepath = "./" . basename($_SERVER["SCRIPT_NAME"]);
$conf_filepath = "./conf.php";
$end_filepath = "./end.php";

# �G���[���b�Z�[�W
$error_msgs = null;

# ���͒l(����т��̃f�t�H���g�l)
$courseno;
$coursename;
$thedate_year;
$thedate_month;
$thedate_day;
$starttime_h;
$starttime_m = -1;
$endtime_h;
$endtime_m = -1;

# POST������B submit���ꂽ���A�܂��͎���ʂ���߂��Ă�����
if($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["submit"]) || isset($_POST["back"]))){
  
  # POST���ꂽ�l��ǂݍ���
  $courseno      = htmlspecialchars($_POST["courseno"], ENT_QUOTES);
  $coursename    = htmlspecialchars($_POST["coursename"], ENT_QUOTES);
  $thedate_year  = intval($_POST["thedate_year"]);
  $thedate_month = intval($_POST["thedate_month"]);
  $thedate_day   = intval($_POST["thedate_day"]);
  $starttime_h   = intval($_POST["starttime_h"]);
  $starttime_m   = intval($_POST["starttime_m"]);
  $endtime_h     = intval($_POST["endtime_h"]);
  $endtime_m     = intval($_POST["endtime_m"]);
  $vacantseats   = htmlspecialchars($_POST["vacantseats"], ENT_QUOTES);
  
  # ����ʂ���߂��Ă������̓G���[�`�F�b�N���Ȃ�
  if(!isset($_POST["back"])){
    # �G���[�`�F�b�N
    #�u�u���ԍ��v
    if($courseno == null){
      $error_msgs .= "�u�u���ԍ��v�͕K�{���͂ł��B<br />";
    }elseif(preg_match("/[^\d]/", $courseno) || floor($courseno / 10000)){
      $error_msgs .= "�u�u���ԍ��v��4���̔��p�����œ��͂��Ă��������B<br />";
    }
    #�u�u�����v
    if($coursename == null){
      $error_msgs .= "�u�u�����v�͕K�{���͂ł��B<br />";
    }elseif(strlen($coursename) > 40){
      $error_msgs .= "�u�u�����v��40���ȓ��œ��͂��Ă��������B<br />";
    }
    # �u�u���J�Ó��v
    if($thedate_year <= 0 || $thedate_month <= 0 || $thedate_day <= 0){
      $error_msgs .= "�u�u���J�Ó��v�͕K�{���͂ł��B<br />";
    }
    # �u�J�n�����v
    if($starttime_h <= 0 || $starttime_m < 0){
      $error_msgs .= "�u�J�n�����v�͕K�{���͂ł��B<br />";
    }
    # �u�I�������v
    if($endtime_h <= 0 || $endtime_m < 0){
      $error_msgs .= "�u�I�������v�͕K�{���͂ł��B<br />";
    }
    # �J�n�����ƏI�������̐���
    if((($starttime_h * 100 ) + $starttime_m) >= (($endtime_h * 100) + $endtime_m)){
      $error_msgs .= "�u�J�n�����v�́u�I�������v���O�ɂ��Ă��������B<br />";
    }
    #�u����v
    if($vacantseats == null){
      $error_msgs .= "�u����v�͕K�{���͂ł��B<br />";
    }elseif(preg_match("/[^\d]/", $vacantseats)){
      $error_msgs .= "�u����v�͔��p�����œ��͂��Ă��������B<br />";
    }elseif($vacantseats > 50 || $vacantseats < 1){
      $error_msgs .= "�u����v��50���܂łł��B<br />";
    }
  }
}

# �G���[������������A�f�[�^��POST����conf.php�ɑJ��
if($error_msgs == null && isset($_POST["submit"])  && !isset($_POST["back"])){
  require($conf_filepath);
}else{

  # option�^�O�𐶐�
  $thisyear = intval(date("Y"));
  $optiontags_thedate_year  = create_optiontag($thisyear, $thisyear + 4, $thedate_year);
  $optiontags_thedate_month = create_optiontag(1, 12, $thedate_month);
  $optiontags_thedate_day   = create_optiontag(1, 31, $thedate_day);
  $optiontags_starttime_h = create_optiontag(10, 18, $starttime_h);
  $optiontags_starttime_m = create_optiontag(0, 59, $starttime_m, "%02d");
  $optiontags_endtime_h = create_optiontag(10, 18, $endtime_h);
  $optiontags_endtime_m = create_optiontag(0, 59, $endtime_m, "%02d");
  
  # ��ʕ`��
echo <<<_HERE_
  <html>
  <head><title>IT-Lab. �u���o�^</title></head>
  <body><div>
  <h1>�u���o�^</h1>
  <p>�� �͓��͕K�{��</p>
  <div id="errors"> $error_msgs </div>
  <form action="$self_filepath" method="POST" enctype="multipart/form-data">
  <p><span>�u���ԍ�&nbsp;��</span>
  <input type="text" name="courseno" value="$courseno" size="30" /></p>
  <p><span>�u����&nbsp;��</span>
  <input type="text" name="coursename" value="$coursename" size="30" /></p>
  <p><span>�u���J�Ó�&nbsp;��</span><select name="thedate_year"> $optiontags_thedate_year </select>�N&nbsp;
     <select name="thedate_month"> $optiontags_thedate_month </select>��&nbsp;
     <select name="thedate_day"> $optiontags_thedate_day </select>��&nbsp;
  </p>
  <p>�J�n����&nbsp;��<select name="starttime_h"> $optiontags_starttime_h </select>��&nbsp;<select name="starttime_m"> $optiontags_starttime_m </select>��</p>
  <p>�I������&nbsp;��<select name="endtime_h"> $optiontags_endtime_h </select>��&nbsp;<select name="endtime_m"> $optiontags_endtime_m </select>��</p>
  <p>���&nbsp;��<input type="text" name="vacantseats" value="$vacantseats" size="10" />�l</p>
  <input type="button" name="back" style="width:10em;" value="�߂�" onclick="location.href='./menu.html'" />
  <input type="submit" name="submit" style="width:10em;" value="�m�F" /></form>
  </div></body>
  </html>
_HERE_;

}


## �֐���`
function create_optiontag($start, $end, $selected = -1, $str_format = "%d", $top_novalue_flg = TRUE){
  $str = "";
  ## ���͒l�̃`�F�b�N�F�������ǂ���
  if(!is_int($start) || !is_int($end)){
    return "ERROR:Function create_optiontag : argments is not integer.";
  }
  ## 1�ԖڂɃ_�~�[�\���̂��̂�t��
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