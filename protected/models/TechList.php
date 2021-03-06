<?php

/**
 * This is the model class for table "tech_list".
 *
 * The followings are the available columns in table 'tech_list':
 * @property integer $id
 * @property integer $tech_id
 * @property string $title
 * @property integer $position
 *
 * The followings are the available model relations:
 * @property Tech $tech
 */
class TechList extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tech_list';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, tech_id, title, position', 'required'),
			array('id, tech_id, position', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, tech_id, title, position', 'safe', 'on'=>'search'),
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
			'tech' => array(self::BELONGS_TO, 'Tech', 'tech_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'tech_id' => 'Tech',
			'title' => 'Title',
			'position' => 'Position',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('tech_id',$this->tech_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('position',$this->position);

        $pagination = new CPagination; $pagination->pageSize = Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination' => $pagination,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TechList the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
