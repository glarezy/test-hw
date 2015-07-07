<?php

class DownloadController extends Controller
{
	public $channelName = 'download';
	public $modelName = 'Event1311Download';

	public function recommendList() {
		$channel = Helper::getChannel();
		$channel = $channel[$this->channelName];
		$files = array();
		$this->pageTitle = Yii::t('download','download').' - '.$this->pageTitle;
		foreach($channel as $type => $entry) {
			if( $type == 'picture' )
				continue;
			$para = array(
				'criteria'=>array(
					'condition' => 'recommend=1 and type=:TYPE',
					'params' => array(':TYPE'=>$type),
					'order' => 'seq, ctime desc',
				),
				'pagination'=>array(
			        'pageSize'=>100,
			    ),
			);

			$dataProvider[$type] = new CActiveDataProvider($this->modelName, $para);
			$data = $dataProvider[$type]->getData();
			if( is_array($data) )
			foreach($data as $entry) {
				$files[$entry->id] = array(
					'label' => $entry->filename ? basename($entry->filename) : basename($entry->path),
					'link' => Helper::shortImg2ImgUrl($entry->path, 'download'),
					'type' => preg_match('/\.([^\.\x20\x09]+)$/', $entry->path, $matched) ? strtolower($matched[1]) : '',
				);
			}
		}

		$leftTree = Helper::getLeftTree($this->channelName);
		$product = $this->getProducts();
		$this->render('recommend',array(
			'dataProvider'=>$dataProvider,
			'product'=>$product,
			'leftTree'=>$leftTree,
			'channel'=>$channel,
			'type'=>'',
			'files'=>$files,
			'searchkey'=>'',
			'searchtype' => '',
		));
	}

	public function actionImage($imagedir, $imagefile) {
		$imagedir = trim(basename($imagedir));
		$imagefile = trim(basename($imagefile));
		$atta = Helper::getAttachmentRealPath();
		$image = $atta.'/download/'.$imagedir.'/'.$imagefile;
		if( $imagedir == '' || $imagefile == '' || !file_exists($image) )
			throw new CHttpException(404,'The requested page does not exist.');
		$mimetype = preg_match('/\.([^\.]+)$/', strtolower($imagefile), $type) && in_array($type[1], array('gif','jpeg','jpg','png','bmp')) ? 'image/'.$type[1] : '';
		if( ! preg_match('/^image\//', $mimetype) )
			throw new CHttpException(404,'The requested page does not exist.');
		header('Content-type: '.$mimetype);
		header('Content-disposition: attachment; filename="'.$imagefile.'"');
		echo file_get_contents($image);
	}

	protected function cookie($name, $value='oops') {
	    if( $value == 'oops' )
	        return Yii::app()->request->cookies[$name];
	    $cookie = Yii::app()->request->getCookies();
        unset($cookie[$name]);
	    $ck = new CHttpCookie($name,$value);
        $ck->expire = time()+3600*24*7;
        Yii::app()->request->cookies[$name] = $ck;
        return $value;
	}

	protected function needCookie() {
	    return (!Yii::app()->request->isPostRequest || isset($_REQUEST['page']))
		    && !isset($_POST['searchtype']) && !isset($_POST['searchtype2'])
		    && !isset($_POST['searchkey']);
	}

	public function actionPicture() {
		Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/basic.css?v=150210.css');
		Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/galleriffic-2.css');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.galleriffic.js');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.opacityrollover.js');

		if( $this->action->id != 'picture' && $this->needCookie() ) {
			$searchkey = $this->cookie('searchkey');
		} else {
			$searchkey = isset($_POST['searchkey']) ? $_POST['searchkey'] : '';
		}

		if( $searchkey != '' ) {
			$condition = 'download.type=:PIC and download.pid=:PID';
			$params = array(':PIC'=>'picture', ':PID'=>$searchkey);
		} else {
			$condition = 'download.type=:PIC';
			$params = array(':PIC'=>'picture');
		}
		$para = array(
			'criteria'=>array(
				'with' => array('product'),
				'order' => 'product.seq, download.pid, download.ctime desc',
				'condition' => $condition,
				'params' => $params,
			),
			'pagination'=>array(
		        'pageSize'=>2,
		    ),
		);

		$channel = Helper::getChannel();
		$this->pageTitle = $channel[$this->channelName]['picture'].' - '.Yii::t('download','download').' - '.$this->pageTitle;

		$criteria = new CDbCriteria();
        $criteria->with = array('product');
		$criteria->order = 'product.seq, download.pid, download.ctime desc';
		$criteria->condition = $condition;
		$criteria->params = $params;
        $count = Event1311Download::model()->count($criteria);

		$pages = new CPagination($count);
        $pages->pageSize = 15;
        $pages->applyLimit($criteria);

