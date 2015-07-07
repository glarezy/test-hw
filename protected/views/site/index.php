<?php
/* @var $this SiteController */

?>
<script type="text/javascript">
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
		<td>
			<div id="picpart" class="slider">
				<div class="conbox">
					<?php
					if( is_array($pic) )
					foreach($pic as $entry)
						echo '<div>'.CHtml::link(CHtml::image(Helper::shortImg2ImgUrl($entry->path,$entry->type)),array('/products/'.$productType[$entry->rid].'/product_'.$entry->rid)).'</div>';
					?>
				</div>
				<div class="switcher">
					<?php
					$n = 1;
					if( is_array($pic) )
					foreach($pic as $entry)
						echo CHtml::link($n++, '#');
					?>
				</div>
			</div>

		</td>
	</tr>
</table>
<div style="height:1px;">&nbsp;</div>
<table width="944" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="270" style="vertical-align:top;word-break:break-all;">
			<?php
			if( isset($newproduct[0]) ) {
				echo CHtml::link(CHtml::image(Helper::resUrl('images/new_prd.jpg'),'',array('width'=>258,'height'=>22,'style'=>'margin-top:10px;')),array('/products/'.$productType[$newproduct[0]->rid].'/product_'.$newproduct[0]->rid));
				echo '<br>';
				echo CHtml::link(CHtml::image(Helper::shortImg2ImgUrl($newproduct[0]->path,'product'),'',array('width'=>258,'height'=>99,'style'=>'margin-top:4px;')),array('/products/'.$productType[$newproduct[0]->rid].'/product_'.$newproduct[0]->rid));
				?>
				<div style="width:258px; height:108px; margin-top:4px;vertical-align:middle; background:url(images/text_bg.jpg); background-repeat:no-repeat;">
					<?php
					$msg1 = '<div style="color:#333;white-space:nowrap;font-weight:bold;padding:0 8px;">'.CHtml::encode($productTitle[$newproduct[0]->rid]).'</div>';
					$msg2 = '<div style="color:#333;word-break:normal;padding:0 8px;">'.CHtml::encode($productDesp[$newproduct[0]->rid]).'</div>';
					echo CHtml::link($msg1,array('/products/'.$productType[$newproduct[0]->rid].'/product_'.$newproduct[0]->rid));
					echo CHtml::link($msg2,array('/products/'.$productType[$newproduct[0]->rid].'/product_'.$newproduct[0]->rid));
					?>
				</div>
			<?php
			}
			?>
		</td>
		<td width="270" style="vertical-align:top;word-break:break-all;">
			<img src="images/contact_title.jpg" width="258" height="22" style="margin-top:10px;"><br>
			<img src="images/contact_img.jpg" width="258" height="99" style="margin-top:4px;"><br>
			<img src="images/contact_number.jpg" width="258" height="106" style="margin-top:4px;"><br>
		</td>
		<td valign="top">
			<table width="399" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td><?php echo H::img('indexnewsbar.jpg',399,34,'','#MapMap');?>
                 		 <map name="MapMap">
                    		<area shape="rect" coords="315,8,396,30" href="news">
                  		</map>
                  	</td>
              	</tr>
				<tr>
                	<td height="7"> </td>
              	</tr>
              	<?php foreach($data as $entry) {?>
				<tr>
					<td height="30" class="newslist">
	               	 	<table width="399" border="0" cellpadding="0" cellspacing="0">
	  						<tr>
	    						<td width="314" height="30"   style="padding-left:21px;">
	    							<?php echo CHtml::link('<font class="lh27" color="676767">'.CHtml::encode($entry->title).'</font>',array('/news/'.$entry->type.'/news_'.$entry->id),array('target'=>'_blank'));?>
	    						</td>
	                      		<td width="85" valign=top style="line-height:27px;">
	                      			<font color="676767"><?php echo date('Y-m-d', $entry->ptime);?></font>
	                      		</td>
							</tr>
						</table>
					</td>
				</tr>
				<?php  } ?>
				<tr>
                	<td>&nbsp;</td>
              	</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height="28">&nbsp;</td>
		<td >&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
<?php $this->widget('Questionnaire'); ?>
