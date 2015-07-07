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

	public function jsonResponse($data) {
		header('Content-type: text/plain; charset=utf-8');
		echo json_encode($data);
	}

	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function init() {
		$cookie = Yii::app()->request->getCookies();
		$language = 'zh_cn';
		if( ! isset($cookie['adminlang']) ) {
			/*
		    $headers = getallheaders();
			$strLanguage = $headers['Accept-Language'];
			if( strchr($strLanguage, 'en') != false )
				$language = 'en';
			if( strchr($strLanguage, 'zh-cn') != false )
				$language = 'zh_cn';
			if( $language == '' )
				$language = 'zh_cn';
				*/
		} else
			$language = $cookie['adminlang']->value;

		$langlist = array('zh_cn', 'en', 'ru');

		$reqlang = Yii::app()->request->getParam('lang', '');
		if( $reqlang != '' && in_array($reqlang, $langlist) )
			$language = $reqlang;

		if( ! in_array($language, $langlist) )
			$language = 'zh_cn';

		if( isset($cookie['adminlang']) && $cookie['adminlang']->value != $language
			|| ! isset($cookie['adminlang'])
			|| $reqlang != '' ) {
			$cookie = new CHttpCookie('adminlang', $language);
			$cookie->expire = time()+60*60*24*30;
			Yii::app()->request->cookies['adminlang'] = $cookie;
		}
		Yii::app()->language = $language;
	}

}