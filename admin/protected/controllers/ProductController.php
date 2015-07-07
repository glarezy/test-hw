<?php

class ProductController extends HwController
{

	public $channelName = 'product';
	public $modelName = 'Event1311Product';

	public function loadModel($id)
	{
		$model=Event1311Product::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function actionIndex() {
		$this->redirect(array('admin'));
	}

}
