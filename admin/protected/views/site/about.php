
<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - '.Yii::t('about','about');
$this->breadcrumbs=array(
	Yii::t('about','about')=>'/about',
	$curChannel=>'/about/'.CHtml::encode($curChannel),
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
<h1><?php echo isset($model->title) ? CHtml::encode($model->title) : '';?></h1>

<div class="form">
<?php echo isset($model->content) ? $model->content : '';?>
</div><!-- form -->
