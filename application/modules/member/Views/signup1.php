        <header class="panel-heading text-center">
          <strong>Sign up</strong>
        </header>
        <? if(isset($error)) {?>
        <div class="alert alert-danger">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <i class="fa fa-ban-circle"></i><?=$error;?>
        </div>
        <? } ?>
        <form action="<?=base_url(); ?>member/signup" method="post" class="panel-body wrapper-lg">
          <div class="form-group">
            <label class="control-label">Name</label>
            <input type="text" id="username" name="username" placeholder="Your Name" class="form-control input-lg">
          </div>
          <div class="form-group">
            <label class="control-label">Email</label>
            <input type="email" id="email" name="email" placeholder="Your Email" class="form-control input-lg">
          </div>
          <div class="form-group">
            <label class="control-label">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" class="form-control input-lg">
          </div>
          <div class="form-group">
            <label class="control-label">Gender:&nbsp;&nbsp;</label>
            <input type="radio" name="gender" id="gender" value="1" > Male&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="gender" id="gender" value="2" > Female
          </div>
          <button type="submit" class="btn btn-primary">Sign up</button>
          <div class="line line-dashed"></div>
          <p class="text-muted text-center"><small>Already have an account?</small></p>
          <a href="<?=base_url(); ?>member" class="btn btn-default btn-block">Sign in</a>
        </form>