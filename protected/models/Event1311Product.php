<?php

/**
 * This is the model class for table "event_1311_product".
 *
 * The followings are the available columns in table 'event_1311_product':
 * @property integer $id
 * @property string $pid
 * @property string $title
 * @property string $desp
 * @property string $standard
 * @property string $performance
 * @property integer $recommend
 * @property string $htmlhead
 * @property string $ctime
 * @property string $mtime
 * @property string $type
 */
class Event1311Product extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'event_1311_product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pid, title, desp, standard, performance, htmlhead, type', 'required'),
			array('recommend', 'numerical', 'integerOnly'=>true),
			array('pid, title, type', 'length', 'max'=>255),
			array('ctime, mtime', 'length', 'max'=>11),
			array('language', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, pid, title, desp, standard, performance, recommend, htmlhead, ctime, mtime, type', 'safe', 'on'=>'search'),
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
			'pid' => Yii::t('product','pid'),
			'title' => Yii::t('product','title'),
			'desp' => Yii::t('product','desp'),
			'standard' => Yii::t('product','standard'),
			'performance' => Yii::t('product','performance'),
			'recommend' => Yii::t('product','recommend'),
			'htmlhead' => Yii::t('product','seo'),
			'ctime' => Yii::t('product','ctime'),
			'mtime' => Yii::t('product','mtime'),
			'type' => Yii::t('product','type'),
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
		$criteria->compare('pid',$this->pid,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('desp',$this->desp,true);
		$criteria->compare('standard',$this->standard,true);
		$criteria->compare('performance',$this->performance,true);
		$criteria->compare('recommend',$this->recommend);
		$criteria->compare('htmlhead',$this->htmlhead,true);
		$criteria->compare('ctime',$this->ctime,true);
		$criteria->compare('mtime',$this->mtime,true);
		$criteria->compare('type',$this->type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function defaultScope() {
        return array(
            'alias' => 'product',
            'condition' => "product.language=:LANG and product.display=1",
            'params' => array(':LANG'=>Yii::app()->language),
        );
    }

	public function beforeSave() {
		parent::beforeSave();
		if( !isset($this->language) || $this->language == '' )
			$this->language = Yii::app()->language;
		return true;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Event1311Product the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
