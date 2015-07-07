<?php
/* @var $this QuestionnaireController */
/* @var $model Event1311QuestionnaireConstruction */

$this->breadcrumbs=array(
	Yii::t('question','questionnaire')=>array('index'),
	Yii::t('question','manage'),
);

$this->menu=array(
//	array('label'=>Yii::t('question','btnList'), 'url'=>array('index')),
	array('label'=>Yii::t('question','btnCreate'), 'url'=>array('create')),
);

?>

<h1><?php echo Yii::t('question','manage2');?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'event1311-questionnaire-construction-grid',
	'dataProvider'=>$model->search(),
//	'filter'=>$model,
	'columns'=>array(
		'name',
		array(
			'name' => 'recommend',
			'value' => '$data->recommend ? Yii::t("common","enable") : Yii::t("common","disable")',
		),
		array(
			'name' => 'ctime',
			'value' => 'date("Y-m-d H:i:s", $data->ctime)',
		),
		array(
			'name' => 'mtime',
			'value' => 'date("Y-m-d H:i:s", $data->mtime)',
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{export}&nbsp;&nbsp;&nbsp;{update}&nbsp;&nbsp;&nbsp;{delete}',
			'buttons'=>array(
		        'export' => array(
		            'label'=>Yii::t('question','result'),
		            //'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
		            'url'=>'Yii::app()->createUrl("/questionnaire/export", array("id"=>$data->id,"target"=>"_blank"))',
		        ),
		    ),
		),
	),
)); ?>
