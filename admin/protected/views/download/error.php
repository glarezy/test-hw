<?php
/* @var $this ProductController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('download','download'),
);

$this->menu=array(
	array('label'=>Yii::t('download','btnCreate'), 'url'=>array('create')),
	array('label'=>Yii::t('download','manage'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('common','error');?></h1>

<div class="error">
<?php echo CHtml::encode($message); ?>
</div>
