<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/login.css" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body >

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tblWrap">
	<tr>
		<td class="tdWrap">

<div id="wrapBox">

<div id="header">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tblWrapHeader">
<tr>
    <td class="tdCellLogo">
        <h1 class="logo"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.jpg" border=1></h1>
    </td>
    <td class="tdCellTopNav">
	<h1 class="title"></h1>
    </td>
</tr>
</table>

</div>
<?php echo $content; ?>
<div class="footerWrap"><div class="footer"></div></div>

</div>

</td>
</tr>
</table>
</form>
></body>
</html>