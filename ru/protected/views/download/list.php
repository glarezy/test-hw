<?php
if( $dataProvider->getTotalItemCount() ) {
echo '<div><label class="fieldFont">'.CHtml::encode($channelName).'</label></div><div><hr></div>';
$para = array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'digest',
	'viewData'=>array('files'=>$files),
);
if( !isset($pageNav) || $pageNav !== true ) {
	$para['summaryText'] = '';
	$para['enablePagination'] = false;
}
$this->widget('zii.widgets.CListView', $para);
echo '<br><br>';
}