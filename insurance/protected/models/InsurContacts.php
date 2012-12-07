<?php
class InsurContacts extends CActiveRecord
{

	public $mapZoomLevel;
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
			array('baranch_name, address, phone, region', 'required'),
			array('create_date, status, latitude, longitude, mapZoomLevel', 'safe'),



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
			'baranch_name' => 'Название филиала',
			'address' => 'Адрес',
			'phone' => 'Телефон',
			'status' => 'Статус',
			'create_date' => 'Дата создания',
			'region' => 'Название региона',

		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($params=false,$pager=false)
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
		$criteria->compare('status',$this->status,true);
		$criteria->compare('create_date',$this->create_date);
		$criteria->compare('latitude',$this->latitude);
		$criteria->compare('longitude',$this->longitude);
		$criteria->compare('mapZoomLevel',$this->mapZoomLevel);
		$criteria->compare('region',$this->region);
		if($pager){
			return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
			));
		}else{
			return new CActiveDataProvider($this);
		}
	}
}