<?php

class SiteController extends Controller
{

	public function actionLang() {

		Yii::app()->request->redirect(Yii::app()->request->urlReferrer);
	}

	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('login','logout','error','lang'),
				'users'=>array('*'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

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
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->redirect('product');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		$this->layout='//layouts/column3';
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	public function actionAbout($target='') {
		if( Yii::app()->user->id === null )
			$this->redirect(array('/login'));
		$channel = Helper::getChannel();
		$curChannel = '';
		$type = '';
		foreach($channel['about'] as $n => $entry) {
			if( $type == '' ) {
				$type = $n;
				$curChannel = $entry;
			}
			if( $target == $entry ) {
				$type = $n;
				$curChannel = $entry;
				break;
			}
		}
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
		$this->render('about', array(
			'model'=>$model,
			'channel'=>$channel['about'],
			'curChannel'=>$curChannel,
		));
	}

	public function actionAboutUpdate($target) {
		if( Yii::app()->user->id === null )
			$this->redirect(array('/login'));
		$channel = Helper::getChannel();
		$type = '';
		$curChannel = '';
		foreach($channel['about'] as $n => $entry) {
			if( $type == '' ) {
				$curChannel = $entry;
				$type = $n;
			}
			if( $target == $entry ) {
				$type = $n;
				$curChannel = $entry;
				break;
			}
		}
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Event1311About'])) {
			$model->attributes=$_POST['Event1311About'];
			$model->type=$type;
			if($model->save())
				$this->redirect(array('about/'.CHtml::encode($target)));
		}
		$this->render('aboutUpdate',array(
			'model'=>$model,
			'channel'=>$channel['about'],
			'curChannel'=>$curChannel,
		));
	}

	public function actionSupport($target='') {
		if( Yii::app()->user->id === null )
			$this->redirect(array('/login'));
		$channel = Helper::getChannel();
		$type = '';
		$curChannel = '';
		foreach($channel['support'] as $n => $entry) {
			if( $type == '' ) {
				$type = $n;
				$curChannel = $entry;
			}
			if( $target == $entry ) {
				$type = $n;
				$curChannel = $entry;
				break;
			}
		}
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

	public function actionSupportUpdate($target) {
		if( Yii::app()->user->id === null )
			$this->redirect(array('/login'));
		$channel = Helper::getChannel();
		$type = '';
		$curChannel = '';
		foreach($channel['support'] as $n => $entry) {
			if( $type == '' ) {
				$type = $n;
				$curChannel = $entry;
			}
			if( $target == $entry ) {
				$type = $n;
				$curChannel = $entry;
				break;
			}
		}
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Event1311About'])) {
			$model->attributes=$_POST['Event1311About'];
			$model->type=$type;
			if($model->save())
				$this->redirect(array('support/'.CHtml::encode($target)));
		}
		$this->render('supportUpdate',array(
			'model'=>$model,
			'channel'=>$channel['support'],
			'curChannel'=>$curChannel,
		));
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect('product');//Yii::app()->user->returnUrl);
		}/* else {
			$lang = Yii::app()->request->getParam('lang', '');
			if( in_array($lang, array('zh_cn', 'en')) ) {
				$cookie = new CHttpCookie('lang', $lang);
				$cookie->expire = 0;
				Yii::app()->request->cookies['lang'] = $cookie;
			}
		}*/
		//$this->layout='//layouts/column3';
		$this->layout='//layouts/column5';
		$this->render('login2',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}