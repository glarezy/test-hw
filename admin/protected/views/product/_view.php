
<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pid), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('recommend')); ?>:</b>
	<?php echo CHtml::encode($data->recommend); ?>
	<br />

	<?php /*

	<b><?php echo CHtml::encode($data->getAttributeLabel('desp')); ?>:</b>
	<?php echo CHtml::encode($data->desp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('standard')); ?>:</b>
	<?php echo CHtml::encode($data->standard); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('performance')); ?>:</b>
	<?php echo CHtml::encode($data->performance); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('htmlhead')); ?>:</b>
	<?php echo CHtml::encode($data->htmlhead); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ctime')); ?>:</b>
	<?php echo CHtml::encode($data->ctime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mtime')); ?>:</b>
	<?php echo CHtml::encode($data->mtime); ?>
	<br />

	*/ ?>

</div>