<?php
/* @var $this QuestionController */
/* @var $model Event1311Question */

$this->breadcrumbs=array(
	Yii::t('contact','contact')=>'/support',
	$curChannel=>'/question',
	Yii::t('question','view'),
);

$this->menu=array(
	array('label'=>Yii::t('question','btnList'), 'url'=>array('index')),
	array('label'=>Yii::t('question','btnDel'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('question','manage'), 'url'=>array('admin')),
);
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

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'email',
		array(
			'name'=>'ctime',
			'value'=>date("Y-m-d H:i:s",$model->ctime),
		),
		'content',
	),
)); ?>
