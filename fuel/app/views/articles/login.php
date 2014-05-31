<ul class="nav nav-pills nav-aritcle">
	<li class='<?php echo Arr::get($subnav, "index" ); ?>'><?php echo Html::anchor('articles/','記事一覧');?></li>
</ul>

<div class="row">
	<div class="col-md-5">
	<?php echo Form::open(array('role' => 'form')); ?>
	<fieldset>
		<?php if(isset($error)): ?>
		<div class="form-group" style="color:red">
			ユーザー名またはパスワードが間違っています。
		</div>
		<?php endif; ?>
  		<div class="form-group">
		<?php echo Form::label('ユーザー名', 'exampleInputEmail1'); ?>
		<?php echo Form::input('username','',array('class' => 'form-control','id' => 'exampleInputEmail1','placeholder' => 'Username')); ?>
		</div>
		<div class="form-group">
		<?php echo Form::label('パスワード', 'exampleInputPassword1'); ?>
		<?php echo Form::password('password','',array('class' => 'form-control','id' => 'exampleInputPassword1','placeholder' => 'Password')); ?>
		</div>
		<div class="form-group">
		<?php echo Form::submit('submit', 'ログイン', array('class' => 'btn btn-default btn-sm')); ?>
		</div>
	</fieldset>
	<?php echo Form::close(); ?>
	</div><!-- col-md-5 -->
</div><!--row -->

