<?php

require_once("./common.php");

$self_filepath = "./" . basename($_SERVER["SCRIPT_NAME"]);

# DBから読み込み
$my_con = mysql_connect("localhost", "root", "");
mysql_select_db("phpjisshu1", $my_con);
$query = "select UNIX_TIMESTAMP(thedate) as thedate,starttime,endtime,coursename,vacantseats,courseno from course where thedate > now() order by thedate limit 5";
$courses = mysql_query($query, $my_con);
if(!count($courses)){
  echo "申込みできる講座はありません。";
	return false;
}

# 入力値
$input_data = new InputData();

# POST時動作。 submitされた時、または次画面から戻ってきた時
if($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["submit"]) || isset($_POST["back"]))){
  
  # POSTされた値を読み込み
  $input_data->load($_POST);
	
  # 次画面から戻ってきた時はエラーチェックしない
  if(!isset($_POST["back"])){
    $input_data->errorCheck();
  }
}

# エラーが無かったら、データをPOSTしつつconf.phpに遷移
# ただし、次画面から戻ってきた場合($_POST["back"]が存在する場合)には遷移しない
if(strlen($input_data->error_msgs) == 0 && isset($_POST["submit"])  && !isset($_POST["back"])){
  require($conf_filepath);
}else{

  # 性別のチェック確認
  if($input_data->sex == 1){
	  $checked_man = "checked=\"checked\"";
	}elseif($input_data->sex == 2){
	  $checked_wom = "checked=\"checked\"";
	}

  # optionタグを生成
  $thisyear = intval(date("Y"));
	$oldest = $thisyear - 60;
	$youngest = $thisyear - 18;
  $optiontags_birth_year  = create_optiontag($oldest, $youngest, $input_data->birth_year);
  $optiontags_birth_month = create_optiontag(1, 12, $input_data->birth_month);
  $optiontags_birth_day   = create_optiontag(1, 31, $input_data->birth_day);
  
	# 希望講座チェックボックス 作成
	# 見出し
	$checkbox_courses = "<table border=\"4\"><tr><th>開催日時</th><th>講座名</th><th>空席状況</th><th>チェック</th></tr>\n";
	# 各講座要素
  while($row = mysql_fetch_array($courses)){
	  # 日時フォーマット
	  $date = date("n月j日", $row["thedate"]) . "(". get_week_day_char($row["thedate"]) .")". $row["starttime"] . "-" . $row["endtime"];
    # 残り席数
	  if($row[vacantseats] <= 0){
		  $seat = "満席";
			$disabled = "disabled=\"disabled\"";
		}else{
  	  $seat = "残" . $row["vacantseats"] . "席";
		}
		# コース名
		$coursename = $row["coursename"];
		# コース番号
		$courseno   = $row["courseno"];
		# チェックされているか確認。チェックが無ければ気にしない
    if($input_data->checks != null){
		  # チェック配列を走査して前回チェックしたものをcheckedに
		  foreach($input_data->checks as $key => $value){
		    if($value == $courseno){
		      $checked = "checked=\"checked\"";
					$input_data->delChecked("$key"); # 確認済み要素は配列から削除
					break;
			  }
			}
		}
		$checkbox_courses .= "<tr><td>$date</td><td>$coursename</td><td>$seat</td><td><input type=\"checkbox\" name=\"checks[]\" value=\"$courseno\" $checked $disabled /></td></tr>\n";
		$checked = "";
		$disabled = "";
	}
	$checkbox_courses .= "</table>\n";
	
  # 画面描画
echo <<<_HERE_
  <html>
  <head><title>IT-Lab. 講座登録</title></head>
  <body><div>
  <h1>講座登録</h1>
  <p>※ は入力必須で</p>
  <div id="errors"> $input_data->error_msgs </div>
  <form action="$self_filepath" method="POST" enctype="multipart/form-data">
  <p><span>お名前&nbsp;※</span>
  <input type="text" name="name" value="{$input_data->name}" size="30" maxlength="255" /></p>
  <p><span>フリガナ&nbsp;※</span>
  <input type="text" name="phonetic" value="$input_data->phonetic" size="30" maxlength="255" /></p>
  <p><span>Eメールアドレス&nbsp;※</span>
  <input type="text" name="mail" value="$input_data->mail" size="30" maxlength="255" /></p>
	<p><span>性別</span>
	  <input type="radio" name="sex" value="1" ${checked_man}>男</input>
	  <input type="radio" name="sex" value="2" ${checked_wom}>女</input></p>
  <p><span>生年月日&nbsp;※</span><select name="birth_year"> $optiontags_birth_year </select>年&nbsp;
     <select name="birth_month"> $optiontags_birth_month </select>月&nbsp;
     <select name="birth_day"> $optiontags_birth_day </select>日&nbsp;
  </p>
  <p><span>電話番号&nbsp;※</span>
  <input type="text" name="phone" value="$input_data->phone" size="30" maxlength="255" /></p>
	<p><span>希望講座 ※</span> $checkbox_courses </p>
	<p>備考欄<textarea name="notes" cols="40" rows="5" >$input_data->notes</textarea></p>
  <input type="submit" name="submit" style="width:10em;" value="確認" /></form>
  </div></body>
  </html>
_HERE_;

}


?>