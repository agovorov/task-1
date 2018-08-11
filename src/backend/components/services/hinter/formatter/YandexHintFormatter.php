<?php

namespace app\components\services\hinter\formatter;


/**
 * Выделяем из ответа строки в которых храниться полное наименование объекта.
 *
 * @package app\components\services\hinter\formatter
 */
class YandexHintFormatter implements HintFormatter
{

    /**
     * Конвертируем ответ Яндекса в массив строк
     *
     * @param $data
     * @return array
     */
    function format($data)
    {
        $response = [];
        if ($data && isset($data['features'])) {
            foreach ($data['features'] as $row) {
                $response[] = $row['properties']['GeocoderMetaData']['text'];
            }
        }

        return $response;
    }
}