<?php

namespace app\controllers;


use app\components\services\hinter\logger\GeoLogger;
use yii\rest\Controller;

/**
 * Работа с адресами
 */
class AddressController extends Controller
{
    /**
     * Only GET on index
     *
     * @return array
     */
    protected function verbs()
    {
        return [
            'index' => ['GET', 'HEAD'],
        ];
    }

    public function actionIndex()
    {
        $query = \Yii::$app->request->get('q');
        $hintService = \Yii::$app->hintService;
        $response = $hintService->getAddress($query);

        // Simple logger object
        $logger = new GeoLogger($query);
        $logger->add($response);

        return $response;
    }
}