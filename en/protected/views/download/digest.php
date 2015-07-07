
<table style="padding:10px;width:100%"><tr>
	<td rowspan=2 width=50>
		<?php echo Helper::m('images/'.$files[$data->id]['type'].'_icon.png',42,42);?>
	</td>
	<td class="fileTitleFont"><?php echo CHtml::encode($data->title);?></td>
	<td width=100 align=right><?php echo Yii::t('download','sizeInfo').Helper::size($data->path,'download');?></td>
	</tr>
	<tr><td><?php echo CHtml::encode($data->desp);?></td>
		<td align=right><?php echo CHtml::link(
			Yii::t('download','downloadFile'),
			$files[$data->id]['link'],
			array('target'=>'_blank'));?></td>
		</tr>
	<tr><td colspan=3>

	</td></tr></table>
	<div><img src="<?php echo Helper::resUrl('images/s_line.jpg');?>" width="100%" height="8"></div>
