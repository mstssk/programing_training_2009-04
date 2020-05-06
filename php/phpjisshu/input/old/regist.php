<html>
<head><title>IT-Lab. 講座登録</title></head>
<body><div>
<h1>講座登録</h1>
<p>※ は入力必須で</p>
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

  #読み込み
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


    ##ここにエラーメッセージ表示
	#「講座番号」
	if($courseno == null){
	  $errorflg++;
	  echo "「講座番号」は必須入力です。<br />";
	}elseif(preg_match("/[^\d]/", $courseno) || floor($courseno / 10000)){
	  $errorflg++;
	  echo "「講座番号」は4桁の半角数字で入力してください。<br />";
	}
    #「講座名」
	if($coursename == null){
	  $errorflg++;
	  echo "「講座名」は必須入力です。<br />";
	}elseif(strlen($coursename) > 40){
	  $errorflg++;
	  echo "「講座名」は40字以内で入力してください。<br />";
	}
    
	# 「講座開催日」
	if($thedate_year == null || $thedate_month == null || $thedate_day == null){
	  $errorflg++;
	  echo "「講座開催日」は必須入力です。<br />";
	}
    
	# 「開始時刻」
	if($starttime_h == null || $starttime_m < 0){
	  $errorflg++;
	  echo "「開始時刻」は必須入力です。<br />";
	}
	
	# 「終了時刻」
	if($endtime_h == null || $endtime_m < 0){
	  $errorflg++;
	  echo "「終了時刻」は必須入力です。<br />";
	}
		
	#「定員」
	if($vacantseats == null){
	  $errorflg++;
	  echo "「定員」は必須入力です。<br />";
	}elseif(preg_match("/[^\d]/", $vacantseats)){
	  $errorflg++;
	  echo "「定員」は半角数字で入力してください。<br />";
	}elseif($vacantseats > 50 || $vacantseats < 1){
	  $errorflg++;
	  echo "「定員」は50名までです。<br />";
	}
  }

}
echo '</div>';

#ポストしていない または エラーが出ている ならフォーム表示
if(!$postflg || $errorflg){

##入力フォーム
echo <<<_HERE_
<form action="$selfname" method="POST" enctype="multipart/form-data">
<p><span>講座番号&nbsp;※</span>
<input type="text" name="courseno" value="$courseno" size="30" /></p>
<p><span>講座名&nbsp;※</span>
<input type="text" name="coursename" value="$coursename" size="30" /></p>
<p><span>講座開催日&nbsp;※</span><select name="thedate_year"><option value=""></option>

_HERE_;

  # YYYY年指定
  $loopend = $thisyear + 5;
  for($thisyear; $thisyear < $loopend; $thisyear++){
    echo "<option value=\"$thisyear\" ";
    if($thisyear == $thedate_year){
      echo "selected=\"selected\"";
    }
    echo ">$thisyear</option>";
  }
  echo "</select>年&nbsp;<select name=\"thedate_month\"><option value=\"\"></option>";
  # MM月指定
  for($i = 1; $i <= 12; $i++){
    echo "<option value=\"$i\"";
    if($i == $thedate_month){
      echo " selected=\"selected\"";
    }
    echo ">$i</option>";
  }
  echo "</select>月&nbsp;<select name=\"thedate_day\"><option value=\"\"></option>";
  # DD日指定
  for($i = 1; $i <= 31; $i++){
    echo "<option value=\"$i\"";
    if($i == $thedate_day){
      echo " selected=\"selected\"";
    }
    echo ">$i</option>";
  }
  echo "</select>日&nbsp;\n</p>\n";
  
  # 開始hh時指定
  echo "<p>開始時刻&nbsp;※<select name=\"starttime_h\"><option value=\"\"></option>";
  for($i = 10; $i <= 18; $i++){
    echo "<option value=\"$i\"";
    if($i == $starttime_h){
      echo " selected=\"selected\"";
    }
    echo ">$i</option>";
  }
  # 開始mm時指定
  echo "</select>時&nbsp;<select name=\"starttime_m\"><option value=\"-1\"></option>";
  for($i = 0; $i <= 59; $i++){
    echo "<option value=\"$i\"";
    if($i == $starttime_m){
      echo " selected=\"selected\"";
    }
    echo ">" . sprintf("%02d", $i) . "</option>";
  }
  echo "</select>分</p>\n";


  # 終了hh時指定
  echo "<p>終了時刻&nbsp;※<select name=\"endtime_h\"><option value=\"\"></option>";
  for($i = 10; $i <= 18; $i++){
    echo "<option value=\"$i\"";
    if($i == $endtime_h){
      echo " selected=\"selected\"";
    }
    echo ">$i</option>";
  }
  # 終了mm時指定
  echo "</select>時&nbsp;<select name=\"endtime_m\"><option value=\"-1\"></option>";
  for($i = 0; $i <= 59; $i++){
    echo "<option value=\"$i\"";
    if($i == $endtime_m){
      echo " selected=\"selected\"";
    }
    echo ">" . sprintf("%02d", $i) . "</option>";
  }
  echo "</select>分</p>\n";

  # 定員入力・ボタン
  echo <<<_HERE_
<p>定員&nbsp;※<input type="text" name="vacantseats" value="$vacantseats" />人</p>
<input type="button" name="back" style="width:10em;" value="戻る" onclick="location.href='./menu.html'" />
<input type="submit" name="submit" style="width:10em;" value="確認" />
_HERE_;

}else{
#ポスト済み および エラー無し 
  echo <<<_HERE_
<form action="$selfname" method="POST" enctype="multipart/form-data">
<p><span>講座番号&nbsp;※</span>${courseno}</p>
<p><span>講座名&nbsp;※</span>${coursename}</p>
<p><span>講座開催日&nbsp;※</span>${thedate_year}年&nbsp;${thedate_month}月&nbsp;${thedate_day}日</p>
<p>開始時刻&nbsp;※${starttime_h}時${starttime_m}分</p>
<p>終了時刻&nbsp;※${endtime_h}時${endtime_m}分</p>
<p>定員&nbsp;※${vacantseats}人</p>
<input type="submit" name="back" style="width:10em;" value="戻る" />
<input type="submit" name="regist" style="width:10em;" value="登録" />
_HERE_;

}


?>
</form>
</div>
</body>
</html>