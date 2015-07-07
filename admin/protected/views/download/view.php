<?php
/* @var $this DownloadController */
/* @var $model Event1311Download */

$this->breadcrumbs=array(
	Yii::t('download','download')=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>Yii::t('download','btnList'), 'url'=>array('index')),
	array('label'=>Yii::t('download','btnCreate'), 'url'=>array('create')),
	array('label'=>Yii::t('download','btnUpdate'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('download','btnDel'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('download','manage'), 'url'=>array('admin')),
);
?>

<ul class="nav">
<?php
foreach($channel as $subid => $entry) {
	echo '<li>'.CHtml::link(CHtml::encode($entry),array('/download/sub/'.CHtml::encode($entry))).'</li>';
}
?>
</ul>
</br></br>
<h1><?php echo CHtml::encode($model->title);?></h1>
<div>
<?php if( $isPicture ) echo CHtml::link(CHtml::image($imgPreview),$fileUrl,array('target'=>'_blank'));?>
</div>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'title',
		'filename',
		'type',
		'pid',
		'desp',
		array(
			'name'=>'ctime',
			'value'=>date('Y-m-d H:i:s', $model->ctime),
		),
		array(
			'name'=>'mtime',
			'value'=>date('Y-m-d H:i:s', $model->mtime),
		),
	),
)); ?>
