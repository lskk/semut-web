        <header class="panel-heading text-center">
          <strong>User Verification</strong>
        </header>
        <? if(isset($info)) {?>
        <div class="alert alert-info">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <i class="fa fa-ban-circle"></i><?=$info;?>
        </div>
        <? } if(isset($error)) {?>
        <div class="alert alert-danger">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <i class="fa fa-ban-circle"></i><?=$error;?>
        </div>
        <? } ?>
        <form action="<?=base_url(); ?>member/verification" method="post" class="panel-body wrapper-lg">
          <div class="form-group">
            <label class="control-label">Email</label>
            <input type="email" id="email" name="email" placeholder="Your valid email" class="form-control input-lg">
          </div>
          <div class="form-group">
            <label class="control-label">Verification Number</label>
            <input type="text" id="number" name="number" placeholder="Your verification Number" class="form-control input-lg">
          </div>
          <button type="submit" class="btn btn-primary">OK</button>
        </form>