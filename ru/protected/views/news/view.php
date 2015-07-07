<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tbody>
        <tr>
            <td height="2" colspan="4" bgcolor="CCCCCC">
            </td>
        </tr>
        <tr>
            <td width="150" height="30" align="center" bgcolor="F0F0F0" class="f16a">
                <?php echo date('Y-m-d', $model->ptime);?>
            </td>
            <td width="1" align="center" bgcolor="F0F0F0">
                <table width="1" height="21" border="0" cellpadding="0" cellspacing="0"
                bgcolor="BDBDBD">
                    <tbody>
                        <tr>
                            <td width="1">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td width="547" align="left" bgcolor="F0F0F0" class="f16" style="padding-left:20px; ">
                <?php echo CHtml::encode($model->title);?>
            </td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td height="31" colspan="4" align="center" class="f16a">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr>
                            <td style="padding-top:20px;">
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td align="left" style="padding-left:30px; padding-right:30px; padding-bottom:50px; ">
                                <div>
                                    <?php echo $model->content;?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                            <td>
                                                &nbsp;
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div align="center">
                                                    <img src="<?php echo Helper::resUrl('images/s_line.jpg');?>" width="594" height="8">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                &nbsp;
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td height="20" colspan="4" align="center" class="f16a" style="padding-right:30px; ">
                <div align="right">
                    <a href="javascript:window.history.back()">
                        <img src="<?php echo Helper::resUrl('images/back.jpg');?>" width="83" height="24" border="0">
                    </a>
                </div>
            </td>
        </tr>
    </tbody>
</table>