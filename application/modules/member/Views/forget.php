        <header class="panel-heading text-center">
          <strong>Reset Password Form</strong>
        </header>
        <form action="<?=base_url(); ?>member/resetpassword" class="panel-body wrapper-lg">
          <div class="form-group">
            <label class="control-label">Email</label>
            <input type="email" id="email" name="email" placeholder="Your valid email" class="form-control input-lg">
          </div>
          <a href="<?=base_url(); ?>member/signin" class="pull-right m-t-xs"><small>Back to Sign in page</small></a>
          <button type="submit" class="btn btn-primary">Reset</button>
        </form>