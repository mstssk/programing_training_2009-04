<?php

# ��ʕ`��
echo <<<_HERE_
<html>
<head><title>IT-Lab. �u���o�^</title></head>
<body><div>
<h1>�o�^�m�F</h1>
<p>�� ���͓��e���m�F���Ă��������B</p>
<p><span>�u���ԍ�&nbsp;��</span> $courseno </p>
<p><span>�u����&nbsp;��</span> $coursename </p>
<p><span>�u���J�Ó�&nbsp;��</span><span> $thedate_year </span>�N&nbsp;
   <span> $thedate_month </span>��&nbsp;
   <span"> $thedate_day </span>��&nbsp;
</p>
<p>�J�n����&nbsp;��<span> $starttime_h </span>��&nbsp;<span> $starttime_m </span>��</p>
<p>�I������&nbsp;��<span> $endtime_h </span>��&nbsp;<span> $endtime_m </span>��</p>
<p>���&nbsp;�� $vacantseats �l</p>
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
<input type="submit" name="back" style="width:10em;" value="�߂�" />
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
<input type="submit" name="conf" style="width:10em;" value="�o�^" />
</form>
</p>
</div></body>
</html>
_HERE_;


?>