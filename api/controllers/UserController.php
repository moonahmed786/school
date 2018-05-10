<?php
/**
 * Controller for manage User
 *
 * @author ihor@karas.in.ua
 * Date: 03.04.15
 * Time: 00:35
 */

namespace api\controllers;

use Yii;
use yii\rest\ActiveController;
use api\models\LoginForm;
use common\models\UserJourney;
use common\models\UserJourneyControl;
use yii\helpers\Json;
use api\logics\Response;

class UserController extends ActiveController
{
    public $modelClass = 'common\models\User';

    public function actionLogin()
    {
        if(Yii::$app->request->isAjax && Yii::$app->request->isPost)
        {
            $model = new LoginForm();

            $requestBody = Json::decode(Yii::$app->request->getRawBody(), true);
            if ($model->load($requestBody) && $model->login())
            {
                $user_data = Yii::$app->GeneralFunctions->getLoginUserData();
                if($user_data->group_type == '0'){
                    $access_no = \common\models\UserJourneyControl::find()->where(["user_id"=>Yii::$app->user->id])->orderBy('id desc')->one();

                    $post = Yii::$app->request->post();
                    $user_journey = new UserJourneyControl();
                    $user_journey->user_id = Yii::$app->user->id;
                    $user_journey->date = date('Y-m-d');
                    $user_journey->time_login = date('G:i:s');
                    $user_journey->access_no = $access_no['access_no']+1;
                    $time = strtotime($user_journey->time_login);
                    $user_journey->time_logout = date("G:i:s", strtotime('+0 minutes', $time));
                    $user_journey->duration = '00:00:00';
                    $user_journey->time_spent_in_introduction_section = '00:00:00';
                    $user_journey->introduction_section_viewed = '1';
                    $access_number = $access_no['access_no']+1;
                    $user_journey->save(false);

                    $command = Yii::$app->db->createCommand('UPDATE user_journey_control SET isLoggedIn="1" WHERE user_id = ".Yii::$app->user->id." AND access_no = "$access_number"');
                    $command->execute();

                    $command = Yii::$app->db->createCommand('UPDATE user_journey_control SET isLoggedIn="0" WHERE user_id = ".Yii::$app->user->id." AND access_no != "$access_number"');
                    $command->execute();

                }
                else{
                    $access_no = \common\models\UserJourney::find()->where(["user_id"=>Yii::$app->user->id])->orderBy('id desc')->one();

                    $post = Yii::$app->request->post();
                    $user_journey = new UserJourney();
                    $user_journey->user_id = Yii::$app->user->id;
                    $user_journey->date = date('Y-m-d');
                    $user_journey->time_login = date('G:i:s');
                    $user_journey->access_no = $access_no['access_no']+1;
                    $time = strtotime($user_journey->time_login);
                    $user_journey->time_logout = date("G:i:s", strtotime('+0 minutes', $time));
                    $user_journey->duration = '00:00:00';
                    $access_number = $access_no['access_no']+1;
                    $user_journey->save(false);

                    $command = Yii::$app->db->createCommand('UPDATE user_journey SET isLoggedIn="1" WHERE user_id = "'.Yii::$app->user->id.'" AND access_no = "'.$access_number.'"');
                    $command->execute();

                    $command = Yii::$app->db->createCommand('UPDATE user_journey SET isLoggedIn="0" WHERE user_id = "'.Yii::$app->user->id.'" AND access_no != "'.$access_number.'"');
                    $command->execute();
                }

                $intro_section_viewed = \common\models\UserJourney::find()->where(["user_id"=>Yii::$app->user->id, "intro_section_viewed" => '1'])->count();
                $goals_set = \common\models\UserJourney::find()->where(["user_id"=>Yii::$app->user->id, "goal1_set" => '1'])->count();
                $goals = \common\models\Goals::find()->where(["user_id"=>Yii::$app->user->id, 'status'=>'1'])->orderBy('id asc')->asArray()->all();

                return 	Response::successReturn(['status'=>1,'user'=>$user_data,'access_no'=>$access_number, 'intro_section_viewed' =>$intro_section_viewed, 'goals_set'=>$goals_set, 'goals'=>$goals]);
            }
            else
            {
                return 	Response::successReturn(['status'=>0,'errors'=>$model->getErrors()]);
            }
        }
        else
        {
            return 	Response::errorReturn('Bad Request',400);
        }

    }
    //================ check if user is logged in ===============//
    public function actionIsLoggedIn($access_number, $group_type)
    {
        if(Yii::$app->request->isAjax)
        {
            if(!Yii::$app->user->isGuest)
            {
                $userDetails = Yii::$app->GeneralFunctions->getLoginUserData();
                if($group_type == '1'){
                    if($access_number != ''){
                        $access_no = \common\models\UserJourney::find()->where(["user_id"=>Yii::$app->user->id, "access_no"=>$access_number, "isLoggedIn"=> '1'])->orderBy('id desc')->one();
                        if(!$access_no){
                            Yii::$app->user->logout();
                        }
                    }

                }
                else
                {
                    if($access_number != ''){
                        $access_no = \common\models\UserJourneyControl::find()->where(["user_id"=>Yii::$app->user->id, "access_no"=>$access_number, "isLoggedIn"=> '1'])->orderBy('id desc')->one();
                        if(!$access_no){
                            Yii::$app->user->logout();
                        }
                    }
                }
                if($userDetails->group_type == '0'){
                    $access_no = \common\models\UserJourneyControl::find()->where(["user_id"=>Yii::$app->user->id])->orderBy('id desc')->one();
                }
                else
                {
                    $access_no = \common\models\UserJourney::find()->where(["user_id"=>Yii::$app->user->id])->orderBy('id desc')->one();
                }
                $intro_section_viewed = \common\models\UserJourney::find()->where(["user_id"=>Yii::$app->user->id, "intro_section_viewed" => '1'])->count();
                $goals_set = \common\models\Goals::find()->where(["user_id"=>Yii::$app->user->id])->count();
                return 	Response::successReturn(['status'=>1,'user'=>$userDetails, 'access_no'=>$access_no->access_no, 'intro_section_viewed' =>$intro_section_viewed, 'goals_set'=>$goals_set]);

            }
            else
            {
                return 	Response::successReturn(['status'=>0]);
            }
        }
        else
        {
            return $this->goHome();
        }

    }

