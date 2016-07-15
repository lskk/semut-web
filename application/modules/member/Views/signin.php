        <header class="panel-heading text-center">
          <strong>Sign in</strong>
        </header>
        <? if(isset($error)) {?>
	      <div class="alert alert-danger">
	        <button type="button" class="close" data-dismiss="alert">&times;</button>
	        <i class="fa fa-ban-circle"></i><?=$error;?>
	      </div>
		<? } if(isset($successreset)) {?>
        <div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <i class="fa fa-ban-circle"></i><?=$successreset;?>
        </div>
        <? } if(isset($errorreset)) {?>
        <div class="alert alert-danger">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <i class="fa fa-ban-circle"></i><?=$errorreset;?>
        </div>
        <? } ?>
        <form action="<?=base_url(); ?>member/signin" method="post" class="panel-body wrapper-lg">
          <div class="form-group">
            <label class="control-label">Email</label>
            <input type="email" id="email" name="email" placeholder="Your Email" class="form-control input-lg">
          </div>
          <div class="form-group">
            <label class="control-label">Password</label>
            <input type="password" id="password" name="password" placeholder="Your Password" class="form-control input-lg">
          </div>
          <a href="<?=base_url(); ?>member/forget" class="pull-right m-t-xs"><small>Forgot password?</small></a>
          <button type="submit" class="btn btn-primary">Sign in</button>
          <div class="line line-dashed"></div>
          <p class="text-muted text-center"><small>Do not have an account?</small></p>
          <a href="<?=base_url(); ?>member/signup" class="btn btn-default btn-block">Create an account</a>
          <div class="line line-dashed"></div>
          <p class="text-muted text-center"><small>--- Or ---</small></p>
          <a href="#" class="btn btn-facebook btn-block m-b-sm"><i class="fa fa-facebook pull-left"></i>Sign in with Facebook</a>
        </form>
