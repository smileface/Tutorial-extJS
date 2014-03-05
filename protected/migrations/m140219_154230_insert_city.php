<?php

class m140219_154230_insert_city extends CDbMigration
{
    public function up()
    {
        $this->insert('city',array(
            'name' => 'Москва',
        ));

        $this->insert('city',array(
            'name' => 'Киев',
        ));

        $this->insert('city',array(
            'name' => 'Харьков',
        ));

        $this->insert('city',array(
            'name' => 'Чернигов',
        ));

        $this->insert('city',array(
            'name' => 'Львов',
        ));

        $this->insert('city',array(
            'name' => 'Одесса',
        ));
    }

    public function down()
    {
        $this->truncateTable('city');
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