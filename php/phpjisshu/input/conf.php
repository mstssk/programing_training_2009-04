<?php

# 画面描画
echo <<<_HERE_
<html>
<head><title>IT-Lab. 講座登録</title></head>
<body><div>
<h1>登録確認</h1>
<p>※ 入力内容を確認してください。</p>
<p><span>講座番号&nbsp;※</span> $courseno </p>
<p><span>講座名&nbsp;※</span> $coursename </p>
<p><span>講座開催日&nbsp;※</span><span> $thedate_year </span>年&nbsp;
   <span> $thedate_month </span>月&nbsp;
   <span"> $thedate_day </span>日&nbsp;
</p>
<p>開始時刻&nbsp;※<span> $starttime_h </span>時&nbsp;<span> $starttime_m </span>分</p>
<p>終了時刻&nbsp;※<span> $endtime_h </span>時&nbsp;<span> $endtime_m </span>分</p>
<p>定員&nbsp;※ $vacantseats 人</p>
<p>
<form action="$self_filepath" method="POST" enctype="multipart/form-data">
<input type="hidden" name="courseno" value="$courseno" />
<input type="hidden" name="coursename" value="$coursename" />
<input type="hidden" name="thedate_year" value="$thedate_year" />
<input type="hidden" name="thedate_month" value="$thedate_month" />
<input type="hidden" name="thedate_day" value="$thedate_day" />
<input type="hidden" name="starttime_h" value="$starttime_h" />
<input type="hidden" name="starttime_m" value="$starttime_m" />
<input type="hidden" name="endtime_h" value="$endtime_h" />
<input type="hidden" name="endtime_m" value="$endtime_m" />
<input type="hidden" name="vacantseats" value="$vacantseats" />
<input type="submit" name="back" style="width:10em;" value="戻る" />
</form>

<form action="$end_filepath" method="POST" enctype="multipart/form-data">
<input type="hidden" name="courseno" value="$courseno" />
<input type="hidden" name="coursename" value="$coursename" />
<input type="hidden" name="thedate_year" value="$thedate_year" />
<input type="hidden" name="thedate_month" value="$thedate_month" />
<input type="hidden" name="thedate_day" value="$thedate_day" />
<input type="hidden" name="starttime_h" value="$starttime_h" />
<input type="hidden" name="starttime_m" value="$starttime_m" />
<input type="hidden" name="endtime_h" value="$endtime_h" />
<input type="hidden" name="endtime_m" value="$endtime_m" />
<input type="hidden" name="vacantseats" value="$vacantseats" />
<input type="submit" name="conf" style="width:10em;" value="登録" />
</form>
</p>
</div></body>
</html>
_HERE_;


?>