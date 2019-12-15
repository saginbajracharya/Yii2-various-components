<?php
namespace app\controllers;
use Yii;

class GeneratorController extends \yii\web\Controller
{
	public function actionGenerate()
    {
		$generator = new \Wsdl2PhpGenerator\Generator();
		$generator->generate(
			new \Wsdl2PhpGenerator\Config(array(
		        // 'inputFile' => 'http://wsf.cdyne.com/WeatherWS/Weather.asmx?wsdl',
		        'inputFile' => 'http://wsf.cdyne.com/WeatherWS/Weather.asmx?wsdl',
		        'outputDir' => '../runtime/output'
		    ))
		);
	}
}
?>