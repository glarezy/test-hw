<?php

$this->breadcrumbs=array(
	Yii::t('news','news')=>array('index'),
	Yii::t('news','btnCreate'),
);

$this->menu=array(
	array('label'=>Yii::t('news','btnList'), 'url'=>array('index')),
	array('label'=>Yii::t('news','manage'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('news','btnCreate');?></h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'channel'=>$channel)); ?>