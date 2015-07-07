            <table width="90%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height="21">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    		<tr>
                      			<td width="641" height="31" colspan="3" align="center" bgcolor="#FFFFFF" class="f16a">
                      				<?php
                      				foreach($dataProvider as $subChannel => $entry) {
                      					if( $entry->getTotalItemCount() < 1 )
                      						continue;
                      					?>
                      				<table width="100%" height="29" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td width="9" align="center"><img src="<?php echo Helper::resUrl('images/protleft.jpg');?>" width="9" height="29"></td>
											<td width="523" align="left" bgcolor="1B3451" class="gf14"><?php echo CHtml::link(CHtml::encode($channel[$subChannel]),array('/product/'.$subChannel),array('class'=>'gf142'));?></td>
											<td width=100 align="right" bgcolor="1B3451" class="gf14"><?php echo CHtml::link(Yii::t('common','more'),array('/product/'.$subChannel),array('class'=>'gf14'));?>&nbsp;</td>
											<td width="9" align="center"><img src="<?php echo Helper::resUrl('images/protright.jpg');?>" width="9" height="29"></td>
										</tr>
									</table>
                      					<?php
	                      				$this->widget('zii.widgets.CListView', array(
											'dataProvider'=>$entry,
											'itemView'=>'_digest2',
											'viewData'=>array('img'=>$img),
											'summaryText' => '',
											'enablePagination' => false,
										));
									}
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