<?php

namespace Fuel\Migrations;

class Create_article_category
{
	public function up()
	{
		\DBUtil::create_table('article_category', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'article_id' => array('constraint' => 11, 'type' => 'int'),
			'category_id' => array('constraint' => 11, 'type' => 'int'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('article_category');
	}
}