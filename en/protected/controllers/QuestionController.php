<?php

class QuestionController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

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

	public function support() {
		$leftTree = Helper::getLeftTree('support');
		$channel = Helper::getChannel();
		$type = '_question';
		$curChannel = '';
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

		$this->pageTitle = $channel['support']['question'].' - '.$this->pageTitle;
		$this->render('about', array(
			'model'=>$model,
			'bannerImage'=>'contactbanner.jpg',
			'leftTree'=>$leftTree,
			'type'=>$type,
			'channel'=>$channel['support'],
			'curChannel'=>$curChannel,
			'viewName'=>'question',
			'viewData'=>array('model'=>$model),
		));
	}

	public function actionIndex()
	{
		if( Yii::app()->language == 'en' )
			return $this->support();

		$model=new Event1311Question;
		$leftTree = Helper::getLeftTree('support');
		Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/form.css');

		if(isset($_POST['Event1311Question']))
		{
			$model->attributes=$_POST['Event1311Question'];
			if( $model->validate() && $model->save()) {
				$emlobj = new Eml();
				$emlobj->send($model->area, $model->email, $model->content);
				$this->redirect(array('finish'));
			}
		}
		$this->pageTitle = Yii::t('question','question').' - '.$this->pageTitle;

		$this->render('index',array(
			'model'=>$model,
			'leftTree' => $leftTree,
			'type' => 'question',
			'viewName' => '_form',
			'viewData' => array('model' => $model),
		));
	}

	public function actionFinish() {
		$leftTree = Helper::getLeftTree('support');

		$this->render('index',array(
			'leftTree' => $leftTree,
			'type' => 'question',
			'viewName' => '_finish',
			'viewData' => array(),
		));
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
