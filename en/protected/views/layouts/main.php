<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<style type="text/css">
<!--
img {
	border:0;
}
.img_switch {
	margin:0 auto; WIDTH:950px; HEIGHT: 310px
}
.img_switch_content {
	WIDTH: 100%;
	HEIGHT: 310px;
	position:relative;
}
#pic {
	OVERFLOW: hidden
}
-->
</style>
</head>

<body topmargin="0">
<table width="979" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td align="center" class="topbg">

<table width="944" border="0" cellpadding="0" cellspacing="0" class="globalbg">
  <tr>
    <td width="576" rowspan="3" align="left" valign="bottom"><img src="<?php echo Helper::resUrl('images/logo.jpg');?>" width="170" height="55"></td>
    <td height="59" colspan="3" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td height="22" align="right"></td>
    <td style="padding-left:12px;"><img src="<?php echo Helper::resUrl('images/language2.jpg');?>" width="216" height="15" border="0" usemap="#Map"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="174" height="22" align="right"> </td>
    <td width="180" align="center">
    </td>
    <td width="49"></td>
  </tr>
</table>
<map name="Map">
  <area shape="rect" coords="4,0,68,15" href="<?php echo Helper::langSel('en');?>">
  <area shape="rect" coords="81,0,128,15" href="<?php echo Helper::langSel('zh_cn');?>">
  <area shape="rect" coords="140,0,211,15" href="<?php echo Helper::langSel('ru');?>">
</map>
<table border="0" cellspacing="0" cellpadding="0" >
  <tr>
    <td colspan="15">&nbsp;</td>
  </tr>
  <tr>
    <td width="10"><?php echo CHtml::image(Helper::resUrl('images/navleft.jpg'),'',array('width'=>10,'height'=>37));?></td>
    <?php $nav = Helper::getNav();
    	foreach($nav as $n => $entry) {
    		if( $n > 0 ) {
    			echo '<td width="3" align="center" background="'.Helper::resUrl('images/navbg.jpg').'">';
    			echo CHtml::image(Helper::resUrl('images/navline.jpg'),CHtml::encode($entry['label']),array('width'=>3,'height'=>37));
    			echo '</td>';
    		}
    		echo '<td class="nav">'.CHtml::link('<span>'.CHtml::encode($entry['label']).'</span>',$entry['link']).'</td>';
    	}
    ?>
    <td width="10"><?php echo CHtml::image(Helper::resUrl('images/navright.jpg'),'',array('width'=>10,'height'=>37));?></td>
  </tr>
</table>
<?php echo $content; ?>
</td>
  </tr>
</table>

<table width="979" height="100" border="0" align="center" cellpadding="0" cellspacing="0" class="bottombg">
  <tr>
    <td align="center">&nbsp;</td>
    <td width="743" rowspan="3"> <br>
<table width="600" border="0" cellspacing="0" cellpadding="0">
        <tbody><tr>
          <td align="center">
            <font color="#666666"><?php echo Yii::t('common','CPR');?>
            	<span style="font-family:arial;">Copyright &copy;Youjie All rights reserved.</span>
            	<br>&nbsp;<?php echo Yii::t('common','ICP');?></font><script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_5868700'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s22.cnzz.com/stat.php%3Fid%3D5868700%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));</script>
            </td>
        </tr>
      </tbody>
</table>

    </td>
  </tr>
  <tr>
    <td width="236" align="center"><img src="<?php echo Helper::resUrl('images/bottomlogo.jpg');?>" width="113" height="23">
</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
</table>

</body>
</html>
