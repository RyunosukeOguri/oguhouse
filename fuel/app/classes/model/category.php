<?php

class Model_Category extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'name',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'mysql_timestamp' => false,
		),
	);
	protected static $_table_name = 'categories';

  public static function category_obj()
	{
	  $data = array();

	  $category = Model_Category::find('all');

	  foreach($category as $categories){
	  	$response[$categories->id] = $categories->name;
	  }

	  return $response;

	}

}
