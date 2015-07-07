<?php

/**
 * This is the model class for table "event_1311_register".
 *
 * The followings are the available columns in table 'event_1311_register':
 * @property integer $id
 * @property string $city
 * @property string $email
 * @property string $gender
 * @property string $tele
 * @property string $phone
 * @property string $name
 * @property string $company
 * @property string $business
 * @property string $lastyear
 * @property string $thisyear
 * @property string $ctime
 */
class Event1311Register extends CActiveRecord
{
	public $verifyCode;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'event_1311_register';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('city, email,  tele,  name, company,  lastyear, thisyear', 'required'),
			array('city, email, gender, tele, phone, name, company, business', 'length', 'max'=>255),
			array('ctime', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, city, email, gender, tele, phone, name, company, business, lastyear, thisyear, ctime', 'safe', 'on'=>'search'),
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
			array('city', 'match', 'pattern'=>'/^[^0\x20\x09\x0a\x0d]+$/'),
			array('phone', 'match', 'pattern'=>'/^1[0-9]{10}$/'),
			array('tele', 'match', 'pattern'=>'/^[0-9\.\-_\x20]+$/'),
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
			'city' => Yii::t('cooperation','Region'),
			'email' => 'Email',
			'gender' => Yii::t('common','gender'),
			'tele' => Yii::t('cooperation','Tel'),
			'phone' => Yii::t('cooperation','Mob'),
			'name' => Yii::t('cooperation','Name'),
			'company' => Yii::t('cooperation','Company Name'),
			'business' => Yii::t('cooperation','Industry involved'),
			'lastyear' => Yii::t('cooperation','lastyear'),
			'thisyear' => Yii::t('cooperation','Current Products'),
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

		$criteria->compare('id',$this->id);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('tele',$this->tele,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('business',$this->business,true);
		$criteria->compare('lastyear',$this->lastyear,true);
		$criteria->compare('thisyear',$this->thisyear,true);
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
		}
		return true;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Event1311Register the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
