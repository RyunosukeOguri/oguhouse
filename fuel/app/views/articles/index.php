<div class="jumbotron top-img">
	<h1>Web Developer BLOG</h1>
	<p>
	I want to design the life of my daily. <br>
	Realization of the dream's around the corner<br>
	Do you have a dream for you?
	</p>
	<p><a class="btn btn-primary btn-lg" role="button">Learn more</a></p>
</div>
<?php foreach ($articles as $article): ?>
<div class="col-md-5 col-blog-list">
    <!-- タイトル -->
	<h2 class="blog-title">
		<a href="<?php echo Uri::create('articles/view/' . $article->id); ?>">
			<?php echo $article->title; ?>
		</a>
	</h2>
	<p class="blog-tags">
	<!-- 投稿者 日付 -->
	<?php echo date("Y/m/d H:i:s", $article->created_at); ?><br>
	<!-- カテゴリー -->
	<?php if ($article->categories): ?>
		<span style="font-weight:bold">カテゴリー:</span>
		<?php foreach ($article->categories as $category): ?>
			<?php echo $category->name; ?>
		<?php endforeach; ?>
	<?php endif; ?>
	</p>
	<div class="blog-body-substr">
		<?php echo substr($article->body,0,130)."..."; ?>
	</div>
	<!-- コメント -->
	<?php if ($article->comments): ?>
		<br>
		<span style="font-weight:bold">コメント:</span>
			<?php echo count($article->comments) ?>件
	<?php endif; ?>
	<p><a class="btn btn-success col-blog-list-btn" href="<?php echo Uri::create('articles/view/' . $article->id); ?>" role="button">続きを読む »</a></p>
</div><!--col-8 col-sm-8 col-lg-6-->
<?php endforeach; ?>
	<?php echo Pagination::instance('mypagination'); ?>
