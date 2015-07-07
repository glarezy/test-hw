<?php

class ProductController extends Controller
{

	public $channelName = 'product';
	public $modelName = 'Event1311Product';

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
	public function setDefaultMeta() {

	}

	public function notfound() {
		$this->redirect(array('index'));
	}

	public function actionBuy() {
		$channel = Helper::getChannel();
		$channel = $channel[$this->channelName];
		Helper::regMeta(Helper::meta2arr($this->metaInfo));
		Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/form.css');
		$this->pageTitle = Yii::t('product','p').' - '.$this->pageTitle;
		$leftTree = Helper::getLeftTree('product');

		$model=new Event1311Buy;
        if(isset($_POST['Event1311Buy']))
        {
            $model->attributes=$_POST['Event1311Buy'];
            if( $model->validate() && $model->save()) {
				$emlobj = new Eml();
				$emlobj->send($model->area, $model->email, $model->desp, 'buy');
				$this->redirect(array('/products/how_to_buy/finish'));
			}
        }

		$this->render('_index',array(
			'leftTree'=>$leftTree,
			'type'=>'',
			'viewName' => '_buy',
			'viewData' => array(
				'model'=>$model,
				'channel'=>$channel,
				'type'=>'',
			)
		));
	}

	public function actionFinish() {
		$leftTree = Helper::getLeftTree('product');

		$this->render('_index',array(
			'leftTree'=>$leftTree,
			'type'=>'',
			'viewName' => '_finish',
			'viewData' => array()
		));
	}

	public function recommend() {
		$channel = Helper::getChannel();
		$channel = $channel[$this->channelName];
		Helper::regMeta(Helper::meta2arr($this->metaInfo));
		$this->pageTitle = Yii::t('product','p').' - '.$this->pageTitle;
		$dataProvider = array();
		$img = array();
		foreach($channel as $type => $entry) {
			$para = array(
				'criteria'=>array(
					'condition' => 'type=:TYPE',
					'params' => array(':TYPE'=>$type),
					'order' => 'seq,recommend desc,ctime desc',
				),
				'pagination'=>array(
			        'pageSize'=>2,
			    ),
			);

			$dataProvider[$type]=new CActiveDataProvider($this->modelName, $para);
			$data = $dataProvider[$type]->getData();
			$rid = array('0');
			foreach($data as $entry) {
				$rid[] = 'rid='.$entry->id;
			}
			$imgRes = Event1311Img::model()->findAll(array(
				'condition' => 'adshow=0 and type=:TYPE and ('.implode(' or ', $rid).')',
				'params' => array(':TYPE'=>$this->channelName),
				'order' => 'mainpic desc',
			));
			if( is_array($imgRes) )
			foreach($imgRes as $entry) {
				if( $entry->mainpic == 1 || !isset($img[$entry->rid]) )
					$img[$entry->rid] = Helper::shortImg2ImgUrl($entry->path,$this->channelName);
			}
		}

		$leftTree = Helper::getLeftTree('product');

		$this->render('_index',array(
			'leftTree'=>$leftTree,
			'type'=>'',
			'viewName' => '_list2',
			'viewData' => array(
				'dataProvider'=>$dataProvider,
				'img'=>$img,
				'channel'=>$channel,
			)
		));
	}

	public function actionIndex()
	{
		$type = $this->getChannelType();
		if( $type == '' )
			return $this->recommend();

		$channel = Helper::getChannel();
		Helper::regMeta(Helper::meta2arr($this->metaInfo));
		$para = array(
			'criteria'=>array(
				'order' => 'seq,ctime desc',
			),
			'pagination'=>array(
		        'pageSize'=>10,
		    ),
		);

		if( $type != '' ) {
			$para['criteria']['condition'] = 'type=:TYPE';
			$para['criteria']['params'] = array(':TYPE'=>$type);
			$this->pageTitle = $channel[$this->channelName][$type].' - '.Yii::t('product','p').' - '.$this->pageTitle;
		} else {
			$this->pageTitle = Yii::t('product','p').' - '.$this->pageTitle;
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

		$leftTree = Helper::getLeftTree('product');

		$this->render('_index',array(
			'dataProvider'=>$dataProvider,
			'img'=>$img,
			'leftTree'=>$leftTree,
			'type'=>$type,
			'viewName' => '_list',
			'viewData' => array(
				'dataProvider'=>$dataProvider,
				'img'=>$img,
				'channel'=>$channel[$this->channelName],
				'type'=>$type,
			)
		));
	}

	public function actionView($id)
	{
		$channel = Helper::getChannel();
		$model = $this->loadModel($id);

		$imgres = Event1311Img::model()->findAll(array(
			'condition' => 'rid=:PID and adshow=0 and newproduct=0 and type=:TYPE',
			'params' => array(':PID'=>$id,':TYPE'=>$this->channelName),
			'order' => 'mainpic desc',
		));
		$img = array();
		if( is_array($imgres) )
		foreach($imgres as $entry) {
			$img[] = array(
				'big' => Helper::shortImg2ImgUrl($entry->path, $this->channelName),
				'small' => Helper::shortImg2Preview($entry->path, $this->channelName, 50, 50),
			);
		}
		if( count($img) < 1 )
			throw new CHttpException(404,'no image found.');

		$leftTree = Helper::getLeftTree('product');
		if( count(Helper::meta2arr($model->htmlhead)) < 1 )
		Helper::regMeta(Helper::meta2arr($this->metaInfo));
		else
		Helper::regMeta(Helper::meta2arr($model->htmlhead));

		$this->pageTitle = $model->title.' - '.$channel[$this->channelName][$model->type].' - '.Yii::t('product','p').' - '.$this->pageTitle;

		$this->render('_index',array(
			'type'=>$this->getChannelType(),
			'leftTree'=>$leftTree,
			'viewName' => '_view',
			'viewData' => array(
				'model'=>$model,
				'img'=>$img,
				'download'=>$this->getDownload($model->pid),
			)
		));
	}

	public function getDownload($pid) {
		$res = Event1311Download::model()->findAll(array(
			'condition' => '(pid like :PID1 or pid like :PID2 or pid like :PID3 or pid=:PID) and type!=:TYPE',
			'params' => array(':PID'=>$pid,':PID1'=>$pid.',%',':PID2'=>'%,'.$pid,':PID3'=>'%,'.$pid.',%',':TYPE'=>'picture'),
			'order' =>'type',
		));
		$d = array();
		if( is_array($res) )
		foreach($res as $entry) {
			$blankLabel = $entry->filename ? basename($entry->filename) : basename($entry->path);
			$postfix = preg_match('/(\.[^\.]+)$/', $entry->path, $m) ? $m[1] : '';
			$name = str_replace(' ','_',$entry->title);
			$name = $entry->title;
			$label = $name != '' && $postfix != '' ? $name.$postfix : $blankLabel;
			$label = preg_replace('/(\.[^\.]+)$/','',$label);
			$d[] = array(
				'label' => $label,
				'link' => Helper::shortImg2ImgUrl($entry->path, 'download'),
				'type' => preg_match('/\.([^\.\x20\x09]+)$/', $entry->path, $matched) ? strtolower($matched[1]) : '',
			);
		}
		return $d;
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
		$model=Event1311Product::model()->findByPk($id);
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