<?php

class m140219_154237_insert_education extends CDbMigration
{
    public function up()
    {
        $this->insert('education',array(
            'name' => 'базовое',
        ));

        $this->insert('education',array(
            'name' => 'среднее',
        ));

        $this->insert('education',array(
            'name' => 'бакалавр',
        ));

        $this->insert('education',array(
            'name' => 'магистр',
        ));
    }

    public function down()
    {
        $this->truncateTable('education');
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