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
            'search' => ['GET', 'HEAD', 'OPTIONS'],
        ];
    }

    /**
     * Правим CORS, в рельном проекте он будет вынесен в базовый класс (при необходимости)
     *
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $auth = $behaviors['authenticator'];
        unset($behaviors['authenticator']);

        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
        ];

        // re-add authentication filter
        $behaviors['authenticator'] = $auth;
        // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
        $behaviors['authenticator']['except'] = ['options'];

        return $behaviors;
    }


    /**
     * Основное действие
     *
     * @return mixed
     */
    public function actionSearch()
    {
        $query = \Yii::$app->request->get('q');
        $hintService = \Yii::$app->hintService;
        $response = $hintService->getAddress($query);

        // Simple logger object
        $logger = new GeoLogger($query);
        $logger->add($response);

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $response;
    }
}