<ul class="title"><li><?php echo H::m('title-icon.jpg',23,26);?></li><li><?php echo CHtml::encode(Yii::t('question','question'));?></li></ul>

<div class="form" style="clear:both">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'event1311-question-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note"><?php echo Yii::t('login','star',array('{star}'=>'<span class="required">*</span>'));?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'area'); ?>
		<?php echo $form->listBox($model, 'area', array('huabei'=>Yii::t('question','huabei'),'huadong'=>Yii::t('question','huadong'),'huanan'=>Yii::t('question','huanan'),), array('size'=>1));?>
		<?php echo $form->error($model,'area'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>20, 'cols'=>80)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode'); ?>
		</div>
		<div class="hint"><?php echo Yii::t('login','authcodetip',array('{n}'=>'</br>'));?></div>
		<?php echo $form->error($model,'verifyCode'); ?>
	</div>
	<?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('common','submit')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->