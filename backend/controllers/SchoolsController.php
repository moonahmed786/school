<?php

namespace backend\controllers;

use Yii;
use backend\models\Schools;
use backend\models\SchoolsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * SchoolsController implements the CRUD actions for Schools model.
 */
class SchoolsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Schools models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SchoolsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Schools model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Schools model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        //$model = new Schools();
        // echo "<pre>";
        // print_r(Yii::$app->request->post());
        // exit;
        $model = new Schools(['scenario' => 'create']);
        $states = ArrayHelper::map($this->getStatesList($model->country_id),'id','name');
        $cities = ArrayHelper::map($this->getCititesList($model->state_id),'id','name');
        if ($model->load(Yii::$app->request->post())) 
        {
            try{
                $picture = UploadedFile::getInstance($model, 'logo');
                $model->logo = $_POST['Schools']['logo'].'.'.$picture->extension;
           }catch(Exception $e){
               Yii::$app->getSession()->setFlash('error',"{$e->getMessage()}");
           }

            if(isset($model->country_id))
            {
                $states = ArrayHelper::map($this->getStatesList($model->country_id),'id','name');   
            }
            if(isset($model->state_id))
            {
               $cities = ArrayHelper::map($this->getCititesList($model->state_id),'id','name'); 
            }
            if($model->save())
            {
                $picture->saveAs('uploads/' . $model->logo.'.'.$picture->extension);
                Yii::$app->getSession()->setFlash('success','Data saved!');
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else
            {
                Yii::$app->getSession()->setFlash('error','Data not saved!');
                return $this->render('create', [
                    'model' => $model,
                    'states'=>$states,
                    'cities'=>$cities,
                ]);
            }   
        } else {
            return $this->render('create', [
                'model' => $model,
                'states'=>$states,
                'cities'=>$cities,
            ]);
        }
    }

    /**
     * Updates an existing Schools model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $states = ArrayHelper::map($this->getStatesList($model->country_id),'id','name');
        $cities = ArrayHelper::map($this->getCititesList($model->state_id),'id','name');

        if ($model->load(Yii::$app->request->post())) 
        {
            if(isset($model->country_id))
            {
                $states = ArrayHelper::map($this->getStatesList($model->country_id),'id','name');   
            }
            if(isset($model->state_id))
            {
               $cities = ArrayHelper::map($this->getCititesList($model->state_id),'id','name'); 
            }

            if($model->save())
            {
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else {
                return $this->render('update', [
                    'model' => $model,
                    'states'=>$states,
                    'cities'=>$cities,
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'states'=>$states,
                'cities'=>$cities,
            ]);
        }
    }

    /**
     * Deletes an existing Schools model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Schools model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Schools the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Schools::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSubStates() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $country_id = $parents[0];
                // $state = \app\models\States::find()->where(['country_id' => $country_id])->all();
                // $all_state = array();
                // $i = 0;
                // foreach ($state as $value) {
                //     $all_state[$i]['id'] = $value['id'];
                //     $all_state[$i]['name'] = $value['title'];
                //     $i++;
                // }
                $out = self::getStatesList($country_id);
                // echo "<pre>";
                // print_r($out);
                // exit; 
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }
    public static function getStatesList($country_id){
        $data= \backend\models\States::find()
           ->where(['country_id'=>$country_id])
           ->select(['id','name AS name' ])->asArray()->all();   
        return $data;
    }
     
    public function actionSubCities() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            
            if ($parents != null) {
                $state_id = $parents[0];
                $data = self::getCititesList($state_id);
                /**
                 * the getProdList function will query the database based on the
                 * cat_id and sub_cat_id and return an array like below:
                 *  [
                 *      'out'=>[
                 *          ['id'=>'<prod-id-1>', 'name'=>'<prod-name1>'],
                 *          ['id'=>'<prod_id_2>', 'name'=>'<prod-name2>']
                 *       ],
                 *       'selected'=>'<prod-id-1>'
                 *  ]
                 */
               
               echo Json::encode(['output'=>$data, 'selected'=>'']);
               return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public static function getCititesList($state_id){
        $data= \backend\models\Cities::find()
           ->where(['state_id'=>$state_id])
           ->select(['id','name AS name' ])->asArray()->all();
        return $data;
    }

public function actionLogoUpload()
{
    $model = new Schools();
    $imageFile = UploadedFile::getInstance($model, 'logo');
    $directory = Yii::getAlias('@backend/web/img/school/logo/');
    if (!is_dir($directory)) {
        FileHelper::createDirectory($directory);
    }

    if ($imageFile) {
        $uid = uniqid(time(), true);
        $fileName = $uid . '.' . $imageFile->extension;
        $filePath = $directory . $fileName;
        if ($imageFile->saveAs($filePath)) {
            $path = Yii::getAlias('@backend/web/img/school/logo/') . $fileName;
            return Json::encode([
                        'name' => $fileName,
                        'size' => $imageFile->size,
                        'url' => $path,
                        'thumbnailUrl' => $path,
                        'deleteUrl' => 'image-delete?name=' . $fileName,
                        'deleteType' => 'POST',
            ]);
        }
    }

    return '';
}
}
