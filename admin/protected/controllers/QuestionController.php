<?php

class QuestionController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$channel = Helper::getChannel();
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'curChannel'=>$channel['support']['question'],
			'channel'=>$channel['support'],
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionSupport() {
		if( Yii::app()->user->id === null )
			$this->redirect(array('/login'));
		$channel = Helper::getChannel();
		$type = '_question';
		$curChannel = $channel['support']['question'];
		$model=Event1311About::model()->find(array(
			'condition' => 'type=:TYPE',
			'params' => array(':TYPE'=>$type),
		));
		if( $model === null ) {
			$model = new Event1311About;
			$model->attributes=array(
				'type'=>$type,
			);
			if(!$model->save()) {
				$this->render('error', array('code'=>'','message'=>'sql error'));
				return;
			}
		}
		$this->render('support', array(
			'model'=>$model,
			'channel'=>$channel['support'],
			'curChannel'=>$curChannel,
		));
	}

	public function actionSupportUpdate() {
		if( Yii::app()->user->id === null )
			$this->redirect(array('/login'));
		$channel = Helper::getChannel();
		$curChannel = $channel['support']['question'];
		$type = '_question';
		$model=Event1311About::model()->find(array(
			'condition' => 'type=:TYPE',
			'params' => array(':TYPE'=>$type),
		));
		if( $model === null ) {
			$model = new Event1311About;
			$model->attributes=array(
				'type'=>$type,
			);
			if(!$model->save()) {
				$this->render('error', array('code'=>'','message'=>'sql error'));
				return;
			}
		}

		if(isset($_POST['Event1311About'])) {
			$model->attributes=$_POST['Event1311About'];
			$model->type=$type;
			if($model->save())
				$this->redirect(array('support'));
		}
		$this->render('supportUpdate',array(
			'model'=>$model,
			'channel'=>$channel['support'],
			'curChannel'=>$curChannel,
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$channel = Helper::getChannel();
		$dataProvider=new CActiveDataProvider('Event1311Question');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'curChannel'=>$channel['support']['question'],
			'channel'=>$channel['support'],
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$channel = Helper::getChannel();
		$model=new Event1311Question('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Event1311Question']))
			$model->attributes=$_GET['Event1311Question'];

		$this->render('admin',array(
			'model'=>$model,
			'curChannel'=>$channel['support']['question'],
			'channel'=>$channel['support'],
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Event1311Question the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Event1311Question::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Event1311Question $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='event1311-question-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
