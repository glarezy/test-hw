<?php
/* @var $this ProductController */
/* @var $model Event1311Product */

$this->breadcrumbs=array(
	Yii::t('product','product')=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>Yii::t('product','btnList'), 'url'=>array('index')),
	array('label'=>Yii::t('product','btnCreate'), 'url'=>array('create')),
	array('label'=>Yii::t('product','btnUpdate'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('product','btnDel'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('product','manage'), 'url'=>array('admin')),
);
?>

<h1><?php echo CHtml::encode($model->title);?></h1>

<ul class="imgPreview">
<?php
foreach($imgsrc as $entry) {
	echo '<li><img src="'.$entry.'" border></li>';
}
?>
</ul>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'pid',
		'title',
		'type',
		'desp',
		'standard',
		'performance',
		'recommend',
		'htmlhead',
		'ctime',
		'mtime',
	),
)); ?>
