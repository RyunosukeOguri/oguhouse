<?php

namespace Fuel\Migrations;

class Delete_user_id_to_comments
{
	public function up()
	{
		\DBUtil::drop_fields('', array(
			'user_id'

		));
	}

	public function down()
	{
		\DBUtil::add_fields('', array(
			'user_id' => array('constraint' => 11, 'type' => 'int'),

		));
	}
}