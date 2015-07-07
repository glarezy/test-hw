
<script type="text/javascript">
$(document).ready(function () {
$('.js-btn-search').bind('click',function(){
document.f.searchtype2.value = $('#stype').val();
document.f.searchtype.value = 'nonpic';
document.f.searchkey.value = $('#skey').val();
document.f.submit();
});
});
</script>
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
                		<ul class="title"><li><?php echo H::m('title-icon.jpg',23,26);?></li><li><?php echo CHtml::encode(Yii::t('download','download'));?></li></ul>
                	</td>
				</tr>
            </table>

			<table width="92%" border="0" cellpadding="0" cellspacing="0">
              	<!--<tr>
                	<td height="40" align="left" valign="top">
                		<select id="stype">
                			<?php
                			foreach($channel as $val => $entry) {
                				echo '<option ';
                				if( $val == $type )
                					echo ' selected ';
                				echo 'value="'.$val.'">'.CHtml::encode($entry).'</option>';
                			}
                			?>
                		</select>
                		<input style="border:1px solid #000;" type=text id="skey" size=32>
                		<input class="js-btn-search" type=button value="<?php echo Yii::t('common','search');?>">
                	</td>
                </tr>-->
                <?php if( isset($product) && is_array($product) && count($product) > 0 ) { ?>
                <tr>
                	<td height="40" align="left" valign="top">
                		<select id="skey" class="js-search">
                			<option value=""><?php echo CHtml::encode(Yii::t('download','selproduct'));?></option>
                			<?php
                			foreach($product as  $entry) {
                				echo '<option';
                				if( $searchkey == $entry['value'] )
                					echo ' selected ';
                				echo ' value="'.$entry['value'].'">'.$entry['text'].'</option>';
                			}
                			?>
                		</select>
                		<select id="stype">
                			<option value=""><?php echo CHtml::encode(Yii::t('download','searchtype'));?></option>
                			<?php
                			foreach($channel as $ckey => $entry) {
                				echo '<option';
                				if( $searchtype == $ckey )
                					echo ' selected ';
                				echo ' value="'.$ckey.'">'.$entry.'</option>';
                			}
                			?>
                		</select>
                		<input class="js-btn-search" type=button value="<?php echo Yii::t('common','search');?>">
                	</td>
                </tr>
	            <?php } ?>
                <tr><td>
                	<?php
                	foreach($dataProvider as $subChannel => $entry)
                		if( $subChannel != 'picture' && ($subChannel == $searchtype || $searchtype == '') )
                		$this->renderPartial('list', array('dataProvider'=>$entry,'files'=>$files,'channelName'=>$channel[$subChannel]));
                	?>

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
<form name="f" action="<?php echo Helper::resUrl('download/search');?>" method="post">
	<input type=hidden name=searchtype2 value="">
	<input type=hidden name=searchtype value="">
	<input type=hidden name=searchkey value="">
</form>
<br>