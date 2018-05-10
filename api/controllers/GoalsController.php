<?php
/**
 * Controller for manage Goals
 *
 * @author ihor@karas.in.ua
 * Date: 03.04.15
 * Time: 00:35
 */

namespace api\controllers;

use Yii;
use yii\rest\ActiveController;
use common\models\UserJourney;
use common\models\UserJourneyControl;
use yii\helpers\Json;
use api\logics\Response;
use  yii\helpers\BaseStringHelper;

class GoalsController extends ActiveController
{
    public $modelClass = 'common\models\Goals';

    public function actionIndex()
    {
        //
    }

    public function actionGetQuestions($history_id=''){
        if(Yii::$app->request->isAjax){
            $questions    = \common\models\Question::find()->select(['question.*'])
                ->joinWith([
                    'questionOptions' => function (\yii\db\ActiveQuery $query)
                    {
                        $query->orderBy('sort_order asc');
                    }

                ])
                ->where(["question.status" => 'active'])
                ->orderBy('question.sort_order asc');

            $questions = $questions->asArray()->all();
            $data = '';
            $key = 0;
            foreach ($questions as $question){
                $key++;
                $data['question'.$key] = $question['question'];
                $data['questionOption'.$key] = $question['questionOptions'];
            }
            if($history_id == ''){
                $data['goals'] = \common\models\Goals::find()->where(["user_id"=>Yii::$app->user->id, 'status'=>'1'])->orderBy('id asc')->asArray()->all();
            }
            else
            {
                $data['goals'] = \common\models\Goals::find()->where(["user_id"=>Yii::$app->user->id, 'id'=>$history_id, 'status'=>'0'])->orderBy('id asc')->asArray()->all();
            }

            $goals_counting = Yii::$app->db->createCommand('
            SELECT count(id) as count FROM goals
            WHERE user_id = '.Yii::$app->user->id.' AND status = "1"')->queryAll();
            $data['goals_count'] = $goals_counting[0]['count'];
            $goals_counting = Yii::$app->db->createCommand('
            SELECT count(id) as count FROM goals
            WHERE user_id = '.Yii::$app->user->id.' AND status = "0"')->queryAll();
            $data['history_count'] = $goals_counting[0]['count'];
            $data['categories'] = \common\models\Strategy::find()->where(["parent_id"=>Null])->orderBy('sort_order asc')->asArray()->all();
            $data['sleep'] = \common\models\Strategy::find()->where(["parent_id"=>'1'])->orderBy('sort_order asc')->asArray()->all();
            $data['medication'] = \common\models\Strategy::find()->where(["parent_id"=>'2'])->orderBy('sort_order asc')->asArray()->all();
            $data['deconditioning'] = \common\models\Strategy::find()->where(["parent_id"=>'3'])->orderBy('sort_order asc')->asArray()->all();
            $data['cognitive'] = \common\models\Strategy::find()->where(["parent_id"=>'4'])->orderBy('sort_order asc')->asArray()->all();
            $data['depression'] = \common\models\Strategy::find()->where(["parent_id"=>'5'])->orderBy('sort_order asc')->asArray()->all();
            $data['general'] = \common\models\Strategy::find()->where(["parent_id"=>'6'])->orderBy('sort_order asc')->asArray()->all();
            foreach ($data['sleep'] as $key => $val){
                $data['sleep'][$key]['label'] = '<div class="goal-strategy-list"><strong>Sleep</strong></div><div class="goal-title-list">'.$val['title'].'</div>';
            }
            foreach ($data['medication'] as $key => $val){
                $data['medication'][$key]['label'] = '<div class="goal-strategy-list"><strong>Medication</strong></div><div class="goal-title-list">'.$val['title'].'</div>';
            }
            foreach ($data['deconditioning'] as $key => $val){
                $data['deconditioning'][$key]['label'] = '<div class="goal-strategy-list"><strong>Deconditioning</strong></div><div class="goal-title-list">'.$val['title'].'</div>';
            }
            foreach ($data['cognitive'] as $key => $val){
                $data['cognitive'][$key]['label'] = '<div class="goal-strategy-list"><strong>Cognitive Fatigue</strong></div><div class="goal-title-list">'.$val['title'].'</div>';
            }
            foreach ($data['depression'] as $key => $val){
                $data['depression'][$key]['label'] = '<div class="goal-strategy-list"><strong>Depression</strong></div><div class="goal-title-list">'.$val['title'].'</div>';
            }
            foreach ($data['general'] as $key => $val){
                $data['general'][$key]['label'] = '<div class="goal-strategy-list"><strong>General</strong></div><div class="goal-title-list">'.$val['title'].'</div>';
            }
            foreach ($data['goals'] as $key => $goal){
                if($goal['strategy1']){
                    $strategy = \common\models\Strategy::find()->where(["value"=>$goal['strategy1']])->one();
                    $parent_id = $strategy->parent_id;
                    $title = $strategy->title;
                    $parent = \common\models\Strategy::find()->where(["id"=>$parent_id])->one()->title;
                    $data['goals'][$key]['stg1'] = $goal['strategy1'];
                    $data['goals'][$key]['strategy1'] = '<div class="goal-strategy-list"><strong>'.$parent.'</strong></div><div class="goal-title-list">'.$title.'</div>';
                }
                else{
                    $data['goals'][$key]['strategy1'] = '';
                    $data['goals'][$key]['stg1'] = '';
                }
                if($goal['strategy2']){
                    $strategy = \common\models\Strategy::find()->where(["value"=>$goal['strategy2']])->one();
                    $parent_id = $strategy->parent_id;
                    $title = $strategy->title;
                    $parent = \common\models\Strategy::find()->where(["id"=>$parent_id])->one()->title;
                    $data['goals'][$key]['stg2'] = $goal['strategy2'];
                    $data['goals'][$key]['strategy2'] = '<div class="goal-strategy-list"><strong>'.$parent.'</strong></div><div class="goal-title-list">'.$title.'</div>';
                }
                else{
                    $data['goals'][$key]['strategy2'] = '';
                    $data['goals'][$key]['stg2'] = '';
                }
                if($goal['strategy3']){
                    $strategy = \common\models\Strategy::find()->where(["value"=>$goal['strategy3']])->one();
                    $parent_id = $strategy->parent_id;
                    $title = $strategy->title;
                    $parent = \common\models\Strategy::find()->where(["id"=>$parent_id])->one()->title;
                    $data['goals'][$key]['stg3'] = $goal['strategy3'];
                    $data['goals'][$key]['strategy3'] = '<div class="goal-strategy-list"><strong>'.$parent.'</strong></div><div class="goal-title-list">'.$title.'</div>';
                }
                else{
                    $data['goals'][$key]['strategy3'] = '';
                    $data['goals'][$key]['stg3'] = '';
                }

            }

            $data['goals_name'] = \common\models\GoalsNaming::find()->where(["user_id"=>Yii::$app->user->id, 'status'=>'1'])->orderBy('id asc')->limit(3)->asArray()->all();

            return Response::successReturn($data);
        }
    }

    public function actionSaveGoal(){
        if(Yii::$app->request->isAjax && Yii::$app->request->isPost)
        {
            if(!Yii::$app->user->isGuest)
            {
                $post = Yii::$app->request->post();
                $data = $post['goal'];
                if($post['current'] == '1'){
                    $goal = \common\models\Goals::find()->where(["user_id"=>Yii::$app->user->id, 'status'=>'1'])->orderBy('id asc')->one();
                }
                elseif($post['current'] == '2'){
                    $goal = \common\models\Goals::find()->where(["user_id"=>Yii::$app->user->id, 'status'=>'1'])->orderBy('id asc')->offset(1)->one();
                }
                else{
                    $goal = \common\models\Goals::find()->where(["user_id"=>Yii::$app->user->id, 'status'=>'1'])->orderBy('id asc')->offset(2)->one();
                }

                $goal_id = '';
                /*if($data['question5'] == ''){
                    $data['question5'] = '-9';
                }*/
                if($goal){
                    $goal_id = $goal->id;
                    $goal->what_do_i_want_to_do = $data['question1'];
                    $goal->when_do_i_want_to_do_it = $data['question2'];
                    $goal->how_often_do_i_want_to_do_it = $data['question3'];
                    $goal->how_will_i_know_that_i_have_achieved_this_goal = $data['question4'];
                    $goal->how_confident_am_i_that_i_can_achieve_this_goal = $data['question5'];
                    $goal->save(false);
                }
                else{
                    $goal = new \common\models\Goals;
                    $goal->user_id = Yii::$app->user->id;
                    $goal->what_do_i_want_to_do = $data['question1'];
                    $goal->when_do_i_want_to_do_it = $data['question2'];
                    $goal->how_often_do_i_want_to_do_it = $data['question3'];
                    $goal->how_will_i_know_that_i_have_achieved_this_goal = $data['question4'];
                    $goal->how_confident_am_i_that_i_can_achieve_this_goal = $data['question5'];
                    $goal->save(false);
                    $goal_id = $goal->id;
                }

                if($data['question5'] != '-9'){
                    $goals_rating = new \common\models\GoalsRating;
                    $goals_rating->user_id = Yii::$app->user->id;
                    $goals_rating->goal_id = $goal_id;
                    $goals_rating->value = $data['question5'];
                    $goals_rating->save(false);
                }

                $user_journey_id = \common\models\UserJourney::find()->where(["user_id"=>Yii::$app->user->id])->orderBy('id desc')->one()->id;
                $goals_journey = \common\models\GoalsJourney::find()->where(["journey_id"=>$user_journey_id, 'goal_id' => $goal_id])->one();
                if($goals_journey){
                    $goals_journey->what_do_i_want_to_do_text = $data['question1'];
                    $goals_journey->when_do_i_want_to_start_doing_it = $data['question2'];
                    $goals_journey->how_often_do_i_want_to_do_it = $data['question3'];
                    $goals_journey->how_will_i_know_that_i_have_achieved_this_goal = $data['question4'];
                    $goals_journey->how_confident_am_I_that_can_achieve_this_goal = $data['question5'];
                }
                else
                {
                    $goals_journey = new \common\models\GoalsJourney;
                    $goals_journey->goal_id = $goal_id;
                    $goals_journey->journey_id = $user_journey_id;
                    $goals_journey->what_do_i_want_to_do_text = $data['question1'];
                    $goals_journey->when_do_i_want_to_start_doing_it = $data['question2'];
                    $goals_journey->how_often_do_i_want_to_do_it = $data['question3'];
                    $goals_journey->how_will_i_know_that_i_have_achieved_this_goal = $data['question4'];
                    $goals_journey->how_confident_am_I_that_can_achieve_this_goal = $data['question5'];
                }

                $goals_journey->save(false);
                $check_goals = \common\models\GoalsNaming::find()->where(["user_id"=>Yii::$app->user->id])->one();
                if(!$check_goals){
                    for($i=1; $i < 16; $i++){
                        $goals_naming = new \common\models\GoalsNaming;
                        $goals_naming->user_id =  Yii::$app->user->id;
                        $goals_naming->title =  'Goal'.' '.$i;
                        $goals_naming->status =  '1';
                        $goals_naming->save(false);
                    }
                }


                $data['goals'] = \common\models\Goals::find()->where(["user_id"=>Yii::$app->user->id, 'status'=>'1'])->orderBy('id asc')->asArray()->all();
                $goals_counting = Yii::$app->db->createCommand('
            SELECT count(id) as count FROM goals
            WHERE user_id = '.Yii::$app->user->id.' AND status = "1"')->queryAll();
                $data['goals_count'] = $goals_counting[0]['count'];
                $goals_counting = Yii::$app->db->createCommand('
            SELECT count(id) as count FROM goals
            WHERE user_id = '.Yii::$app->user->id.' AND status = "0"')->queryAll();
                $data['history_count'] = $goals_counting[0]['count'];
                return Response::successReturn($data);

            }
        }
    }

    public function actionSaveGoals(){
        if(Yii::$app->request->isAjax && Yii::$app->request->isPost)
        {
            if(!Yii::$app->user->isGuest)
            {
                $post = Yii::$app->request->post();
                $id = $post['id'];
                $data = $post['goal'];
                $strategies = $post['strategies'];
                if($post['current'] == '1'){
                    $goal = \common\models\Goals::find()->where(["user_id"=>Yii::$app->user->id, 'status'=>'1'])->orderBy('id asc')->one();
                }
                elseif($post['current'] == '2'){
                    $goal = \common\models\Goals::find()->where(["user_id"=>Yii::$app->user->id, 'status'=>'1'])->orderBy('id asc')->offset(1)->one();
                }
                else{
                    $goal = \common\models\Goals::find()->where(["user_id"=>Yii::$app->user->id, 'status'=>'1'])->orderBy('id asc')->offset(2)->one();
                }

                $goal_id = '';
                $goal_id = '';
                if($data['question5'] == ''){
                    $data['question5'] = '-9';
                }
                if($data['question6'] == ''){
                    $data['question6'] = '-9';
                }

                if($goal){
                    $goal_id = $goal->id;
                    $goal->what_do_i_want_to_do = $data['question1'];
                    $goal->when_do_i_want_to_do_it = $data['question2'];
                    $goal->how_often_do_i_want_to_do_it = $data['question3'];
                    $goal->how_will_i_know_that_i_have_achieved_this_goal = $data['question4'];
                    if($strategies == ''){
                        $goal->how_confident_am_i_that_i_can_achieve_this_goal = $data['question5'];
                        $goal->how_is_your_goal_completion_progressing = $data['question6'];
                    }
                    if($data['question6'] == '3'){
                        $goals_naming = \common\models\GoalsNaming::find()->where(["id"=>$id])->one();
                        $goals_naming->status = '0';
                        $goals_naming->save(false);
                        $goal->status = '0';
                        $goal->reason = 'Achieved';
                    }
                    if($data['question6'] == '4'){
                        $goals_naming = \common\models\GoalsNaming::find()->where(["id"=>$id])->one();
                        $goals_naming->status = '0';
                        $goals_naming->save(false);
                        $goal->status = '0';
                        $goal->reason = 'Abandoned';
                    }
                    if($data['stg1'] != ''){
                        $data['stg1'] = ($data['stg1'] == '-9')?'':$data['stg1'];
                        $goal->strategy1 = $data['stg1'];
                    }
                    if($data['stg2'] != ''){
                        $data['stg2'] = ($data['stg2'] == '-9')?'':$data['stg2'];
                        $goal->strategy2 = $data['stg2'];
                    }
                    if($data['stg3'] != ''){
                        $data['stg3'] = ($data['stg3'] == '-9')?'':$data['stg3'];
                        $goal->strategy3 = $data['stg3'];
                    }
                    $goal->save(false);
                }
                else{
                    $goal = new \common\models\Goals;
                    $goal->user_id = Yii::$app->user->id;
                    $goal->what_do_i_want_to_do = $data['question1'];
                    $goal->when_do_i_want_to_do_it = $data['question2'];
                    $goal->how_often_do_i_want_to_do_it = $data['question3'];
                    $goal->how_will_i_know_that_i_have_achieved_this_goal = $data['question4'];
                    $goal->how_confident_am_i_that_i_can_achieve_this_goal = $data['question5'];
                    $goal->how_is_your_goal_completion_progressing = $data['question6'];
                    if($data['question6'] == '3'){
                        $goals_naming = \common\models\GoalsNaming::find()->where(["id"=>$id])->one();
                        $goals_naming->status = '0';
                        $goals_naming->save(false);
                        $goal->status = '0';
                        $goal->reason = 'Achieved';
                    }
                    if($data['question6'] == '4'){
                        $goals_naming = \common\models\GoalsNaming::find()->where(["id"=>$id])->one();
                        $goals_naming->status = '0';
                        $goals_naming->save(false);
                        $goal->status = '0';
                        $goal->reason = 'Abandoned';
                    }
                    if($data['stg1'] != ''){
                        $data['stg1'] = ($data['stg1'] == '-9')?'':$data['stg1'];
                        $goal->strategy1 = $data['stg1'];
                    }
                    if($data['stg2'] != ''){
                        $data['stg2'] = ($data['stg2'] == '-9')?'':$data['stg2'];
                        $goal->strategy2 = $data['stg2'];
                    }
                    if($data['stg3'] != ''){
                        $data['stg3'] = ($data['stg3'] == '-9')?'':$data['stg3'];
                        $goal->strategy3 = $data['stg3'];
                    }
                    $goal->save(false);
                    $goal_id = $goal->id;
                }

                if($strategies == ''){
                    if($data['question5'] != '-9'){
                        $goals_rating = new \common\models\GoalsRating;
                        $goals_rating->user_id = Yii::$app->user->id;
                        $goals_rating->goal_id = $goal_id;
                        $goals_rating->value = $data['question5'];
                        $goals_rating->save(false);
                    }

                    if($data['question6'] != '-9') {
                        $goals_progress = new \common\models\GoalsProgress;
                        $goals_progress->user_id = Yii::$app->user->id;
                        $goals_progress->goal_id = $goal_id;
                        $goals_progress->value = $data['question6'];
                        $goals_progress->save(false);
                    }
                }

                $user_journey_id = \common\models\UserJourney::find()->where(["user_id"=>Yii::$app->user->id])->orderBy('id desc')->one()->id;
                $goals_journey = \common\models\GoalsJourney::find()->where(["journey_id"=>$user_journey_id, 'goal_id' => $goal_id])->one();
                if($goals_journey){
                    $goals_journey->what_do_i_want_to_do_text = $data['question1'];
                    $goals_journey->when_do_i_want_to_start_doing_it = $data['question2'];
                    $goals_journey->how_often_do_i_want_to_do_it = $data['question3'];
                    $goals_journey->how_will_i_know_that_i_have_achieved_this_goal = $data['question4'];
                    if($strategies == ''){
                        $goals_journey->how_confident_am_I_that_can_achieve_this_goal = $data['question5'];
                        $goals_journey->where_am_i_currently_in_accomplishing_this_goal = $data['question6'];
                    }

                    if($data['stg1'] != ''){
                        $goals_journey->strategy1 = $data['stg1'];
                    }
                    if($data['stg2'] != ''){
                        $goals_journey->strategy2 = $data['stg2'];
                    }
                    if($data['stg3'] != ''){
                        $goals_journey->strategy3 = $data['stg3'];
                    }
                }
                else
                {
                    $goals_journey = new \common\models\GoalsJourney;
                    $goals_journey->goal_id = $goal_id;
                    $goals_journey->journey_id = $user_journey_id;
                    $goals_journey->what_do_i_want_to_do_text = $data['question1'];
                    $goals_journey->when_do_i_want_to_start_doing_it = $data['question2'];
                    $goals_journey->how_often_do_i_want_to_do_it = $data['question3'];
                    $goals_journey->how_will_i_know_that_i_have_achieved_this_goal = $data['question4'];
                    $goals_journey->how_confident_am_I_that_can_achieve_this_goal = $data['question5'];
                    $goals_journey->where_am_i_currently_in_accomplishing_this_goal = $data['question6'];
                    if($data['stg1'] != ''){
                        $goals_journey->strategy1 = $data['stg1'];
                    }
                    if($data['stg2'] != ''){
                        $goals_journey->strategy2 = $data['stg2'];
                    }
                    if($data['stg3'] != ''){
                        $goals_journey->strategy3 = $data['stg3'];
                    }
                }

                $goals_journey->save(false);

                $questions    = \common\models\Question::find()->select(['question.*'])
                    ->joinWith([
                        'questionOptions' => function (\yii\db\ActiveQuery $query)
                        {
                            $query->orderBy('sort_order asc');
                        }

                    ])
                    ->where(["question.status" => 'active'])
                    ->orderBy('question.sort_order asc');

                $questions = $questions->asArray()->all();
                $data = '';
                $key = 0;
                foreach ($questions as $question){
                    $key++;
                    $data['question'.$key] = $question['question'];
                    $data['questionOption'.$key] = $question['questionOptions'];
                }
                $data['goals'] = \common\models\Goals::find()->where(["user_id"=>Yii::$app->user->id, 'status'=>'1'])->orderBy('id asc')->asArray()->all();

                $goals_counting = Yii::$app->db->createCommand('
            SELECT count(id) as count FROM goals
            WHERE user_id = '.Yii::$app->user->id.' AND status = "1"')->queryAll();
                $data['goals_count'] = $goals_counting[0]['count'];
                $goals_counting = Yii::$app->db->createCommand('
            SELECT count(id) as count FROM goals
            WHERE user_id = '.Yii::$app->user->id.' AND status = "0"')->queryAll();
                $data['history_count'] = $goals_counting[0]['count'];
                $data['categories'] = \common\models\Strategy::find()->where(["parent_id"=>Null])->orderBy('sort_order asc')->asArray()->all();
                $data['sleep'] = \common\models\Strategy::find()->where(["parent_id"=>'1'])->orderBy('sort_order asc')->asArray()->all();
                $data['medication'] = \common\models\Strategy::find()->where(["parent_id"=>'2'])->orderBy('sort_order asc')->asArray()->all();
                $data['deconditioning'] = \common\models\Strategy::find()->where(["parent_id"=>'3'])->orderBy('sort_order asc')->asArray()->all();
                $data['cognitive'] = \common\models\Strategy::find()->where(["parent_id"=>'4'])->orderBy('sort_order asc')->asArray()->all();
                $data['depression'] = \common\models\Strategy::find()->where(["parent_id"=>'5'])->orderBy('sort_order asc')->asArray()->all();
                $data['general'] = \common\models\Strategy::find()->where(["parent_id"=>'6'])->orderBy('sort_order asc')->asArray()->all();
                foreach ($data['sleep'] as $key => $val){
                    $data['sleep'][$key]['label'] = '<div class="goal-strategy-list"><strong>Sleep</strong></div><div class="goal-title-list">'.$val['title'].'</div>';
                }
                foreach ($data['medication'] as $key => $val){
                    $data['medication'][$key]['label'] = '<div class="goal-strategy-list"><strong>Medication</strong></div><div class="goal-title-list">'.$val['title'].'</div>';
                }
                foreach ($data['deconditioning'] as $key => $val){
                    $data['deconditioning'][$key]['label'] = '<div class="goal-strategy-list"><strong>Deconditioning</strong></div><div class="goal-title-list">'.$val['title'].'</div>';
                }
                foreach ($data['cognitive'] as $key => $val){
                    $data['cognitive'][$key]['label'] = '<div class="goal-strategy-list"><strong>Cognitive Fatigue</strong></div><div class="goal-title-list">'.$val['title'].'</div>';
                }
                foreach ($data['depression'] as $key => $val){
                    $data['depression'][$key]['label'] = '<div class="goal-strategy-list"><strong>Depression</strong></div><div class="goal-title-list">'.$val['title'].'</div>';
                }
                foreach ($data['general'] as $key => $val){
                    $data['general'][$key]['label'] = '<div class="goal-strategy-list"><strong>General</strong></div><div class="goal-title-list">'.$val['title'].'</div>';
                }
                foreach ($data['goals'] as $key => $goal){
                    if($goal['strategy1']){
                        $strategy = \common\models\Strategy::find()->where(["value"=>$goal['strategy1']])->one();
                        $parent_id = $strategy->parent_id;
                        $title = $strategy->title;
                        $parent = \common\models\Strategy::find()->where(["id"=>$parent_id])->one()->title;
                        $data['goals'][$key]['stg1'] = $goal['strategy1'];
                        $data['goals'][$key]['strategy1'] = '<div class="goal-strategy-list"><strong>'.$parent.'</strong></div><div class="goal-title-list">'.$title.'</div>';
                    }
                    else{
                        $data['goals'][$key]['strategy1'] = '';
                        $data['goals'][$key]['stg1'] = '';
                    }
                    if($goal['strategy2']){
                        $strategy = \common\models\Strategy::find()->where(["value"=>$goal['strategy2']])->one();
                        $parent_id = $strategy->parent_id;
                        $title = $strategy->title;
                        $parent = \common\models\Strategy::find()->where(["id"=>$parent_id])->one()->title;
                        $data['goals'][$key]['stg2'] = $goal['strategy2'];
                        $data['goals'][$key]['strategy2'] = '<div class="goal-strategy-list"><strong>'.$parent.'</strong></div><div class="goal-title-list">'.$title.'</div>';
                    }
                    else{
                        $data['goals'][$key]['strategy2'] = '';
                        $data['goals'][$key]['stg2'] = '';
                    }
                    if($goal['strategy3']){
                        $strategy = \common\models\Strategy::find()->where(["value"=>$goal['strategy3']])->one();
                        $parent_id = $strategy->parent_id;
                        $title = $strategy->title;
                        $parent = \common\models\Strategy::find()->where(["id"=>$parent_id])->one()->title;
                        $data['goals'][$key]['stg3'] = $goal['strategy3'];
                        $data['goals'][$key]['strategy3'] = '<div class="goal-strategy-list"><strong>'.$parent.'</strong></div><div class="goal-title-list">'.$title.'</div>';
                    }
                    else{
                        $data['goals'][$key]['strategy3'] = '';
                        $data['goals'][$key]['stg3'] = '';
                    }

                }
                $data['status'] = '1';
                $data['goals_name'] = \common\models\GoalsNaming::find()->where(["user_id"=>Yii::$app->user->id, 'status'=>'1'])->orderBy('id asc')->limit(3)->asArray()->all();

                return Response::successReturn($data);
            }
            else
            {
                $data['status'] = '0';
                return Response::successReturn($data);
            }
        }
    }

    public function actionGetRating($limit=''){
        if($limit == ''){
            $limit = 10;
        }
        if(Yii::$app->request->isAjax)
        {
            $rows = Yii::$app->db->createCommand('SELECT *
            FROM
            (
                SELECT *
                FROM rating
                WHERE user_id = '.Yii::$app->user->id.'
                 ORDER BY created_at DESC
                 LIMIT '.$limit.'
            ) T1
            ORDER BY created_at')->queryAll();
            $values = array();
            $labels = array();
            $time = '';
            foreach ($rows as $row){
                $time = $row['created_at'];
                if($time != ''){
                    $time = date('h:i A', strtotime($time));
                }

                $values[] = $row['value'] + 0;
                $labels[] = date('M d',strtotime($row['created_at'])).'<br>'.$time;

            }
            $date = date('Y-m-d');
            $today_rating = \common\models\UserJourney::find()->where(["user_id"=>Yii::$app->user->id])->orderBy('id desc')->one()->fatigue_rating;
            $canSubmit = ($today_rating != '-9')? '0':'1';
            return Response::successReturn(['values'=>$values, 'labels'=> $labels, 'count'=>count($rows), 'canSubmit' => $canSubmit, 'time'=>$time]);
        }
    }

    public function actionSaveRating(){
        if(Yii::$app->request->isAjax && Yii::$app->request->isPost)
        {
            if(!Yii::$app->user->isGuest)
            {
                $post = Yii::$app->request->post();
                $value = $post['value'];
                $rating = new \common\models\Rating;
                $rating->user_id = Yii::$app->user->id;
                $rating->value = $value;
                $rating->save(false);

                $userJourney = \common\models\UserJourney::find()->where(["user_id"=>Yii::$app->user->id])->orderBy('id desc')->one();
                $userJourney->fatigue_rating = $value;
                $userJourney->time_of_fatigue_rating = date('h:i:s');
                $userJourney->save(false);

                $values = array();
                $labels = array();
                $rows = Yii::$app->db->createCommand('SELECT *
            FROM
            (
                SELECT *
                FROM rating
                WHERE user_id = '.Yii::$app->user->id.'
                 ORDER BY created_at DESC
                 LIMIT 10
            ) T1
            ORDER BY created_at')->queryAll();
                $time = '';
                foreach ($rows as $row){
                    $time = $row['created_at'];
                    if($time != ''){
                        $time = date('h:i A', strtotime($time));
                    }

                    $values[] = $row['value'] + 0;
                    $labels[] = date('M d',strtotime($row['created_at'])).'<br>'.$time;

                }
                $date = date('Y-m-d');
                $today_rating = \common\models\UserJourney::find()->where(["user_id"=>Yii::$app->user->id])->orderBy('id desc')->one()->fatigue_rating;
                $canSubmit = ($today_rating != '-9')? '0':'1';
                return Response::successReturn(['values'=>$values, 'labels'=> $labels, 'count'=>count($rows), 'canSubmit' => $canSubmit, 'time'=>$time, 'status'=> '1']);
            }
            else
            {
                $data['status'] = '0';
                return Response::successReturn($data);
            }
        }
    }

    public function actionSearchRating(){
        if(Yii::$app->request->isAjax && Yii::$app->request->isPost)
        {
            if(!Yii::$app->user->isGuest)
            {
                $post = Yii::$app->request->post();
                $data = $post['data'];
                $start = $data['start'];
                $end = $data['end'];
                if($start == '' && $end == ''){
                    $rows = Yii::$app->db->createCommand('SELECT *
            FROM
            (
                SELECT *
                FROM rating
                WHERE user_id = '.Yii::$app->user->id.'
                 ORDER BY created_at DESC
                 LIMIT 10
            ) T1
            ORDER BY created_at')->queryAll();
                    $values = array();
                    $labels = array();
                    $time = '';
                    foreach ($rows as $row){
                        $time = $row['created_at'];
                        if($time != ''){
                            $time = date('h:i A', strtotime($time));
                        }

                        $values[] = $row['value'] + 0;
                        $labels[] = date('M d',strtotime($row['created_at'])).'<br>'.$time;

                    }
                    $date = date('Y-m-d');
                    $today_rating = \common\models\UserJourney::find()->where(["user_id"=>Yii::$app->user->id])->orderBy('id desc')->one()->fatigue_rating;
                    $canSubmit = ($today_rating != '-9')? '0':'1';
                    return Response::successReturn(['values'=>$values, 'labels'=> $labels, 'count'=>count($rows), 'canSubmit' => $canSubmit, 'time'=>$time, 'status'=> '1']);
                }
                else
                {
                    $rows = Yii::$app->db->createCommand("SELECT * FROM rating WHERE DATE(created_at) >= '".$start."' AND DATE(created_at) <= '".$end."' AND user_id = '".Yii::$app->user->id."'
    ")->queryAll();
                    $values = array();
                    $labels = array();
                    foreach ($rows as $row){
                        $time = $row['created_at'];
                        if($time != ''){
                            $time = date('h:i A', strtotime($time));
                        }

                        $values[] = $row['value'] + 0;
                        $labels[] = date('M d',strtotime($row['created_at'])).'<br>'.$time;

                    }
                    return Response::successReturn(['values'=>$values, 'labels'=> $labels, 'count'=>count($rows), 'time'=>$time, 'status'=> '1']);
                }

            }
            else
            {
                $data['status'] = '0';
                return Response::successReturn($data);
            }
        }
    }

    public function actionGetGoalsRating($goal, $history){
        if(Yii::$app->request->isAjax)
        {
            $values = array();
            $labels = array();
            $recording_time  = array();
            $count = 0;
            $rate_value = '';
            if($history == '1') {
                $goal_id = \common\models\Goals::find()->where(["user_id"=>Yii::$app->user->id, 'id'=>$goal, 'status'=>'0'])->orderBy('id asc')->one();
                if ($goal_id) {
                    $rate_value = $goal_id->how_confident_am_i_that_i_can_achieve_this_goal;
                }
                $goal_id = $goal_id->id;
            }
            else
            {
                if($goal == '1'){
                    $goal_id = \common\models\Goals::find()->where(["user_id"=>Yii::$app->user->id, 'status'=>'1'])->orderBy('id asc')->one()->id;

                    if($goal_id){
                        $rate_value = \common\models\Goals::find()->where(["user_id"=>Yii::$app->user->id, 'status'=>'1'])->orderBy('id asc')->one()->how_confident_am_i_that_i_can_achieve_this_goal;
                    }
                }
                elseif($goal == '2'){
                    $goal_id = \common\models\Goals::find()->where(["user_id"=>Yii::$app->user->id, 'status'=>'1'])->orderBy('id asc')->offset(1)->one()->id;
                    if($goal_id){
                        $rate_value = \common\models\Goals::find()->where(["user_id"=>Yii::$app->user->id, 'status'=>'1'])->orderBy('id asc')->offset(1)->one()->how_confident_am_i_that_i_can_achieve_this_goal;
                    }
                }
                else{
                    $goal_id = \common\models\Goals::find()->where(["user_id"=>Yii::$app->user->id, 'status'=>'1'])->orderBy('id asc')->offset(2)->one()->id;
                    if($goal_id){
                        $rate_value = \common\models\Goals::find()->where(["user_id"=>Yii::$app->user->id, 'status'=>'1'])->orderBy('id asc')->offset(2)->one()->how_confident_am_i_that_i_can_achieve_this_goal;
                    }
                }
            }
            if($goal_id){
                $rows = Yii::$app->db->createCommand('SELECT *
            FROM
            (
                SELECT *
                FROM goals_rating
                WHERE goal_id = '.$goal_id.'
                 ORDER BY created_at DESC
                 LIMIT 5
            ) T1
            ORDER BY created_at')->queryAll();

                $time = '';
                foreach ($rows as $row){
                    $time = $row['created_at'];
                    if($time != ''){
                        $time = date('h:i A', strtotime($time));
                    }

                    $values[] = $row['value'] + 0;
                    $labels[] = date('M d',strtotime($row['created_at'])).'<br>'.$time;

                }
                $count =count($rows);
            }

            return Response::successReturn(['values'=>$values, 'labels'=> $labels, 'count'=>$count, 'rate_value'=>$rate_value, 'time'=>$time]);
        }
    }

    public function actionGetGoalsProgress($goal, $history){
        if(Yii::$app->request->isAjax)
        {
            $values = array();
            $labels = array();
            $recording_time = array();
            $count = 0;
            $progress_value = '';

            if($history == '1') {
                $goal_id = \common\models\Goals::find()->where(["user_id"=>Yii::$app->user->id, 'id'=>$goal, 'status'=>'0'])->orderBy('id asc')->one();
                if ($goal_id) {
                    $progress_value = $goal_id->how_is_your_goal_completion_progressing;
                }
                $goal_id = $goal_id->id;
            }
            else
            {
                if($goal == '1'){
                    $goal_id = \common\models\Goals::find()->where(["user_id"=>Yii::$app->user->id, 'status'=>'1'])->orderBy('id asc')->one()->id;
                    if($goal_id){
                        $progress_value = \common\models\Goals::find()->where(["user_id"=>Yii::$app->user->id, 'status'=>'1'])->orderBy('id asc')->one()->how_is_your_goal_completion_progressing;
                    }
                }
                elseif($goal == '2'){
                    $goal_id = \common\models\Goals::find()->where(["user_id"=>Yii::$app->user->id, 'status'=>'1'])->orderBy('id asc')->offset(1)->one()->id;
                    if($goal_id){
                        $progress_value =\common\models\Goals::find()->where(["user_id"=>Yii::$app->user->id, 'status'=>'1'])->orderBy('id asc')->offset(1)->one()->how_is_your_goal_completion_progressing;
                    }
                }
                else{
                    $goal_id = \common\models\Goals::find()->where(["user_id"=>Yii::$app->user->id, 'status'=>'1'])->orderBy('id asc')->offset(2)->one()->id;
                    if($goal_id){
                        $progress_value = \common\models\Goals::find()->where(["user_id"=>Yii::$app->user->id, 'status'=>'1'])->orderBy('id asc')->offset(2)->one()->how_is_your_goal_completion_progressing;
                    }
                }
            }
            if($goal_id){
                $rows = Yii::$app->db->createCommand('SELECT *
            FROM
            (
                SELECT *
                FROM goals_progress
                WHERE goal_id = '.$goal_id.'
                 ORDER BY created_at DESC
                 LIMIT 5
            ) T1
            ORDER BY created_at')->queryAll();

                $time = '';
                foreach ($rows as $row){
                    $time = $row['created_at'];
                    if($time != ''){
                        $time = date('h:i A', strtotime($time));
                    }

                    $values[] = $row['value'] + 0;
                    $labels[] = date('M d',strtotime($row['created_at'])).'<br>'.$time;

                }

                $count =count($rows);
            }

            $question_options = \common\models\QuestionOptions::find()->where(["question_id"=>'6'])->orderBy('sort_order asc')->all();

            return Response::successReturn(['values'=>$values, 'labels'=> $labels, 'count'=>$count, 'progress_value'=>$progress_value, 'question_options'=>$question_options, 'time'=>$time]);
        }
    }

    public function actionGetHistory(){
        if(Yii::$app->request->isAjax)
        {
            $goals = \common\models\Goals::find()->where(["user_id"=>Yii::$app->user->id, 'status'=>'0'])->orderBy('id asc')->asArray()->all();
            $count = 0;
            foreach ($goals as $key => $goal){
                $count++;
                $goals[$key]['trim_title'] = '';
                if (BaseStringHelper::countWords($goal['what_do_i_want_to_do']) > 10)
                {
                    $goals[$key]['trim_title'] = BaseStringHelper::truncateWords($goal['what_do_i_want_to_do'], 10, $suffix = ' ...', $asHtml = false);
                }
                if($goal['updated_at'] != ''){
                    $goals[$key]['date'] = date('l, F d, Y', strtotime($goal['updated_at']));
                }
                else
                {
                    $goals[$key]['date'] = date('l, F d, Y', strtotime($goal['created_at']));
                }
                $goals[$key]['count'] = sprintf("%02d", $count);
            }
            return Response::successReturn(['goals'=>$goals]);
        }

    }

}