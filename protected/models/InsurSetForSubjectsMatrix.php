<?php

/**
 * This is the model class for table "insur_set_for_subjects_matrix".
 *
 * The followings are the available columns in table 'insur_set_for_subjects_matrix':
 * @property integer $id
 * @property integer $id_subject
 * @property integer $id_product
 *
 * The followings are the available model relations:
 * @property InsurInsuranceProducts $idProduct
 * @property InsurSubjectOfInsurance $idSubject
 */
class InsurSetForSubjectsMatrix extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return InsurSetForSubjectsMatrix the static model class
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
		return 'insur_set_for_subjects_matrix';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_subject, id_product', 'required'),
			array('id_subject, id_product', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_subject, id_product', 'safe', 'on'=>'search'),
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
			'idProduct' => array(self::BELONGS_TO, 'InsurInsuranceProducts', 'id_product'),
			'idSubject' => array(self::BELONGS_TO, 'InsurSubjectOfInsurance', 'id_subject'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_subject' => 'Id Subject',
			'id_product' => 'Id Product',
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
		$criteria->compare('id_subject',$this->id_subject);
		$criteria->compare('id_product',$this->id_product);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}