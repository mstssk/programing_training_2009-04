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

# POST������B submit���ꂽ���A
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){
  
  # POST���ꂽ�l��ǂݍ���
  $input_data->load($_POST);

	# hidden�Ŗ��ߍ��ރf�[�^
	$hidden_tags = $input_data->get_data_hidden();

  # ���ʂ̃`�F�b�N�m�F
  if($input_data->sex == 1){
	  $checked_man = "��";
		$checked_wom = "��";
	}elseif($input_data->sex == 2){
	  $checked_man = "��";
		$checked_wom = "��";
	}else{
	  $checked_man = "��";
	  $checked_wom = "��";
	}
  
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
		      $checked = "�T";
					$input_data->delChecked("$key"); # �m�F�ςݗv�f�͔z�񂩂�폜
					break;
			  }
			}
		}
		$checkbox_courses .= "<tr><td>$date</td><td>$coursename</td><td>$seat</td><td style=\"text-align:center;\"> $checked </td></tr>\n";
		$checked = "";
		$disabled = "";
	}
	$checkbox_courses .= "</table>\n";
	
	$taged_notes = nl2br($input_data->notes);
	
  # ��ʕ`��
echo <<<_HERE_
  <html>
  <head><title>IT-Lab. �u���o�^</title></head>
  <body><div>
  <h1>�u���o�^</h1>
  <p>�� ���͓��e���m�F���Ă��������B</p>
  <div>
  <p><span>�����O&nbsp;</span>$input_data->name</p>
  <p><span>�t���K�i&nbsp;</span>$input_data->phonetic</p>
  <p><span>E���[���A�h���X&nbsp;</span>$input_data->mail</p>
	<p><span>����</span>
	  ${checked_man} �j&nbsp;&nbsp;
	  ${checked_wom} ��</p>
  <p><span>���N����&nbsp;</span>$input_data->birth_year �N&nbsp;
      $input_data->birth_month ��&nbsp;
      $input_data->birth_day ��&nbsp;
  </p>
  <p><span>�d�b�ԍ�&nbsp;</span>$input_data->phone</p>
	<p><span>��]�u��</span> $checkbox_courses </p>
	<p><span>���l��</span><div>$taged_notes</div></p>
  <form action="$input_filepath" method="POST" enctype="multipart/form-data">$hidden_tags<input type="submit" name="back" style="width:10em;" value="�߂�" /></form>
  <form action="$end_filepath" method="POST" enctype="multipart/form-data">$hidden_tags<input type="submit" name="submit" style="width:10em;" value="�\����" /></form>
	</div>
  </div></body>
  </html>
_HERE_;

}else{

  echo "Error! : ������Ȃ��A�N�Z�X";
 
}





?>