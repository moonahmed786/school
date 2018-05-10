<?php

namespace api\controllers;

use Yii;
use yii\rest\ActiveController;
use frontend\models\Artists;
use frontend\models\ArtistsSearch;
// use yii\web\Controller;
// use yii\web\NotFoundHttpException;
// use yii\filters\VerbFilter;
use yii\helpers\Json;
use api\logics\Response;
use  yii\helpers\BaseStringHelper;

/**
 * ArtistsController implements the CRUD actions for Artists model.
 */

class ArtistsController extends ActiveController
{
    public $modelClass = 'frontend\models\Artists';
    
    public function actionGetIndex()
    {
        if(Yii::$app->request->isAjax){
            $artists    = \frontend\models\Artists::find()->select(['name','email','city'])->asArray()->all();
            return Response::successReturn($artists);   
        }
        else
        {
            $artists    = \frontend\models\Artists::find()->select(['name','email','city'])->asArray()->all();
            return Response::successReturn($artists); 
        }
    }

    public function actionGetCreate()
    {
        // if(Yii::$app->request->isAjax && Yii::$app->request->isPost)
        // {
            if(!Yii::$app->user->isGuest)
            {
                $post = Yii::$app->request->post();
                $name = $post['name'];
                $email = $post['email'];
                $city = $post['city'];

                $model = new Artists();
                $model->name = $name;
                $model->email = $email;
                $model->city = $city;
                $model->created_by = 1;
                $model->updated_by = 1;
                $model->save(false);
                $data = "Succussfully Added !";
            }
            else
            {
                $post = Yii::$app->request->post();
                $name = $post['name'];
                $email = $post['email'];
                $city = $post['city'];

                $model = new Artists();
                $model->name = $name;
                $model->email = $email;
                $model->city = $city;
                $model->created_by = 1;
                $model->updated_by = 1;
                $model->save(false);
                $data = "Succussfully Added !";
            }
        return Response::successReturn($data);
        //}    
    }

    public function actionGetUpdate()
    {
        $post = Yii::$app->request->post();
        $id = $post['id'];
        $name = $post['name'];
        $email = $post['email'];
        $city = $post['city']; 
        $model = $this->findModel($id);
        $model->name = $name;
        $model->email = $email;
        $model->city = $city;
        $model->created_by = 1;
        $model->updated_by = 1;
        $model->save(false);
        $data = "Succussfully Updated !";
        return Response::successReturn($data);
    }

    public function actionGetDelete()
    {
        $post = Yii::$app->request->post();
        $id = $post['id']; 
        $this->findModel($id)->delete();
        $data = "Succussfully Deleted !";
        return Response::successReturn($data);
    }

    protected function findModel($id)
    {
        if (($model = Artists::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
