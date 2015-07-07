<?php
/* @var $this QuestionnaireController */
/* @var $model Event1311QuestionnaireConstruction */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'event1311-questionnaire-construction-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recommend'); ?>
		<?php echo $form->checkBox($model, 'recommend').' '.Yii::t('common','enable');?>
		<?php echo $form->error($model,'recommend'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'construction'); ?>
		<label><?php echo CHtml::link(Yii::t('common','showSample'),array('/questionnaire/sample'),array('target'=>'_blank'));?></label>
		<?php echo $form->textArea($model,'construction',array('rows'=>50, 'cols'=>85)); ?>
		<?php echo $form->error($model,'construction'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('common','create') : Yii::t('common','save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->