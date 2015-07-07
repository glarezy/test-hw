<?php
/* @var $this DownloadController */
/* @var $model Event1311Download */

$this->breadcrumbs=array(
	Yii::t('download','download')=>array('index'),
	Yii::t('download','manage')=>array('admin'),
);

if( isset($subchannel) )
	$this->breadcrumbs[] = $subchannel;

$this->menu=array(
	array('label'=>Yii::t('download','btnCreate'), 'url'=>array('create')),
);

?>

<ul class="nav">
	<?php foreach($channel as $subid => $entry)
	echo '<li>'.CHtml::link(CHtml::encode($entry),array($channelName.'/adminSub/'.CHtml::encode($entry))).'</li>';?>
</ul>
<br></br>

<h1><?php echo Yii::t('download','manage');?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'event1311-download-grid',
	'dataProvider'=>$model->search(),
//	'filter'=>$model,
	'columns'=>array(
		'title',
		array(
			'name' => 'type',
			'value' => 'Helper::getSubChannelName("download", $data->type)',
		),
		'pid',
		'desp',
		/*
		'subtype',
		'seq',
		'path',
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
