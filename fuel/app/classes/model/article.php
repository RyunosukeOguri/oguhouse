<?php

class Model_Article extends \Orm\Model
{

	protected static $_properties = array(
		'id',
		'title' => array(
			'data_type' => 'varchar',
			'label' => 'タイトル',
			'validation' => array('required'),
			'form' => array('type' => 'text','class' => 'blog-text-title'),
		),
		'body' => array(
			'data_type' => 'text',
			'label' => '本文',
			'validation' => array('required'),
			'form' => array('type' => 'textarea','class' => 'blog-text-area'),
		),
		'user_id' => array(
			'data_type' => 'string',
			'validation' => array('required','valid_string' => array(array('numeric'))),
			'form' => array('type' => 'hidden'),
		),
		'created_at' => array(
			'form' => array('type' => false),
		),
		'updated_at' => array(
			'form' => array('type' => false),
		),
	);

	protected static $_belongs_to = array(
		'user' => array(
			'key_from' => 'user_id',
			'model_to' => 'Model_User',
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
		)
	);
	protected static $_has_many = array(
		'comments' => array(
			'key_from' => 'id',
			'model_to' => 'Model_Comment',
			'key_to' => 'article_id',
			'cascade_save' => false,
			'cascade_delete' => false,
		)
	);

	protected static $_many_many = array(
		'categories' => array(
			'key_from' => 'id',
			'key_through_from' => 'article_id',
			'table_through' => 'article_category',
			'key_through_to' => 'category_id',
			'model_to' => 'Model_Category',
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
		)
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
	protected static $_table_name = 'articles';

	//ページネーション
	public static function pagination()
	{

		$response = array();

		//ページネーションの設定
		$count = Model_Article::count();
		$config = array(
			'uri_segment' => 2,
			'num_links' => 5,
			'per_page' => 4,
			'total_items' => $count,
				'template' => array(
				'previous_mark' => 'previous',
				'next_mark' => 'next',
				'name' => 'pagination',
			), 
		);
		$pagination = Pagination::forge('mypagination', $config);
		$response['pagination'] = $pagination;
		Pagination::set_config($config);

		$response['articles'] = Model_Article::query()
			->order_by('created_at', 'desc')
			->order_by('id', 'desc')
			->rows_offset(\Pagination::get('offset'))
			->rows_limit(\Pagination::get('per_page'))
			->get();

		return $response;
	}

}
