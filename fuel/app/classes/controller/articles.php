<?php

class Controller_Articles extends Controller_Example
{
	private $per_page = 4;

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
		//ビューに渡す配列の初期化
		$data = array();

		//ページネーションの設定
		$count = Model_Article::count();
		$config = array(
			'pagination_url' => 'http://localhost.com/oguhouse/public/articles/',
			'uri_segment' => 2,
			'num_links' => 5,
			'per_page' => $this->per_page,
			'total_items' => $count,
				'template' => array(
				'wrapper_start' => '<div class="actions"> ',
				'wrapper_end' => '</div>',
				'active_start' => '<span class="active"> ',
				'active_end' => '</span>',
				'first_link' => '最初のページ',
				'last_link' => '最後のページ',
				'previous_start' => 'previous',
				'previous_end' => 'next',
				'previous_mark' => 'previous',
				'next_mark' => 'next',
				'name' => 'pagination',
			), 
		);
		$pagination = Pagination::forge('mypagination', $config);
		$data['pagination'] = $pagination;
		Pagination::set_config($config);

		// Pagination::set('per_page', 3);

		//モデルから記事を取得
		// 'mypagination' という名前の pagination インスタンスを作る
//		$data['articles'] = Model_Article::find('all')
		$data['articles'] = Model_Article::query()
			->order_by('created_at', 'desc')
			->order_by('id', 'desc')
			->rows_offset(\Pagination::get('offset'))
			->rows_limit(\Pagination::get('per_page'))
			->get();

		//ビューの読み込み
		$data["subnav"] = array('index'=> 'active' );
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

		$data["subnav"] = array('view'=> 'active' );
		$this->template->title = $data['article']->title;
		$this->template->content = View::forge('articles/view', $data);
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
}
