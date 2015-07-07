<?php

class ProjectController extends Controller
{
	public $channelName = 'project';
	public $modelName = 'Event1311Project';

	public function setDefaultMeta() {

	}

	public function actionIndex()
	{
		$channel = Helper::getChannel();
		$type = $this->getChannelType();
		$model = Event1311Project::model()->find(array(
			'condition' => 'type=:TYPE',
			'params' => array(':TYPE'=>$type),
		));
		$this->pageTitle = $channel[$this->channelName][$type].' - '.Yii::t('project','project').' - '.$this->pageTitle;

		if( $model === null )
			throw new CHttpException(404,'The requested page does not exist('.$type.').');

		$leftTree = Helper::getLeftTree($this->channelName);
		if( count(Helper::meta2arr($model->htmlhead)) < 1 )
		Helper::regMeta(Helper::meta2arr($this->metaInfo));
		else
		Helper::regMeta(Helper::meta2arr($model->htmlhead));

		$this->render('index',array(
			'typename' => $channel[$this->channelName][$type],
			'type'=>$type,
			'leftTree'=>$leftTree,
			'viewName' => 'view',
			'viewData' => array(
				'model'=>$model,
			)
		));
	}

	public function actionView($id)
	{
		$model = $this->loadModel($id);
		$channel = Helper::getChannel();
		$subvalue = '';
		foreach($channel[$this->channelName] as $field => $value) {
			if( $field == $model->type ) {
				$subvalue = $value;
				break;
			}
		}
		if( $subvalue == '' ) {
			throw new CHttpException(404,'The requested page does not exist.');
		}

		$this->redirect(array('index',
			'subvalue'=>$subvalue,
		));
	}

	public function getChannelType() {
		$type = '';
		$subvalue = isset($_REQUEST['subvalue']) ? $_REQUEST['subvalue'] : '';
		$channel = Helper::getChannel();

		foreach($channel[$this->channelName] as $n => $value) {
			if( $type == '' )
				$type = $n;
			if( $value == $subvalue || $n == $subvalue ) {
				$type = $n;
				break;
			}
		}
		if( $type == '' ) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $type;
	}

	public function notfound() {
		$this->redirect(array('index'));
	}

	public function loadModel($id)
	{
		$model=Event1311Project::model()->findByPk($id);
		if($model===null) $this->notfound();
			//throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}