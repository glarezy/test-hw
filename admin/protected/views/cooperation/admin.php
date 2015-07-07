<?php
/* @var $this CooperationController */
/* @var $model Event1311Register */

$this->breadcrumbs=array(
	Yii::t('about','about')=>'/about',
	$curChannel=>'/cooperation',
	Yii::t('common','manage'),
);

$this->menu=array(
	array('label'=>Yii::t('cooperation','btnList'), 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#event1311-register-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
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
<h1><?php echo Yii::t('cooperation','manage');?></h1>

<?php echo CHtml::link(Yii::t('common','advancedSearch'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'event1311-register-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'name',
		'company',
		'email',
		array(
			'name'=>'ctime',
			'value'=>'date("Y-m-d H:i:s",$data->ctime)',
		),
		/*
		'tele',
		'phone',
		'city',
		'gender',
		'business',
		'lastyear',
		'thisyear',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
