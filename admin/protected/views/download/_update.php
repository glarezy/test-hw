
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/upload.js?v=131229"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/ajaxfileupload.js"></script>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'event1311-download-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recommend'); ?>
		<?php echo $form->checkBox($model, 'recommend').' '.Yii::t('download','recommendTip');?>
		<?php echo $form->error($model,'recommend'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'seq'); ?>
		<?php echo $form->textField($model, 'seq', array('size'=>8,'maxlength'=>2)).' '.Yii::t('download','seqTip');?>
		<?php echo $form->error($model,'seq'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->listBox($model, 'type', $channel, array('size'=>1));?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<b><?php echo Yii::t('download', 'upload');?></b>
		<input type=button id=btnUploadOne value="<?php echo Yii::t('download','uploadfile');?>">
	</div>

	<?php
	if( isset($uploaded) && is_array($uploaded) )
	foreach($uploaded as $entry) {
		?>
	<div class="row js-file-existed">
		<input type=hidden value="<?php echo $entry['val'];?>" name="existed_<?php echo $entry['num'];?>">
		<img src="<?php echo $entry['imgsrc'];?>">
		<span class="uploadedText"><?php echo $entry['txt'];?></span>
		<a href="javascript:void(0)"><span class="js-btn-del btnSpan"><?php echo Yii::t('common','delete');?></span></a>
	</div>
		<?php
	}
	?>

	<div id="uploadFlag" class="row">
		<?php echo $form->labelEx($model,'desp'); ?>
		<?php echo $form->textArea($model,'desp',array('id'=>'despArea', 'rows'=>16, 'cols'=>100)); ?>
		<?php echo $form->error($model,'desp'); ?>
	</div>

	<div id="uploadFlag" class="row">
		<?php echo $form->labelEx($model,'pid'); ?>
		<?php echo $form->textArea($model,'pid',array('id'=>'pidArea', 'rows'=>5, 'cols'=>100)); ?>
		<?php echo $form->error($model,'pid'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::button($model->isNewRecord ? Yii::t('common','create') : Yii::t('common','save'),array('id'=>'btnFormSubmit')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<div class="parthidden">
	<div id="textUploadOne"><?php echo Yii::t('product','uploadone');?></div>
	<div id="textUploadAgain"><?php echo Yii::t('product','uploadagain');?></div>
	<div id="textBtnDelete"><?php echo Yii::t('common','delete');?></div>
	<div id="uploadUrl"><?php echo Yii::app()->request->hostInfo.Yii::app()->request->baseUrl.'/download/upload';?></div>
	<div id="uploadTip"><?php echo Yii::t('download','uploadTip');?></div>
</div>