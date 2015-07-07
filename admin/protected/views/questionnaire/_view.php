<?php
/* @var $this QuestionnaireController */
/* @var $data Event1311QuestionnaireConstruction */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->name), array('view', 'id'=>$data->id)); ?>
	<?php echo ' [ '.CHtml::link(Yii::t('question','result'),array('/questionnaire/result','id'=>$data->id)).' ]';?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('recommend')); ?>:</b>
	<?php echo CHtml::encode($data->recommend?Yii::t('common','enable'):Yii::t('common','disable')); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('construction')); ?>:</b>
	<?php echo CHtml::encode($data->construction); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ctime')); ?>:</b>
	<?php echo CHtml::encode(date('Y-m-d H:i:s', $data->ctime)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mtime')); ?>:</b>
	<?php echo CHtml::encode(date('Y-m-d H:i:s', $data->mtime)); ?>
	<br />


</div>