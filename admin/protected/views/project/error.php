<?php
/* @var $this ProductController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('project','project'),
);

$this->menu=array(
	array('label'=>Yii::t('project','btnCreate'), 'url'=>array('create')),
	array('label'=>Yii::t('project','manage'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('common','error');?></h1>

<div class="error">
<?php echo CHtml::encode($message); ?>
</div>
