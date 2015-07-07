<script>
$(document).ready(function () {
	var langstr = "<?php echo Yii::app()->language;?>";
	var ch = <?php echo json_encode($channel);?>;

	$('#infopart').hide();

	$('.js-channel-list').bind('change',function(){
//		var v = this.value.split('_');
		v = ["",""];
		var n = this.value.indexOf('_');
		if( n != -1 )
			v = [this.value.substring(0,n), this.value.substring(n+1)];
//		if( !v || v.length != 2 ) {
		if( n == -1 || v[0] == "" ) {
			$('#channelCnName').val('');
			$('#channelEnName').val('');
			$('#channelkey').val('');
			$('#btnNew').show();
			$('#btnUp').hide();
			$('#btnDown').hide();
			$('#btnSave').hide();
			$('#btnDel').hide();
			$('#infopart').show();
			return;
		}

		var s = '';
		eval("s=ch.zh_cn."+v[0]+"."+v[1]+";");
		$('#channelCnName').val(s);
		eval("s=ch.en."+v[0]+"."+v[1]+";");
		$('#channelEnName').val(s);
		eval("s=ch.ru."+v[0]+"."+v[1]+";");
		$('#channelRuName').val(s);
		$('#channelkey').val(v[1]);
		$('#btnNew').hide();
		$('#btnUp').show();
		$('#btnDown').show();
		$('#btnSave').show();
		$('#btnDel').show();
		$('#infopart').show();
	});

	$('#btnNew').bind('click',function(){
		$('#cmd').val('newChannel');
		$('#l1').val($('#curchannel').val());
		$('#event1311-options-form').submit();
	});

	$('#btnSave').bind('click',function(){
		$('#cmd').val('saveChannel');
		$('#l1').val($('#curchannel').val());
		$('#event1311-options-form').submit();
	});

	$('#btnUp').bind('click',function(){
		$('#cmd').val('moveup');
		$('#l1').val($('#curchannel').val());
		$('#event1311-options-form').submit();
	});

	$('#btnDown').bind('click',function(){
		$('#cmd').val('movedown');
		$('#l1').val($('#curchannel').val());
		$('#event1311-options-form').submit();
	});

	$('#btnDel').bind('click',function(){
		if( !confirm($('#channelDelConfirm').html()) )
			return;
		$('#cmd').val('delChannel');
		$('#l1').val($('#curchannel').val());
		$('#event1311-options-form').submit();
	});
})
</script>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'event1311-options-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
	<?php echo CHtml::hiddenField('cmd','');?>
	<?php echo CHtml::hiddenField('l1','');?>
	<?php echo CHtml::hiddenField('l2','');?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'htmlhead'); ?>
		<?php echo $form->textArea($model,'htmlhead',array('rows'=>10, 'cols'=>80)); ?>
		<?php echo $form->error($model,'htmlhead'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::label(Yii::t('common','subchannel').'&nbsp;&nbsp;'.$channelRep,''); ?>
	</div>

	<div class="row">
		<hr>
	</div>

	<div class="row">
		<?php echo CHtml::label(Yii::t('common','curchannel'),''); ?>
		<table><tr><td width=1>
		<?php
		echo '<select class="js-channel-list" id=curchannel name=curchannel multiple="multiple" size="20">';
		foreach($nav as $entry) {
			if( !isset($channel[Yii::app()->language][$entry['key']]) || in_array($entry['key'], array('about','support')) )
				continue;
			echo '<option value="'.$entry['key'].'">'.CHtml::encode($entry['label']).'</option>';
			foreach($channel[Yii::app()->language][$entry['key']] as $l2 => $label) {
				echo '<option value="'.$entry['key'].'_'.$l2.'">&nbsp;&nbsp;&nbsp;&nbsp;'.CHtml::encode($label).'</option>';
			}
		}
		echo '</select>';
		?>
		</td><td><ul><li><?php echo Yii::t('common','channelTip');?></li></ul>
			<ul id="infopart">
				<li><?php echo CHtml::label(Yii::t('common','channelCnName'),''); ?></li>
				<li><?php echo CHtml::textField('channelCnName','',array('id'=>'channelCnName', 'size'=>32, 'maxlength'=>64));?></li>
				<li><?php echo CHtml::label(Yii::t('common','channelEnName'),''); ?></li>
				<li><?php echo CHtml::textField('channelEnName','',array('id'=>'channelEnName', 'size'=>32, 'maxlength'=>64));?></li>
				<li><?php echo CHtml::label(Yii::t('common','channelRuName'),''); ?></li>
				<li><?php echo CHtml::textField('channelRuName','',array('id'=>'channelRuName', 'size'=>32, 'maxlength'=>64));?></li>
				<li><?php echo CHtml::label(Yii::t('common','channelkey'),''); ?></li>
				<li><?php echo CHtml::textField('channelkey','',array('id'=>'channelkey', 'size'=>32, 'maxlength'=>64));?></li>
			<li><?php
				echo CHtml::button(Yii::t('common','btnNew'),array('id'=>'btnNew'));
				echo CHtml::button(Yii::t('common','btnUp'),array('id'=>'btnUp'));
				echo '&nbsp;&nbsp;'.CHtml::button(Yii::t('common','btnDown'),array('id'=>'btnDown'));
				echo '&nbsp;&nbsp;'.CHtml::button(Yii::t('common','btnModify'),array('id'=>'btnSave'));
				echo '&nbsp;&nbsp;'.CHtml::button(Yii::t('common','delete'),array('id'=>'btnDel'));
				?></li>
		</ul></td>
		</tr></table>
	</div>

	<div class="row">
		<?php echo CHtml::label(Yii::t('common','chgpasswd').'&nbsp;&nbsp;'.$passwdRep,''); ?>
	</div>

	<div class="row">
		<hr>
	</div>

	<div class="row">
		<?php echo CHtml::label(Yii::t('common','curpasswd'),''); ?>
		<?php echo CHtml::passwordField('curpasswd','',array('size'=>32, 'maxlength'=>64));?>
	</div>

	<div class="row">
		<?php echo CHtml::label(Yii::t('common','newpasswd'),''); ?>
		<?php echo CHtml::passwordField('newpasswd','',array('size'=>32, 'maxlength'=>64));?>
	</div>

	<div class="row">
		<?php echo CHtml::label(Yii::t('common','confirmpasswd'),''); ?>
		<?php echo CHtml::passwordField('newpasswd2','',array('size'=>32, 'maxlength'=>64));?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('common','save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<div class="hidden">
	<div id="channelDelConfirm"><?php echo CHtml::encode(Yii::t('common','channelDelConfirm'));?></div>
</div>