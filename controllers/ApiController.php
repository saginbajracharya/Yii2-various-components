<?php

namespace app\controllers;
use Yii;

class ApiController extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'index' => [
                'class' => 'mongosoft\soapserver\Action',
                'serviceOptions' => [
                    'disableWsdlMode' => true,
                ]
            ],
        ];
    }

    /**
     * @param string $name
     * @return string
     * @soap
     */
    public function getHello($fname,$lname)
    {
        return 'Hello ' . $fname .' '.$lname;
    }
}
?>