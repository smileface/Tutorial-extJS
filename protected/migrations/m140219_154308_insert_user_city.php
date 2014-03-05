<?php

class m140219_154308_insert_user_city extends CDbMigration
{
	public function up()
	{
        $this->insert('user_city',array(
            'user_id' => '1',
            'city_id' => '1'
        ));

        $this->insert('user_city',array(
            'user_id' => '1',
            'city_id' => '2'
        ));

        $this->insert('user_city',array(
            'user_id' => '2',
            'city_id' => '2'
        ));

        $this->insert('user_city',array(
            'user_id' => '2',
            'city_id' => '3'
        ));

        $this->insert('user_city',array(
            'user_id' => '3',
            'city_id' => '3'
        ));

        $this->insert('user_city',array(
            'user_id' => '3',
            'city_id' => '4'
        ));

        $this->insert('user_city',array(
            'user_id' => '4',
            'city_id' => '4'
        ));

        $this->insert('user_city',array(
            'user_id' => '5',
            'city_id' => '6'
        ));
	}

	public function down()
	{
        $this->truncateTable('user_city');
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