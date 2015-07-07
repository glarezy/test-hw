<?php
/* @var $this QuestionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('contact','contact')=>array('/support'),
	$curChannel=>array('/question'),
	Yii::t('common','list'),
);

$this->menu=array(
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
<h1><?php echo Yii::t('question','btnList');?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
