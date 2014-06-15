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
	  $response = array();

	  $category = Model_Category::find('all');

	  foreach($category as $categories){
	  	$response[$categories->id] = $categories->name;
	  }

	  return $response;

	}

	public static function category_init($array = "", $id = 0)
	{
		$response = array();
		$category = Model_Category::find($id);
		
		//ページネーションの設定

		$response = array(
			"articles" => Model_Article::query()
			->order_by('created_at', 'desc')
			->order_by('id', 'desc')
			->rows_offset(\Pagination::get('offset'))
			->rows_limit(\Pagination::get('per_page'))
			->get(),
			"category" => $category->name
		);

		//$article = Model_Article::find();

		// $response['category'] = Model_Article::query()
		// 	->order_by('created_at', 'desc')
		// 	->order_by('name', 'desc')
		// 	->get();

		return $response[$array];
	}
}
