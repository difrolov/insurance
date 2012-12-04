<?php

/**
 * This is the model class for table "insur_coworkers".
 *
 * The followings are the available columns in table 'insur_coworkers':
 * @property integer $id
 * @property integer $id_role
 * @property string $name_middlename_surname
 * @property integer $insur_workers_roles_id
 *
 * The followings are the available model relations:
 * @property InsurArticleContent[] $insurArticleContents
 * @property InsurWorkersRoles $insurWorkersRoles
 */
class InsurCoworkers extends CActiveRecord
{
	const ROLE_ADMIN = 'admin';
	public $rememberMe;
	public $role;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return InsurCoworkers the static model class
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
		return 'insur_coworkers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_role, insur_workers_roles_id', 'required'),
			array('id_role, insur_workers_roles_id', 'numerical', 'integerOnly'=>true),
			array('name_middlename_surname', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_role, name_middlename_surname, insur_workers_roles_id', 'safe', 'on'=>'search'),
				array('id, login, password, status, role', 'required'),
				array('id, status, role', 'numerical', 'integerOnly'=>true),
				array('login', 'length', 'max'=>100),
				array('password', 'length', 'max'=>255),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, login, password, status, role', 'safe', 'on'=>'search'),
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
			'insurArticleContents' => array(self::HAS_MANY, 'InsurArticleContent', 'insur_coworkers_id'),
			'insurWorkersRoles' => array(self::BELONGS_TO, 'InsurWorkersRoles', 'insur_workers_roles_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_role' => 'Id Role',
			'name_middlename_surname' => 'Name Middlename Surname',
			'insur_workers_roles_id' => 'Insur Workers Roles',
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
		$criteria->compare('id_role',$this->id_role);
		$criteria->compare('name_middlename_surname',$this->name_middlename_surname,true);
		$criteria->compare('insur_workers_roles_id',$this->insur_workers_roles_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}