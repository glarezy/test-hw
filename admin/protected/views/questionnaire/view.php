<?php
/* @var $this QuestionnaireController */
/* @var $model Event1311QuestionnaireConstruction */

$this->breadcrumbs=array(
	Yii::t('question','questionnaire')=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>Yii::t('question','btnList'), 'url'=>array('index')),
	array('label'=>Yii::t('question','btnCreate'), 'url'=>array('create')),
	array('label'=>Yii::t('question','btnUpdate'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('question','btnDel'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('common','confirm'))),
	array('label'=>Yii::t('question','manage'), 'url'=>array('admin')),
);

?>

<h1><?php echo Yii::t('question','view');?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		array(
			'name' => 'recommend',
			'value' => $model->recommend ? Yii::t('common','enable') : Yii::t('common','disable'),
		),
		'construction',
		array(
			'name' => 'ctime',
			'value' => date('Y-m-d H:i:s', $model->ctime),
		),
		array(
			'name' => 'mtime',
			'value' => date('Y-m-d H:i:s', $model->mtime),
		),
	),
)); ?>
