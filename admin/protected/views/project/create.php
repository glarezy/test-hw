<?php

$this->breadcrumbs=array(
	Yii::t('project','project')=>array('index'),
	Yii::t('project','btnCreate'),
);

$this->menu=array(
	array('label'=>Yii::t('project','btnList'), 'url'=>array('index')),
	array('label'=>Yii::t('project','manage'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('project','btnCreate');?></h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'channel'=>$channel)); ?>