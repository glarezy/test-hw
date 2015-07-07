<?php

$this->breadcrumbs=array(
	Yii::t('news','news')=>array('index'),
);

if( isset($subchannel) )
	$this->breadcrumbs[] = $subchannel;

$this->menu=array(
	array('label'=>Yii::t('news','btnCreate'), 'url'=>array('create')),
	array('label'=>Yii::t('news','manage'), 'url'=>array('admin')),
);
?>

<ul class="nav">
	<?php foreach($channel as $subid => $entry)
	echo '<li>'.CHtml::link(CHtml::encode($entry),array($channelName.'/sub/'.CHtml::encode($entry))).'</li>';?>
</ul>
<br></br>
<h1><?php echo Yii::t('news','news');?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
