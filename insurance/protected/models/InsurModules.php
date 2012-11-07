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
class InsurModules extends CActiveRecord
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
		return 'insur_modules';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('object_id', 'required'),

		);
	}

	/**
	 * @return array relational rules.
	 */


	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',

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
		$criteria->compare('object_id',$this->object_id,true);
		$criteria->compare('content_id',$this->content_id,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}