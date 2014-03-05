<?php

class m140219_152216_create_city_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('city', array(
            'id'     => 'pk',
            'name'   => 'string NOT NULL'
        ));
	}

	public function down()
	{
        $this->dropTable('city');
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