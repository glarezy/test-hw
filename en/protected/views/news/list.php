<?php $this->widget('zii.widgets.CListView', array(
										'dataProvider'=>$dataProvider,
										'itemView'=>'digest',
										'viewData'=>array('img'=>$img),
									));
									?>