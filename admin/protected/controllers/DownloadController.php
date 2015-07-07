<?php

class DownloadController extends Controller
{

	public $layout='//layouts/column2';
	public $channelName = 'download';
	public $modelName = 'Event1311Download';

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function actionUpload() {
		$upload = new UploadAttachment($this->channelName);
		$filename = $upload->save();
		if( $filename === false ) {
			$this->jsonResponse(array('code'=>'failed'));
			return;
		}
		if( $upload->isPicture() ) {
			$preview = $this->resizeImage($filename, 500, 500);
			$preview = $this->makeRectangleImage($filename, 90, 90);
			$preview = $this->makeRectangleImage($filename, 50, 50);
			$this->jsonResponse(array(
				'code'=>'success',
				'uploaded'=>array(
					'num'=>time().'_'.rand(1000,9999),
					'val'=>basename(Helper::img2tmp($filename)),
					'txt'=>Yii::t('common', 'imgsrc', array('{url}'=>Helper::getAttachmentUrl($filename))),
					'imgsrc' => Helper::getAttachmentUrl($preview),
				)
			));
		} else {
			$this->jsonResponse(array(
				'code'=>'success',
				'uploaded'=>array(
					'num'=>time().'_'.rand(1000,9999),
					'val'=>basename(Helper::img2tmp($filename)),
					'txt'=>basename($upload->getFilename()),
					'imgsrc' => Helper::attachmentImgSrc(),
				)
			));
		}
	}

	public function actionView($id)
	{
		$channel = Helper::getChannel();
		$model = $this->loadModel($id);
		$isPicture = $this->isPicture($model->type);
		$model->type = $channel[$this->channelName][$model->type];
		$imgPreview = $isPicture ? Helper::shortImg2Preview($model->path, $this->channelName, 90, 90) : '';
		$fileUrl = Helper::shortImg2ImgUrl($model->path, $this->channelName);
		$this->render('view',array(
			'model'=>$model,
			'imgPreview' => $imgPreview,
			'channel'=>$channel[$this->channelName],
			'isPicture'=>$isPicture,
			'fileUrl'=>$fileUrl,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{


		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST[$this->modelName]))
		{
			$n=0;
			foreach($_POST as $field => $val) {
				if( !preg_match('/^uploaded_([0-9]+_[0-9]+)$/', $field, $matched)
					|| !preg_match('/^[0-9a-zA-Z\.\-_]+$/', $val) )
					continue;
				$model=new $this->modelName;
				$model->attributes=$_POST[$this->modelName];
				$model->path = Helper::shortTmp2ShortImg(basename($val), $this->channelName);
				if( isset($_POST['label_'.$matched[1]]) )
					$model->filename = basename($_POST['label_'.$matched[1]]);
				if($model->save()) {
					Helper::deleteTmpIdx($val,$this->channelName);
				}
				$model->setIsNewRecord(TRUE);
				$n++;
			}
			if( $n == 0 ) {
				$model=new $this->modelName;
				$model->attributes=$_POST[$this->modelName];
				$model->save();
			}
			if( $model->id )
			$this->redirect(array('index'));
		} else
			Helper::clearTmp($this->channelName);

		$channel = Helper::getChannel();
		$model=new $this->modelName;

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
			if($model->save()) {
				$existed = array();
				$newimg = array();
				$label = array();
				foreach($_POST as $field => $val) {
					$matched = array();
					if( preg_match('/^existed_[0-9]+_[0-9]+$/', $field)
						&& preg_match('/^[0-9a-zA-Z\.\-_]+$/', $val) ) {
						$existed[] = $val;
						continue;
					}
					if( preg_match('/^uploaded_([0-9]+_[0-9]+)$/', $field, $matched)
						&& preg_match('/^[0-9a-zA-Z\.\-_]+$/', $val) ) {
						$newimg[] = $val;
						$label[] = isset($_POST['label_'.$matched[1]]) ? $_POST['label_'.$matched[1]] : '';
						continue;
					}
				}

				if( count($existed) == 1 && count($newimg) == 0
					|| count($existed) == 0 && count($newimg) == 1 ) {
					if( count($existed) < 1 ) {
						Helper::deleteImg(Helper::shortImg2RealPathImg($model->path, $this->channelName));
					}

					foreach($newimg as $i => $val) {
						$model->path = Helper::shortTmp2ShortImg(basename($val), $this->channelName);
						$model->filename = basename($label[$i]);
						Helper::deleteTmpIdx($val,$this->channelName);
						$model->save();
						break;
					}

					$this->redirect(array('view','id'=>$model->id));
				}
			}
		}

		$channel = Helper::getChannel();
		$uploaded = array();
		$flag = $this->isPicture($model->type);

		$uploaded[] = array(
			'num'=>time().'_'.rand(1000,9999),
			'val'=>Helper::shortImg2BaseTmp($model->path),
			'txt'=>$flag ? Helper::shortImg2ImgUrl($model->path, $this->channelName) : ( $model->filename ? CHtml::encode($model->filename) : CHtml::encode(basename($model->path)) ),
			'imgsrc' => $flag ? Helper::shortImg2Preview($model->path, $this->channelName) : Helper::attachmentImgSrc(),
		);

		$this->render('update',array(
			'model'=>$model,
			'uploaded'=>$uploaded,
			'channel'=>$channel[$this->channelName],
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

	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
		Helper::deleteImg(Helper::shortImg2RealPathImg($model->path, $this->channelName));
		$model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->redirect(array('admin'));
		$channel = Helper::getChannel();
		$subvalue = '';
		foreach($channel[$this->channelName] as $n => $value) {
			$subvalue = $value;
			break;
		}
		$this->redirect(array('/'.$this->channelName.'/sub/'.CHtml::encode($subvalue)));
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

		$isPicture = isset($type) && $this->isPicture($type);

		$dataProvider=new CActiveDataProvider($this->modelName, array(
			'criteria'=>array(
				'condition' => 'type=:TYPE',
				'params' => array(':TYPE'=>$type),
				'order' => 'pid',
			),
			'pagination'=>array(
		        'pageSize'=>$isPicture?10:20,
		    ),
		));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'channel' => $channel[$this->channelName],
			'channelName'=>$this->channelName,
			'subchannel'=>CHtml::encode($subvalue),
			'isPicture'=>$isPicture,
		));
	}

	public function actionAdmin()
	{
		$channel = Helper::getChannel();
		$model=new $this->modelName('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET[$this->modelName]))
			$model->attributes=$_GET[$this->modelName];

		$this->render('admin',array(
			'model'=>$model,
			'channel' => $channel[$this->channelName],
			'channelName'=>$this->channelName,
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

	public function resizeImage($filename, $width, $height) {
		$type = preg_match('/\.([^\.]+)$/', $filename, $matched) ? $matched[1] : 'jpg';
		$d = dirname($filename);
		$fname = basename($filename);
		$dname = $d.'/'.preg_replace('/\.([^\.]+)$/','',$fname).'_'.$width.'_'.$height.'.'.$type;

		$t = new ThumbHandler();
		$t->setSrcImg($filename);
		$t->setDstImg($dname);
		$t->resize($width, $height);
		return $dname;
	}

	public function isPicture($type) {
		return in_array($type, array('picture'));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Event1311Download the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Event1311Download::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Event1311Download $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='event1311-download-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
