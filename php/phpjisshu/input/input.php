<?php

# ファイルパス
$self_filepath = "./" . basename($_SERVER["SCRIPT_NAME"]);
$conf_filepath = "./conf.php";
$end_filepath = "./end.php";

# エラーメッセージ
$error_msgs = null;

# 入力値(およびそのデフォルト値)
$courseno;
$coursename;
$thedate_year;
$thedate_month;
$thedate_day;
$starttime_h;
$starttime_m = -1;
$endtime_h;
$endtime_m = -1;

# POST時動作。 submitされた時、または次画面から戻ってきた時
if($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["submit"]) || isset($_POST["back"]))){
  
  # POSTされた値を読み込み
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
  
  # 次画面から戻ってきた時はエラーチェックしない
  if(!isset($_POST["back"])){
    # エラーチェック
    #「講座番号」
    if($courseno == null){
      $error_msgs .= "「講座番号」は必須入力です。<br />";
    }elseif(preg_match("/[^\d]/", $courseno) || floor($courseno / 10000)){
      $error_msgs .= "「講座番号」は4桁の半角数字で入力してください。<br />";
    }
    #「講座名」
    if($coursename == null){
      $error_msgs .= "「講座名」は必須入力です。<br />";
    }elseif(strlen($coursename) > 40){
      $error_msgs .= "「講座名」は40字以内で入力してください。<br />";
    }
    # 「講座開催日」
    if($thedate_year <= 0 || $thedate_month <= 0 || $thedate_day <= 0){
      $error_msgs .= "「講座開催日」は必須入力です。<br />";
    }
    # 「開始時刻」
    if($starttime_h <= 0 || $starttime_m < 0){
      $error_msgs .= "「開始時刻」は必須入力です。<br />";
    }
    # 「終了時刻」
    if($endtime_h <= 0 || $endtime_m < 0){
      $error_msgs .= "「終了時刻」は必須入力です。<br />";
    }
    # 開始時刻と終了時刻の整合
    if((($starttime_h * 100 ) + $starttime_m) >= (($endtime_h * 100) + $endtime_m)){
      $error_msgs .= "「開始時刻」は「終了時刻」より前にしてください。<br />";
    }
    #「定員」
    if($vacantseats == null){
      $error_msgs .= "「定員」は必須入力です。<br />";
    }elseif(preg_match("/[^\d]/", $vacantseats)){
      $error_msgs .= "「定員」は半角整数で入力してください。<br />";
    }elseif($vacantseats > 50 || $vacantseats < 1){
      $error_msgs .= "「定員」は50名までです。<br />";
    }
  }
}

# エラーが無かったら、データをPOSTしつつconf.phpに遷移
if($error_msgs == null && isset($_POST["submit"])  && !isset($_POST["back"])){
  require($conf_filepath);
}else{

  # optionタグを生成
  $thisyear = intval(date("Y"));
  $optiontags_thedate_year  = create_optiontag($thisyear, $thisyear + 4, $thedate_year);
  $optiontags_thedate_month = create_optiontag(1, 12, $thedate_month);
  $optiontags_thedate_day   = create_optiontag(1, 31, $thedate_day);
  $optiontags_starttime_h = create_optiontag(10, 18, $starttime_h);
  $optiontags_starttime_m = create_optiontag(0, 59, $starttime_m, "%02d");
  $optiontags_endtime_h = create_optiontag(10, 18, $endtime_h);
  $optiontags_endtime_m = create_optiontag(0, 59, $endtime_m, "%02d");
  
  # 画面描画
echo <<<_HERE_
  <html>
  <head><title>IT-Lab. 講座登録</title></head>
  <body><div>
  <h1>講座登録</h1>
  <p>※ は入力必須で</p>
  <div id="errors"> $error_msgs </div>
  <form action="$self_filepath" method="POST" enctype="multipart/form-data">
  <p><span>講座番号&nbsp;※</span>
  <input type="text" name="courseno" value="$courseno" size="30" /></p>
  <p><span>講座名&nbsp;※</span>
  <input type="text" name="coursename" value="$coursename" size="30" /></p>
  <p><span>講座開催日&nbsp;※</span><select name="thedate_year"> $optiontags_thedate_year </select>年&nbsp;
     <select name="thedate_month"> $optiontags_thedate_month </select>月&nbsp;
     <select name="thedate_day"> $optiontags_thedate_day </select>日&nbsp;
  </p>
  <p>開始時刻&nbsp;※<select name="starttime_h"> $optiontags_starttime_h </select>時&nbsp;<select name="starttime_m"> $optiontags_starttime_m </select>分</p>
  <p>終了時刻&nbsp;※<select name="endtime_h"> $optiontags_endtime_h </select>時&nbsp;<select name="endtime_m"> $optiontags_endtime_m </select>分</p>
  <p>定員&nbsp;※<input type="text" name="vacantseats" value="$vacantseats" size="10" />人</p>
  <input type="button" name="back" style="width:10em;" value="戻る" onclick="location.href='./menu.html'" />
  <input type="submit" name="submit" style="width:10em;" value="確認" /></form>
  </div></body>
  </html>
_HERE_;

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