<table width="92%" height="29" border="0" cellpadding="0" cellspacing="0">
              <tbody><tr>
                <td width="9" align="center"><img src="<?php echo Helper::resUrl('images/protleft.jpg');?>" width="9" height="29"></td>

                <td width="*" align="left" bgcolor="1B3451" class="gf14"><?php echo CHtml::encode($model->title);?></td>


                <td width="9" align="center"><img src="<?php echo Helper::resUrl('images/protright.jpg');?>" width="9" height="29"></td>
              </tr>
            </tbody></table>
<table width="90%" border="0" cellspacing="0" cellpadding="0">
    <tbody>
        <tr>
            <td height="21">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr>
                            <td width="100%" height="31" colspan="3" align="center" bgcolor="#FFFFFF"
                            class="f16a">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                            <td height="30" colspan="2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="32%" rowspan="5" valign="top">
                                                <table width="188" border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
                                                    <tbody>
                                                        <tr>
                                                            <td width="188" height="177" align="center">
                                                                <div id="b2bContent" style="filter:revealTrans(Duration=1,Transition=23); width:100%">
                                                                    <?php echo CHtml::image($img[0]['big'],'',array('height'=>177,'width'=>188));?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td width="68%" align="left" class="pf14">
                                                <?php echo CHtml::encode($model->title);?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" style="padding-top:20px; ">
                                                <table width="230" height="33" border="0" cellpadding="0" cellspacing="0">
                                                    <tbody>
                                                        <tr><?php for($i=1;$i<6;$i++)
                                                        	echo '<td>'.CHtml::image(Helper::resUrl('images/icon-'.$i.'.jpg'),Yii::t('product','for'.$i),array('width'=>33,'height'=>33)).'</td>';
                                                           ?>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" style="padding-top:20px; ">
                                                <table border="0" cellspacing="0" cellpadding="0">
                                                    <tbody>
                                                        <tr align="left">
                                                        	<?php
                                                        	foreach($img as $n => $entry) {
                                                        	?>
                                                        	<td>
                                                                <table border="0" cellpadding="0" cellspacing="0" bgcolor="A7A7A7">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td bgcolor="#FFFFFF" class="smallpic">
                                                                                <a href="#" onmouseover="javascript:showPage(<?php echo $n;?>);" onclick="javascript:showPage(<?php echo $n;?>);">
                                                                                    <?php echo CHtml::image($entry['small'],'',array('width'=>50,'height'=>50,'border'=>0));?>
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        	<?php
                                                        	}
                                                        	?>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <script language="javascript">
                                                    b2bStr = new Array();
                                                    <?php
                                                    foreach($img as $n => $entry)
                                                    	echo 'b2bStr['.$n.'] = \''.CHtml::image($entry['big'],'',array('width'=>188,'height'=>177)).'\';';
                                                    ?>
                                                    var page = 0;
                                                    var speed = 360000;

                                                    function showPage(id) {
                                                        page = id;
                                                        setTransition();
                                                        b2bContent.innerHTML = b2bStr[id];
                                                        b2bContent.filters.revealTrans.play();
                                                    }
                                                    function turnPage() {
                                                        showPage(page);
                                                        theTimer = setTimeout("turnPage()", speed);
                                                        page++;
                                                        if (page >= b2bStr.length) page = 0;
                                                    }

                                                    function setTransition() {
                                                        if (document.all) {
                                                            b2bContent.filters.revealTrans.Transition = 12; //Math.floor(Math.random()*23)
                                                            b2bContent.filters.revealTrans.apply();
                                                        }
                                                    }
                                                    b2bContent.innerHTML = b2bStr[0];
                                                </script>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td height="20" colspan="3" bgcolor="#FFFFFF" class="f16a">
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div id="a">
                                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="1">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <table class="tab">
                                                        <tbody>
                                                            <tr>
                                                                <td class="tabSel">
                                                                	<a href="javascript:void(0)" class="js-chgtab" data="desp">
                                                                    <font color="1B3451">
                                                                        <?php echo Yii::t('product','desp');?>
                                                                    </font>
	                                                                </a>
                                                                </td>
                                                                <td width="3" align="center">
                                                                </td>
                                                                <td class="tab" style="width:116px;">
                                                                    <a href="javascript:void(0)" class="js-chgtab" data="standard">
                                                                        <font color="1B3451">
                                                                            <?php echo Yii::t('product','standard');?>
                                                                        </font>
                                                                    </a>
                                                                </td>
                                                                <td width="3" align="center">
                                                                </td>
                                                                <td class="tab" style="width:192px;">
                                                                    <a href="javascript:void(0)" class="js-chgtab" data="performance">
                                                                        <font color="1B3451">
                                                                            <?php echo Yii::t('product','performance');?>
                                                                        </font>
                                                                    </a>
                                                                </td>
                                                                <td width="3" align="center">
                                                                </td>
                                                                <td class="tab">
                                                                    <a href="javascript:void(0)" class="js-chgtab" data="download">
                                                                        <font color="1B3451">
                                                                            <?php echo Yii::t('common','download');?>
                                                                        </font>
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    &nbsp;
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div style="word-break:normal;" class="pdesp js-desp"><?php echo $model->desp;?></div>
                                                    <div class="pdesp js-standard partHidden"><?php echo $model->standard;?></div>
                                                    <div class="pdesp js-performance partHidden"><?php echo $model->performance;?></div>
													<div class="pdesp js-download partHidden">
													<?php foreach($download as $entry) {
													if(trim($entry['label'])!='')
													echo '<ul class="downloadLine"><li>'.Helper::m('images/'.$entry['type'].'_icon.png',42,42).'</li><li>'.CHtml::link($entry['label'],$entry['link'],array('target'=>'_blank')).'</li></ul>';
													}?>
													</div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td height="20" colspan="3" align="center" bgcolor="#FFFFFF" class="f16a">
                                <?php echo Helper::m('images/dotline.jpg',662,6);?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<script type="text/javascript" src="<?php echo Helper::resUrl('js/product.js?v=24.js');?>"></script>
