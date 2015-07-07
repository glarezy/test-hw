<?php

class QuestionnaireController extends Controller
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
				'testLimit'=>999,
			),
		);
	}

	public function actionSubmit() {
		$model=new Event1311Questionnaire;
/*
		if(isset($_POST['ajax']) && $_POST['ajax']==='questionnaire-form') {
		    echo CActiveForm::validate($model);
		    Yii::app()->end();
		}*/
		$code = 'failed';
		$msg = '';
		$debug = $_POST['Event1311Questionnaire'];
		if(isset($_POST['Event1311Questionnaire']))
		{
			$data = array();
			foreach($_POST['Event1311Questionnaire'] as $field => $entry) {
				if( $entry == '' ) {
					echo json_encode(array('code'=>$code,'msg'=>Yii::t('common','qwarn'),'close'=>0));
					return true;
				}
				$data[$field] = is_array($entry) ? implode('|', $entry) : $entry;
			}

			$q = Event1311QuestionnaireConstruction::model()->find(array(
				'condition' => 'recommend=1',
				'order' => 'ctime desc',
			));
			if( !$q ) {
				$msg = Yii::t('common','qerr');
				echo json_encode(array('code'=>$code,'msg'=>$msg,'close'=>1));
				return true;
			}
			$qid = $q->id;
			$name = $q->name;

			$q = Event1311Questionnaire::model()->find(array(
				'condition' => 'qid=:QID and ip=:IP',
				'params' => array(':QID'=>$qid, ':IP'=>$_SERVER['REMOTE_ADDR']),
				'order' => 'ctime desc',
			));
			if( $q ) {
				$cookie = new CHttpCookie('questionnaire', $name);
				$cookie->expire = time()+60*60*24*30;
				Yii::app()->request->cookies['questionnaire'] = $cookie;
				$msg = Yii::t('common','qexist');
				echo json_encode(array('code'=>$code,'msg'=>$msg,'close'=>1));
				return true;
			}

			$model->attributes=$data;
			$model->qid = $qid;
			if( $model->save() ) {
				$cookie = new CHttpCookie('questionnaire', $name);
				$cookie->expire = time()+60*60*24*30;
				Yii::app()->request->cookies['questionnaire'] = $cookie;

				$code = 'success';
				$msg = Yii::t('common','q');
			} else {
				$msg = Yii::t('common','qerr');
			}
		}
		echo json_encode(array('code'=>$code,'msg'=>$msg,'close'=>1));
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='questionnaire-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
