<?php

class Questionnaire extends CWidget {
	public $fields;

    public function run() {
		$model = Event1311QuestionnaireConstruction::model()->find(array(
			'condition' => 'recommend=1',
			'order' => 'ctime desc',
		));

		$fields = array();
		if( $model ) {
			$cons= json_decode($model->construction, true);
			$fields = $cons['question'];
		} else {
			return true;
		}

		$cookie = Yii::app()->request->getCookies();
		if( isset($cookie['questionnaire']) && $cookie['questionnaire'] == $model->name )
			return true;

    	$data = array(
    		'fields' => $fields,
    		'model' => new Event1311Questionnaire,
    		'title' => $model->name,
    	);
		Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/easyui/default/easyui.css');
		Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/easyui/icon.css');
		Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/q.css');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.easyui.min.js');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/easyui-lang-'.Yii::app()->language.'.js');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.scroll-follow.js');
    	$this->render('_questionnaire', $data);
    }
}
