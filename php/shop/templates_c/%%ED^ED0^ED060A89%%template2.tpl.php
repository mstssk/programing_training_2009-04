<?php /* Smarty version 2.6.22, created on 2009-04-28 19:09:35
         compiled from template2.tpl */ ?>
<html>
<head>
<title>Nozama.co.jp - <?php echo $this->_tpl_vars['title']; ?>
</title>
<meta http-equiv="Content-Style-Type" content="text/css" />
<link rel="Stylesheet" type="text/css" href="./style.css" />
</style>
</head>
<body>
<div id="container">
<div id="header"><a href="<?php echo $this->_tpl_vars['url_top']; ?>
"><h1><?php echo $this->_tpl_vars['title']; ?>
</h1></a><div></div>
<div id="menu">
<input type="button" name="<?php echo $this->_tpl_vars['button_a_name']; ?>
" value="<?php echo $this->_tpl_vars['button_a_str']; ?>
" onclick="location.href='<?php echo $this->_tpl_vars['button_a_url']; ?>
'" />
<br>
<br>
<?php if ($this->_tpl_vars['button_b_flg']): ?>
<form method="POST" action="<?php echo $this->_tpl_vars['button_b_url']; ?>
">
<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['button_b_value']; ?>
" />
<input type="submit" name="conf" value="<?php echo $this->_tpl_vars['button_b_str']; ?>
" />
<?php endif; ?>
</div>
<div id="contents">
-------------------------------------------------------
<br>
<table border="1">
<?php unset($this->_sections['cnt']);
$this->_sections['cnt']['name'] = 'cnt';
$this->_sections['cnt']['loop'] = is_array($_loop=$this->_tpl_vars['clm0']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['cnt']['show'] = true;
$this->_sections['cnt']['max'] = $this->_sections['cnt']['loop'];
$this->_sections['cnt']['step'] = 1;
$this->_sections['cnt']['start'] = $this->_sections['cnt']['step'] > 0 ? 0 : $this->_sections['cnt']['loop']-1;
if ($this->_sections['cnt']['show']) {
    $this->_sections['cnt']['total'] = $this->_sections['cnt']['loop'];
    if ($this->_sections['cnt']['total'] == 0)
        $this->_sections['cnt']['show'] = false;
} else
    $this->_sections['cnt']['total'] = 0;
if ($this->_sections['cnt']['show']):

            for ($this->_sections['cnt']['index'] = $this->_sections['cnt']['start'], $this->_sections['cnt']['iteration'] = 1;
                 $this->_sections['cnt']['iteration'] <= $this->_sections['cnt']['total'];
                 $this->_sections['cnt']['index'] += $this->_sections['cnt']['step'], $this->_sections['cnt']['iteration']++):
$this->_sections['cnt']['rownum'] = $this->_sections['cnt']['iteration'];
$this->_sections['cnt']['index_prev'] = $this->_sections['cnt']['index'] - $this->_sections['cnt']['step'];
$this->_sections['cnt']['index_next'] = $this->_sections['cnt']['index'] + $this->_sections['cnt']['step'];
$this->_sections['cnt']['first']      = ($this->_sections['cnt']['iteration'] == 1);
$this->_sections['cnt']['last']       = ($this->_sections['cnt']['iteration'] == $this->_sections['cnt']['total']);
?>
<tr>
<td><?php echo $this->_tpl_vars['clm0'][$this->_sections['cnt']['index']]; ?>
</td>
<td><?php echo $this->_tpl_vars['clm1'][$this->_sections['cnt']['index']]; ?>
</td>
</tr>
<?php endfor; endif; ?>
</table>
<?php echo $this->_tpl_vars['bill']; ?>

</form>
<?php if ($this->_tpl_vars['button_c_flg']): ?>
<center>
<input type="button" name="<?php echo $this->_tpl_vars['button_c_name']; ?>
" value="<?php echo $this->_tpl_vars['button_c_value']; ?>
" onclick="location.href='<?php echo $this->_tpl_vars['button_c_url']; ?>
'" />
</center>
<?php endif; ?>
-------------------------------------------------------
</div><!-- contents -->
</div><!-- container -->
</body>
</html>