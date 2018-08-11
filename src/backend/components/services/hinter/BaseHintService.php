<?php

namespace app\components\services\hinter;


class BaseHintService
{
    /** @var int Минимальное кол-во символов для началы отправки запроса */
    public $minLettersCount = 2;

    /** @var int Максимальное кол-во строк при выдачи */
    public $maxResults = 10;

    /**
     * Простой метод валидации
     *
     * @param $query
     * @return bool
     */
    public function valid($query) {
        if (strlen($query) < $this->minLettersCount) {
            return false;
        }

        return true;
    }
}