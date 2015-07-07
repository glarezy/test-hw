<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	public $metaInfo='';

	public function jsonResponse($data) {
		header('Content-type: text/plain; charset=utf-8');
		echo json_encode($data);
	}

	public function init() {
		$cookie = Yii::app()->request->getCookies();
		$language = 'ru';
		if( isset($cookie['lang']) && $cookie['lang']->value != $language
			|| ! isset($cookie['lang']) ) {
			$cookie = new CHttpCookie('lang', $language);
			$cookie->expire = time()+60*60*24*30;
			Yii::app()->request->cookies['lang'] = $cookie;
		}
		Yii::app()->language = $language;

		$this->setDefaultSth();
		$this->setDefaultMeta();
		$this->loadCssJs();
	}

	public function setDefaultSth() {
		$info = Event1311Options::model()->find();
		if( $info === null ) {
			$this->pageTitle = Yii::t('home','title');
			$this->metaInfo = '';
			return false;
		}
		$this->pageTitle = $info->title;
		$this->metaInfo = $info->htmlhead;
	}

	public function setDefaultMeta() {
		if( isset($this->metaInfo) && $this->metaInfo != '' )
		Helper::regMeta(Helper::meta2arr($this->metaInfo));
	}

	public function loadCssJs() {
		Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/common.css?v=150624.css');
		Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/font-'.Yii::app()->language.'.css');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.scroll-follow.core.js');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.scroll-follow.core.oops.js');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery-1.7.2.js');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery-1.7.2.oops.js');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.js');
//		Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.oops.js');
	}

}
