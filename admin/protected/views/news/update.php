<?php

$this->breadcrumbs=array(
	Yii::t('news','news')=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('news','btnUpdate'),
);

$this->menu=array(
	array('label'=>Yii::t('news','btnList'), 'url'=>array('index')),
	array('label'=>Yii::t('news','btnCreate'), 'url'=>array('create')),
	array('label'=>Yii::t('news','view'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('news','manage'), 'url'=>array('admin')),
);
?>

<h1><?php echo CHtml::encode($model->title);?></h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'channel'=>$channel, 'uploaded'=>$uploaded)); ?>