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

# POST時動作。 submitされた時、
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){
  
  # POSTされた値を読み込み
  $input_data->load($_POST);

	# hiddenで埋め込むデータ
	$hidden_tags = $input_data->get_data_hidden();

  # 性別のチェック確認
  if($input_data->sex == 1){
	  $checked_man = "●";
		$checked_wom = "○";
	}elseif($input_data->sex == 2){
	  $checked_man = "○";
		$checked_wom = "●";
	}else{
	  $checked_man = "○";
	  $checked_wom = "○";
	}
  
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
		      $checked = "ゝ";
					$input_data->delChecked("$key"); # 確認済み要素は配列から削除
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
	
  # 画面描画
echo <<<_HERE_
  <html>
  <head><title>IT-Lab. 講座登録</title></head>
  <body><div>
  <h1>講座登録</h1>
  <p>※ 入力内容を確認してください。</p>
  <div>
  <p><span>お名前&nbsp;</span>$input_data->name</p>
  <p><span>フリガナ&nbsp;</span>$input_data->phonetic</p>
  <p><span>Eメールアドレス&nbsp;</span>$input_data->mail</p>
	<p><span>性別</span>
	  ${checked_man} 男&nbsp;&nbsp;
	  ${checked_wom} 女</p>
  <p><span>生年月日&nbsp;</span>$input_data->birth_year 年&nbsp;
      $input_data->birth_month 月&nbsp;
      $input_data->birth_day 日&nbsp;
  </p>
  <p><span>電話番号&nbsp;</span>$input_data->phone</p>
	<p><span>希望講座</span> $checkbox_courses </p>
	<p><span>備考欄</span><div>$taged_notes</div></p>
  <form action="$input_filepath" method="POST" enctype="multipart/form-data">$hidden_tags<input type="submit" name="back" style="width:10em;" value="戻る" /></form>
  <form action="$end_filepath" method="POST" enctype="multipart/form-data">$hidden_tags<input type="submit" name="submit" style="width:10em;" value="申込み" /></form>
	</div>
  </div></body>
  </html>
_HERE_;

}else{

  echo "Error! : 許可されないアクセス";
 
}





?>