<?php
/* @var $this HowtobuyController */
/* @var $model Event1311Buy */

$this->breadcrumbs=array(
	Yii::t('product','product')=>array('/product/index'),
	Yii::t('buy','title')=>array('index'),
	Yii::t('common','manage'),
);

?>

<h1><?php echo Yii::t('buy','title');?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'event1311-buy-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'name',
		'company',
		'email',
		'phone',
		'area',
		/*
		'desp',
		'language',
		'ctime',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}&nbsp;&nbsp;&nbsp;{delete}',
		),
	),
)); ?>
