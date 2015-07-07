<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tbody>
        <tr>
            <td height="2" colspan="4" bgcolor="CCCCCC">
            </td>
        </tr>
        <tr>
            <td width="130" align="center" bgcolor="F0F0F0" class="f16a">
                <?php echo CHtml::encode(date('Y-m-d',$data->ptime));?>
            </td>
            <td width="8" align="center" bgcolor="F0F0F0">
                <table width="1" height="21" border="0" cellpadding="0" cellspacing="0"
                bgcolor="BDBDBD">
                    <tbody>
                        <tr>
                            <td>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td width="411" align="left" bgcolor="F0F0F0" class="f16" style="padding-left:10px; ">
            	<?php echo CHtml::link(CHtml::encode($data->title),array('news/'.$data->type.'/news_'.$data->id),array('class'=>'nlk'));?>
            </td>
            <td align="right" bgcolor="F0F0F0" style="padding-right:20px; ">
            	<?php echo CHtml::link(CHtml::image(Helper::resUrl('images/more.jpg')),array('view','id'=>$data->id));?>
            </td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td height="31" colspan="4" align="center" class="f16a">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr>
                            <td height="7" colspan="2">
                            </td>
                        </tr>
                        <tr>
                            <td width="28%" height="117">
                                <table width="170" height="116" border="0" cellpadding="0" cellspacing="1"
                                bgcolor="D0CCC9">
                                    <tbody>
                                        <tr>
                                            <td align="center" bgcolor="#FFFFFF">
                                            	<?php echo CHtml::link(CHtml::image(isset($img[$data->id])?$img[$data->id]:'','',array('width'=>160,'height'=>106)),array('view','id'=>$data->id));?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td width="72%" align="left">
                                <?php echo CHtml::encode($data->subject);?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td height="20" colspan="4" align="center" class="f16a">
                &nbsp;
            </td>
        </tr>
    </tbody>
</table>