<?php

class CooperationController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
		);
	}

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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionIndex()
	{
		$model=new Event1311Register;
		$leftTree = Helper::getLeftTree('about');
		Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/form.css');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$this->pageTitle = Yii::t('cooperation','title').' - '.$this->pageTitle;

		if(isset($_POST['Event1311Register']))
		{
			$model->attributes=$_POST['Event1311Register'];
			if( $model->validate() && $model->save())
				$this->redirect(array('finish'));
		}

		$this->render('index',array(
			'model'=>$model,
			'leftTree' => $leftTree,
			'type' => 'cooperation',
			'viewName' => '_form',
			'viewData' => array('model' => $model),
		));
	}

	public function actionFinish() {
		$leftTree = Helper::getLeftTree('about');

		$this->render('index',array(
			'leftTree' => $leftTree,
			'type' => 'cooperation',
			'viewName' => '_finish',
			'viewData' => array(),
		));
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='event1311-register-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
