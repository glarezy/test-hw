<?php
/* @var $this HowtobuyController */
/* @var $model Event1311Buy */

$this->breadcrumbs=array(
	Yii::t('product','product')=>array('/product/index'),
	Yii::t('buy','title')=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>Yii::t('common','manage'), 'url'=>array('admin')),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'company',
		'email',
		'phone',
		'area',
		'desp',
		array(
			'name'=>'ctime',
			'value'=>date('Y-m-d H:i:s', $model->ctime),
		),
	),
)); ?>
