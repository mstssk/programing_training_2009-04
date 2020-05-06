<?php

# ‰æ–Ê•`‰æ
echo <<<_HERE_
<html>
<head><title>IT-Lab. uÀ“o˜^</title></head>
<body><div>
<h1>“o˜^Šm”F</h1>
<p>¦ “ü—Í“à—e‚ğŠm”F‚µ‚Ä‚­‚¾‚³‚¢B</p>
<p><span>uÀ”Ô†&nbsp;¦</span> $courseno </p>
<p><span>uÀ–¼&nbsp;¦</span> $coursename </p>
<p><span>uÀŠJÃ“ú&nbsp;¦</span><span> $thedate_year </span>”N&nbsp;
   <span> $thedate_month </span>Œ&nbsp;
   <span"> $thedate_day </span>“ú&nbsp;
</p>
<p>ŠJn&nbsp;¦<span> $starttime_h </span>&nbsp;<span> $starttime_m </span>•ª</p>
<p>I—¹&nbsp;¦<span> $endtime_h </span>&nbsp;<span> $endtime_m </span>•ª</p>
<p>’èˆõ&nbsp;¦ $vacantseats l</p>
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
<input type="submit" name="back" style="width:10em;" value="–ß‚é" />
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
<input type="submit" name="conf" style="width:10em;" value="“o˜^" />
</form>
</p>
</div></body>
</html>
_HERE_;


?>