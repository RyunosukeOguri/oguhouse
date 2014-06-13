//記事モデル
oil g model article title:varchar[50] body:text user_id:int

//データーベースに反映
oil refine migrate

//投稿者モデル  string = varchar[255]
oil g model user email:string password:string name:varchar[50]

oil refine migrate

//コメントモデル
oil g model comment article_id:int user_id:int body:text

//カテゴリモデル
oil g model category name:varchar[50]

oil generate migration create_article_category article_id:int category_id:int --no-timestamp

create database blog_oguhouse;
grant all on blog_oguhouse.* to oguri@localhost identified by 'ryuunosuke2k2';

//初期テストユーザー登録
$auth = Auth::instance();
$user = Model_User::forge();
$user->email = 'oguri@example.com';
$user->password = $auth->hash_password('qwer1234');
$user->name = 'Ryuunosuke Oguri';
$user->username = 'amagurik2';
$user->save();
true

$auth = Auth::instance();
$user = Model_User::forge();
$user->email = 'admin@example.com';
$user->password = $auth->hash_password('oguhousemyadmin0314');
$user->name = 'admin';
$user->username = 'admin';
$user->save();


//登録内容をみる
Model_User::find('all');

//初期カテゴリーの設定
$cat = Model_Category::forge();
$cat->name = 'diary';
$cat->save();
true

$cat = Model_Category::forge();
$cat->name = 'news';
$cat->save();
true

$cat = Model_Category::forge();
$cat->name = 'php';
$cat->save();

$cat = Model_Category::forge();
$cat->name = 'mysql';
$cat->save();

$cat = Model_Category::forge();
$cat->name = 'fuelphp';
$cat->save();

$cat = Model_Category::forge();
$cat->name = 'html';
$cat->save();

$cat = Model_Category::forge();
$cat->name = 'css';
$cat->save();

$cat = Model_Category::forge();
$cat->name = 'article';
$cat->save();

//初期記事の投稿
$art = Model_Article::forge();
$art->user_id = 1;
$art->title = 'ブログ始めました';
$art->body = "最近勉強を始めたFuelPHPでブログを作ってみたいと思います。webエンジニアに役立つ情報や自分がハマったり、うまくいかなかった事などをまとめていけたらなと思います。自分の勉強も兼ねてwebのいろ いろを記事にしていきたいです！";
$art->categories[] = Model_Category::find(1);
$art->categories[] = Model_Category::find(2);
$art->save();
true


//初期コメントの登録
$comment = Model_Comment::forge();
$comment->article_id = 1;
$comment->user_id = 2;
$comment->body = "コメントテストです。";
$comment->save();
true



//コントローラーとビュー作成
oil g controller articles index view login


//２回目のテスト投稿
$art = Model_Article::forge();
$art->user_id = 1;
$art->title = '初期段階はできたようです';
$art->body = 'mysqlも無事動いていますし、migarteもうまくいきました＾＾。<br>まだわからない事ばかりなのでとりあえずは参考書通りに作れるかやってみようと思います。<br>もっとfuelphpの開発フローに慣れていきたいです。';
$art->categories[] = Model_Category::find(1);
$art->categories[] = Model_Category::find(2);
$art->save();

$art = Model_Article::forge();
$art->user_id = 1;
$art->title = 'fuelphp part1-3';
$art->body = 'php oil generate articles index view ------------------------------php oil refine migrate';
$art->categories[] = Model_Category::find(1);
$art->categories[] = Model_Category::find(2);
$art->save();


// Model_User
の修正

oil generate migration add_username_to_users username:varchar[50]

oil generate migration add_last_login_to_users last_login:int

oil generate migration add_login_hash_to_users login_hash:string

oil refine migrate


//pagination
config/paginaiton.php
1.7の書き方




ロリポップサーバー　mysqlぶちこむ


<<<<<<< HEAD
コメントモデル修正

oil generate migration add_email_to_comments email:string

=======
>>>>>>> origin/master


こーで
