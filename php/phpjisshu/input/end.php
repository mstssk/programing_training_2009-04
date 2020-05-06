<?php

$no = "'" . $_POST["courseno"] . "'";
$nm = "'" . $_POST["coursename"] . "'";
$date = "'".$_POST["thedate_year"] . "-" . $_POST["thedate_month"] . "-" . $_POST["thedate_day"]."'";
$seat = intval($_POST["vacantseats"]);
$st   = "'" . sprintf("%02d",$_POST["starttime_h"]) . ":" . sprintf("%02d",$_POST["starttime_m"]) . "'";
$et   = "'" . sprintf("%02d",$_POST["endtime_h"])   . ":" . sprintf("%02d",$_POST["endtime_m"])   . "'";
$in   = "'" . date("Y-m-d") . "'";
$up   = $in;

$my_con = mysql_connect("localhost", "root");
if($my_con == false){
  die(mysql_error());
  header("location:\"./error.html\"");
}else{
  if(mysql_select_db("phpjisshu1", $my_con) == false){
    die(mysql_error());
    header("location:\"./error.html\"");
  }else{
    $query = "insert into course values($no,$nm,$date,$seat,$st,$et,$in,$up)";
    $my_req = mysql_query($query, $my_con);
	if(!$my_req){
      die(mysql_error());
      header("location:\"./error.html\"");
	}
  }
}

echo <<<_HERE_
<html>
<head><title>IT-Lab. uÀ“o˜^</title></head>
<body><div>
<h1>“o˜^Š®—¹</h1>
<p>uÀ“o˜^‚ðŠ®—¹‚µ‚Ü‚µ‚½B</p>
<input type="button" style="width:10em;" value="uÀŠÇ—ƒƒjƒ…[" onclick="location.href='./menu.html'" />
<input type="button" style="width:10em;" value="’Ç‰Á“o˜^" onclick="location.href='./input.php'" />
</div>
</body></html>
_HERE_;

?>