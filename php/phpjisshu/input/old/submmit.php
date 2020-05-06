<?php

#POSTされたとき
if($_SERVER["REQUEST_METHOD"] == "POST"){
  
  # 確認ボタン押下 submitした
  if(isset($_POST["submit"])){
  
  # 登録ボタン押下 commitした
  }elseif(isset($_POST["commit"])){
  
  }
}




# 描画
echo <<<_TEMPLATE_
<html>
<head><title>IT-Lab. 講座登録</title></head>
<body><div>
<h1>$pagetitle</h1>
<p>※ $message_comment</p>
<div id="errors">$message_error</div>
<form action="./regist.php" method="POST" enctype="multipart/form-data">
<p><span class="input_title">講座番号&nbsp;※</span></p>
<p><span class="input_title">講座名&nbsp;※</span>$form_coursename</p>
<p><span class="input_title">講座開催日&nbsp;※</span>$form_thedate_year年&nbsp;$form_thedate_month月&nbsp;$form_thedate_day日</p>
<p><span class="input_title">開始時刻&nbsp;※</span>$form_starttime_h時&nbsp;$form_starttime_m&nbsp;分</p>
<p><span class="input_title">終了時刻&nbsp;※</span>$form_endtime_h時&nbsp;$form_endtime_m&nbsp;分</p>
<p><span class="input_title">定員&nbsp;※</span>$form_vacantseats人</p>
<input $back_button_property />
<input $next_button_property />
</form>
</div>
</body>
</html>
_TEMPLATE_

?>