    //===================== Logout user ==================================//
    public function actionLogout()
    {
        if(Yii::$app->request->isAjax && Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post();
            $user_data = Yii::$app->GeneralFunctions->getLoginUserData();
            if($user_data->group_type == '0'){
                $user_journey = \common\models\UserJourneyControl::find()->where(["user_id"=>Yii::$app->user->id])->orderBy('id desc')->one();
                if($user_journey) {
                    $date = $post['date'];
                    $login_date = $user_journey->date;
                    $login_time = $user_journey->time_login;
                    $logout_time = date('G:i:s');
                    $ts1 = strtotime($login_date.' '.$login_time);
                    $ts2 = strtotime($date.' '.$logout_time);

                    $hours = floor(abs($ts2 - $ts1) / 3600);
                    $hours = sprintf("%02d", $hours);
                    $minutes = floor(abs($ts2 - $ts1) / 60);
                    $minutes = sprintf("%02d", $minutes);
                    $seconds = abs($ts2 - $ts1) % 60;
                    $seconds = sprintf("%02d", $seconds);

                    $user_journey->time_logout = $logout_time;
                    $user_journey->duration = $hours.':'.$minutes.':'.$seconds;
                    $user_journey->time_spent_in_introduction_section = $hours.':'.$minutes.':'.$seconds;
                    $user_journey->save(false);
                }
            }
            else{
                $user_journey = \common\models\UserJourney::find()->where(["user_id"=>Yii::$app->user->id])->orderBy('id desc')->one();
                if($user_journey) {
                    $date = $post['date'];
                    $login_date = $user_journey->date;
                    $login_time = $user_journey->time_login;
                    $logout_time = date('G:i:s');
                    $ts1 = strtotime($login_date.' '.$login_time);
                    $ts2 = strtotime($date.' '.$logout_time);

                    $hours = floor(abs($ts2 - $ts1) / 3600);
                    $hours = sprintf("%02d", $hours);
                    $minutes = floor(abs($ts2 - $ts1) / 60);
                    $minutes = sprintf("%02d", $minutes);
                    $seconds = abs($ts2 - $ts1) % 60;
                    $seconds = sprintf("%02d", $seconds);

                    $user_journey->time_logout = $logout_time;
                    $user_journey->duration = $hours.':'.$minutes.':'.$seconds;
                    $user_journey->save(false);
                }
            }


            Yii::$app->user->logout();
            return 	Response::successReturn(['status'=>1]);
        }else
        {
            return $this->goHome();
        }

    }

