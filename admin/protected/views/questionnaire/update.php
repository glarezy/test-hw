<?php
/* @var $this QuestionnaireController */
/* @var $model Event1311QuestionnaireConstruction */

$this->breadcrumbs=array(
	'Event1311 Questionnaire Constructions'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Event1311QuestionnaireConstruction', 'url'=>array('index')),
	array('label'=>'Create Event1311QuestionnaireConstruction', 'url'=>array('create')),
	array('label'=>'View Event1311QuestionnaireConstruction', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Event1311QuestionnaireConstruction', 'url'=>array('admin')),
);

$this->breadcrumbs=array(
	Yii::t('question','questionnaire')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('question','btnUpdate'),
);

$this->menu=array(
	array('label'=>Yii::t('question','btnList'), 'url'=>array('index')),
	array('label'=>Yii::t('question','btnCreate'), 'url'=>array('create')),
	array('label'=>Yii::t('question','view'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('question','manage'), 'url'=>array('admin')),
);

?>

<h1><?php echo Yii::t('question','btnUpdate');?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>