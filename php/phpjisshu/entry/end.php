<?php

require_once("./common.php");

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){

# application�i�\���݃e�[�u���j�ւ̏�������
$input_data = new InputData();
$input_data->load($_POST);
$data_str = $input_data->get_data_quoted_str_4applicationtable();
$today   = "'" . date("Y-m-d") . "'";
$my_con = mysql_connect("localhost", "root");
mysql_select_db("phpjisshu1", $my_con);
$query = "insert into application (name,phonetic,mail,sex,birthday,tel,remarks,indate,upddate) values ($data_str,$today,$today)";
if(mysql_query($query, $my_con) == 0){
  echo "Error:application�i�\���݃e�[�u���j�ւ̏�������<br />$query<br />";
  die(mysql_error());
}
#mysql_query("commit", $my_con);

# course_apply(��]�u���e�[�u��)��
# course�i�u���e�[�u���j�ւ̏�������
$query = "select id from application order by id desc limit 1";
$new_id = mysql_query($query, $my_con);
$new_id = mysql_fetch_array($new_id);
$new_id = $new_id["id"];

if($new_id == null){
  echo "Error:id�̎擾<br />$query<br />";
  die(mysql_error());
}
foreach($input_data->checks as $courseno){
  $query = "insert into course_apply (id_application, courseno, indate, upddate) values ($new_id, '$courseno', $today, $today)";
  if(mysql_query($query, $my_con) == 0){
    echo "Error:course_apply(��]�u���e�[�u��)�ւ̏�������<br />$query<br />";
    die(mysql_error());
  }
	$query = "update course set vacantseats = vacantseats - 1 where courseno = '$courseno'";
  if(mysql_query($query, $my_con) == 0){
    echo "Error:course�i�u���e�[�u���j�ւ̏�������<br />$query<br />";
    die(mysql_error());
  }
}

echo <<<_HERE_
<html>
<head><title>IT-Lab. �u���\����</title></head>
<body><div>
<h1>�\���݊���</h1>
<p>�u���\���݂��������܂����B<br />
���肪�Ƃ��������܂����B</p>
<input type="button" style="width:10em;" value="�ǉ��o�^" onclick="location.href='$input_filepath'" />
</div>
</body></html>
_HERE_;

}else{
  echo "�s���ȃA�N�Z�X";
}


?>