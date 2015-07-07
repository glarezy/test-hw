<?php

$this->breadcrumbs=array(
	Yii::t('news','news')=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>Yii::t('news','btnList'), 'url'=>array('index')),
	array('label'=>Yii::t('news','btnCreate'), 'url'=>array('create')),
	array('label'=>Yii::t('news','btnUpdate'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('news','btnDel'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('news','manage'), 'url'=>array('admin')),
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
		'title',
		'type',
		'ptime',
		'recommend',
		'subject',
		'content',
		'htmlhead',
		'ctime',
		'mtime',
	),
)); ?>
