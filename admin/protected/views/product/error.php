<?php
/* @var $this ProductController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('product','product'),
);

$this->menu=array(
	array('label'=>Yii::t('product','btnCreate'), 'url'=>array('create')),
	array('label'=>Yii::t('product','manage'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('common','error');?></h1>

<div class="error">
<?php echo CHtml::encode($message); ?>
</div>
