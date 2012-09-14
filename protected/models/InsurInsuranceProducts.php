<?php

/**
 * This is the model class for table "insur_insurance_products".
 *
 * The followings are the available columns in table 'insur_insurance_products':
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property integer $parent_id
 *
 * The followings are the available model relations:
 * @property InsurInsuranceProductsMatrix[] $insurInsuranceProductsMatrixes
 * @property InsurSetForSubjectsMatrix[] $insurSetForSubjectsMatrixes
 * @property InsurSetOfProductsMatrix[] $insurSetOfProductsMatrixes
 */
class InsurInsuranceProducts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return InsurInsuranceProducts the static model class
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
		return 'insur_insurance_products';
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
			array('status, parent_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, status, parent_id', 'safe', 'on'=>'search'),
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
			'insurInsuranceProductsMatrixes' => array(self::HAS_MANY, 'InsurInsuranceProductsMatrix', 'id_parent_product'),
			'insurSetForSubjectsMatrixes' => array(self::HAS_MANY, 'InsurSetForSubjectsMatrix', 'id_product'),
			'insurSetOfProductsMatrixes' => array(self::HAS_MANY, 'InsurSetOfProductsMatrix', 'product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'status' => 'Status',
			'parent_id' => 'Parent',
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}