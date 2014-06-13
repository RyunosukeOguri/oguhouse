<div class="sidebar-module">
<div class="panel panel-black">
	<div class="panel-heading"><i class="fa fa-book i-left"></i>Dairy -最近の記事-</div>
	<div class="panel-body">
	<ol class="list-unstyled">
		<?php foreach ($articles as $article): ?>
		<li>
			<!-- 投稿者 日付 -->
			<i class="fa fa-calendar i-left"></i><span style="color:#89DB21"><?php echo date("Y/m/d H:i:s", $article->created_at); ?></span><br>
			<span class="blog-tags-side">
			<p class="blog-tags">
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
</div><!-- sidebar -->