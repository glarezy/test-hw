
<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - '.Yii::t('contact','contact');
$this->breadcrumbs=array(
	Yii::t('contact','contact')=>'/support',
	$curChannel=>'/support/'.CHtml::encode($curChannel),
);
?>
<ul class="nav">
<?php
foreach($channel as $subid => $entry) {
	if( $subid == 'question' ) {
		if( Yii::app()->language == 'en' ) {
			echo '<li>'.CHtml::link(CHtml::encode($entry),array('/question/support')).' [ ';
			echo CHtml::link(CHtml::encode(Yii::t('common','edit')), array('/question/supportUpdate'));
			echo ' ]</li>';
			continue;
		}
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
<h1><?php echo isset($model->title) ? CHtml::encode($model->title) : '';?></h1>

<div class="form">
<?php echo isset($model->content) ? $model->content : '';?>
</div><!-- form -->
