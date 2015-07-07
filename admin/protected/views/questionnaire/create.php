<?php
/* @var $this QuestionnaireController */
/* @var $model Event1311QuestionnaireConstruction */

$this->breadcrumbs=array(
	Yii::t('question','questionnaire')=>array('index'),
	Yii::t('question','btnCreate'),
);

$this->menu=array(
	array('label'=>Yii::t('question','btnList'), 'url'=>array('index')),
	array('label'=>Yii::t('question','manage'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('question','btnCreate');?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>