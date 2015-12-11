<?php

use yii\db\Schema;
use yii\db\Migration;

class m150507_130946_books extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

//Таблица books
        $this->createTable('{{%books}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING,
            'date' => Schema::TYPE_DATETIME,
            'preview' => Schema::TYPE_STRING,
            'author_id' => Schema::TYPE_INTEGER,
            'date_create' => Schema::TYPE_DATETIME . ' NOT NULL',
            'date_update' => Schema::TYPE_DATETIME . ' NOT NULL',
        ], $tableOptions);

//Таблица authors
        $this->createTable('{{%authors}}', [
            'id' => Schema::TYPE_PK,
            'firstname' => Schema::TYPE_STRING,
            'lasttname' => Schema::TYPE_STRING,
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%books}}');
        $this->dropTable('{{%authors}}');
        echo "m150507_130946_books can be reverted.\n";

        return true;
    }
    
    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }
    
    public function safeDown()
    {
    }
    */
}
