<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<div style="height:300px;">
	<table width="100%" height="100%"><tr><td style="text-align:center;">
		<h1><?php echo CHtml::encode(Yii::t('common','error404')); ?></h1>
	</td></tr></table>
</div>