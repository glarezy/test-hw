<table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr>
    	<td height="10" colspan="2"> </td>
  	</tr>
  	<tr>
		<td width=1 rowspan="5" valign=top align="left" style="padding-right:20px;"><?php echo CHtml::link(CHtml::image(isset($img[$data->id])?$img[$data->id]:'','',array('width'=>192,'height'=>181,'border'=>0)),array('view','id'=>$data->id));?>&nbsp;</td>
    	<td align="left" class="pf14"><?php echo CHtml::encode($data->title);?></td>
  	</tr>
  	<tr>
    	<td align="left" class="pf"> </td>
  	</tr>
  	<tr>
    	<td valign=top align="left" style="word-break: break-all;"><?php echo CHtml::encode(mb_substr(html_entity_decode(strip_tags($data->desp),ENT_QUOTES,'utf-8'),0,150,'utf-8')).'...';?></td>
  	</tr>
  	<tr>
    	<td valign=top align="left"><?php echo CHtml::link(H::img('detailss.jpg',89,25),array('products/'.$data->type.'/product_'.$data->id));?></td>
  	</tr>
   	<tr>
		<td height="10" colspan="3" align="center" bgcolor="#FFFFFF" class="f16a">&nbsp;</td>
	</tr>
	<tr>
		<td height="20" colspan="3" align="center" bgcolor="#FFFFFF" class="f16a"><img src="<?php echo Helper::resUrl('images/dotline.jpg');?>" width="662" height="6"></td>
	</tr>
</table>