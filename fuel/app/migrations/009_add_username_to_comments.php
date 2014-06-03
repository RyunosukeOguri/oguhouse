<?php

namespace Fuel\Migrations;

class Add_username_to_comments
{
	public function up()
	{
		\DBUtil::add_fields('comments', array(
			'username' => array('constraint' => 50, 'type' => 'varchar'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('comments', array(
			'username'

		));
	}
}