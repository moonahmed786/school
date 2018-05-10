<?php
/**
 * Controller for manage Content
 *
 * @author ihor@karas.in.ua
 * Date: 03.04.15
 * Time: 00:35
 */

namespace api\controllers;

use phpDocumentor\Reflection\Types\Null_;
use Yii;
use yii\rest\ActiveController;
use yii\helpers\Json;
use api\logics\Response;

class SiteController extends ActiveController
{
    public $modelClass = 'common\models\block';

    public function actionGetBlock($identifier, $identifier1=Null, $identifier2=Null, $identifier3=Null)
    {
        if(Yii::$app->request->isAjax)
        {
            $block = \common\models\Block::find()->select('details, title, page_id')->where(['identifier' => $identifier])->one();
            $page_id = $block->page_id;
            $data['details'] = $block['details'];
            if($identifier1){
                $block = \common\models\Block::find()->select('details, title')->where(['identifier' => $identifier1])->one();
                $data['details1'] = $block['details'];
            }
            if($identifier2){
                $block = \common\models\Block::find()->select('details, title')->where(['identifier' => $identifier2])->one();
                $data['details2'] = $block['details'];
            }
            if($identifier3){
                $block = \common\models\Block::find()->select('details, title')->where(['identifier' => $identifier3])->one();
                $data['details3'] = $block['details'];
            }
            $data['heading'] = \common\models\Page::find()->select('heading')->where(['id' => $page_id])->one()->heading;
            return 	Response::successReturn($data);
        }
        else
        {
            return $this->goHome();
        }
    }

    public function actionGetNavigation(){
        $navigation    = \common\models\Page::find()->where(["is_menu_page" => '1', 'parent_id' => NULL])->orderBy('sort_order asc')->asArray()->all();
        foreach ($navigation as $key => $nav){
            $child_pages = \common\models\Page::find()->where(["is_menu_page" => '1', 'parent_id' => $nav['id']])->orderBy('sort_order asc')->asArray()->all();
            if($child_pages){
                $navigation[$key]['child_pages'] = $child_pages;
            }
        }

        $data['navigation'] = $navigation;
        return Response::successReturn($data);
    }

    public function actionGetPageVisits(){
        $query = (new \yii\db\Query())->from('user_journey')->where(["user_id"=>Yii::$app->user->id]);

        $data['sleep'] = sprintf("%02d", $query->sum('sleep_visited'));
        $data['medication'] = sprintf("%02d", $query->sum('medication_visited'));
        $data['deconditioning'] = sprintf("%02d", $query->sum('exercise_visited'));
        $data['depression'] = sprintf("%02d", $query->sum('depression_visited'));
        $data['cognitiveFatigue'] = sprintf("%02d", $query->sum('cognitivefatigue_visited'));
        $data['managementStrategies'] = sprintf("%02d", $query->sum('managementstrategies_visited'));
        $data['goals'] = \common\models\Goals::find()->where(["user_id"=>Yii::$app->user->id, 'status'=>'1'])->orderBy('id asc')->all();
        $today_rating = \common\models\UserJourney::find()->where(["user_id"=>Yii::$app->user->id])->orderBy('id desc')->one()->fatigue_rating;
        $data['canSubmit'] = ($today_rating != '-9')? '0':'1';
        $data['goals_name'] = \common\models\GoalsNaming::find()->where(["user_id"=>Yii::$app->user->id, 'status'=>'1'])->orderBy('id asc')->limit(3)->asArray()->all();
        $goals_counting = Yii::$app->db->createCommand('
            SELECT count(id) as count FROM goals
            WHERE user_id = '.Yii::$app->user->id.' AND status = "0"')->queryAll();
        $data['history_count'] = $goals_counting[0]['count'];
        return Response::successReturn($data);
    }


    public function actionSearchContent($keyword)
    {
        $content = (new \yii\db\Query())->select("p.*, b.*")
            ->from("block as b")
            ->innerJoin("page as p","p.id = b.page_id")
            ->where('b.title LIKE "%'.$keyword.'%"')
            ->orWhere('details LIKE "%'.$keyword.'%"')
            ->groupBy('b.page_id')
            ->all();

        return Response::successReturn(['content'=>$content]);
    }

}