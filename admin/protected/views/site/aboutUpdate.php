
<script>
	$(document).ready(function() {
		$('#contArea').xheditor({tools:'Cut,Copy,Paste,|,Fontface,FontSize,Bold,Italic,Underline,Strikethrough,FontColor,BackColor,|,SelectAll,Removeformat,|,Align,List,Outdent,Indent,|,Link,Unlink,Anchor,Img,Flash,Hr,Table,|,Source,Preview,Fullscreen'});
		//$('#seoArea').xheditor({tools:'Cut,Copy,Paste,|,Fontface,FontSize,Bold,Italic,Underline,Strikethrough,FontColor,BackColor,|,SelectAll,Removeformat,|,Align,List,Outdent,Indent,|,Link,Unlink,Anchor,Img,Flash,Hr,Table,|,Source,Preview,Fullscreen'});
	});
</script>

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

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'event1311-about-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
</br></br>
<h1><?php echo isset($model->title) ? CHtml::encode($model->title) : '';?></h1>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title'); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('id'=>'contArea', 'rows'=>25, 'cols'=>100)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'htmlhead'); ?>
		<?php echo $form->textArea($model,'htmlhead',array('id'=>'seoArea', 'rows'=>16, 'cols'=>100)); ?>
		<?php echo $form->error($model,'htmlhead'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('common','submit')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
