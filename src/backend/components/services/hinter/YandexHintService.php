<?php

namespace app\components\services\hinter;


use app\components\services\hinter\formatter\YandexHintFormatter;

/**
 * Ищем адрес при помощи сервиса Яндекса
 *
 * @package app\components\services\hinter
 */
class YandexHintService extends BaseHintService implements HintService
{
    const API_URL = 'https://geocode-maps.yandex.ru/1.x/';
    private $lang = 'ru_RU';


    /**
     * Get addresses from yandex API
     *
     * @param $query
     * @return mixed
     * @throws HintServiceException
     */
    public function getAddress($query)
    {
        if (!$this->valid($query)) {
            return [];
        }

        $response = $this->doYandexRequest($query);
        $yandexFormatter = new YandexHintFormatter();
        return $yandexFormatter->format($response);
    }


    protected function doYandexRequest($query)
    {
        $client = new \yii\httpclient\Client();
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl(self::API_URL)
            ->setData([
                'results' => $this->maxResults,
                'format' => 'json',
                'lang' => $this->lang,
                'geocode' => $query
            ])
            ->send();

        if (!$response->isOk) {
            return false;
        }

        // TODO Кеширование результата

        return $response->data['response']['GeoObjectCollection'];
    }
}