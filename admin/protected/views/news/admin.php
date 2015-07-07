<?php

$this->breadcrumbs=array(
	Yii::t('news','news')=>array('index'),
	Yii::t('news','manage')=>array('admin'),
);

if( isset($subchannel) )
	$this->breadcrumbs[] = $subchannel;

$this->menu=array(
	array('label'=>Yii::t('news','btnCreate'), 'url'=>array('create')),
);

?>

<ul class="nav">
	<?php foreach($channel as $subid => $entry)
	echo '<li>'.CHtml::link(CHtml::encode($entry),array($channelName.'/adminSub/'.CHtml::encode($entry))).'</li>';?>
</ul>
<br></br>

<h1><?php echo Yii::t('news','manage');?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'event1311-news-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		'title',
		array(
			'name' => 'type',
			'value' => 'Helper::getSubChannelName("project", $data->type)',
		),
		array(
			'name' => 'ptime',
			'value' => 'date("Y-m-d", $data->ptime)',
		),
		array(
			'name' => 'recommend',
			'value' => 'Helper::yesOrNo($data->recommend)',
		),
		/*
		'id',
		'subject',
		'content',
		'htmlhead',
		'ctime',
		'mtime',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}&nbsp;&nbsp;&nbsp;{delete}',
		),
	),
)); ?>
