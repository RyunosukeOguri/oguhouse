<div class="sidebar-module">
<div class="panel panel-info">
		<div class="panel-heading">SNS</div>
		<div class="panel-body">
		<ol class="list-unstyled">
		<li><a target="_blank" href="https://github.com/RyunosukeOguri">GitHub</a></li>
		<li><a target="_blank" href="https://twitter.com/amagurik2">Twitter</a></li>
		<li><a target="_blank" href="https://www.facebook.com/ryuunosuke.oguri">Facebook</a></li>
		</ol>
		</div>
</div>

<div class="panel panel-warning">
<<<<<<< HEAD
	<div class="panel-heading"><i class="fa fa-book i-left"></i>Dairy -最近の記事-</div>
=======
	<div class="panel-heading">Dairy -最近の記事-</div>
>>>>>>> origin/master
	<div class="panel-body">
	<ol class="list-unstyled">
		<?php foreach ($articles as $article): ?>
		<li>
			<!-- 投稿者 日付 -->
<<<<<<< HEAD
			<i class="fa fa-calendar i-left"></i><span style="color:#AFAFAF"><?php echo date("Y/m/d H:i:s", $article->created_at); ?></span><br>
			<span class="blog-tags-side">
=======
			更新日：<span style="color:#AFAFAF"><?php echo date("Y/m/d H:i:s", $article->created_at); ?></span>
			<h2 class="blog-title">
			<a href="<?php echo Uri::create('articles/view/' . $article->id); ?>">
			<?php echo $article->title; ?>
			</a>
			</h2>
			<p class="blog-tags">
>>>>>>> origin/master
			<!-- カテゴリー -->
			<?php if ($article->categories): ?>
			<span style="font-weight:bold"><i class="fa fa-tags i-left"></i></span>
			<?php foreach ($article->categories as $category): ?>
			<?php echo $category->name; ?>
			<?php endforeach; ?>
			<?php endif; ?>
			</span>
			<h2 class="blog-title-side">
			<a href="<?php echo Uri::create('articles/view/' . $article->id); ?>">
			<?php echo $article->title; ?>
			</a>
			</h2>
			<div class="blog-body-substr">
			<?php echo substr($article->body,0,130)."..."; ?>
			</div>
			<hr>
		</li>
		<?php endforeach; ?>
	</ol>
	</div>
</div>
<<<<<<< HEAD
</div><!-- sidebar -->
=======

	
	</div><!-- sidebar -->
>>>>>>> origin/master
