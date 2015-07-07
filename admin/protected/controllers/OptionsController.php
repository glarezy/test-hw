<?php

class OptionsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

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

	public function actionIndex()
	{
		$model=Event1311Options::model()->find();
		if( $model === null ) {
			$model = new Event1311Options;
			$model->attributes=array('title'=>'YouJie 优解','htmlhead'=>'<meta NAME="title" CONTENT="UJ 优解">
<meta name="DESCRIPTION" content="性能卓越、设计紧凑、全向多线型激光条形码扫描器">
<meta name="keywords" content="多线型,激光,条形码,扫描器">');
			$model->save();
		}
		if(isset($_POST['Event1311Options']))
		{
			$model->attributes=$_POST['Event1311Options'];
			$model->save();
		}

		$channelRep = '';
		$passwdRep = '';
		if( isset($_POST['curpasswd']) && isset($_POST['newpasswd']) && isset($_POST['newpasswd2']) ) {
			if( $_POST['curpasswd'] != '' || $_POST['newpasswd'] != '' || $_POST['newpasswd2'] != '' ) {
				$authModel = Event1311Admin::model()->find(array(
					'condition' => 'username=:NAME and passwd=:PW',
					'params' => array(':NAME'=>Yii::app()->user->id, ':PW'=>md5($_POST['curpasswd'])),
				));
				$passwdRep = '<font color=red>'.Yii::t('common','failed').'</font>';
				if( $_POST['newpasswd'] != $_POST['newpasswd2'] || $authModel === null ) {

				} else {
					$authModel->attributes=array('passwd'=>md5($_POST['newpasswd']));
					if( $authModel->save() )
						$passwdRep = '<font color=blue>'.Yii::t('common','success').'</font>';
				}
			}
		}

		if( isset($_POST['cmd']) && $_POST['cmd'] == 'moveup' ) {
			$p = strpos($_POST['l1'], '_');
			$l1 = '';
			$l2 = '';
			if( $p !== false ) {
				$l1 = substr($_POST['l1'],0,$p);
				$l2 = substr($_POST['l1'],$p+1);
			}
			//$sp = explode('_', $_POST['l1']);
			//$l1 = $sp[0];
			//$l2 = $sp[1];
			$r = Channel::moveUpSub($l1, $l2);
			$channelRep = $r === true ? '<font color=blue>'.Yii::t('common','channelSuccess').'</font>' : ($r===false ? '<font color=red>'.Yii::t('common','channelFailed').'</font>' : '<font color=red>'.Yii::t('common', $r).'</font>');
		}

		if( isset($_POST['cmd']) && $_POST['cmd'] == 'movedown' ) {
			$p = strpos($_POST['l1'], '_');
			$l1 = '';
			$l2 = '';
			if( $p !== false ) {
				$l1 = substr($_POST['l1'],0,$p);
				$l2 = substr($_POST['l1'],$p+1);
			}
			$r = Channel::moveDownSub($l1, $l2);
			$channelRep = $r === true ? '<font color=blue>'.Yii::t('common','channelSuccess').'</font>' : ($r===false ? '<font color=red>'.Yii::t('common','channelFailed').'</font>' : '<font color=red>'.Yii::t('common', $r).'</font>');
		}

		if( isset($_POST['cmd']) && $_POST['cmd'] == 'newChannel' ) {
			$l1 = $_POST['l1'];
			$info = array(
				'cnname' => $_POST['channelCnName'],
				'enname' => $_POST['channelEnName'],
				'key' => $_POST['channelkey'],
			);
			$r = Channel::addSub($l1,$info);
			$channelRep = $r === true ? '<font color=blue>'.Yii::t('common','channelSuccess').'</font>' : ($r===false ? '<font color=red>'.Yii::t('common','channelFailed').'</font>' : '<font color=red>'.Yii::t('common', $r).'</font>');
		}

		if( isset($_POST['cmd']) && $_POST['cmd'] == 'saveChannel' ) {
			$p = strpos($_POST['l1'], '_');
			$l1 = '';
			$l2 = '';
			if( $p !== false ) {
				$l1 = substr($_POST['l1'],0,$p);
				$l2 = substr($_POST['l1'],$p+1);
			}
			$info = array(
				'cnname' => $_POST['channelCnName'],
				'enname' => $_POST['channelEnName'],
				'runame' => $_POST['channelRuName'],
				'key' => $_POST['channelkey'],
			);
			$r = Channel::modSub($l1,$l2,$info);
			$channelRep = $r === true ? '<font color=blue>'.Yii::t('common','channelSuccess').'</font>' : ($r===false ? '<font color=red>'.Yii::t('common','channelFailed').'</font>' : '<font color=red>'.Yii::t('common', $r).'</font>');
		}

		if( isset($_POST['cmd']) && $_POST['cmd'] == 'delChannel' ) {
			$p = strpos($_POST['l1'], '_');
			$l1 = '';
			$l2 = '';
			if( $p !== false ) {
				$l1 = substr($_POST['l1'],0,$p);
				$l2 = substr($_POST['l1'],$p+1);
			}
			$r = Channel::delSub($l1,$l2);
			$channelRep = $r === true ? '<font color=blue>'.Yii::t('common','channelSuccess').'</font>' : ($r===false ? '<font color=red>'.Yii::t('common','channelFailed').'</font>' : '<font color=red>'.Yii::t('common', $r).'</font>');
		}

		$channel = Helper::getChannel('all');
		$nav = Helper::getNav();
//echo '<pre>';
//print_r($channel);
//echo '</pre>';
		$this->render('index',array(
			'model'=>$model,
			'passwdRep'=>$passwdRep,
			'channelRep'=>$channelRep,
			'channel'=>$channel,
			'nav'=>$nav,
		));
	}

	/**
	 * Performs the AJAX validation.
	 * @param Event1311Options $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='event1311-options-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
