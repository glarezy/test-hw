
<script type="text/javascript">
$(document).ready(function () {
$('.js-search').bind('change',function(){
document.f.searchtype.value = 'picture';
document.f.searchkey.value = $('#skey').val();
document.f.submit();
});
});
</script>
<br>
<table width="943" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="943" height="410" align="center" valign="top" >
			<table width="940" border="0" cellpadding="0" cellspacing="0">
              	<tr>
                	<td height="40" align="left" valign="top">
                		<select id="skey" class="js-search">
                			<option value=""><?php echo CHtml::encode(Yii::t('download','selproduct'));?></option>
                			<?php
                			foreach($product as  $entry) {
                				echo '<option';
                				if( $entry['value'] == $searchkey )
                					echo ' selected ';
                				echo ' value="'.$entry['value'].'">'.$entry['text'].'</option>';
                			}
                			?>
                		</select>
                	</td>
                </tr>
                <tr><td>
                	<?php
                	$this->renderPartial($viewName, $viewData);

                	?>

					</td>
				</tr>
            </table>


		</td>
	</tr>
</table>
<form name="f" action="<?php echo Helper::resUrl('download/search');?>" method="post">
	<input type=hidden name=searchtype value="">
	<input type=hidden name=searchkey value="">
</form>
<br>