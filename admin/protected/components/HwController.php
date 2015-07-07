<?php

class HwController extends Controller
{

	public $layout='//layouts/column2';
	public $channelName = 'product';
	public $modelName = 'Event1311Product';

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function actionUploadpic() {
		$upload = new UploadBase($this->channelName);
		$filename = $upload->save();
		if( $filename === false ) {
			$this->jsonResponse(array('code'=>'failed'));
			return;
		}
		$width = 50;
		$height = 50;
		$preview = $this->makeRectangleImage($filename, $width, $height);
		$this->jsonResponse(array(
			'code'=>'success',
			'uploaded'=>array(
				'num'=>time().'_'.rand(1000,9999),
				'val'=>basename(Helper::img2tmp($filename)),
				'txt'=>Yii::t('common', 'imgsrc', array('{url}'=>Helper::getAttachmentUrl($filename))),
				'imgsrc' => Helper::getAttachmentUrl($preview),
				'adshow' => 0,
				'newproduct' => 0,
				'mainpic' => 0,
			)
		));
	}

	public function actionView($id)
	{
		$channel = Helper::getChannel();
		$model = $this->loadModel($id);
		$model->ctime = date('Y-m-d H:i:s', $model->ctime);
		$model->mtime = date('Y-m-d H:i:s', $model->mtime);
		$model->type = $channel[$this->channelName][$model->type];
		$model->recommend = Helper::yesOrNo($model->recommend);
		$this->fmtValue4View($model);
		$imgs = $this->getImg($model->id);
		$imgsrc = array();
		if( is_array($imgs) )
		foreach($imgs as $img) {
			$imgsrc[] = Helper::shortImg2Preview($img->path, $this->channelName);
		}
		$this->render('view',array(
			'model'=>$model,
			'imgsrc' => $imgsrc,
		));
	}

