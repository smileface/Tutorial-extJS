<?php

class m140219_154223_insert_user extends CDbMigration
{
	public function up()
	{
        $this->insert('user',array(
            'name' => 'Александр',
        ));

        $this->insert('user',array(
            'name' => 'Анатолий',
        ));

        $this->insert('user',array(
            'name' => 'Иван',
        ));

        $this->insert('user',array(
            'name' => 'Сергей',
        ));

        $this->insert('user',array(
            'name' => 'Павел',
        ));
	}

	public function down()
	{
        $this->truncateTable('user');
    }

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}