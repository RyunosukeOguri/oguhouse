<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="content-language" content="ja">
	<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1, maximum-scale=1\">
	<title><?php echo $title; ?></title>
	<?php echo Asset::css('bootstrap.css'); ?>
	<?php echo Asset::css('blog.css'); ?>
	<?php echo Asset::css('style.css'); ?>
	<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<?php echo Asset::js('jquery-1.9.1.min.js'); ?>
	<?php echo Asset::js('test.js'); ?>
</head>
<body>
	<!--/////////////////
	 >>>> header <<<<
	/////////////////-->
	<header class="navbar navbar-default navbar-static-top" id="header" role="navigation">
	<div class="logo">
		<p class="logo-title">OGU<i class="fa fa-home"></i>OUSE</p>
		<span>WEB-CREATER BLOG</span>
		</div>
		<div class="nav-header-auth">
			<a class="sns-btn-a" target="_blank" href="https://plus.google.com/u/0/115875078341552818583/posts"><i class="fa fa-google-plus-square fa-2x i-left google"></i></a>
			<a class="sns-btn-a" target="_blank" href="https://github.com/RyunosukeOguri"><i class="fa fa-github fa-2x i-left git"></i></a>
			<a class="sns-btn-a" target="_blank" href="https://twitter.com/amagurik2"><i class="fa fa-twitter-square fa-2x i-left twitter"></i></a>
			<a class="sns-btn-a" target="_blank" href="https://www.facebook.com/ryuunosuke.oguri"><i class="fa fa-facebook-square fa-2x i-left facebook"></i></a>
		</div>

		<nav class="nav-header-auth">
			<ul>		
			<?php if(Auth::check()): ?>
			<li><?php echo Html::anchor('articles/logout','<i class="fa fa-unlock i-left"></i>ログアウト'); ?></li>
			<li><?php echo Html::anchor('articles/create','<i class="fa fa-pencil-square-o"></i>新規投稿');?></li>
			<?php else: ?>
			<li><?php echo Html::anchor('articles/login','<i class="fa fa-key i-left"></i>ログイン'); ?></li>
			<?php endif; ?>
			</ul>
		</nav>
	</header>
	<div class="container" id="container">
		<div class="row row-offcanvas row-offcanvas-right">
			<!--/////////////////
			 >>>> blog-main <<<<
			/////////////////-->
			<div class="col-sm-8 blog-main">
				<?php echo $content; ?>
			</div><!-- col-sm-8 blog-main -->
			<!--/////////////////
			 >>>> sidebar <<<<
			/////////////////-->
			<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
				<?php echo $side; ?>
			</div><!-- col-sm-3 blog-sidebar -->
		</div><!-- row -->
	</div><!--container -->
	<!--/////////////////
	 >>>> footer <<<<
	/////////////////-->
	<footer class="panel-footer" id="footer">
	<div>
		<ol>
		<li class="sns-btn"><a target="_blank" href="https://plus.google.com/u/0/115875078341552818583/posts"><i class="fa fa-google-plus-square fa-2x i-left sns-icon"></i>Google+</a></li>
		<li class="sns-btn"><a target="_blank" href="https://github.com/RyunosukeOguri"><i class="fa fa-github fa-2x i-left sns-icon"></i>GitHub</a></li>
		<li class="sns-btn"><a target="_blank" href="https://twitter.com/amagurik2"><i class="fa fa-twitter-square fa-2x i-left sns-icon"></i>Twitter</a></li>
		<li class="sns-btn"><a target="_blank" href="https://www.facebook.com/ryuunosuke.oguri"><i class="fa fa-facebook-square fa-2x i-left sns-icon"></i>Facebook</a></li>
		</ol>
	</div>
		<p>
			<p class="copyRight">&copy;<a href="http://oguhouse.com/">oguhouse</a></p>
			<small>Version: 1.7.0</small>
		</p>
	</footer>
</body>
</html>
