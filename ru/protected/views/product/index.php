<script type="text/javascript" src="<?php echo Helper::resUrl('js/jquery.Xslider.js');?>"></script>
<script type="text/javascript">
var _c = _h = 0;
$(document).ready(function () {
$("#picpart").Xslider({
		affect:'fade',
		ctag: 'div'
	});
})
</script>
<br>
<table width="944" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="226"><img src="<?php echo Helper::resUrl('images/productbannera.jpg');?>" width="226" height="182"  ></td>
		<td>
			<div id="picpart" class="productSlider">
				<div class="conbox">
					<div><img src="<?php echo Helper::resUrl('images/productbannerb01.jpg');?>" ></div>
					<div><img src="<?php echo Helper::resUrl('images/productbannerb02.jpg');?>" ></div>
				</div>
			</div>


		</td>
	</tr>
	<tr>
		<td height="29" colspan="2" align="left" bgcolor="EDEDED" style="padding-left:20px">
			<a href="index.asp" class="titlelink"><?php echo CHtml::link(Yii::t('home','h'),'/');?></a> &gt; <?php echo Yii::t('product','p');?>
		</td>
	</tr>
</table>
<br>
<table width="943" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td colspan="2" height="8"></td>
	</tr>
	<tr>
		<td width="222" height="8" valign="top" bgcolor="EDEDED">
			<img src="<?php echo Helper::resUrl('images/left-top.jpg');?>" width="224" height="8">
		</td>
		<td width="720" height="410" rowspan="3" align="center" valign="top" >
			<table width="92%" border="0" cellpadding="0" cellspacing="0">
              	<tr>
                	<td height="40" align="left" valign="top">
                		<img src="<?php echo Helper::resUrl('images/producttitle.jpg');?>" width="130" height="26">
                	</td>
				</tr>
            </table>

            <table width="90%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height="21">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    		<tr>
                      			<td width="641" height="31" colspan="3" align="center" bgcolor="#FFFFFF" class="f16a">
                      				<?php
                      				$this->widget('zii.widgets.CListView', array(
										'dataProvider'=>$dataProvider,
										'itemView'=>'_digest',
										'viewData'=>array('img'=>$img),
									));
									?>
								</td>
							</tr>
							<tr>
                      			<td height="20" colspan="3" align="center" bgcolor="#FFFFFF"  ></td>
                    		</tr>
                  		</table>
                  	</td>
              	</tr>
            </table>

            <table width="92%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
            </table>
            <p>&nbsp;</p>
		</td>
	</tr>
	<tr>
		<td width="224" height="14" valign="top" bgcolor="EDEDED">
			<table width="224" height="380" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td align="center" valign="top" bgcolor="EDEDED"  >
						<ul id="example1">
						<?php
						foreach($leftTree as $entry) {
							if( isset($entry['sub']) ) {
									?>
							<li>
    							<table width="190" border="0" cellpadding="0" cellspacing="0">
									<tr>
        								<td height="32" align="left" background="<?php echo Helper::resUrl('images/left-bg.jpg');?>"  style="padding-left:25px;font-size:14px;">
        									<?php echo CHtml::link('<font color="#FFFFFF">'.$entry['label'].'</font>',$entry['link']);?>
        								</td>
      								</tr>
    							</table>
    							<ul>
      								<table width="190" border="0" cellpadding="0" cellspacing="0">
      									<?php foreach($entry['sub'] as $subentry) { ?>
        								<tr>
          									<td width="24" align="center" style="padding-left:10px;">

          									</td>
          									<td width="166" height="22" align="left">
          										<?php echo CHtml::link($subentry['label'],$subentry['link'],array('class'=>'link_blue'));?>
          									</td>
        								</tr>
	        							<?php } ?>
       								</table>
    							</ul>
  								<table height="8" border="0" cellpadding="0" cellspacing="0">
	      							<tr>
          								<td height="8" colspan="2" align="center"><img src="<?php echo Helper::resUrl('images/left-line.jpg');?>" width="189" height="6"></td>
        							</tr>
      							</table>
  							</li>
						<?php
							} else {
						?>
							<li>
    							<table width="190" height="32" border="0" cellpadding="0" cellspacing="0">
      								<tr>
        								<td width="28" align="center"   >
        									<img src="<?php echo Helper::resUrl('images/leftdot.jpg');?>" width="8" height="9">
        								</td>
        								<td width="162" align="left">
        									<?php echo CHtml::link($entry['label'],$entry['link'],array('class'=>'link_black'));?>
        								</td>
      								</tr>
	  								<tr>
        								<td height="6" colspan="2" align="center"   >
        									<img src="<?php echo Helper::resUrl('images/left-line.jpg');?>" width="189" height="6">
        								</td>
      								</tr>
    							</table>
  							</li>
  						<?php
							}
						}
						?>
						</ul>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height="8" valign="bottom" bgcolor="EDEDED"><img src="<?php echo Helper::resUrl('images/left-down.jpg');?>" width="224" height="8"></td>
	</tr>
</table>
<br>