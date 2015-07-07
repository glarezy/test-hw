<?php
/* @var $this ProductController */
/* @var $model Event1311Product */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'pid'); ?>
		<?php echo $form->textField($model,'pid',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
	</div>
<?php /*

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'desp'); ?>
		<?php echo $form->textArea($model,'desp',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'standard'); ?>
		<?php echo $form->textArea($model,'standard',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'performance'); ?>
		<?php echo $form->textArea($model,'performance',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'recommend'); ?>
		<?php echo $form->textField($model,'recommend'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'htmlhead'); ?>
		<?php echo $form->textArea($model,'htmlhead',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ctime'); ?>
		<?php echo $form->textField($model,'ctime',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mtime'); ?>
		<?php echo $form->textField($model,'mtime',array('size'=>11,'maxlength'=>11)); ?>
	</div>
*/?>
	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('common','search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->