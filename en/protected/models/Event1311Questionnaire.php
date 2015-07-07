<?php

/**
 * This is the model class for table "event_1311_questionnaire".
 *
 * The followings are the available columns in table 'event_1311_questionnaire':
 * @property string $id
 * @property integer $qid
 * @property string $language
 * @property string $ctime
 * @property string $field1
 * @property string $field2
 * @property string $field3
 * @property string $field4
 * @property string $field5
 * @property string $field6
 * @property string $field7
 * @property string $field8
 * @property string $field9
 * @property string $field10
 * @property string $field11
 * @property string $field12
 * @property string $field13
 * @property string $field14
 * @property string $field15
 * @property string $field16
 * @property string $field17
 * @property string $field18
 * @property string $field19
 * @property string $field20
 * @property string $field21
 * @property string $field22
 * @property string $field23
 * @property string $field24
 * @property string $field25
 * @property string $field26
 * @property string $field27
 * @property string $field28
 * @property string $field29
 * @property string $field30
 */
class Event1311Questionnaire extends CActiveRecord
{
	public $verifyCode;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'event_1311_questionnaire';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('qid', 'numerical', 'integerOnly'=>true),
			array('language, ip', 'length', 'max'=>50),
			array('ctime', 'length', 'max'=>11),
			array('field1, field2, field3, field4, field5, field6, field7, field8, field9, field10, field11, field12, field13, field14, field15, field16, field17, field18, field19, field20, field21, field22, field23, field24, field25, field26, field27, field28, field29, field30', 'length', 'max'=>512),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, qid, language, ip, ctime, field1, field2, field3, field4, field5, field6, field7, field8, field9, field10, field11, field12, field13, field14, field15, field16, field17, field18, field19, field20, field21, field22, field23, field24, field25, field26, field27, field28, field29, field30', 'safe', 'on'=>'search'),
//			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'qid' => 'Qid',
			'language' => 'Language',
			'ip' => 'Ip',
			'ctime' => 'Ctime',
			'verifyCode'=>Yii::t('login','authcode'),
			'field1' => 'Field1',
			'field2' => 'Field2',
			'field3' => 'Field3',
			'field4' => 'Field4',
			'field5' => 'Field5',
			'field6' => 'Field6',
			'field7' => 'Field7',
			'field8' => 'Field8',
			'field9' => 'Field9',
			'field10' => 'Field10',
			'field11' => 'Field11',
			'field12' => 'Field12',
			'field13' => 'Field13',
			'field14' => 'Field14',
			'field15' => 'Field15',
			'field16' => 'Field16',
			'field17' => 'Field17',
			'field18' => 'Field18',
			'field19' => 'Field19',
			'field20' => 'Field20',
			'field21' => 'Field21',
			'field22' => 'Field22',
			'field23' => 'Field23',
			'field24' => 'Field24',
			'field25' => 'Field25',
			'field26' => 'Field26',
			'field27' => 'Field27',
			'field28' => 'Field28',
			'field29' => 'Field29',
			'field30' => 'Field30',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('qid',$this->qid);
		$criteria->compare('language',$this->language,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('ctime',$this->ctime,true);
		$criteria->compare('field1',$this->field1,true);
		$criteria->compare('field2',$this->field2,true);
		$criteria->compare('field3',$this->field3,true);
		$criteria->compare('field4',$this->field4,true);
		$criteria->compare('field5',$this->field5,true);
		$criteria->compare('field6',$this->field6,true);
		$criteria->compare('field7',$this->field7,true);
		$criteria->compare('field8',$this->field8,true);
		$criteria->compare('field9',$this->field9,true);
		$criteria->compare('field10',$this->field10,true);
		$criteria->compare('field11',$this->field11,true);
		$criteria->compare('field12',$this->field12,true);
		$criteria->compare('field13',$this->field13,true);
		$criteria->compare('field14',$this->field14,true);
		$criteria->compare('field15',$this->field15,true);
		$criteria->compare('field16',$this->field16,true);
		$criteria->compare('field17',$this->field17,true);
		$criteria->compare('field18',$this->field18,true);
		$criteria->compare('field19',$this->field19,true);
		$criteria->compare('field20',$this->field20,true);
		$criteria->compare('field21',$this->field21,true);
		$criteria->compare('field22',$this->field22,true);
		$criteria->compare('field23',$this->field23,true);
		$criteria->compare('field24',$this->field24,true);
		$criteria->compare('field25',$this->field25,true);
		$criteria->compare('field26',$this->field26,true);
		$criteria->compare('field27',$this->field27,true);
		$criteria->compare('field28',$this->field28,true);
		$criteria->compare('field29',$this->field29,true);
		$criteria->compare('field30',$this->field30,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function defaultScope() {
        return array(
            'alias' => 'entry',
            'condition' => "entry.language=:LANG",
            'params' => array(':LANG'=>Yii::app()->language),
        );
    }

	public function beforeSave() {
		parent::beforeSave();
		if( !isset($this->language) || $this->language == '' )
			$this->language = Yii::app()->language;
		if( $this->isNewRecord ) {
			if( !isset($this->ctime) || $this->ctime == '' )
				$this->ctime = time();
			if( !isset($this->ip) || $this->ip == '' )
				$this->ip = $_SERVER['REMOTE_ADDR'];
		}
		return true;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Event1311Questionnaire the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function float() {
		return Event1311Questionnaire::model()->countByAttributes(array('recommend'=>1)) > 0;
	}

}
