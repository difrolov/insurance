<?php

/**
 * This is the model class for table "insur_insurance_object".
 *
 * The followings are the available columns in table 'insur_insurance_object':
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property integer $parent_id
 * @property string $action
 * @property integer $category_id
 * @property string $date_changes
 *
 * The followings are the available model relations:
 * @property InsurArticleContent[] $insurArticleContents
 * @property InsurObjectCategory $category
 */
class InsurInsuranceObject extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return InsurInsuranceObject the static model class
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
		return 'insur_insurance_object';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('status, parent_id, category_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>100),
			array('action', 'length', 'max'=>255),
			array('date_changes', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, status, parent_id, action, category_id, date_changes', 'safe', 'on'=>'search'),
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
			'insurArticleContents' => array(self::HAS_MANY, 'InsurArticleContent', 'object_id'),
			'category' => array(self::BELONGS_TO, 'InsurObjectCategory', 'category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Имя',
			'status' => 'Status',
			'parent_id' => 'Parent',
			'action' => 'Action',
			'category_id' => 'Category',
			'date_changes' => 'Date Changes',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('action',$this->action,true);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('date_changes',$this->date_changes,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}