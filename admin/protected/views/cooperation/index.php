<?php
/* @var $this CooperationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('about','about')=>'/about',
	$curChannel=>'/cooperation',
	Yii::t('common','list'),
);

$this->menu=array(
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
<h1><?php echo Yii::t('cooperation','btnList');?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
