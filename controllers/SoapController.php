<?php
namespace app\controllers;
use Yii;

class SoapController extends \yii\web\Controller
{
	public function actionList()
    {
		$client = Yii::$app->siteApi;
		echo $client->getHello('Sagin','Bajracharya');
    }
}

?>