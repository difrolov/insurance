<?php
class InsurJobs extends CActiveRecord
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
		return 'insur_jobs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('jobs_name', 'required'),
			array('requirements, responsibility, terms, job, contact_name, creat_date, status', 'safe'),


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
			'id' => 'ID',
			'jobs_name' => 'Наименование вакансии',
			'requirements' => 'Требования',
			'responsibility' => 'Обязанности',
			'terms' => 'Условия',
			'job' => 'Место работы',
			'contact_name' => 'Контактное лицо',
			'status' => 'Статус',
			'creat_date' => 'Дата создания',
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
		$criteria->compare('jobs_name',$this->jobs_name,true);
		/* $criteria->compare('status',$this->status);*/
		$criteria->compare('requirements',$this->requirements);
		$criteria->compare('responsibility',$this->responsibility,true);
		$criteria->compare('terms',$this->terms);
		$criteria->compare('job',$this->job,true);
		$criteria->compare('contact_name',$this->contact_name);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('creat_date',$this->creat_date);
		if($pager){
			return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
			));
		}else{
			return new CActiveDataProvider($this);
		}
	}
}