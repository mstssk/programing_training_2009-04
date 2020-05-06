<html>
<head><title>IT-Lab. �u���o�^</title></head>
<body><div>
<h1>�u���o�^</h1>
<p>�� �͓��͕K�{��</p>
<?php

foreach($_POST as $key => $value){
  echo "$key : $value";
}

$thisyear = date("Y");
$selfname = "./" . basename($_SERVER["SCRIPT_NAME"]);
$postflg = 0;
$errorflg = 0;

#input data
$courseno;
$coursename;
$thedate_year;
$thedate_month;
$thedate_day;
$starttime_h;
$starttime_m = "-1";
$endtime_h;
$endtime_m = "-1";
$vacantseats;

echo '<div id="errors">';

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $postflg = 1;

  if(isset($_POST["back"])){
    $postflg = 0;
  }

  #�ǂݍ���
  if(isset($_POST["submit"])){
  
    $courseno = htmlspecialchars($_POST["courseno"], ENT_QUOTES);
    $coursename = htmlspecialchars($_POST["coursename"], ENT_QUOTES);
    $thedate_year = $_POST["thedate_year"];
    $thedate_month = $_POST["thedate_month"];
    $thedate_day = $_POST["thedate_day"];
    $starttime_h = $_POST["starttime_h"];
    $starttime_m = $_POST["starttime_m"];
    $endtime_h = $_POST["endtime_h"];
    $endtime_m = $_POST["endtime_m"];
    $vacantseats = htmlspecialchars($_POST["vacantseats"], ENT_QUOTES);


    ##�����ɃG���[���b�Z�[�W�\��
	#�u�u���ԍ��v
	if($courseno == null){
	  $errorflg++;
	  echo "�u�u���ԍ��v�͕K�{���͂ł��B<br />";
	}elseif(preg_match("/[^\d]/", $courseno) || floor($courseno / 10000)){
	  $errorflg++;
	  echo "�u�u���ԍ��v��4���̔��p�����œ��͂��Ă��������B<br />";
	}
    #�u�u�����v
	if($coursename == null){
	  $errorflg++;
	  echo "�u�u�����v�͕K�{���͂ł��B<br />";
	}elseif(strlen($coursename) > 40){
	  $errorflg++;
	  echo "�u�u�����v��40���ȓ��œ��͂��Ă��������B<br />";
	}
    
	# �u�u���J�Ó��v
	if($thedate_year == null || $thedate_month == null || $thedate_day == null){
	  $errorflg++;
	  echo "�u�u���J�Ó��v�͕K�{���͂ł��B<br />";
	}
    
	# �u�J�n�����v
	if($starttime_h == null || $starttime_m < 0){
	  $errorflg++;
	  echo "�u�J�n�����v�͕K�{���͂ł��B<br />";
	}
	
	# �u�I�������v
	if($endtime_h == null || $endtime_m < 0){
	  $errorflg++;
	  echo "�u�I�������v�͕K�{���͂ł��B<br />";
	}
		
	#�u����v
	if($vacantseats == null){
	  $errorflg++;
	  echo "�u����v�͕K�{���͂ł��B<br />";
	}elseif(preg_match("/[^\d]/", $vacantseats)){
	  $errorflg++;
	  echo "�u����v�͔��p�����œ��͂��Ă��������B<br />";
	}elseif($vacantseats > 50 || $vacantseats < 1){
	  $errorflg++;
	  echo "�u����v��50���܂łł��B<br />";
	}
  }

}
echo '</div>';

