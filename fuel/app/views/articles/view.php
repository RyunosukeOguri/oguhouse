<div class="col-md-12">
	<div class="row">
	<div class="blog-post">
	<h1 class="blog-post-title"><?php echo $article->title; ?></h1>
		<p class="blog-post-meta">
		<span style="font-weight:bold">投稿者:</span>
		<?php echo $article->user->name; ?>
		(<?php echo date("Y-m-d H:i:s", $article->created_at); ?>)<br>
		<?php if ($article->categories): ?>
		<span style="font-weight:bold">カテゴリー:</span>
		<?php foreach ($article->categories as $category): ?>
			<?php echo $category->name; ?>
		<?php endforeach; ?>
		</p>
		<?php endif; ?>
		<hr>
	</div>
	<?php echo $article->body; ?>
	<hr>
	<?php if ($article->comments): ?>
		<div class="offset1">
		<?php foreach ($article->comments as $comment): ?>
		<div>
			<div style="font-weight:bold">
				<?php echo $comment->user->name; ?>さんのコメント
			</div>
			<div>
				<?php echo $comment->body; ?>
			</div>
			<div>
				(<?php echo date("Y-m-d H:i:s", $comment->created_at); ?>)
			</div>
			<hr>
		</div>
		<?php endforeach; ?>
<?php endif; ?>
	</div>
</div>
<ul class="nav nav-pills nav-aritcle">
	<li class='<?php echo Arr::get($subnav, "index" ); ?>'><?php echo Html::anchor('articles/','<i class="fa fa-reply i-left"></i>戻る');?></li>
</ul>