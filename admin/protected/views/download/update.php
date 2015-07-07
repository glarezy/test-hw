<?php

$this->breadcrumbs=array(
	Yii::t('download','download')=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('download','btnUpdate'),
);
$this->menu=array(
	array('label'=>Yii::t('download','btnList'), 'url'=>array('index')),
	array('label'=>Yii::t('download','btnCreate'), 'url'=>array('create')),
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
<h1><?php echo Yii::t('download','btnUpdate');?></h1>

<?php $this->renderPartial('_update', array('model'=>$model, 'channel'=>$channel, 'uploaded'=>$uploaded)); ?>