    public function actionLog()
    {
        Yii::$app->user->logout();
        return 	Response::successReturn(['status'=>1]);

    }

    public function actionSetStatus()
    {
        if(Yii::$app->request->isAjax && Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post();
            $page = $post['page'];
            if($page == 'goals'){
                $user_journey = \common\models\UserJourney::find()->where(["user_id"=>Yii::$app->user->id])->orderBy('id desc')->one();
                if($user_journey) {

                    $visits = $user_journey->goals_visited;
                    $visits += 1;
                    if($visits == '1'){
                        $user_journey->time_spent_in_goal_section = '00:00:00';
                    }
                    
                    $date = $post['date_logout'];
                    $login_date = $user_journey->date;
                    $login_time = $user_journey->time_login;
                    $logout_time = date('G:i:s');

                    if($visits == '1'){
                        $logout_time = date('G:i:s',strtotime($logout_time . ' +0 minutes'));
                    }
                    $ts1 = strtotime($login_date.' '.$login_time);
                    $ts2 = strtotime($date.' '.$logout_time);

                    $hours = floor(abs($ts2 - $ts1) / 3600);
                    $hours = sprintf("%02d", $hours);
                    $minutes = floor(abs($ts2 - $ts1) / 60);
                    $minutes = sprintf("%02d", $minutes);
                    $seconds = abs($ts2 - $ts1) % 60;
                    $seconds = sprintf("%02d", $seconds);

                    $user_journey->time_logout = $logout_time;
                    $user_journey->duration = $hours.':'.$minutes.':'.$seconds;


                    $user_journey->goals_visited = $visits;
                    $user_journey->save(false);

                    $date = date('Y-m-d');
                    $start_time = date('G:i:s');

                    return 	Response::successReturn(['status'=>1, 'date' => $date, 'start_time' => $start_time]);
                }
            }
            elseif($page == 'control'){
                $user_journey = \common\models\UserJourneyControl::find()->where(["user_id"=>Yii::$app->user->id])->orderBy('id desc')->one();
                if($user_journey) {
                    if($user_journey->introduction_section_viewed == '-9'){
                        $user_journey->time_spent_in_introduction_section = '00:00:00';
                    }
                    $user_journey->save(false);

                    $date = date('Y-m-d');
                    $start_time = date('G:i:s');

                    return 	Response::successReturn(['status'=>1, 'date' => $date, 'start_time' => $start_time]);
                }
            }
            else{
                $variable_a = $post['variable_a'];
                $variable_b = $post['variable_b'];
                $variable_c = $post['variable_c'];
                $user_journey = \common\models\UserJourney::find()->where(["user_id"=>Yii::$app->user->id])->orderBy('id desc')->one();
                if($user_journey) {
                    $visits = $user_journey->{$variable_c};
                    $visits += 1;
                    $user_journey->{$variable_a} = '1';
                    if($visits == '1'){
                        if($page != 'intro'){
                            $user_journey->{$variable_b} = '00:00:00';
                        }

                    }
                    $user_journey->{$variable_c} = $visits;
                    if($page == 'depression'){
                        if($user_journey->depression_Patient_health_questionare_downloaded != '1')
                            $user_journey->depression_Patient_health_questionare_downloaded = '0';
                    }
                    if($page == 'fatiguebasics'){
                        if($user_journey->downloaded_monitoring_fatigue_pdf != '1')
                            $user_journey->downloaded_monitoring_fatigue_pdf = '0';
                    }
                    if($page == 'managementstrategies'){
                        if($user_journey->creating_a_rest_schedule_pdf_downloaded != '1')
                            $user_journey->creating_a_rest_schedule_pdf_downloaded = '0';
                        if($user_journey->COMMUNICATION_PDF_DOWNLOADED != '1')
                            $user_journey->COMMUNICATION_PDF_DOWNLOADED = '0';
                        if($user_journey->VOICEOVER_1_LISTENED_TO != '1')
                            $user_journey->VOICEOVER_1_LISTENED_TO = '0';
                        if($user_journey->VOICEOVER_2_LISTENED_TO != '1')
                            $user_journey->VOICEOVER_2_LISTENED_TO = '0';
                        if($user_journey->VOICEOVER_3_LISTENED_TO != '1')
                            $user_journey->VOICEOVER_3_LISTENED_TO = '0';
                        if($user_journey->VOICEOVER_4_LISTENED_TO != '1')
                            $user_journey->VOICEOVER_4_LISTENED_TO = '0';
                        if($user_journey->VOICEOVER_5_LISTENED_TO != '1')
                            $user_journey->VOICEOVER_5_LISTENED_TO = '0';
                    }
                    if($page == 'medication'){
                        if($user_journey->medication_side_effects_table_downloaded != '1'){
                            $user_journey->medication_side_effects_table_downloaded = '0';
                        }
                        if($user_journey->medication_side_effects_blank_table_downloaded != '1'){
                            $user_journey->medication_side_effects_blank_table_downloaded = '0';
                        }
                    }
                    if($page == 'nextsteps'){
                        if($user_journey->more_info_link_out_1 != '1')
                            $user_journey->more_info_link_out_1 = '0';
                        if($user_journey->more_info_link_out_2 != '1')
                            $user_journey->more_info_link_out_2 = '0';
                        if($user_journey->more_info_link_out_3 != '1')
                            $user_journey->more_info_link_out_3 = '0';
                        if($user_journey->more_info_link_out_4 != '1')
                            $user_journey->more_info_link_out_4 = '0';
                        if($user_journey->more_info_link_out_5 != '1')
                            $user_journey->more_info_link_out_5 = '0';
                        if($user_journey->more_info_link_out_6 != '1')
                            $user_journey->more_info_link_out_6 = '0';
                        if($user_journey->more_info_link_out_7 != '1')
                            $user_journey->more_info_link_out_7 = '0';
                    }
                    if($page == 'sleep'){
                        if($user_journey->downloaded_sleep_diary != '1')
                            $user_journey->downloaded_sleep_diary = '0';
                        if($user_journey->downloaded_sleep_diary2 != '1')
                            $user_journey->downloaded_sleep_diary2 = '0';
                    }
                    if($page == 'deconditioning'){
                        if($user_journey->canadian_physical_activity_guidelines_downloaded != '1')
                            $user_journey->canadian_physical_activity_guidelines_downloaded = '0';
                        if($user_journey->canadian_physical_activity_scientific_statements_downloaded != '1')
                            $user_journey->canadian_physical_activity_scientific_statements_downloaded = '0';
                    }

                    $date = $post['date_logout'];
                    $login_date = $user_journey->date;
                    $login_time = $user_journey->time_login;
                    $logout_time = date('G:i:s');
                    if($visits == '1'){
                        $logout_time = date('G:i:s',strtotime($logout_time . ' +0 minutes'));
                    }
                    $ts1 = strtotime($login_date.' '.$login_time);
                    $ts2 = strtotime($date.' '.$logout_time);

                    $hours = floor(abs($ts2 - $ts1) / 3600);
                    $hours = sprintf("%02d", $hours);
                    $minutes = floor(abs($ts2 - $ts1) / 60);
                    $minutes = sprintf("%02d", $minutes);
                    $seconds = abs($ts2 - $ts1) % 60;
                    $seconds = sprintf("%02d", $seconds);

                    $user_journey->time_logout = $logout_time;
                    $user_journey->duration = $hours.':'.$minutes.':'.$seconds;

                    $user_journey->save(false);

                    $date = date('Y-m-d');
                    $start_time = date('G:i:s');

                    return 	Response::successReturn(['status'=>1, 'date' => $date, 'start_time' => $start_time]);
                }
            }
        }
        else
        {
            return $this->goHome();
        }
    }

