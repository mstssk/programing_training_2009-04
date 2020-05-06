<?php

require_once("./common.php");

$self_filepath = "./" . basename($_SERVER["SCRIPT_NAME"]);

# DB����ǂݍ���
$my_con = mysql_connect("localhost", "root", "");
mysql_select_db("phpjisshu1", $my_con);
$query = "select UNIX_TIMESTAMP(thedate) as thedate,starttime,endtime,coursename,vacantseats,courseno from course where thedate > now() order by thedate limit 5";
$courses = mysql_query($query, $my_con);
if(!count($courses)){
  echo "�\���݂ł���u���͂���܂���B";
	return false;
}

# ���͒l
$input_data = new InputData();

# POST������B submit���ꂽ���A�܂��͎���ʂ���߂��Ă�����
if($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["submit"]) || isset($_POST["back"]))){
  
  # POST���ꂽ�l��ǂݍ���
  $input_data->load($_POST);
	
  # ����ʂ���߂��Ă������̓G���[�`�F�b�N���Ȃ�
  if(!isset($_POST["back"])){
    $input_data->errorCheck();
  }
}

# �G���[������������A�f�[�^��POST����conf.php�ɑJ��
# �������A����ʂ���߂��Ă����ꍇ($_POST["back"]�����݂���ꍇ)�ɂ͑J�ڂ��Ȃ�
if(strlen($input_data->error_msgs) == 0 && isset($_POST["submit"])  && !isset($_POST["back"])){
  require($conf_filepath);
}else{

  # ���ʂ̃`�F�b�N�m�F
  if($input_data->sex == 1){
	  $checked_man = "checked=\"checked\"";
	}elseif($input_data->sex == 2){
	  $checked_wom = "checked=\"checked\"";
	}

  # option�^�O�𐶐�
  $thisyear = intval(date("Y"));
	$oldest = $thisyear - 60;
	$youngest = $thisyear - 18;
  $optiontags_birth_year  = create_optiontag($oldest, $youngest, $input_data->birth_year);
  $optiontags_birth_month = create_optiontag(1, 12, $input_data->birth_month);
  $optiontags_birth_day   = create_optiontag(1, 31, $input_data->birth_day);
  
	# ��]�u���`�F�b�N�{�b�N�X �쐬
	# ���o��
	$checkbox_courses = "<table border=\"4\"><tr><th>�J�Ó���</th><th>�u����</th><th>��ȏ�</th><th>�`�F�b�N</th></tr>\n";
	# �e�u���v�f
  while($row = mysql_fetch_array($courses)){
	  # �����t�H�[�}�b�g
	  $date = date("n��j��", $row["thedate"]) . "(". get_week_day_char($row["thedate"]) .")". $row["starttime"] . "-" . $row["endtime"];
    # �c��Ȑ�
	  if($row[vacantseats] <= 0){
		  $seat = "����";
			$disabled = "disabled=\"disabled\"";
		}else{
  	  $seat = "�c" . $row["vacantseats"] . "��";
		}
		# �R�[�X��
		$coursename = $row["coursename"];
		# �R�[�X�ԍ�
		$courseno   = $row["courseno"];
		# �`�F�b�N����Ă��邩�m�F�B�`�F�b�N��������΋C�ɂ��Ȃ�
    if($input_data->checks != null){
		  # �`�F�b�N�z��𑖍����đO��`�F�b�N�������̂�checked��
		  foreach($input_data->checks as $key => $value){
		    if($value == $courseno){
		      $checked = "checked=\"checked\"";
					$input_data->delChecked("$key"); # �m�F�ςݗv�f�͔z�񂩂�폜
					break;
			  }
			}
		}
		$checkbox_courses .= "<tr><td>$date</td><td>$coursename</td><td>$seat</td><td><input type=\"checkbox\" name=\"checks[]\" value=\"$courseno\" $checked $disabled /></td></tr>\n";
		$checked = "";
		$disabled = "";
	}
	$checkbox_courses .= "</table>\n";
	
  # ��ʕ`��
echo <<<_HERE_
  <html>
  <head><title>IT-Lab. �u���o�^</title></head>
  <body><div>
  <h1>�u���o�^</h1>
  <p>�� �͓��͕K�{��</p>
  <div id="errors"> $input_data->error_msgs </div>
  <form action="$self_filepath" method="POST" enctype="multipart/form-data">
  <p><span>�����O&nbsp;��</span>
  <input type="text" name="name" value="{$input_data->name}" size="30" maxlength="255" /></p>
  <p><span>�t���K�i&nbsp;��</span>
  <input type="text" name="phonetic" value="$input_data->phonetic" size="30" maxlength="255" /></p>
  <p><span>E���[���A�h���X&nbsp;��</span>
  <input type="text" name="mail" value="$input_data->mail" size="30" maxlength="255" /></p>
	<p><span>����</span>
	  <input type="radio" name="sex" value="1" ${checked_man}>�j</input>
	  <input type="radio" name="sex" value="2" ${checked_wom}>��</input></p>
  <p><span>���N����&nbsp;��</span><select name="birth_year"> $optiontags_birth_year </select>�N&nbsp;
     <select name="birth_month"> $optiontags_birth_month </select>��&nbsp;
     <select name="birth_day"> $optiontags_birth_day </select>��&nbsp;
  </p>
  <p><span>�d�b�ԍ�&nbsp;��</span>
  <input type="text" name="phone" value="$input_data->phone" size="30" maxlength="255" /></p>
	<p><span>��]�u�� ��</span> $checkbox_courses </p>
	<p>���l��<textarea name="notes" cols="40" rows="5" >$input_data->notes</textarea></p>
  <input type="submit" name="submit" style="width:10em;" value="�m�F" /></form>
  </div></body>
  </html>
_HERE_;

}


?>