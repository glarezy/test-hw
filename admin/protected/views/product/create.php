<?php

$this->breadcrumbs=array(
	Yii::t('product','product')=>array('index'),
	Yii::t('product','btnCreate'),
);

$this->menu=array(
	array('label'=>Yii::t('product','btnList'), 'url'=>array('index')),
	array('label'=>Yii::t('product','manage'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('product','btnCreate');?></h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'channel'=>$channel)); ?>