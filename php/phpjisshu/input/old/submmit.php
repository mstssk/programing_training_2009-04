<?php

#POST���ꂽ�Ƃ�
if($_SERVER["REQUEST_METHOD"] == "POST"){
  
  # �m�F�{�^������ submit����
  if(isset($_POST["submit"])){
  
  # �o�^�{�^������ commit����
  }elseif(isset($_POST["commit"])){
  
  }
}




# �`��
echo <<<_TEMPLATE_
<html>
<head><title>IT-Lab. �u���o�^</title></head>
<body><div>
<h1>$pagetitle</h1>
<p>�� $message_comment</p>
<div id="errors">$message_error</div>
<form action="./regist.php" method="POST" enctype="multipart/form-data">
<p><span class="input_title">�u���ԍ�&nbsp;��</span></p>
<p><span class="input_title">�u����&nbsp;��</span>$form_coursename</p>
<p><span class="input_title">�u���J�Ó�&nbsp;��</span>$form_thedate_year�N&nbsp;$form_thedate_month��&nbsp;$form_thedate_day��</p>
<p><span class="input_title">�J�n����&nbsp;��</span>$form_starttime_h��&nbsp;$form_starttime_m&nbsp;��</p>
<p><span class="input_title">�I������&nbsp;��</span>$form_endtime_h��&nbsp;$form_endtime_m&nbsp;��</p>
<p><span class="input_title">���&nbsp;��</span>$form_vacantseats�l</p>
<input $back_button_property />
<input $next_button_property />
</form>
</div>
</body>
</html>
_TEMPLATE_

?>