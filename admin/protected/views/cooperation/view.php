<?php
/* @var $this CooperationController */
/* @var $model Event1311Register */

$this->breadcrumbs=array(
	Yii::t('about','about')=>'/about',
	$curChannel=>'/cooperation',
	Yii::t('cooperation','view'),
);

$this->menu=array(
	array('label'=>Yii::t('cooperation','btnList'), 'url'=>array('index')),
	array('label'=>Yii::t('cooperation','btnDel'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('cooperation','manage'), 'url'=>array('admin')),
);
?>

<ul class="nav">
<?php
foreach($channel as $subid => $entry) {
	if( $subid == 'cooperation' ) {
		echo '<li>'.CHtml::link(CHtml::encode($entry),array('/cooperation')).'</li>';
		continue;
	}
	echo '<li>'.CHtml::link(CHtml::encode($entry),array('/about/'.CHtml::encode($entry))).' [ ';
	echo CHtml::link(CHtml::encode(Yii::t('common','edit')), array('/about/update/'.CHtml::encode($entry)));
	echo ' ]</li>';
}
?>
</ul>

</br></br>
<h1><?php echo CHtml::encode($model->name).' , '.CHtml::encode($model->company); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'company',
		'tele',
		'phone',
		'email',
		'city',
		array(
			'name'=>'gender',
			'value'=>Yii::t('common',$model->gender),
		),
		'business',
		'lastyear',
		'thisyear',
		array(
			'name'=>'ctime',
			'value'=>date('Y-m-d H:i:s', $model->ctime),
		),
	),
)); ?>
