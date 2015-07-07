<?php
/* @var $this ProductController */
/* @var $model Event1311Product */

$this->breadcrumbs=array(
	Yii::t('product','product')=>array('index'),
	Yii::t('product','manage')=>array('admin'),
);

if( isset($subchannel) )
	$this->breadcrumbs[] = $subchannel;

$this->menu=array(
//	array('label'=>Yii::t('product','btnList'), 'url'=>array('index')),
	array('label'=>Yii::t('product','btnCreate'), 'url'=>array('create')),
);


?>

<ul class="nav">
	<?php foreach($channel as $subid => $entry)
	echo '<li>'.CHtml::link(CHtml::encode($entry).'('.CHtml::encode($cnchannel[$subid]).')',array($channelName.'/adminSub/'.CHtml::encode($entry))).'</li>';
	echo '<li>'.Chtml::link(Yii::t('buy','title').'('.Yii::t('buy','title',array(),null,'zh_cn').')',array('/howtobuy')).'</li>';?>
</ul>
<br></br>

<h1><?php echo Yii::t('product','manage');?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'event1311-product-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		'pid',
		'title',
		array(
			'name' => 'type',
			'value' => 'Helper::getSubChannelName("product", $data->type)',
		),
		array(
			'name' => 'recommend',
			'value' => 'Helper::yesOrNo($data->recommend)',
		),
		array(
			'name' => 'display',
			'value' => '$data->display?Yii::t("product","display"):Yii::t("product","hidden")',
		),
		'seq',
		/*
		'desp',
		'standard',
		'performance',
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
