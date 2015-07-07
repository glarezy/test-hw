
<div class="form" style="text-align:left;padding-left:35px;clear:both;">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'event1311-buy-test-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // See class documentation of CActiveForm for details on this,
    // you need to use the performAjaxValidation()-method described there.
    'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Yii::t('login','star',array('{star}'=>'<span class="required">*</span>'));?></p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name'); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'company'); ?>
        <?php echo $form->textField($model,'company'); ?>
        <?php echo $form->error($model,'company'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'email'); ?>
        <?php echo $form->textField($model,'email'); ?>
        <?php echo $form->error($model,'email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'phone'); ?>
        <?php echo $form->textField($model,'phone'); ?>
        <?php echo $form->error($model,'phone'); ?>
    </div>

	<div class="row" style="display:none;">
		<?php echo $form->labelEx($model,'area'); ?>
		<?php echo $form->listBox($model, 'area', array('ROA'=>'ROA'), array('size'=>1));?>
		<?php echo $form->error($model,'area'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'desp'); ?>
        <?php echo $form->textArea($model,'desp',array('rows'=>20, 'cols'=>80)); ?>
        <?php echo $form->error($model,'desp'); ?>
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
