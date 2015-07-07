<?php

class NewsController extends HwController
{

	public $channelName = 'news';
	public $modelName = 'Event1311News';

	public function fmtValue4View(&$model) {
		if( !$model )
			return false;
		$model->ptime = date('Y-m-d H:i:s', $model->ptime);
		return true;
	}

	public function actionIndex() {
		$this->redirect(array('admin'));
	}

	public function loadModel($id)
	{
		$model=Event1311News::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

}