		//$dataProvider=new CActiveDataProvider($this->modelName, $para);
		$dataProvider=Event1311Download::model()->findAll($criteria);
		$leftTree = Helper::getLeftTree($this->channelName);
		$channel = Helper::getChannel();
		$product = $this->getProducts();
		$this->render('picture',array(
			'dataProvider'=>$dataProvider,
			'product'=>$product,
			'leftTree'=>$leftTree,
			'searchkey'=>$searchkey,
			'channel'=>$channel[$this->channelName],
			'type'=>'picture',
			'viewName' => 'pictures',
			'viewData' => array(
				'dataProvider'=>$dataProvider,
				'pages'=>$pages,
			)
		));
	}

	public function actionIndex()
	{
		$type2 = isset($_POST['searchtype2']) ? $_POST['searchtype2'] : '';
		$type = $this->getChannelType();
		if( $type == '' )
			return $this->recommendList();
		if( $type == 'picture' )
			return $this->actionPicture();

		$para = array(
			'criteria'=>array(
				'order' => 'ctime desc',
			),
			'pagination'=>array(
		        'pageSize'=>20,
		    ),
		);

		if( $type != '' ) {
			$para['criteria']['condition'] = 'type=:TYPE';
			$para['criteria']['params'] = array(':TYPE'=>$type);
		}

		$channel = Helper::getChannel();
		$this->pageTitle = Yii::t('download','download').' - '.$this->pageTitle;
		if( $type != '' )
			$this->pageTitle = $channel[$this->channelName][$type].' - '.$this->pageTitle;

		$dataProvider[$type]=new CActiveDataProvider($this->modelName, $para);
		$files = array();
		$data = $dataProvider[$type]->getData();
		if( is_array($data) )
		foreach($data as $entry) {
			$files[$entry->id] = array(
				'label' => $entry->filename ? basename($entry->filename) : basename($entry->path),
				'link' => Helper::shortImg2ImgUrl($entry->path, 'download'),
				'type' => preg_match('/\.([^\.\x20\x09]+)$/', $entry->path, $matched) ? strtolower($matched[1]) : '',
			);
		}

		$leftTree = Helper::getLeftTree($this->channelName);
		$channel = Helper::getChannel();
		$product = $this->getProducts();
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'leftTree'=>$leftTree,
			'product'=>$product,
			'channel'=>$channel[$this->channelName],
			'type'=>$type,
			'searchtype'=>$type2,
			'viewName' => 'list',
			'viewData' => array(
				'dataProvider'=>$dataProvider[$type],
				'files'=>$files,
				'channelName'=>$channel[$this->channelName][$type],
				'pageNav'=>true,
			)
		));
	}

	public function actionSearch() {
		$type = $_POST['searchtype'];
		$type2 = isset($_POST['searchtype2']) ? $_POST['searchtype2'] : '';
		if( isset($_POST['searchtype']) )
			$this->cookie('searchtype', $_POST['searchtype']);
		if( isset($_POST['searchtype2']) )
			$this->cookie('searchtype2', $_POST['searchtype2']);
		if( isset($_POST['searchkey']) )
			$this->cookie('searchkey', $_POST['searchkey']);
		if( $this->needCookie() ) {
			$type = $this->cookie('searchtype');
			$type2 = $this->cookie('searchtype2');
		}
		if( $type == 'picture' || $type2 == 'picture' )
			return $this->actionPicture();

		$key = $_POST['searchkey'];
		if( $key == '' )
			return $this->recommendList();
		$channel = Helper::getChannel();
		$searchChannel = $channel[$this->channelName];
		$files = array();
		foreach($searchChannel as $type => $entry) {
			$para = array(
				'criteria'=>array(
					'condition' => 'type=:TYPE and ( pid like :KEY or title like :KEY or filename like :KEY )',
					'params' => array(':TYPE'=>$type, ':KEY'=>'%'.$key.'%'),
					'order' => 'ctime desc',
				),
				'pagination'=>array(
			        'pageSize'=>100,
			    ),
			);

			$dataProvider[$type]=new CActiveDataProvider($this->modelName, $para);
			$data = $dataProvider[$type]->getData();
			if( is_array($data) )
			foreach($data as $entry) {
				$files[$entry->id] = array(
					'label' => $entry->filename ? basename($entry->filename) : basename($entry->path),
					'link' => Helper::shortImg2ImgUrl($entry->path, 'download'),
					'type' => preg_match('/\.([^\.\x20\x09]+)$/', $entry->path, $matched) ? strtolower($matched[1]) : '',
				);
			}
		}

		$leftTree = Helper::getLeftTree($this->channelName);
		$product = $this->getProducts();

		$this->render('recommend',array(
			'dataProvider'=>$dataProvider,
			'product'=>$product,
			'leftTree'=>$leftTree,
			'channel'=>$channel[$this->channelName],
			'type'=>'',
			'files'=>$files,
			'searchkey'=>$key,
			'searchtype'=>$type2,
		));
	}

	public function actionView()
	{
		$this->render('view');
	}

	public function getProducts() {
		$product = array();
		$res = Event1311Product::model()->findAll(array(
			'order' => 'seq,type,ctime',
		));
		if( $res === null )
			return $product;
		if( !is_array($res) )
			return $product;
		foreach($res as $entry) {
			$product[] = array('value' => CHtml::encode($entry->pid), 'text' => CHtml::encode($entry->title));
		}
		return $product;
	}

	public function getChannelType() {
		$type = '';
		$subvalue = isset($_REQUEST['subvalue']) ? $_REQUEST['subvalue'] : '';
		$channel = Helper::getChannel();
		foreach($channel[$this->channelName] as $n => $value) {
			if( $value == $subvalue || $n == $subvalue ) {
				$type = $n;
				break;
			}
		}
		if( $type == '' ) {
			//$type = 'adpage';
		}
		return $type;
	}

	public function loadModel($id)
	{
		$model=Event1311Download::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
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