<?php

namespace app\components\services\hinter;


use app\components\services\hinter\formatter\YandexHintFormatter;
use yii\helpers\Json;

/**
 * Ищем адрес при помощи сервиса Яндекса
 *
 * @package app\components\services\hinter
 */
class YandexHintService extends BaseHintService implements HintService
{
    const API_URL = 'https://search-maps.yandex.ru/v1/';
    private $apiKey = 'APGvblsBAAAAc4jVLwIAkBcJs0M4f_Z3UZWYA55LVtTqVe4AAAAAAAAAAACiMP2sMutmWieKKug7Udc9SiXEDQ==';
    private $type = 'geo';
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
            throw new HintServiceException(\Yii::t('app', 'Запрос не прошел валидацию.'));
        }
        // validator

        $response = $this->doYandexRequest($query);
        $json = Json::decode($response);
        $yandexFormatter = new YandexHintFormatter();
        return $yandexFormatter->format($json);
    }


    protected function doYandexRequest($query)
    {
        $client = new \yii\httpclient\Client();
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl(self::API_URL)
            ->setData([
                'apikey' => $this->apiKey,
                'text' => $query,
                'results' => $this->maxResults,
                'type' => $this->type,
                'lang' => $this->lang
            ])
            ->send();

        // TODO Кеширование результата

        // Яндекс ругается на invalid key, пока сделаю зашлушку
        return $this->sampleResponse();
    }


    // TODO Remove after fix
    private function sampleResponse()
    {
        /**
         * [status] => error
         * [message] => invalid key
         * [code] => 403
         */

        return '{   
          "type": "FeatureCollection",
          "properties": {
            "ResponseMetaData": {
              "SearchRequest": {
                "request": "Rai,Russia",
                "results": 10,
                "skip": 0,
                "boundedBy": [
                  [
                    37.04842675,
                    55.43644829
                  ],
                  [
                    38.17590226,
                    56.04690124
                  ]
                ]
              },
              "SearchResponse": {
                "found": 24,
                "Point": {
                  "type": "Point",
                  "coordinates": [
                    32.01884032,
                    54.70408144
                  ]
                },
                "boundedBy": [
                  [
                    32.00759341,
                    54.70136583
                  ],
                  [
                    32.03008723,
                    54.70679686
                  ]
                ],
                "display": "single"
              }
            }
          },
          "features": [
            {
              "type": "Feature",
              "properties": {
                "GeocoderMetaData": {
                  "kind": "locality",
                  "text": "Russia, Smolensk oblast, Smolensk region, village of Rai",
                  "precision": "other"
                },
                "description": "Smolensk region, Smolensk oblast, Russia",
                "name": "village of Rai",
                "boundedBy": [
                  [
                    32.007593,
                    54.701366
                  ],
                  [
                    32.030087,
                    54.706797
                  ]
                ]
              },
              "geometry": {
                "type": "Point",
                "coordinates": [
                  32.024464,
                  54.704602
                ]
              }
            }         
          ]
        }';
    }
}