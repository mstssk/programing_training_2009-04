<html>
<head>
<title>Nozama.co.jp - {$title}</title>
<meta http-equiv="Content-Style-Type" content="text/css" />
<link rel="Stylesheet" type="text/css" href="./style.css" />
</style>
</head>
<body>
<div id="container">
<div id="header"><a href="{$url_top}"><h1>{$title}</h1></a><div></div>
<div id="menu">
<input type="button" name="{$button_a_name}" value="{$button_a_str}" onclick="location.href='{$button_a_url}'" />
<br>
<br>
{if $button_b_flg }
<form method="POST" action="{$button_b_url}">
<input type="hidden" name="id" value="{$button_b_value}" />
<input type="submit" name="conf" value="{$button_b_str}" />
{/if}
</div>
<div id="contents">
-------------------------------------------------------
<br>
<table border="1">
{section name=cnt loop=$clm0}
<tr>
<td>{$clm0[cnt]}</td>
<td>{$clm1[cnt]}</td>
</tr>
{/section}
</table>
{$bill}
</form>
{if $button_c_flg }
<center>
<input type="button" name="{$button_c_name}" value="{$button_c_value}" onclick="location.href='{$button_c_url}'" />
</center>
{/if}
-------------------------------------------------------
</div><!-- contents -->
</div><!-- container -->
</body>
</html>