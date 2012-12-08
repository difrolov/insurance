<?php
class InsurNews extends CActiveRecord
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
		return 'insur_news';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, content', 'required'),
			array('date_edit, status, img', 'safe'),



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
			'name' => 'Название филиала',
			'content' => 'Текст статьи',
			'status' => 'Статус',
			'date_edit' => 'Дата Изменения',
			'img' => 'картинка статьи',

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

		$criteria->compare('name',$this->name);
		$criteria->compare('content',$this->content);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('date_edit',$this->date_edit);
		$criteria->compare('img',$this->img);
		if($pager){
			return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
			));
		}else{
			return new CActiveDataProvider($this);
		}
	}
}