<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "students".
 *
 * @property integer $id
 * @property string $student_code
 * @property string $firstName
 * @property string $lastName
 * @property integer $phone_no
 * @property string $email
 * @property integer $b_form_no
 * @property string $image
 * @property integer $parent_id
 * @property integer $teacher_id
 * @property integer $class_id
 * @property integer $school_id
 * @property integer $user_id
 * @property integer $fee_id
 * @property integer $created_by
 * @property string $created_date
 * @property integer $updated_by
 * @property string $updated_date
 * @property integer $status_id
 *
 * @property Parents $parent
 * @property Teachers $teacher
 * @property Classes $class
 * @property Schools $school
 * @property User $user
 * @property Fees $fee
 * @property User $createdBy
 * @property User $updatedBy
 * @property Status $status
 */
class Students extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'students';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_code', 'firstName', 'lastName', 'phone_no', 'email', 'b_form_no', 'image', 'created_date'], 'required'],
            [['phone_no', 'b_form_no', 'parent_id', 'teacher_id', 'class_id', 'school_id', 'user_id', 'fee_id', 'created_by', 'updated_by', 'status_id'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['student_code', 'firstName', 'lastName', 'image'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 128],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Parents::className(), 'targetAttribute' => ['parent_id' => 'id']],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teachers::className(), 'targetAttribute' => ['teacher_id' => 'id']],
            [['class_id'], 'exist', 'skipOnError' => true, 'targetClass' => Classes::className(), 'targetAttribute' => ['class_id' => 'id']],
            [['school_id'], 'exist', 'skipOnError' => true, 'targetClass' => Schools::className(), 'targetAttribute' => ['school_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['fee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Fees::className(), 'targetAttribute' => ['fee_id' => 'id']],
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
            'student_code' => 'Student Code',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'phone_no' => 'Phone No',
            'email' => 'Email',
            'b_form_no' => 'B Form No',
            'image' => 'Image',
            'parent_id' => 'Parent ID',
            'teacher_id' => 'Teacher ID',
            'class_id' => 'Class ID',
            'school_id' => 'School ID',
            'user_id' => 'User ID',
            'fee_id' => 'Fee ID',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'updated_by' => 'Updated By',
            'updated_date' => 'Updated Date',
            'status_id' => 'Status ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Parents::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(Teachers::className(), ['id' => 'teacher_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClass()
    {
        return $this->hasOne(Classes::className(), ['id' => 'class_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchool()
    {
        return $this->hasOne(Schools::className(), ['id' => 'school_id']);
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
    public function getFee()
    {
        return $this->hasOne(Fees::className(), ['id' => 'fee_id']);
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
}
