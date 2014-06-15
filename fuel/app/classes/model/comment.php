<?php

class Model_Comment extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'article_id' => array(
			'data_type' => 'int',
			'label' => '記事ID',
			'validation' => array(),
			'form' => array('type' => 'hidden'),
		),
		'username' => array(
			'data_type' => 'varchar',
			'label' => 'お名前',
			'validation' => array('required'),
			'form'=> array('type' => 'text','class' => 'blog-text-title'),
		),
		'email' => array(
			'data_type' => 'varchar',
			'label' => 'Eメール',
			'validation' => array('required'),
			'form' => array('type' => 'email','class' => 'blog-text-title'),
		),
		'body' => array(
			'data_type' => 'int',
			'label' => 'コメント',
			'validation' => array('required'),
			'form' => array('type' => 'textarea'),
		),
		'created_at' => array(
			'form' => array('type' => false),
		),
		'updated_at' => array(
			'form' => array('type' => false),
		)
	);


	protected static $_belongs_to = array(
		'user' => array(
			'key_from' => 'user_id',
			'mode_to' => 'Model_User',
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
	protected static $_table_name = 'comments';

	public static function comment_obj($id)
	{
		$response = array();

		//Model_commentオブジェクトの新規作成
		$comment = Model_Comment::forge();
//		$comment->user_id = Arr::get(Auth::get_user_id(), 1);

		//Fieldsetオブジェクトにモデルを登録
		$fieldset = Fieldset::forge()->add_model('Model_Comment')->populate($comment, true);
		//フォーム要素の追加
		$form = $fieldset->form();
		//投稿ボタンの追加
		$form->add('submit', '', array('type' => 'submit', 'value' => 'コメントする', 'class' => 'btn btn-default btn-md'));


		//Validationの実行
		// if($fieldset->validation()->run())
		var_dump(input::post());

		if(input::post()){
			if($fieldset->validation()->run()){

				$fields = $fieldset->validated();
				$comment->article_id = $id;
				$comment->body = $fields['body'];
				$comment->username = $fields['username'];
				$comment->email = $fields['email'];

				// $new_comment = Model_Comment::forge(array(
				// 	"body" => Input::post("body")
				// ));

				//$new_comment = new Model_Comment();

				//$new_comment->save()
				
				if($comment->save()){ Response::redirect('articles/view/' . $id); }

			}else{
				echo 'validation not run';
			//	$fieldset->repopulate();
			}


		}
				$response['form'] = $form->build();

				return $response;
	}

}
