<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Students;

/**
 * StudentsSearch represents the model behind the search form about `backend\models\Students`.
 */
class StudentsSearch extends Students
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'phone_no', 'b_form_no', 'parent_id', 'teacher_id', 'class_id', 'school_id', 'user_id', 'fee_id', 'created_by', 'updated_by', 'status_id'], 'integer'],
            [['student_code', 'firstName', 'lastName', 'email', 'image', 'created_date', 'updated_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Students::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'phone_no' => $this->phone_no,
            'b_form_no' => $this->b_form_no,
            'parent_id' => $this->parent_id,
            'teacher_id' => $this->teacher_id,
            'class_id' => $this->class_id,
            'school_id' => $this->school_id,
            'user_id' => $this->user_id,
            'fee_id' => $this->fee_id,
            'created_by' => $this->created_by,
            'created_date' => $this->created_date,
            'updated_by' => $this->updated_by,
            'updated_date' => $this->updated_date,
            'status_id' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', 'student_code', $this->student_code])
            ->andFilterWhere(['like', 'firstName', $this->firstName])
            ->andFilterWhere(['like', 'lastName', $this->lastName])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