	public function date2mtime($t) {
		if( preg_match('/^([0-9]{4})\-([0-9]{1,2})\-([0-9]{1,2})$/', $t, $m) )
			return mktime(0,0,0,$m[2],$m[3],$m[1]);
		if( preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $t, $m) )
			return mktime(0,0,0,$m[1],$m[2],$m[3]);
		return '';
	}

	public function actionCreate()
	{
		$model=new $this->modelName;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST[$this->modelName]))
		{
			$model->attributes=$_POST[$this->modelName];
			$model->ctime = time();
			$model->mtime = time();
			if( isset($model->ptime) )
			$model->ptime = $this->date2mtime($model->ptime);
			if($model->save()) {
				foreach($_POST as $field => $val) {
					if( !preg_match('/^uploaded_([0-9]+_[0-9]+)$/', $field, $matched)
						|| !preg_match('/^[0-9a-zA-Z\.\-_]+$/', $val) )
						continue;
					$img = new Event1311Img;
					$img->attributes = array(
						'rid' => $model->id,
						'type' => $this->channelName,
						'path' => Helper::shortTmp2ShortImg(basename($val), $this->channelName),
						'adshow' =>  $model->recommend == 1 && isset($_POST['adshow_'.$matched[1]]) && $_POST['adshow_'.$matched[1]] == $val ? 1 : 0,
						'newproduct' =>  $model->recommend == 1 && isset($_POST['newproduct_'.$matched[1]]) && $_POST['newproduct_'.$matched[1]] == $val ? 1 : 0,
						'mainpic' =>  isset($_POST['mainpic_'.$matched[1]]) && $_POST['mainpic_'.$matched[1]] == $val ? 1 : 0,
					);
					$img->save();
					Helper::deleteTmpIdx($val,$this->channelName);
				}
				//$this->redirect(array('view','id'=>$model->id));
				$this->redirect(array('admin'));
			}
		} else {
			Helper::clearTmp($this->channelName);
			$model->htmlhead = "<meta NAME=\"title\" CONTENT=\" \">\n<meta name=\"DESCRIPTION\" content=\" \">\n<meta name=\"keywords\" content=\" \">";
		}

		$channel = Helper::getChannel();
		Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/easyui/default/easyui.css');
		Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/easyui/icon.css');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.easyui.min.js');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/easyui-lang-'.Yii::app()->language.'.js');
		if( isset($model->ptime) ) {
			if( Yii::app()->language == 'zh_cn' )
				$model->ptime = date('Y-m-d', $model->ptime);
			else
				$model->ptime = date('m/d/Y', $model->ptime);
		}

		$this->render('create',array(
			'model'=>$model,
			'channel'=>$channel[$this->channelName],
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST[$this->modelName]))
		{
			$model->attributes=$_POST[$this->modelName];
			$model->mtime = time();
			if( isset($model->ptime) )
			$model->ptime = $this->date2mtime($model->ptime);
			if($model->save()) {
				$existed = array();
				$newimg = array();
				$adshow = array();
				$newproduct = array();
				$mainpic = array();
				foreach($_POST as $field => $val) {
					if( preg_match('/^existed_[0-9]+_[0-9]+$/', $field)
						&& preg_match('/^[0-9a-zA-Z\.\-_]+$/', $val) ) {
						$existed[] = $val;
						continue;
					}
					if( preg_match('/^uploaded_[0-9]+_[0-9]+$/', $field)
						&& preg_match('/^[0-9a-zA-Z\.\-_]+$/', $val) ) {
						$newimg[] = $val;
						continue;
					}
					if( preg_match('/^adshow_[0-9]+_[0-9]+$/', $field)
						&& preg_match('/^[0-9a-zA-Z\.\-_]+$/', $val) ) {
						$adshow[] = $val;
						continue;
					}
					if( preg_match('/^newproduct_[0-9]+_[0-9]+$/', $field)
						&& preg_match('/^[0-9a-zA-Z\.\-_]+$/', $val) ) {
						$newproduct[] = $val;
						continue;
					}
					if( preg_match('/^mainpic_[0-9]+_[0-9]+$/', $field)
						&& preg_match('/^[0-9a-zA-Z\.\-_]+$/', $val) ) {
						$mainpic[] = $val;
						continue;
					}
				}

				if( count($existed) > 0 ) {
					$imgs = $this->getImg($model->id);
					foreach($imgs as $img) {
						$idx = Helper::shortImg2BaseTmp($img->path);
						if( ! in_array($idx, $existed) ) {
							Helper::deleteImg(Helper::shortImg2RealPathImg($img->path, $this->channelName));
							Event1311Img::model()->deleteByPk($img->id);
						}
						if( in_array($idx, $adshow) )
							Event1311Img::model()->updateByPk($img->id,array('adshow'=>1),'adshow=0');
						else
							Event1311Img::model()->updateByPk($img->id,array('adshow'=>0),'adshow=1');

						if( in_array($idx, $newproduct) && $model->recommend == 1 )
							Event1311Img::model()->updateByPk($img->id,array('newproduct'=>1),'newproduct=0');
						else
							Event1311Img::model()->updateByPk($img->id,array('newproduct'=>0),'newproduct=1');

						if( in_array($idx, $mainpic) )
							Event1311Img::model()->updateByPk($img->id,array('mainpic'=>1),'mainpic=0');
						else
							Event1311Img::model()->updateByPk($img->id,array('mainpic'=>0),'mainpic=1');
					}
				} else {
					$imgs = $this->getImg($model->id);
					foreach($imgs as $img) {
						Helper::deleteImg(Helper::shortImg2RealPathImg($img->path, $this->channelName));
						Event1311Img::model()->deleteByPk($img->id);
					}
				}

				foreach($newimg as $val) {
					$img = new Event1311Img;
					$img->attributes = array(
						'rid' => $model->id,
						'type' => $this->channelName,
						'path' => Helper::shortTmp2ShortImg(basename($val), $this->channelName),
						'adshow' => in_array($val, $adshow) && $model->recommend == 1 ? 1 : 0,
						'newproduct' => in_array($val, $newproduct) && $model->recommend == 1 ? 1 : 0,
						'mainpic' => in_array($val, $mainpic) ? 1 : 0,
					);
					$img->save();
					Helper::deleteTmpIdx($val,$this->channelName);
				}

				//$this->redirect(array('view','id'=>$model->id));
				$this->redirect(array('admin'));
			}
		}

		$imgs = $this->getImg($id);
		$channel = Helper::getChannel();
		$uploaded = array();
		Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/easyui/default/easyui.css');
		Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/easyui/icon.css');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.easyui.min.js');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/easyui-lang-'.Yii::app()->language.'.js');
		if( isset($model->ptime) ) {
			if( Yii::app()->language == 'zh_cn' )
				$model->ptime = date('Y-m-d', $model->ptime);
			else
				$model->ptime = date('m/d/Y', $model->ptime);
		}

		if( is_array($imgs) )
		foreach($imgs as $img) {
			$uploaded[] = array(
				'num'=>time().'_'.rand(1000,9999),
				'val'=>Helper::shortImg2BaseTmp($img->path),
				'txt'=>Yii::t('common', 'imgsrc', array('{url}'=>Helper::shortImg2ImgUrl($img->path, $this->channelName))),
				'imgsrc' => Helper::shortImg2Preview($img->path, $this->channelName),
				'adshow' => $img->adshow,
				'newproduct' => $img->newproduct,
				'mainpic' => $img->mainpic,
			);
		}

		$this->render('update',array(
			'model'=>$model,
			'uploaded'=>$uploaded,
			'channel'=>$channel[$this->channelName],
		));
	}

	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
		$imgs = $this->getImg($model->id);
		foreach($imgs as $img) {
			Helper::deleteImg(Helper::shortImg2RealPathImg($img->path, $this->channelName));
			Event1311Img::model()->deleteByPk($img->id);
		}
		$model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider($this->modelName);
		$data = $dataProvider->getData();
		$channel = Helper::getChannel();

		//$data = $model->findAll();
		foreach($data as $n => $entry) {
			$data[$n]->type = $channel[$this->channelName][$entry->type];
			$data[$n]->recommend = Helper::yesOrNo($entry->recommend);
		}
		$dataProvider->setData($data);
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'channel' => $channel[$this->channelName],
			'channelName'=>$this->channelName,
		));
	}

	public function actionSub($subvalue)
	{
		$channel = Helper::getChannel();
		$type = '';
		foreach($channel[$this->channelName] as $n => $value) {
			if( $value == $subvalue ) {
				$type = $n;
				break;
			}
		}
		if( $type == '' ) {
			$this->render('error',array(
				'message'=>Yii::t($this->channelName,'notfound'),
				'channel' => $channel[$this->channelName],
				'channelName'=>$this->channelName,
			));
			return;
		}

		$dataProvider=new CActiveDataProvider($this->modelName, array('criteria'=>array(
			'condition' => 'type=:TYPE',
			'params' => array(':TYPE'=>$type),
		)));
		$data = $dataProvider->getData();
		//$data = $model->findAll();
		foreach($data as $n => $entry)
			$data[$n]->type = $channel[$this->channelName][$entry->type];
		$dataProvider->setData($data);

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'channel' => $channel[$this->channelName],
			'channelName'=>$this->channelName,
			'subchannel'=>CHtml::encode($subvalue),
		));
	}

	public function actionAdmin()
	{
		$channel = Helper::getChannel();
		$model=new $this->modelName('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET[$this->modelName]))
			$model->attributes=$_GET[$this->modelName];

		$cnchannel = Helper::getChannel('zh_cn');
		$this->render('admin',array(
			'model'=>$model,
			'channel' => $channel[$this->channelName],
			'cnchannel' => $cnchannel[$this->channelName],
			'channelName'=>$this->channelName,
		));
	}

	public function actionAdminSub($subvalue)
	{
		$channel = Helper::getChannel();
		$type = '';
		foreach($channel[$this->channelName] as $n => $value) {
			if( $value == $subvalue ) {
				$type = $n;
				break;
			}
		}
		if( $type == '' ) {
			$this->render('error',array(
				'message'=>Yii::t($this->channelName,'notfound'),
				'channel' => $channel[$this->channelName],
				'channelName'=>$this->channelName,
			));
			return;
		}

		$model=new $this->modelName('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET[$this->modelName]))
			$model->attributes=$_GET[$this->modelName];
		$model->type = $type;

		$this->render('admin',array(
			'model'=>$model,
			'channel' => $channel[$this->channelName],
			'channelName'=>$this->channelName,
			'subchannel'=>CHtml::encode($subvalue),
		));
	}

	public function getImg($id) {
		return Event1311Img::model()->findAll(array(
			'condition' => 'rid=:RID and type=:TYPE',
			'params' => array(
				':RID' => $id,
				':TYPE' => $this->channelName,
			),
		));
	}

	public function makeRectangleImage($filename, $width, $height) {
		$type = preg_match('/\.([^\.]+)$/', $filename, $matched) ? $matched[1] : 'jpg';
		$d = dirname($filename);
		$fname = basename($filename);
		$dname = $d.'/'.preg_replace('/\.([^\.]+)$/','',$fname).'_'.$width.'_'.$height.'.'.$type;

		$t = new ThumbHandler();
		$t->setSrcImg($filename);
		$t->setDstImg($dname);
		$t->cutToRectangle($width, $height);
		return $dname;
	}

	public function fmtValue4View(&$model) {
		if( !$model )
			return false;
		return true;
	}

	public function loadModel($id)
	{
		$model=Event1311Product::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='event1311-'.$this->channelName.'-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
