<?php
/* @var $this ProductController */
/* @var $model Event1311Product */
/* @var $form CActiveForm */
?>

<script>
	$(document).ready(function() {
		$('#despArea').xheditor({tools:'Cut,Copy,Paste,|,Fontface,FontSize,Bold,Italic,Underline,Strikethrough,FontColor,BackColor,|,SelectAll,Removeformat,|,Align,List,Outdent,Indent,|,Link,Unlink,Anchor,Img,Flash,Hr,Table,|,Source,Preview,Fullscreen'});
		$('#standardArea').xheditor({tools:'Cut,Copy,Paste,|,Fontface,FontSize,Bold,Italic,Underline,Strikethrough,FontColor,BackColor,|,SelectAll,Removeformat,|,Align,List,Outdent,Indent,|,Link,Unlink,Anchor,Img,Flash,Hr,Table,|,Source,Preview,Fullscreen'});
		$('#performanceArea').xheditor({tools:'Cut,Copy,Paste,|,Fontface,FontSize,Bold,Italic,Underline,Strikethrough,FontColor,BackColor,|,SelectAll,Removeformat,|,Align,List,Outdent,Indent,|,Link,Unlink,Anchor,Img,Flash,Hr,Table,|,Source,Preview,Fullscreen'});
		//$('#htmlheadArea').xheditor({tools:'Cut,Copy,Paste,|,Fontface,FontSize,Bold,Italic,Underline,Strikethrough,FontColor,BackColor,|,SelectAll,Removeformat,|,Align,List,Outdent,Indent,|,Link,Unlink,Anchor,Img,Flash,Hr,Table,|,Source,Preview,Fullscreen'});

	});
</script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/upload.js?v=131229"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/ajaxfileupload.js"></script>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'event1311-product-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Yii::t('login','star',array('{star}'=>'<span class="required">*</span>'));?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'pid'); ?>
		<?php echo $form->textField($model,'pid',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'pid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'display'); ?>
		<?php echo $form->listBox($model, 'display', array('0'=>Yii::t('product','hidden'),'1'=>Yii::t('product','display')), array('size'=>1));?>
		<?php echo $form->error($model,'display'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recommend'); ?>
		<?php echo $form->checkBox($model, 'recommend').' '.Yii::t('product','recommendTip');?>
		<?php echo $form->error($model,'recommend'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'seq'); ?>
		<?php echo $form->textField($model, 'seq', array('size'=>8,'maxlength'=>2)).' '.Yii::t('product','seqTip');?>
		<?php echo $form->error($model,'seq'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->listBox($model, 'type', $channel, array('size'=>1));?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<b><?php echo Yii::t('product', 'uploadpic');?></b>
		<input type=button id=btnUpload value="<?php echo Yii::t('product','uploadone');?>">
		<span><?php echo CHtml::encode(Yii::t('product','uploadtip'));?></span>
	</div>

	<?php
	if( isset($uploaded) && is_array($uploaded) )
	foreach($uploaded as $entry) {
		?>
	<div class="row">
		<input type=hidden value="<?php echo $entry['val'];?>" name="existed_<?php echo $entry['num'];?>">
		<ul class="uploaded"><li>
		<img src="<?php echo $entry['imgsrc'];?>">
		</li><li>
		<div class="uploadedText"><?php echo $entry['txt'];?></div>
		<input value="<?php echo $entry['val'];?>" <?php if($entry['adshow']==1) echo ' checked ';?> type=checkbox id="adshow_<?php echo $entry['num'];?>" name="adshow_<?php echo $entry['num'];?>"><label for="adshow_<?php echo $entry['num'];?>" style="display:inline;"><?php echo Yii::t('common','adshow');?></label>
		&nbsp;
		<input value="<?php echo $entry['val'];?>" <?php if($entry['newproduct']==1) echo ' checked ';?> type=checkbox id="newproduct_<?php echo $entry['num'];?>" name="newproduct_<?php echo $entry['num'];?>"><label for="newproduct_<?php echo $entry['num'];?>" style="display:inline;"><?php echo Yii::t('common','newproduct');?></label>
		&nbsp;
		<input value="<?php echo $entry['val'];?>" <?php if($entry['mainpic']==1) echo ' checked ';?> type=checkbox id="mainpic_<?php echo $entry['num'];?>" name="mainpic_<?php echo $entry['num'];?>"><label for="mainpic_<?php echo $entry['num'];?>" style="display:inline;"><?php echo Yii::t('common','mainpic');?></label>
		<a href="javascript:void(0)"><span class="js-btn-del btnSpan"><?php echo Yii::t('common','delete');?></span></a>
		</li></ul>
	</div>
		<?php
	}
	?>

	<div id="uploadFlag" class="row" style="clear:both;">
		<?php echo $form->labelEx($model,'desp'); ?>
		<?php echo $form->textArea($model,'desp',array('id'=>'despArea', 'rows'=>16, 'cols'=>100)); ?>
		<?php echo $form->error($model,'desp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'standard'); ?>
		<?php echo $form->textArea($model,'standard',array('id'=>'standardArea', 'rows'=>16, 'cols'=>100)); ?>
		<?php echo $form->error($model,'standard'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'performance'); ?>
		<?php echo $form->textArea($model,'performance',array('id'=>'performanceArea', 'rows'=>16, 'cols'=>100)); ?>
		<?php echo $form->error($model,'performance'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'htmlhead'); ?>
		<?php echo $form->textArea($model,'htmlhead',array('id'=>'htmlheadArea', 'rows'=>10, 'cols'=>100)); ?>
		<?php echo $form->error($model,'htmlhead'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('common','create') : Yii::t('common','save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<div class="parthidden">
	<div id="textUploadOne"><?php echo Yii::t('product','uploadone');?></div>
	<div id="textUploadAgain"><?php echo Yii::t('product','uploadagain');?></div>
	<div id="textBtnDelete"><?php echo Yii::t('common','delete');?></div>
	<div id="uploadUrl"><?php echo Yii::app()->request->baseUrl.'/product/uploadpic';?></div>
	<div id="adshow"><?php echo Yii::t('common','adshow');?></div>
	<div id="mainpic"><?php echo Yii::t('common','mainpic');?></div>
	<div id="newproduct"><?php echo Yii::t('common','newproduct');?></div>
</div>