<?php

$this->breadcrumbs=array(
	Yii::t('question','questionnaire')=>array('index'),
	$name=>array('view','id'=>$id),
	Yii::t('question','result'),
);

$this->menu=array(
	array('label'=>Yii::t('question','btnCreate'), 'url'=>array('create')),
	array('label'=>Yii::t('common','export'), 'url'=>array('export','id'=>$id)),
);

?>

<h1><?php echo Yii::t('question','result').'-----'.CHtml::encode($name);?></h1>

<?php

$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_result',
	'viewData'=>array('fields'=>$fields),
));

?>

<?php
/*
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'event1311-questionnaire-grid',
	'dataProvider'=>$model->search(),
//	'filter'=>$model,
	'columns'=>$column,
));
*/
?>
