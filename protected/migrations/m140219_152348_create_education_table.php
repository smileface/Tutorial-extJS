<?php

class m140219_152348_create_education_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('education', array(
            'id'     => 'pk',
            'name'   => 'string NOT NULL'
        ));
	}

	public function down()
	{
        $this->dropTable('education');
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