    public function actionUpdateStatus()
    {
        if(Yii::$app->request->isAjax && Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post();
            $page = $post['page'];
            $variable = $post['variable'];
            $variable_a = $post['variable_a'];
            $login_time = $post['start_time'];
            $date = $post['date'];
            if(Yii::$app->user->id){
                $user_id = Yii::$app->user->id;
            }
            else{
                $user_id = $post['user_id'];
            }
            $user_journey = \common\models\UserJourney::find()->where(["user_id"=>$user_id])->orderBy('id desc')->one();
            if($page == 'goals'){
                if($user_journey) {
                    $logout_time = date('G:i:s');
                    $ts1 = strtotime($date.' '.$login_time);
                    $ts2 = strtotime($date.' '.$logout_time);

                    $hours = floor(abs($ts2 - $ts1) / 3600);
                    $hours = sprintf("%02d", $hours);
                    $minutes = floor(abs($ts2 - $ts1) / 60);
                    $minutes = sprintf("%02d", $minutes);
                    $seconds = abs($ts2 - $ts1) % 60;
                    $seconds = sprintf("%02d", $seconds);

                    $visits = $user_journey->goals_visited;

                    $time1 = $user_journey->time_spent_in_goal_section;
                    $times = array($time1, $hours.':'.$minutes.':'.$seconds);
                    $seconds = 0;
                    foreach ($times as $time)
                    {
                        list($hour,$minute,$second) = explode(':', $time);
                        $seconds += $hour*3600;
                        $seconds += $minute*60;
                        $seconds += $second;
                    }
                    $hours = floor($seconds/3600);
                    $seconds -= $hours*3600;
                    $minutes  = floor($seconds/60);
                    $seconds -= $minutes*60;
                    $user_journey->time_spent_in_goal_section = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

                    $user_journey->save(false);

                    return 	Response::successReturn(['status'=>1]);
                }
            }
            elseif($page == 'control'){
                $user_journey = \common\models\UserJourneyControl::find()->where(["user_id"=>$user_id])->orderBy('id desc')->one();
                if($user_journey) {
                    $logout_time = date('G:i:s');
                    $ts1 = strtotime($date.' '.$login_time);
                    $ts2 = strtotime($date.' '.$logout_time);

                    $hours = floor(abs($ts2 - $ts1) / 3600);
                    $hours = sprintf("%02d", $hours);
                    $minutes = floor(abs($ts2 - $ts1) / 60);
                    $minutes = sprintf("%02d", $minutes);
                    $seconds = abs($ts2 - $ts1) % 60;
                    $seconds = sprintf("%02d", $seconds);

                    if($user_journey->time_spent_in_introduction_section == '00:00:00'){
                        $user_journey->time_spent_in_introduction_section = $hours.':'.$minutes.':'.$seconds;
                    }
                    else
                    {
                        $time1 = $user_journey->time_spent_in_introduction_section;
                        $times = array($time1, $hours.':'.$minutes.':'.$seconds);
                        $seconds = 0;
                        foreach ($times as $time)
                        {
                            list($hour,$minute,$second) = explode(':', $time);
                            $seconds += $hour*3600;
                            $seconds += $minute*60;
                            $seconds += $second;
                        }
                        $hours = floor($seconds/3600);
                        $seconds -= $hours*3600;
                        $minutes  = floor($seconds/60);
                        $seconds -= $minutes*60;
                        $user_journey->time_spent_in_introduction_section = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
                    }

                    $user_journey->save(false);

                    return 	Response::successReturn(['status'=>1]);
                }
            }
            else{
                if($user_journey) {
                    $visits = $user_journey->{$variable_a};
                    $logout_time = date('G:i:s');
                    $ts1 = strtotime($date.' '.$login_time);
                    $ts2 = strtotime($date.' '.$logout_time);

                    $hours = floor(abs($ts2 - $ts1) / 3600);
                    $hours = sprintf("%02d", $hours);
                    $minutes = floor(abs($ts2 - $ts1) / 60);
                    $minutes = sprintf("%02d", $minutes);
                    $seconds = abs($ts2 - $ts1) % 60;
                    $seconds = sprintf("%02d", $seconds);

                    $time1 = $user_journey->{$variable};
                    $times = array($time1, $hours.':'.$minutes.':'.$seconds);
                    $seconds = 0;
                    foreach ($times as $time)
                    {
                        list($hour,$minute,$second) = explode(':', $time);
                        $seconds += $hour*3600;
                        $seconds += $minute*60;
                        $seconds += $second;
                    }
                    $hours = floor($seconds/3600);
                    $seconds -= $hours*3600;
                    $minutes  = floor($seconds/60);
                    $seconds -= $minutes*60;
                    if($page != 'intro'){
                        $user_journey->{$variable} = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
                    }else
                    {
                        $login_date = $user_journey->date;
                        $login_time = $user_journey->time_login;
                        $logout_time = date('G:i:s');
                        $ts1 = strtotime($login_date.' '.$login_time);
                        $ts2 = strtotime($date.' '.$logout_time);

                        $hours = floor(abs($ts2 - $ts1) / 3600);
                        $hours = sprintf("%02d", $hours);
                        $minutes = floor(abs($ts2 - $ts1) / 60);
                        $minutes = sprintf("%02d", $minutes);
                        $seconds = abs($ts2 - $ts1) % 60;
                        $seconds = sprintf("%02d", $seconds);
                        $user_journey->{$variable} = $hours.':'.$minutes.':'.$seconds;
                    }

                    $user_journey->save(false);

                    return 	Response::successReturn(['status'=>1]);
                }
            }
        }
        else
        {
            return $this->goHome();
        }
    }

