<?php

class m140219_152526_create_user_education_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('user_education', array(
            'user_id'           => 'integer NOT NULL',
            'education_id'      => 'integer NOT NULL'
        ));

        $this->addForeignKey('fk_user_education_user_id',
            'user_education', 'user_id',
            'user', 'id',
            'CASCADE', 'CASCADE'
        );

        $this->addForeignKey('fk_user_education_education_id',
            'user_education', 'education_id',
            'education', 'id',
            'CASCADE', 'CASCADE'
        );
	}

	public function down()
	{
        $this->dropTable('user_education');
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