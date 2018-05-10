<?php
/**
 * Parents controller for all ones
 *
 * @author Ihor Karas <ihor@karas.in.ua>
 * Date: 03.04.15
 * Time: 00:29
 */

namespace api\components;
use yii\helpers\ArrayHelper;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;
use filsh\yii2\oauth2server\filters\ErrorToExceptionFilter;
use filsh\yii2\oauth2server\filters\auth\CompositeAuth;
//use yii\filters\auth\CompositeAuth;
use yii\filters\AccessControl;

class ActiveController extends \yii\rest\ActiveController
{
	use \api\components\traits\ControllersCommonTrait;
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return ArrayHelper::merge(parent::behaviors(), [
			'authenticator' => [
				'class' => CompositeAuth::className(),
				'except' => ['login', 'resetpassword'],
				'authMethods' => [
					['class' => HttpBasicAuth::className()],
					['class' => HttpBearerAuth::className()],
					['class' => QueryParamAuth::className(), 'tokenParam' => 'access_token']
				]
			],
			'exceptionFilter' => [
				'class' => ErrorToExceptionFilter::className()
			],
		]);
	}
}