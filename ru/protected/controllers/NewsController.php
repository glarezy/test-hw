<?php

class NewsController extends Controller
{
	public $channelName = 'news';
	public $modelName = 'Event1311News';

	public function setDefaultMeta() {

	}

	public function notfound() {
		$this->redirect(array('index'));
	}

	public function actionIndex()
	{
		$channel = Helper::getChannel();
		Helper::regMeta(Helper::meta2arr($this->metaInfo));
		$para = array(
			'criteria'=>array(
				'order' => 'ptime desc',
			),
			'pagination'=>array(
		        'pageSize'=>10,
		    ),
		);

		$type = $this->getChannelType();
		if( $type != '' ) {
			$para['criteria']['condition'] = 'type=:TYPE';
			$para['criteria']['params'] = array(':TYPE'=>$type);
			$this->pageTitle = $channel[$this->channelName][$type].' - '.Yii::t('news','news').' - '.$this->pageTitle;
			$newsTitle = $channel[$this->channelName][$type];
		} else {
			$this->pageTitle = Yii::t('news','news').' - '.$this->pageTitle;
			$newsTitle = Yii::t('news','news');
		}

		$dataProvider=new CActiveDataProvider($this->modelName, $para);
		$data = $dataProvider->getData();
		$rid = array('0');
		foreach($data as $entry) {
			$rid[] = 'rid='.$entry->id;
		}
		$imgRes = Event1311Img::model()->findAll(array(
			'condition' => 'adshow=0 and type=:TYPE and ('.implode(' or ', $rid).')',
			'params' => array(':TYPE'=>$this->channelName),
			'order' => 'mainpic desc',
		));
		$img = array();
		if( is_array($imgRes) )
		foreach($imgRes as $entry) {
			if( $entry->mainpic == 1 || !isset($img[$entry->rid]) )
				$img[$entry->rid] = Helper::shortImg2ImgUrl($entry->path,$this->channelName);
		}

		$leftTree = Helper::getLeftTree('news');

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'img'=>$img,
			'leftTree'=>$leftTree,
			'type'=>$type,
			'viewName' => 'list',
			'viewData' => array(
				'dataProvider'=>$dataProvider,
				'img'=>$img,
			),
			'newsTitle' => $newsTitle,
		));
	}

	public function actionView($id)
	{
		$model = $this->loadModel($id);

		$leftTree = Helper::getLeftTree('news');
		if( count(Helper::meta2arr($model->htmlhead)) < 1 )
		Helper::regMeta(Helper::meta2arr($this->metaInfo));
		else
		Helper::regMeta(Helper::meta2arr($model->htmlhead));
		$channel = Helper::getChannel();
		$this->pageTitle = $model->title.' - '.$channel[$this->channelName][$model->type].' - '.Yii::t('news','news').' - '.$this->pageTitle;

		$this->render('index',array(
			'type'=>$this->getChannelType(),
			'leftTree'=>$leftTree,
			'viewName' => 'view',
			'viewData' => array(
				'model'=>$model,
			),
			'newsTitle' => $channel[$this->channelName][$model->type],
		));
	}

	public function getChannelType() {
		if( !isset($_REQUEST['subvalue']) )
			return '';

		$type = '';
		$subvalue = $_REQUEST['subvalue'];
		$channel = Helper::getChannel();
		foreach($channel[$this->channelName] as $n => $value) {
			if( $value == $subvalue || $n == $subvalue ) {
				$type = $n;
				break;
			}
		}
		if( $type == '' ) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $type;
	}

	public function loadModel($id)
	{
		$model=Event1311News::model()->findByPk($id);
		if($model===null) $this->notfound();
			//throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}