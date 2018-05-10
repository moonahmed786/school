<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "schools".
 *
 * @property integer $id
 * @property string $title
 * @property string $ower_name
 * @property integer $phone_no
 * @property string $email
 * @property integer $cnic
 * @property string $address
 * @property string $logo
 * @property integer $user_id
 * @property integer $country_id
 * @property integer $state_id
 * @property integer $city_id
 * @property integer $created_by
 * @property string $created_date
 * @property integer $updated_by
 * @property string $updated_date
 * @property integer $status_id
 *
 * @property Classes[] $classes
 * @property Fees[] $fees
 * @property Parents[] $parents
 * @property User $user
 * @property Countries $country
 * @property States $state
 * @property Cities $city
 * @property User $createdBy
 * @property User $updatedBy
 * @property Status $status
 * @property Students[] $students
 * @property Teachers[] $teachers
 * @property UserProfile[] $userProfiles
 */
class Schools extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'schools';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'ower_name', 'phone_no', 'email', 'cnic', 'address', 'created_date'], 'required'],
            [['user_id', 'country_id', 'state_id', 'city_id', 'created_by', 'updated_by', 'status_id'], 'integer'],
            [['address','phone_no','cnic'], 'string'],
            [['created_date', 'updated_date'], 'safe'],
            [['title', 'ower_name'], 'string', 'max' => 255],
            [['logo'],'required','on' => 'create'],
            [['logo'],'file','extensions'=>'jpg, jpeg, png', 'maxSize'=>1024 * 1024 * 1],
            [['background'],'required','on' => 'create'],
            [['background'],'file','extensions'=>'jpg, jpeg, png', 'maxSize'=>1024 * 1024 * 1],
            [['email'], 'string', 'max' => 128],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['country_id' => 'id']],
            [['state_id'], 'exist', 'skipOnError' => true, 'targetClass' => States::className(), 'targetAttribute' => ['state_id' => 'id']],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'School Name',
            'ower_name' => 'Ower Name',
            'phone_no' => 'Phone Number',
            'email' => 'Email',
            'cnic' => 'CNIC',
            'address' => 'Address',
            'logo' => 'Logo',
            'background' =>'Background',
            'user_id' => 'User Name',
            'country_id' => 'Country',
            'state_id' => 'State',
            'city_id' => 'City',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'updated_by' => 'Updated By',
            'updated_date' => 'Updated Date',
            'status_id' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClasses()
    {
        return $this->hasMany(Classes::className(), ['school_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFees()
    {
        return $this->hasMany(Fees::className(), ['school_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParents()
    {
        return $this->hasMany(Parents::className(), ['school_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Countries::className(), ['id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getState()
    {
        return $this->hasOne(States::className(), ['id' => 'state_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Students::className(), ['school_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeachers()
    {
        return $this->hasMany(Teachers::className(), ['school_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfiles()
    {
        return $this->hasMany(UserProfile::className(), ['school_id' => 'id']);
    }
}
