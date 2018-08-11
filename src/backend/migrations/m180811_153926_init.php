<?php

use yii\db\Migration;

/**
 * Class m180811_153926_init
 */
class m180811_153926_init extends Migration
{
    public function up()
    {
        $this->createTable("geo_logger", [
            "id" => $this->primaryKey(),
            "query" => $this->string(255),
            "description" => $this->text(),
            "ts" => 'timestamptz NOT NULL DEFAULT NOW()'
        ]);
    }

    public function down()
    {
        echo "m180811_153926_init cannot be reverted.\n";
        return false;
    }
}
