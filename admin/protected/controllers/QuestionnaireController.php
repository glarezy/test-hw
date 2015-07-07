<?php

class QuestionnaireController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Event1311QuestionnaireConstruction;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Event1311QuestionnaireConstruction']))
		{
			$model->attributes=$_POST['Event1311QuestionnaireConstruction'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Event1311QuestionnaireConstruction']))
		{
			$model->attributes=$_POST['Event1311QuestionnaireConstruction'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

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
		$dataProvider=new CActiveDataProvider('Event1311QuestionnaireConstruction');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Event1311QuestionnaireConstruction('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Event1311QuestionnaireConstruction']))
			$model->attributes=$_GET['Event1311QuestionnaireConstruction'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionResult($id) {
		$model = $this->loadModel($id);
		$qname = $model->name;
		$qid = $model->id;
		$dataProvider=new CActiveDataProvider('Event1311Questionnaire', array(
			'criteria'=>array(
				'condition' => 'qid=:QID',
				'params' => array(
					':QID' => $id,
				),
			),
			'pagination'=>array(
		        'pageSize'=>10,
		    ),
		));
		$fields = $this->getFields($id);

		$this->render('result',array(
			'dataProvider'=>$dataProvider,
			'model'=>$model,
			'fields' => $fields,
			'name'=>$qname,
			'id'=>$qid,
		));
	}

	public function actionExport($id) {
		$model = $this->loadModel($id);
		$res = Event1311Questionnaire::model()->findAll(array(
			'condition' => 'qid=:QID',
			'params' => array(
				':QID' => $id,
			),
		));
		$exportField = array();
		$content = array();
		$fields = $this->getFields($id);
		foreach($res as $data) {
			$line = array();
			foreach($fields as $n => $entry) {
				$field = 'field'.($n+1);
				if( !in_array($entry['label'], $exportField) )
					$exportField[] = $entry['label'];
				switch($entry['type']) {
					case '单项选择题':
					case 'radio':
						foreach($entry['options'] as $option) {
							if( $data->$field == $option['value'] ) {
								$line[] = $this->fmtCvsValue($option['label']);
								break;
							}
						}
						break;
					case '多项选择题':
					case 'checkbox':
						$v = explode('|', $data->$field);
						$label = array();
						foreach($entry['options'] as $option) {
							if( in_array($option['value'],$v) ) {
								$label[] = str_replace('|','',$option['label']);
							}
						}
						$line[] = $this->fmtCvsValue(implode('|',$label));
						break;
					case '单行输入':
					case 'text':
					case '多行输入':
					case 'textarea':
						$line[] = $this->fmtCvsValue($data->$field);
						break;
				}
			}
			$content[] = implode(',', $line);
		}

		header("Content-type:text/csv; charset=UTF-8");
	    header("Content-Disposition:attachment;filename=".trim($model->name).".csv");
	    header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
	    header('Expires:0');
	    header('Pragma:public');
		//header("Content-type:application/vnd.ms-excel; charset=UTF-8");
		//header("Content-Disposition:filename=".trim($model->name).".csv");
		echo "\xEF\xBB\xBF".implode(',', $exportField)."\n";
		echo implode("\n", $content);
	}

	public function actionSample() {
		$tpl = str_replace("\\","/",dirname(Yii::app()->basePath)).'/tpl/questionnaire/demo.tpl';
		echo '<html><body><pre>';
		echo file_get_contents($tpl);
		echo '</pre></body></html>';
	}

	public function fmtCvsValue($val) {
		$from = array("\r","\n","\"");
		$to = array('','',"\"\"");
		if( strstr($val, ',') || strstr($val, '"') )
			return "\"".str_replace($from,$to,$val)."\"";
		return str_replace($from,$to,$val);
	}

/*
	public function actionResult($id) {
		$model = $this->loadModel($id);
		$qname = $model->name;
		$qid = $model->id;

		$model=new Event1311Questionnaire('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Event1311Questionnaire']))
			$model->attributes=$_GET['Event1311Questionnaire'];
		$fields = $this->getFields($id);
		$column = array();
		for($i=1;$i<=count($fields);$i++)
			$column[] = 'field'.$i;
		$column[] = array(
			'class'=>'CButtonColumn',
		);

		$this->render('result',array(
			'model'=>$model,
			'column'=>$column,
			'name'=>$qname,
			'id'=>$qid,
		));
	}
*/
	public function getFields($id) {
		$model = $this->loadModel($id);
		$fields= json_decode($model->construction, true);
		return $fields['question'];
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Event1311QuestionnaireConstruction the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Event1311QuestionnaireConstruction::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Event1311QuestionnaireConstruction $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='event1311-questionnaire-construction-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
