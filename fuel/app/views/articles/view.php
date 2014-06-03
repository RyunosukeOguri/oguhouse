<div class="col-md-12">
	<div class="row">
	<div class="blog-post">
	<h1 class="blog-post-title"><?php echo $article->title; ?></h1>
		<p class="btn btn-default btn-md right"><?php echo Html::Anchor('articles/edit/' . $article->id, '<i class="fa fa-pencil-square-o"></i>編集'); ?></p>
		<p class="blog-post-meta">
		<i class="fa fa-calendar i-left"></i><?php echo date("Y-m-d H:i:s", $article->created_at); ?>
		<?php if ($article->categories): ?>
		<span style="font-weight:bold"><i class="fa fa-tags"></i></span>
		<?php foreach ($article->categories as $category): ?>
			<?php echo $category->name; ?>
		<?php endforeach; ?>
		</p>
		<?php endif; ?>
		<hr>
	</div>
	<pre class="blog-text-area-view">
	<?php echo $article->body; ?>
	</pre>
	<hr>
	<?php if ($article->comments): ?>
		<div class="offset1">
		<?php foreach ($article->comments as $comment): ?>
		<div>
			<div style="font-weight:bold">
				<?php echo $comment->username; ?>さんのコメント
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
	<li class='<?php echo Arr::get($subnav, "index" ); ?>'><?php echo Html::anchor('articles/','<i class="fa fa-reply i-left"></i>記事一覧へ');?></li>
</ul>

<?php echo $form; ?>