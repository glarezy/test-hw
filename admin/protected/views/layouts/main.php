<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/honeywell.css" />

	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/xheditor/jquery/jquery-1.4.4.min.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/xheditor/xheditor-1.2.1.min.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/xheditor/xheditor_lang/zh-cn.js"></script>


	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.jpg" border=1>
		<div class="topbarBtnLine">
			<span class="topbarBtn"><a href="<?php echo Yii::app()->request->baseUrl; ?>/lang/zh_cn">中文</a></span>
			<span class="topbarBtn"><a href="<?php echo Yii::app()->request->baseUrl; ?>/lang/en">English</a></span>
			<span class="topbarBtn"><a href="<?php echo Yii::app()->request->baseUrl; ?>/lang/ru">Russian</a></span>
		</div>
		</div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
//				array('label'=>Yii::t('home','home'), 'url'=>array('/product')),
				array('label'=>Yii::t('product','product'), 'url'=>array('/product')),
				array('label'=>Yii::t('project','project'), 'url'=>array('/project')),
				array('label'=>Yii::t('download','download'), 'url'=>array('/download')),
				array('label'=>Yii::t('news','news'), 'url'=>array('/news')),
				//array('label'=>Yii::t('about','about'), 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>Yii::t('about','about'), 'url'=>array('/about')),
				array('label'=>Yii::t('contact','contact'), 'url'=>array('/support')),
				array('label'=>Yii::t('question','questionnaire'), 'url'=>array('/questionnaire')),
				array('label'=>Yii::t('common','options'), 'url'=>array('/options')),
				array('label'=>Yii::t('login','login'), 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>Yii::t('login','logout').' ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(Yii::app()->language=='ru'):?>
	<div style="padding:5px 20px;color:red;">您正在进行俄语版的页面管理</div>
	<?php endif;?>
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
	</div><!-- footer -->

</div><!-- page -->
<div class="parthidden">
<div id="processingImgSrc"><?php echo Helper::resUrl('images/processing.gif');?></div>
<div id="uploadingTextTip"><?php echo Yii::t('common','uploadingTextTip');?></div>
<div id="uploadFailed"><?php echo Yii::t('common','uploadFailed');?></div>
<div id="uploadingSubmitDeny"><?php echo Yii::t('common','uploadingSubmitDeny');?></div>
</div>
</body>
</html>
