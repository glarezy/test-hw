<?php
/* @var $this DownloadController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('download','download')=>array('index'),
);

if( isset($subchannel) )
	$this->breadcrumbs[] = $subchannel;

$this->menu=array(
	array('label'=>Yii::t('download','btnCreate'), 'url'=>array('create')),
	array('label'=>Yii::t('download','manage'), 'url'=>array('admin')),
);
?>

<ul class="nav">
<?php
foreach($channel as $subid => $entry) {
	echo '<li>'.CHtml::link(CHtml::encode($entry),array('/download/sub/'.CHtml::encode($entry))).'</li>';
}
?>
</ul>

</br></br>
<?php if(isset($subchannel) ) echo '<h1>'.CHtml::encode($subchannel).'</h1>'; ?>

<?php
if( isset($isPicture) && $isPicture )
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_pic',
	'itemsTagName'=>'ul',
	'itemsCssClass'=>'picture',
	'template'=>"{pager}{items}",
));
else
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));
?>