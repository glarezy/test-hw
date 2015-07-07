<?php
/* @var $this QuestionnaireController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('question','questionnaire'),
);

$this->menu=array(
	array('label'=>Yii::t('question','btnCreate'), 'url'=>array('create')),
	array('label'=>Yii::t('question','manage'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('question','questionnaire');?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
