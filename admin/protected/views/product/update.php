<?php

$this->breadcrumbs=array(
	Yii::t('product','product')=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('product','btnUpdate'),
);

$this->menu=array(
	array('label'=>Yii::t('product','btnList'), 'url'=>array('index')),
	array('label'=>Yii::t('product','btnCreate'), 'url'=>array('create')),
	array('label'=>Yii::t('product','view'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('product','manage'), 'url'=>array('admin')),
);
?>

<h1><?php echo CHtml::encode($model->title);?></h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'channel'=>$channel, 'uploaded'=>$uploaded)); ?>