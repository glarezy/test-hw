<?php

$this->breadcrumbs=array(
	Yii::t('download','download')=>array('index'),
	Yii::t('download','btnCreate'),
);

$this->menu=array(
	array('label'=>Yii::t('download','btnList'), 'url'=>array('index')),
	array('label'=>Yii::t('download','manage'), 'url'=>array('admin')),
);
?>

<ul class="nav">
<?php
foreach($channel as $subid => $entry) {
	echo '<li>'.CHtml::link(CHtml::encode($entry),array('download/sub/'.CHtml::encode($entry))).'</li>';
}
?>
</ul>
</br></br>
<h1><?php echo Yii::t('download','btnCreate');?></h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'channel'=>$channel)); ?>