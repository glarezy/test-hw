
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
		<td><?php echo H::img('memberbanner.jpg',943,182);?></td>
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
                <tr><td>
                	<?php $this->renderPartial($viewName, $viewData);?>

					</td>
				</tr>
            </table>


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
      									<?php foreach($entry['sub'] as $subtype => $subentry) { ?>
        								<tr>
          									<td width="24" align="center" style="padding-left:10px;">
											<?php if( $subtype == $type ) echo CHtml::image(Helper::resUrl('images/arrowblue.jpg'),'',array('width'=>4,'height'=>7));?>
          									</td>
          									<td width="166" height="22" align="left">
          										<?php echo CHtml::link($subentry['label'],$subentry['link'],array('class'=>$subtype == $type?'link_blues':'link_blue'));?>
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