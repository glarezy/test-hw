<?php
/* @var $this QuestionController */
/* @var $model Event1311Question */

$this->breadcrumbs=array(
	Yii::t('contact','contact')=>'/support',
	$curChannel=>'/question',
	Yii::t('common','manage'),
);

$this->menu=array(
	array('label'=>Yii::t('question','btnList'), 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#event1311-question-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<ul class="nav">
<?php
foreach($channel as $subid => $entry) {
	if( $subid == 'question' ) {
		echo '<li>'.CHtml::link(CHtml::encode($entry),array('/question')).'</li>';
		continue;
	}
	echo '<li>'.CHtml::link(CHtml::encode($entry),array('/support/'.CHtml::encode($entry))).' [ ';
	echo CHtml::link(CHtml::encode(Yii::t('common','edit')), array('/support/update/'.CHtml::encode($entry)));
	echo ' ]</li>';
}
?>
</ul>

</br></br>
<h1><?php echo Yii::t('question','manage');?></h1>

<?php echo CHtml::link(Yii::t('common','advancedSearch'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'event1311-question-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'email',
		'content',
		array(
			'name'=>'ctime',
			'value'=>'date("Y-m-d H:i:s",$data->ctime)',
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{delete}',
		),
	),
)); ?>