    public function actionUpdateDuration()
    {
        if(Yii::$app->request->isAjax && Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post();
            $page = $post['page'];
            $variable = $post['variable'];
            $variable_a = $post['variable_a'];
            $login_time = $post['start_time'];
            $date = $post['date'];
            if(Yii::$app->user->id){
                $user_id = Yii::$app->user->id;
            }
            else{
                $user_id = $post['user_id'];
            }
            $user_journey = \common\models\UserJourney::find()->where(["user_id"=>$user_id])->orderBy('id desc')->one();
            if($page == 'goals'){
                if($user_journey) {
                    $logout_time = date('G:i:s');
                    $ts1 = strtotime($date.' '.$login_time);
                    $ts2 = strtotime($date.' '.$logout_time);

                    $hours = floor(abs($ts2 - $ts1) / 3600);
                    $hours = sprintf("%02d", $hours);
                    $minutes = floor(abs($ts2 - $ts1) / 60);
                    $minutes = sprintf("%02d", $minutes);
                    $seconds = abs($ts2 - $ts1) % 60;
                    $seconds = sprintf("%02d", $seconds);

                    $visits = $user_journey->goals_visited;

                    $time1 = $user_journey->time_spent_in_goal_section;
                    $times = array($time1, $hours.':'.$minutes.':'.$seconds);
                    $seconds = 0;
                    foreach ($times as $time)
                    {
                        list($hour,$minute,$second) = explode(':', $time);
                        $seconds += $hour*3600;
                        $seconds += $minute*60;
                        $seconds += $second;
                    }
                    $hours = floor($seconds/3600);
                    $seconds -= $hours*3600;
                    $minutes  = floor($seconds/60);
                    $seconds -= $minutes*60;
                    $user_journey->time_spent_in_goal_section = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

                    /* Update total duration. */
                    $login_date = $user_journey->date;
                    $login_time = $user_journey->time_login;
                    $logout_time = date('G:i:s');
                    $ts1 = strtotime($login_date.' '.$login_time);
                    $ts2 = strtotime($date.' '.$logout_time);

                    $hours = floor(abs($ts2 - $ts1) / 3600);
                    $hours = sprintf("%02d", $hours);
                    $minutes = floor(abs($ts2 - $ts1) / 60);
                    $minutes = sprintf("%02d", $minutes);
                    $seconds = abs($ts2 - $ts1) % 60;
                    $seconds = sprintf("%02d", $seconds);

                    $user_journey->time_logout = $logout_time;
                    $user_journey->duration = $hours.':'.$minutes.':'.$seconds;

                    $user_journey->save(false);

                    $date = date('Y-m-d');
                    $start_time = date('G:i:s');
                    return 	Response::successReturn(['status'=>1, 'date' => $date, 'start_time' => $start_time]);
                }
            }
            elseif($page == 'control'){
                $user_journey = \common\models\UserJourneyControl::find()->where(["user_id"=>$user_id])->orderBy('id desc')->one();
                if($user_journey) {
                    $logout_time = date('G:i:s');
                    $ts1 = strtotime($date.' '.$login_time);
                    $ts2 = strtotime($date.' '.$logout_time);

                    $hours = floor(abs($ts2 - $ts1) / 3600);
                    $hours = sprintf("%02d", $hours);
                    $minutes = floor(abs($ts2 - $ts1) / 60);
                    $minutes = sprintf("%02d", $minutes);
                    $seconds = abs($ts2 - $ts1) % 60;
                    $seconds = sprintf("%02d", $seconds);

                    if($user_journey->time_spent_in_introduction_section == '00:00:00'){
                        $user_journey->time_spent_in_introduction_section = $hours.':'.$minutes.':'.$seconds;
                    }
                    else
                    {
                        $time1 = $user_journey->time_spent_in_introduction_section;
                        $times = array($time1, $hours.':'.$minutes.':'.$seconds);
                        $seconds = 0;
                        foreach ($times as $time)
                        {
                            list($hour,$minute,$second) = explode(':', $time);
                            $seconds += $hour*3600;
                            $seconds += $minute*60;
                            $seconds += $second;
                        }
                        $hours = floor($seconds/3600);
                        $seconds -= $hours*3600;
                        $minutes  = floor($seconds/60);
                        $seconds -= $minutes*60;
                        $user_journey->time_spent_in_introduction_section = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
                    }

                    $date = $post['date'];
                    $login_date = $user_journey->date;
                    $login_time = $user_journey->time_login;
                    $logout_time = date('G:i:s');
                    $ts1 = strtotime($login_date.' '.$login_time);
                    $ts2 = strtotime($date.' '.$logout_time);

                    $hours = floor(abs($ts2 - $ts1) / 3600);
                    $hours = sprintf("%02d", $hours);
                    $minutes = floor(abs($ts2 - $ts1) / 60);
                    $minutes = sprintf("%02d", $minutes);
                    $seconds = abs($ts2 - $ts1) % 60;
                    $seconds = sprintf("%02d", $seconds);

                    $user_journey->time_logout = $logout_time;
                    $user_journey->duration = $hours.':'.$minutes.':'.$seconds;

                    $user_journey->save(false);

                    $date = date('Y-m-d');
                    $start_time = date('G:i:s');
                    return 	Response::successReturn(['status'=>1, 'date' => $date, 'start_time' => $start_time]);
                }
            }
            else{
                if($user_journey) {
                    $visits = $user_journey->{$variable_a};
                    $logout_time = date('G:i:s');
                    $ts1 = strtotime($date.' '.$login_time);
                    $ts2 = strtotime($date.' '.$logout_time);

                    $hours = floor(abs($ts2 - $ts1) / 3600);
                    $hours = sprintf("%02d", $hours);
                    $minutes = floor(abs($ts2 - $ts1) / 60);
                    $minutes = sprintf("%02d", $minutes);
                    $seconds = abs($ts2 - $ts1) % 60;
                    $seconds = sprintf("%02d", $seconds);

                    $time1 = $user_journey->{$variable};
                    $times = array($time1, $hours.':'.$minutes.':'.$seconds);
                    $seconds = 0;
                    foreach ($times as $time)
                    {
                        list($hour,$minute,$second) = explode(':', $time);
                        $seconds += $hour*3600;
                        $seconds += $minute*60;
                        $seconds += $second;
                    }
                    $hours = floor($seconds/3600);
                    $seconds -= $hours*3600;
                    $minutes  = floor($seconds/60);
                    $seconds -= $minutes*60;
                    if($page != 'intro'){
                        $user_journey->{$variable} = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
                    }

                    /* Update total duration. */
                    $login_date = $user_journey->date;
                    $login_time = $user_journey->time_login;
                    $logout_time = date('G:i:s');
                    $ts1 = strtotime($login_date.' '.$login_time);
                    $ts2 = strtotime($date.' '.$logout_time);

                    $hours = floor(abs($ts2 - $ts1) / 3600);
                    $hours = sprintf("%02d", $hours);
                    $minutes = floor(abs($ts2 - $ts1) / 60);
                    $minutes = sprintf("%02d", $minutes);
                    $seconds = abs($ts2 - $ts1) % 60;
                    $seconds = sprintf("%02d", $seconds);

                    $user_journey->time_logout = $logout_time;
                    $user_journey->duration = $hours.':'.$minutes.':'.$seconds;
                    if($page == 'intro'){
                        $user_journey->{$variable} = $hours.':'.$minutes.':'.$seconds;
                    }

                    $user_journey->save(false);

                    $date = date('Y-m-d');
                    $start_time = date('G:i:s');
                    return 	Response::successReturn(['status'=>1, 'date' => $date, 'start_time' => $start_time]);
                }
            }
        }
        else
        {
            return $this->goHome();
        }
    }

    public function actionSetVariable()
    {
        if(Yii::$app->request->isAjax && Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post();
            $variable = $post['variable'];
            if(isset($post['user']) && $post['user'] == '0'){
                $user_journey = \common\models\UserJourneyControl::find()->where(["user_id"=>Yii::$app->user->id])->orderBy('id desc')->one();
            }
            else
            {
                $user_journey = \common\models\UserJourney::find()->where(["user_id"=>Yii::$app->user->id])->orderBy('id desc')->one();
            }
            if($user_journey) {

                $user_journey->{$variable} = '1';
                $user_journey->save(false);

                return 	Response::successReturn(['status'=>1]);
            }
        }
        else
        {
            return $this->goHome();
        }
    }

    public function actionSetIntroStatus()
    {
        $date = date('Y-m-d');
        $start_time = date('G:i:s');
        return 	Response::successReturn(['status'=>1, 'date' => $date, 'start_time' => $start_time]);
    }
}