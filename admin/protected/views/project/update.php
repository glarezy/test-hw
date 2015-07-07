<?php

$this->breadcrumbs=array(
	Yii::t('project','project')=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('project','btnUpdate'),
);

$this->menu=array(
	array('label'=>Yii::t('project','btnList'), 'url'=>array('index')),
	array('label'=>Yii::t('project','btnCreate'), 'url'=>array('create')),
	array('label'=>Yii::t('project','view'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('project','manage'), 'url'=>array('admin')),
);
?>

<h1><?php echo CHtml::encode($model->title);?></h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'channel'=>$channel, 'uploaded'=>$uploaded)); ?>