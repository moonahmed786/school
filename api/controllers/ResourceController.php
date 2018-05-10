<?php
/**
 * Controller for manage User
 *
 * @author ihor@karas.in.ua
 * Date: 03.04.15
 * Time: 00:35
 */

namespace api\controllers;
use \Yii as Yii;


class ResourceController extends \api\components\Controller
{
	public $modelClass = '\common\models\Resources';
    public function accessRules()
    {
        return [
            ['allow' => true, 'roles' => ['?']],
            [
                'allow' => true,
                'actions' => ['view','create','update','delete','deleteall'],
                'roles' => ['@'],
            ],
        ];
    }
	public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }


	//================================ Resources ============================//
    public function actionIndex()
    {
        $params         =   Yii::$app->request->get();
        $sort           =   "";
        $page           =   1;
        $limit          =   20;
        $resource_thumb =   '';
        $resource_path  = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME'].Yii::$app->urlManagerFrontEnd->baseUrl.'/uploads/resources/';
        if(isset($params['page']))
        {
            $page   =   $params['page'];
        }
        if(isset($params['limit']))
        {
            $limit  =   $params['limit'];
        }
        $offset =   $limit*($page-1);
        /* Filter elements */

        if(isset($params['sort']))
        {
            $sort=$params['sort'];
            if(isset($params['order']))
            {
                if($params['order']=="false")
                    $sort.=" desc";
                else
                    $sort.=" asc";

            }
        }
        $totalItems  =   \common\models\Resources::find()
            ->count();
        $all_resources   =   \common\models\Resources::find()
            ->offset($offset)
            ->orderBy($sort)->all();

        $data           =   [];
        if($all_resources)
        {
            foreach($all_resources as $resource)
            {
                $type = $resource->resource_type;
                $resource_type  = '';
                switch ($type) {
                    case 'png':
                    case 'jpg': {
                        $resource_type = 'image';
                        $resource_thumb = $resource_path.'image_icon.png';
                        break;
                    }
                    case 'ogg':
                    case 'webm':
                    case 'mp4': {
                        $resource_type = 'video';
                        $resource_thumb = $resource_path.'video_icon.png';
                        break;
                    }
                    case 'mp3': {
                        $resource_type = 'audio';
                        $resource_thumb = $resource_path.'audio_icon.png';
                        break;
                    }
                    case 'pdf': {
                        $resource_type = 'pdf';
                        $resource_thumb = $resource_path.'pdf_icon.png';
                        break;
                    }
                    case 'doc':
                    case 'docx': {
                        $resource_type = 'word';
                        $resource_thumb = $resource_path.'doc_icon.png';
                        break;
                    }
                    case 'ppt':
                    case 'pptx': {
                        $resource_type = 'powerpoint';
                        $resource_thumb = $resource_path.'ppt_icon.png';
                        break;
                    }
                    default:{
                        $resource_type = '';
                        $resource_thumb = '';
                    }
                        
                }
                if($resource->attachment != '')
                {
                    $resource_link    =  $resource_path.$resource->attachment;
                }
                else
                {
                    $resource_link ='';
                }


                $resource_row =[
                	'id'				=> $resource->id,
                	'title'				=> $resource->title,
                	'description'       => $resource->description,
                	'resource_type'     => $resource_type,
                    'attachment'        => $resource_link,
                    'resource_thumb'    => $resource_thumb,
                    'added_by'    		=> $resource->addedBy->first_name." ".$resource->addedBy->last_name,
                    'added_date'        => $resource->added_date,
                    'updated_date'      => $resource->updated_date,
                    'status'     		=> $resource->status,
                    
                    
                ];

                $data[] =   $resource_row;
            }
            $this->setHeader(200);
            return array('status'=>1,'data'=>$data,'totalItems'=>$totalItems);
        }
        else
        {
            $this->setHeader(200);
            return array('status'=>1,'data'=>[],'message'=>'No Resources added for this Patient');
        }

    }

    private function setHeader($status)
    {

        $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
        $content_type="application/json; charset=utf-8";

        header($status_header);
        header('Content-type: ' . $content_type);
    }
    private function _getStatusCodeMessage($status)
    {
        // these could be stored in a .ini file and loaded
        // via parse_ini_file()... however, this will suffice
        // for an example
        $codes = Array(
            200 => 'OK',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
        );
        return (isset($codes[$status])) ? $codes[$status] : '';
    }
}