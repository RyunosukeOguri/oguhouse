<?php

class Controller_Articles extends Controller_Example
{

	public function before()
	{
		parent::before();
	
		// if(!Auth::check() and !in_array(Request::active()->action, array('create')))
		// {
		// 	Response::redirect('articles/login');
		// }

		$this->template->side = Controller_Example::side_contents();
	}

	public function action_index()
	{
		$aaa = Model_Article::pagination();
		$data["articles"] = $aaa['articles'];

		//ビューの読み込み
		$data["subnav"] = array('index'=> 'active');
		$this->template->title = '記事一覧';
		$this->template->content = View::forge('articles/index', $data);
	}

	public function action_view($id = 0)
	{
		//ビューに渡す配列の初期化
		$data = array();
		//IDが指定されていない場合や、指定されたIDの記事が見つからない場合は一覧にダイレクト
		$id and $data['article'] = Model_Article::find($id);
		if(!$data['article'])
		{
			Response::redirect('articles');
		}

		$response = Model_Comment::comment_obj($id);
		$data["form"] = $response['form'];

		$data["subnav"] = array('view'=> 'active' );
		$this->template->title = $data['article']->title;
		$this->template->content = View::forge('articles/view', $data, false);
	}
	public function action_login()
	{
		//既にログイン済みかどうか
		Auth::check() and Response::redirect('articles');
		//配列の作成
		$data = array();
		//Authインスタンスの作成
		$auth = Auth::instance();

		//usernameとpasswordがPOSTされているとき認証
		if(Input::post('username') and Input::post('password'))
		{
			$username = Input::post('username');
			$password = Input::post('password');
			$auth = Auth::instance();

			//認証
			if($auth->login($username, $password))
			{
				//リダイレクト
				Response::redirect('articles');
			}else
			{
				//認証失敗　$errorをセット
				$data['error'] = true;
			}
		}
		$data["subnav"] = array('login'=> 'active' );
		$this->template->title = 'ログイン';
		$this->template->content = View::forge('articles/login', $data);

	}
	public function action_logout()
	{
		//ログアウト
		$auth = Auth::instance();
		$auth->logout();

		//'member'にリダイレクト
		Response::redirect('articles');
		$this->template->title = 'ログアウト';
		$this->template->content = View::forge('articles/logout', $data);
	}

	public function action_create()
	{
		//ログイン中のユーザIDを取得
		// Auth::get_user_id()で取得できる（Auth package）
	   if (Auth::check()) {
	    } else {
	        // 未ログイン時はログインページへリダイレクト
	        Response::redirect('articles/login');
	    }
		//Model_Articleオブジェクトを新規作成
		$article = Model_Article::forge();
		$article->user_id = Arr::get(Auth::get_user_id(),1);
		//Fieldsetオブジェクトにモデルを登録
		$fieldset = Fieldset::forge()->add_model('Model_Article')->populate($article,true);

		//カテゴリのチェックボックス用のオプション配列の作成
		$categories = Model_Category::find('all');
		$category_options = array();
		foreach ($categories as $category)
		{
			$category_options[$category->id] = $category->name;
		}
		//フォーム要素の追加
		$form = $fieldset->form();
		//カテゴリチェックボックスの追加
		$form->add('category_id', 'カテゴリ', array('type' => 'checkbox', 'options' => $category_options));
		//投稿ボタンの追加
		$form->add('submit', '', array('type' => 'submit', 'value' => '投稿', 'class' =>'btn btn-default'));

		//validationの実行
		if($fieldset->validation()->run())
		{
			//validationに成功したフィールド読み込み
			$fields = $fieldset->validated();

			//Model_Articleオブジェクト作成
			$article = Model_Article::forge();

			//Model_Articleオブジェクトのプロパティの設定
			$article->title = $fields['title'];
			$article->body = $fields['body'];
			$article->user_id = $fields['user_id'];

			//カテゴリIDからカテゴリオブジェクト生成して$categoriesプロパティに設定
			if($fields['category_id'])
			{
				foreach ($fields['category_id'] as $category_id)
				{
					$category = Model_Category::find($category_id);
					if($category)
					{
						$article->categories[] = $category;
					}
				}
			}
			if($article->save())
			{
				Response::redirect('articles/view/' . $article->id);
			}
		}
			$this->template->title = '新規投稿';
			$this->template->set('content', $form->build(), false);
	}


	public function action_edit($id = 0)
	{
		if($id)
		{
			$article = Model_Article::find($id);
			if(!$article or $article->user_id != Arr::get(Auth::get_user_id(), 1))
			{
				Response::redirect('articles');
			}
		}
		//Fieldsetにモデルを登録
		$fieldset = Fieldset::forge()->add_model('Model_Article')->populate($article,true);

		//フォーム要素の追加
		$form = $fieldset->form();
		//投稿ボタンの追加
		$form->add('submit', '', array('type' => 'submit', 'value' => '更新', 'class' => 'btn btn-default btn-md'));

		//Validationnの実行
		if($fieldset->validation()->run())
		{
			//成功時
			$fields = $fieldset->validated();
			//Model_Articleのオブジェクトのプロパティ設定
			$article->title = $fields['title'];
			$article->body = $fields['body'];
			$article->user_id = $fields['user_id'];

			if($article->save())
			{
				Response::redirect('articles/view/' . $article->id);
			}
		}

		$this->template->title = '編集';
		$this->template->set('content', $form->build(), false);
	}

	public function action_category($id = 0)
	{
		$data = array();
		$this->template->title = 'カテゴリー別表示';
		$this->template->content = View::forge('articles/category', $data, false);
	}
}
