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
class InsurBanners extends CActiveRecord
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
		return 'insur_banners';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			/* array('insur_coworkers_id', 'required'),
			array('status, insur_coworkers_id, object_id', 'numerical', 'integerOnly'=>true),
			array('content, created', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, content, created, status, insur_coworkers_id, object_id', 'safe', 'on'=>'search'), */
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

		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($params = false,$pager=false)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		if($params){
			$criteria->condition = $params;
		}
		$criteria->compare('id',$this->id);
		$criteria->compare('src',$this->src,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('date_edit',$this->date_edit);
		$criteria->compare('place',$this->place);
		if($pager){
			return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'pagination'=>array('pageSize'=>3),
		));
		}else{
			return new CActiveDataProvider($this);
		}
	}
}