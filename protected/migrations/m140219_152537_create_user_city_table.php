<?php

class m140219_152537_create_user_city_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('user_city', array(
            'user_id'      => 'integer NOT NULL',
            'city_id'      => 'integer NOT NULL'
        ));

        $this->addForeignKey('fk_user_city_user_id',
            'user_city',
            'user_id',
            'user', 'id',
            'CASCADE', 'CASCADE'
        );

        $this->addForeignKey('fk_user_city_city_id',
            'user_city',
            'city_id',
            'city', 'id',
            'CASCADE', 'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('user_city');
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