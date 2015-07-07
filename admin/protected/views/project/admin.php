<?php

$this->breadcrumbs=array(
	Yii::t('project','project')=>array('index'),
	Yii::t('project','manage')=>array('admin'),
);

if( isset($subchannel) )
	$this->breadcrumbs[] = $subchannel;

$this->menu=array(
	array('label'=>Yii::t('project','btnCreate'), 'url'=>array('create')),
);

$_chanel = Helper::getChannel();
$_name = '';
foreach($_chanel['project'] as $id => $label) {
	$_name = str_replace('%s', $label, Yii::t('project','oopstip'));
	break;
}
?>

<h1><?php echo Yii::t('project','manage');?></h1>
<h5><?php echo $_name;?></h5>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'event1311-project-grid',
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
