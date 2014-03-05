<?php

class m140219_154300_insert_user_education extends CDbMigration
{
    public function up()
    {
        $this->insert('user_education',array(
            'user_id' => '1',
            'education_id' => '1'
        ));

        $this->insert('user_education',array(
            'user_id' => '2',
            'education_id' => '2'
        ));

        $this->insert('user_education',array(
            'user_id' => '3',
            'education_id' => '3'
        ));

        $this->insert('user_education',array(
            'user_id' => '4',
            'education_id' => '3'
        ));

        $this->insert('user_education',array(
            'user_id' => '5',
            'education_id' => '4'
        ));
    }

	public function down()
	{
        $this->truncateTable('user_education');
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