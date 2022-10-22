<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_User_Activities extends CI_Migration
{
	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'BIGINT',
				'constraint' => 20,
				'unsigned' => true,
				'auto_increment' => true
			),
			'message_text' => array(
				'type' => 'MEDIUMTEXT'
			),
			'message_from' => array(
				'type' => 'VARCHAR',
				'constraint' => '100'
			),
			'datetime' => array(
				'type' => 'VARCHAR',
				'constraint' => '100'
			),
			'timestamp' => array(
				'type' => 'VARCHAR',
				'constraint' => '100'
			),
		));

		$this->dbforge->add_key('id', true);
		$this->dbforge->add_key('uid');
		$this->dbforge->create_table('user_activities');

		$foreignKey = [
			'uid' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => true,
				'null' => false
			),
			'CONSTRAINT users_uid_fk FOREIGN KEY(`uid`) REFERENCES `users`(`id`)'
		];

		$this->dbforge->add_column('user_activities', $foreignKey);
	}

	public function down()
	{
		$this->dbforge->drop_table('user_activities');
	}
}
