<?php

class m140219_150604_create_user_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('user', array(
            'id'     => 'pk',
            'name'   => 'string NOT NULL'
        ));
	}

	public function down()
	{
        $this->dropTable('user');
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