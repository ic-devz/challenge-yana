<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_User extends CI_Migration
{
	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => true,
				'auto_increment' => true
			),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => '60',
			),
			'password' => array(
				'type' => 'VARCHAR',
				'constraint' => '32'
			),
		));
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('users');

		$this->db->query('CREATE INDEX email_user_index ON users (email);');
	}

	public function down()
	{
		$this->dbforge->drop_table('users');
	}
}
