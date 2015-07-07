<ul class="title"><li><?php echo H::m('title-icon.jpg',23,26);?></li><li><?php echo CHtml::encode(Yii::t('cooperation','title'));?></li></ul>

<div class="form" style="clear:both">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'event1311-register-form',
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
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'company'); ?>
		<?php echo $form->textField($model,'company',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'company'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tele'); ?>
		<?php echo $form->textField($model,'tele',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'tele'); ?>
	</div>

	<div class="row2">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->dropDownList($model,'city',Helper::getProvince()); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lastyear'); ?>
		<?php echo $form->textArea($model,'lastyear',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'lastyear'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'thisyear'); ?>
		<?php echo $form->textArea($model,'thisyear',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'thisyear'); ?>
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