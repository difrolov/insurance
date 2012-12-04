<?php
class InsurContactss extends CActiveRecord
{
	/* public $id;
	public $jobs_name;
	public $requirements;
	public $responsibility;
	public $terms;
	public $job;
	public $contact_name;
	public $status;
	public $creat_date; */
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
		return 'insur_contacts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('baranch_name, address, phone', 'required'),



			// The following rule is used by search().
			// Please remove those attributes that should not be searched.

		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'baranch_name' => 'Название региона',
			'address' => 'Адрес',
			'phone' => 'Телефон',
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

		$criteria->compare('baranch_name',$this->baranch_name);
		$criteria->compare('address',$this->address,true);
		/* $criteria->compare('status',$this->status);*/
		$criteria->compare('phone',$this->phone);
		if($pager){
			return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
			));
		}else{
			return new CActiveDataProvider($this);
		}
	}
}