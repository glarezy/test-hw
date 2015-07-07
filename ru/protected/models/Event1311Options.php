<?php

/**
 * This is the model class for table "event_1311_options".
 *
 * The followings are the available columns in table 'event_1311_options':
 * @property integer $id
 * @property string $title
 * @property string $htmlhead
 * @property string $language
 * @property string $ctime
 * @property string $mtime
 */
class Event1311Options extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'event_1311_options';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, htmlhead', 'required'),
			array('title', 'length', 'max'=>255),
			array('language', 'length', 'max'=>50),
			array('ctime, mtime', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, htmlhead, language, ctime, mtime', 'safe', 'on'=>'search'),
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
			'title' => Yii::t('common','deftitle'),
			'htmlhead' => Yii::t('common','meta'),
			'language' => 'Language',
			'ctime' => 'Ctime',
			'mtime' => 'Mtime',
		);
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
		}
		if( !isset($this->mtime) || $this->mtime == '' )
			$this->mtime = time();
		return true;
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('htmlhead',$this->htmlhead,true);
		$criteria->compare('language',$this->language,true);
		$criteria->compare('ctime',$this->ctime,true);
		$criteria->compare('mtime',$this->mtime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Event1311Options the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
