            <table width="90%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height="21">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    		<tr>
                      			<td width="641" height="31" colspan="3" align="center" bgcolor="#FFFFFF" class="f16a">
                      				<table width="100%" height="29" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td width="9" align="center"><img src="<?php echo Helper::resUrl('images/protleft.jpg');?>" width="9" height="29"></td>
											<td width="623" align="left" bgcolor="1B3451" class="gf14"><?php echo CHtml::encode($channel[$type]);?></td>
											<td width="9" align="center"><img src="<?php echo Helper::resUrl('images/protright.jpg');?>" width="9" height="29"></td>
										</tr>
										<tr><td>&nbsp;</td></tr>
									</table>
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