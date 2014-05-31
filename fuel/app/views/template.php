
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
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
<!-- 		<header class="blog-masthead" id="header">
 -->		<div class="logo">
		<p class="logo-title">OGU<i class="fa fa-home"></i>OUSE</p>
		<span>WEB-CREATER BLOG</span>
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
		<p class="pull-right">Page rendered in {exec_time}s using {mem_usage}mb of memory.</p>
		<p>
			<a href="http://fuelphp.com">FuelPHP</a> is released under the MIT license.<br>
			<small>Version: <?php echo e(Fuel::VERSION); ?></small>
		</p>
	</footer>
</body>
</html>
