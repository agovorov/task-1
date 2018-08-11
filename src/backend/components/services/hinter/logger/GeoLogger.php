<?php

namespace app\components\services\hinter\logger;

/**
 * Класс сохраняет данные в хранилище
 *
 * @package app\components\services\hinter\logger
 */
class GeoLogger
{
    private $query;

    /**
     * GeoLogger constructor.
     * @param $query
     */
    public function __construct($query)
    {
        $this->query = $query;
    }


    /**
     * Чтобы компонент работал быстрее, лучше сохранять в rabbit или редис
     *
     * @param $items
     */
    public function add($items)
    {
        if ($items) {
            $cmd = \Yii::$app->db->createCommand();

            $insertData = [];
            foreach ($items as $item) {
                $insertData[] = [
                    'query' => $this->query,
                    'description' => $item
                ];
            }

            $cmd->batchInsert('geo_logger', ['query', 'description'], $insertData);
            $cmd->execute();
        }
    }
}