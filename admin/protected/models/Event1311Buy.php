<?php

/**
 * This is the model class for table "event_1311_buy".
 *
 * The followings are the available columns in table 'event_1311_buy':
 * @property string $id
 * @property string $name
 * @property string $company
 * @property string $email
 * @property string $phone
 * @property string $area
 * @property string $desp
 * @property string $language
 * @property string $ctime
 */
class Event1311Buy extends CActiveRecord
{
	public $verifyCode;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'event_1311_buy';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, company, email, phone, area, desp', 'required'),
			array('name, company, email, phone, area, desp, language', 'length', 'max'=>255),
			array('ctime', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, company, email, phone, area, desp, language, ctime', 'safe', 'on'=>'search'),
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
			array('area', 'match', 'pattern'=>'/^[^0\x20\x09\x0a\x0d]+$/'),
			array('phone', 'match', 'pattern'=>'/^[0-9\.\-_\x20]+$/'),
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
			'name' => Yii::t('cooperation','Name'),
			'company' => Yii::t('cooperation','Company Name'),
			'email' => 'Email',
			'phone' => Yii::t('cooperation','Tel'),
			'area' => Yii::t('cooperation','Region'),
			'desp' => Yii::t('buy','desp'),
			'language' => 'Language',
			'ctime' => Yii::t('common','ctime'),
			'verifyCode'=>Yii::t('login','authcode'),
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('area',$this->area,true);
		$criteria->compare('desp',$this->desp,true);
		$criteria->compare('language',$this->language,true);
		$criteria->compare('ctime',$this->ctime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function beforeSave() {
		parent::beforeSave();
		if( $this->isNewRecord ) {
			if( !isset($this->ctime) || $this->ctime == '' )
				$this->ctime = time();
			if( !isset($this->language) || $this->language == '' )
				$this->language = Yii::app()->language;
		}
		return true;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Event1311Buy the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
