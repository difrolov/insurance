<?php

/**
 * This is the model class for table "insur_article_content".
 *
 * The followings are the available columns in table 'insur_article_content':
 * @property integer $id
 * @property string $content
 * @property string $created
 * @property integer $status
 * @property integer $insur_coworkers_id
 * @property integer $object_id
 *
 * The followings are the available model relations:
 * @property InsurInsuranceObject $object
 * @property InsurCoworkers $insurCoworkers
 */
class InsurArticleContent extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return InsurArticleContent the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'insur_article_content';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('insur_coworkers_id', 'required'),
			array('status, insur_coworkers_id, object_id', 'numerical', 'integerOnly'=>true),
			array('content, created', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, content, created, status, insur_coworkers_id, object_id', 'safe', 'on'=>'search'),
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
			'object' => array(self::BELONGS_TO, 'InsurInsuranceObject', 'object_id'),
			/* 'insurCoworkers' => array(self::BELONGS_TO, 'InsurCoworkers', 'insur_coworkers_id'), */
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'content' => 'Content',
			'created' => 'Created',
			'status' => 'Status',
			'insur_coworkers_id' => 'Insur Coworkers',
			'object_id' => 'Object',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($params = false)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		if($params){
			$criteria->condition = $params;
		}
		$criteria->compare('id',$this->id);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('insur_coworkers_id',$this->insur_coworkers_id);
		$criteria->compare('object_id',$this->object_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}