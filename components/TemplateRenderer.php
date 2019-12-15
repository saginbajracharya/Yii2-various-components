<?php 
namespace app\components;
use Yii;
use yii\helpers\Html;
use yii\base\Component;
use yii\base\InvalidConfigException;

// TemplateParser 
// $Template = msg
class TemplateRenderer extends Component
{
	public function render($template, $params){
		// print_r($params);die();
		$loader = new \Twig\Loader\ArrayLoader(array('template' =>$template ));
        $twig   = new \Twig\Environment($loader,array(
									'debug' => true,
						  			'cache' => 'E:\web\wamp64\www\miracle\rndp\Yii2TestProject\Yii2ComponentsTest\compilation_cache',
						  			'auto_reload' => false,
						  			// 'strict_variables' => true,
								));
        $twig->addExtension(new \Twig\Extension\DebugExtension());// to use dump
        return $twig->render('template',['params'=>$params]);
	}
}
?>