#�|�X�g���Ă��Ȃ� �܂��� �G���[���o�Ă��� �Ȃ�t�H�[���\��
if(!$postflg || $errorflg){

##���̓t�H�[��
echo <<<_HERE_
<form action="$selfname" method="POST" enctype="multipart/form-data">
<p><span>�u���ԍ�&nbsp;��</span>
<input type="text" name="courseno" value="$courseno" size="30" /></p>
<p><span>�u����&nbsp;��</span>
<input type="text" name="coursename" value="$coursename" size="30" /></p>
<p><span>�u���J�Ó�&nbsp;��</span><select name="thedate_year"><option value=""></option>

_HERE_;

  # YYYY�N�w��
  $loopend = $thisyear + 5;
  for($thisyear; $thisyear < $loopend; $thisyear++){
    echo "<option value=\"$thisyear\" ";
    if($thisyear == $thedate_year){
      echo "selected=\"selected\"";
    }
    echo ">$thisyear</option>";
  }
  echo "</select>�N&nbsp;<select name=\"thedate_month\"><option value=\"\"></option>";
  # MM���w��
  for($i = 1; $i <= 12; $i++){
    echo "<option value=\"$i\"";
    if($i == $thedate_month){
      echo " selected=\"selected\"";
    }
    echo ">$i</option>";
  }
  echo "</select>��&nbsp;<select name=\"thedate_day\"><option value=\"\"></option>";
  # DD���w��
  for($i = 1; $i <= 31; $i++){
    echo "<option value=\"$i\"";
    if($i == $thedate_day){
      echo " selected=\"selected\"";
    }
    echo ">$i</option>";
  }
  echo "</select>��&nbsp;\n</p>\n";
  
  # �J�nhh���w��
  echo "<p>�J�n����&nbsp;��<select name=\"starttime_h\"><option value=\"\"></option>";
  for($i = 10; $i <= 18; $i++){
    echo "<option value=\"$i\"";
    if($i == $starttime_h){
      echo " selected=\"selected\"";
    }
    echo ">$i</option>";
  }
  # �J�nmm���w��
  echo "</select>��&nbsp;<select name=\"starttime_m\"><option value=\"-1\"></option>";
  for($i = 0; $i <= 59; $i++){
    echo "<option value=\"$i\"";
    if($i == $starttime_m){
      echo " selected=\"selected\"";
    }
    echo ">" . sprintf("%02d", $i) . "</option>";
  }
  echo "</select>��</p>\n";


  # �I��hh���w��
  echo "<p>�I������&nbsp;��<select name=\"endtime_h\"><option value=\"\"></option>";
  for($i = 10; $i <= 18; $i++){
    echo "<option value=\"$i\"";
    if($i == $endtime_h){
      echo " selected=\"selected\"";
    }
    echo ">$i</option>";
  }
  # �I��mm���w��
  echo "</select>��&nbsp;<select name=\"endtime_m\"><option value=\"-1\"></option>";
  for($i = 0; $i <= 59; $i++){
    echo "<option value=\"$i\"";
    if($i == $endtime_m){
      echo " selected=\"selected\"";
    }
    echo ">" . sprintf("%02d", $i) . "</option>";
  }
  echo "</select>��</p>\n";

  # ������́E�{�^��
  echo <<<_HERE_
<p>���&nbsp;��<input type="text" name="vacantseats" value="$vacantseats" />�l</p>
<input type="button" name="back" style="width:10em;" value="�߂�" onclick="location.href='./menu.html'" />
<input type="submit" name="submit" style="width:10em;" value="�m�F" />
_HERE_;

}else{
#�|�X�g�ς� ����� �G���[���� 
  echo <<<_HERE_
<form action="$selfname" method="POST" enctype="multipart/form-data">
<p><span>�u���ԍ�&nbsp;��</span>${courseno}</p>
<p><span>�u����&nbsp;��</span>${coursename}</p>
<p><span>�u���J�Ó�&nbsp;��</span>${thedate_year}�N&nbsp;${thedate_month}��&nbsp;${thedate_day}��</p>
<p>�J�n����&nbsp;��${starttime_h}��${starttime_m}��</p>
<p>�I������&nbsp;��${endtime_h}��${endtime_m}��</p>
<p>���&nbsp;��${vacantseats}�l</p>
<input type="submit" name="back" style="width:10em;" value="�߂�" />
<input type="submit" name="regist" style="width:10em;" value="�o�^" />
_HERE_;

}


?>
</form>
</div>
</body>
</html>