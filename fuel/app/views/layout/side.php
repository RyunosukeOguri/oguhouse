<div class="sidebar-module">

	<ul class="nav nav-pills nav-aritcle">
		<li><?php echo Html::anchor('articles/','記事一覧');?></li>
	</ul>
	<h4>SNS</h4>
	<ol class="list-unstyled">
	<li><a target="_blank" href="https://github.com/RyunosukeOguri">GitHub</a></li>
	<li><a target="_blank" href="https://twitter.com/amagurik2">Twitter</a></li>
	<li><a target="_blank" href="https://www.facebook.com/ryuunosuke.oguri">Facebook</a></li>
	</ol>

	<h4>Dairy -最近の記事-</h4>
	<ol class="list-unstyled">
		<?php foreach ($articles as $article): ?>
		<li>
			<!-- 投稿者 日付 -->
			<?php echo date("Y/m/d H:i:s", $article->created_at); ?><br>
			<h2 class="blog-title">
			<a href="<?php echo Uri::create('articles/view/' . $article->id); ?>">
			<?php echo $article->title; ?>
			</a>
			</h2>
			<p class="blog-tags">
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
			<hr>
		</li>
		<?php endforeach; ?>
	</ol>
	</div><!-- sidebar -->