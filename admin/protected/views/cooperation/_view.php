<?php
/* @var $this CooperationController */
/* @var $data Event1311Register */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('company')); ?>:</b>
	<?php echo CHtml::encode($data->company); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tele')); ?>:</b>
	<?php echo CHtml::encode($data->tele); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('city')); ?>:</b>
	<?php echo CHtml::encode($data->city); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lastyear')); ?>:</b>
	<?php echo CHtml::encode($data->lastyear); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('thisyear')); ?>:</b>
	<?php echo CHtml::encode($data->thisyear); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ctime')); ?>:</b>
	<?php echo CHtml::encode(date('Y-m-d H:i:s',$data->ctime)); ?>
	<br />


</div>