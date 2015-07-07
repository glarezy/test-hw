<?php

class SiteController extends Controller
{

	public function loadCssJs() {
		Controller::loadCssJs();
		Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.Xslider.js');
	}

	public function setDefaultMeta() {

	}

	public function actionLang() {

		Yii::app()->request->redirect(Yii::app()->request->urlReferrer);
	}

	public function actionAccessibility() {
		$this->render('accessibility');
	}

	public function actionPrivacy() {
		$this->render('privacy');
	}

	public function actionTerms() {
		$this->render('terms');
	}

	public function actionAboutPartners() {
		return $this->actionAbout('partner');
	}

	public function actionAboutCooperation() {
		return $this->actionAbout('cooperation');
	}

	public function actionAbout($target='') {
		$leftTree = Helper::getLeftTree('about');
		$channel = Helper::getChannel();
		$curChannel = '';
		$type = '';
		foreach($channel['about'] as $n => $entry) {
			if( $type == '' ) {
				$type = $n;
				$curChannel = $entry;
			}
			if( $target == $entry || $target == $n ) {
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
		if( !isset($model->htmlhead) )
			Helper::regMeta(Helper::meta2arr($this->metaInfo));
		else
			Helper::regMeta(Helper::meta2arr($model->htmlhead));

		$this->pageTitle = $channel['about'][$type].' - '.$this->pageTitle;
		$this->render('about', array(
			'model'=>$model,
			'leftTree'=>$leftTree,
			'bannerImage'=>'aboutbanner.jpg',
			'type'=>$type,
			'channel'=>$channel['about'],
			'curChannel'=>$curChannel,
			'viewName'=>$type,
			'viewData'=>array('model'=>$model),
		));
	}

	public function actionSupportFaq() {
		return $this->actionSupport('qanda');
	}

	public function actionSupportRepaire() {
		return $this->actionSupport('aftermarket');
	}

	public function actionSupportRepaire2() {
		return $this->actionSupport('warranty');
	}

	public function actionSupport($target='') {
		$leftTree = Helper::getLeftTree('support');
		$channel = Helper::getChannel();
		$type = '';
		$curChannel = '';
		foreach($channel['support'] as $n => $entry) {
			if( $type == '' ) {
				$type = $n;
				$curChannel = $entry;
			}
			if( $target == $entry || $target == $n ) {
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
		if( !isset($model->htmlhead) )
			Helper::regMeta(Helper::meta2arr($this->metaInfo));
		else
			Helper::regMeta(Helper::meta2arr($model->htmlhead));

		$this->pageTitle = $channel['support'][$type].' - '.$this->pageTitle;
		$this->render('about', array(
			'model'=>$model,
			'bannerImage'=>'contactbanner.jpg',
			'leftTree'=>$leftTree,
			'type'=>$type,
			'channel'=>$channel['support'],
			'curChannel'=>$curChannel,
			'viewName'=>$type,
			'viewData'=>array('model'=>$model),
		));
	}

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
		$data = Event1311News::model()->findAll(array(
			'condition' => 'recommend=1',
			'order' => 'ptime desc,mtime desc',
			'limit' => 6,
		));
		$pic = Event1311Img::model()->findAll(array(
			//'condition' => 'adshow=1 and type=:TYPE',
			//'params' => array(':TYPE'=>'product'),
			'condition' => 'adshow=1 and type=:TYPE',
			'params' => array(':TYPE'=>'product'),
			'order' => 'rid desc',
		));
		$newproduct = Event1311Img::model()->findAll(array(
			//'condition' => 'adshow=1 and type=:TYPE',
			//'params' => array(':TYPE'=>'product'),
			'condition' => 'newproduct=1 and type=:TYPE',
			'params' => array(':TYPE'=>'product'),
			'order' => 'rid desc',
			'limit' => 2,
		));

		$condition = '';
		if( is_array($newproduct) )
		foreach($newproduct as $entry) {
			$condition.= ' or id='.$entry->rid;
		}
		if( is_array($pic) )
		foreach($pic as $entry) {
			$condition.= ' or id='.$entry->rid;
		}

		$product = Event1311Product::model()->findAll(array(
			'condition' => '0'.$condition,
		));
		$productDesp = array();
		$productTitle = array();
		$productType = array();
		if( is_array($product) )
		foreach($product as $entry) {
			$productType[$entry->id] = $entry->type;
			$productTitle[$entry->id] = $entry->title;
			$despStr = html_entity_decode(strip_tags($entry->desp),ENT_QUOTES,'utf-8');
			$productDesp[$entry->id] = mb_substr($despStr,0,78,'utf-8').'......';
			if( Yii::app()->language == 'en' )
				$productDesp[$entry->id] = substr($despStr, 0, strpos($despStr, '.')+1);
		}

		Helper::regMeta(Helper::meta2arr($this->metaInfo));

		$this->render('index',array(
			'data' => $data,
			'pic' => $pic,
			'newproduct' => $newproduct,
			'productTitle' => $productTitle,
			'productDesp' => $productDesp,
			'productType' => $productType,
		));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		//$this->redirect(array('/site'));
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
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
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
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