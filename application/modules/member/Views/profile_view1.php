
<section class="vbox">
  <header class="header bg-white b-b b-light">
    <p><?=$profile['Name'];?> profile</p>
  </header>
  <section class="scrollable">
    <section class="hbox stretch">
      <aside class="aside-lg bg-light lter b-r">
        <section class="vbox">
          <section class="scrollable">
            <div class="wrapper">
              <div class="clearfix m-b">
                <a href="#" class="pull-left thumb m-r">
                  <img src="<?=base_url();?>/asset/images/avatar_default.jpg" class="img-circle">
                </a>
                <div class="clear">
                  <div class="h3 m-t-xs m-b-xs"><?=$profile['Name'];?></div>
                  <small class="text-muted"><i class="fa fa-map-marker"></i>  Indonesia</small>
                </div>                
              </div>
              <div class="panel wrapper panel-success">
                <div class="row">
                  <div class="col-xs-4">
                    <a href="#">
                      <span class="m-b-xs h4 block"><?=$profile['Poin'];?></span>
                      <small class="text-muted">Poins</small>
                    </a>
                  </div>
                  <div class="col-xs-4">
                    <a href="#">
                      <span class="m-b-xs h4 block"><?=$reports;?></span>
                      <small class="text-muted">Posts</small>
                    </a>
                  </div>
                  <div class="col-xs-4">
                    <a href="#">
                      <span class="m-b-xs h4 block"><?=$checkins;?></span>
                      <small class="text-muted">Checkins</small>
                    </a>
                  </div>
                </div>
              </div>
              <div>
                <small class="text-uc text-xs text-muted">Level</small>
                <p><?if ((int)$profile['PoinLevel']<=1000) {
                  echo 'Newbie';
                } else if ((int)$profile['PoinLevel']<=10000) {
                  echo 'Addict';
                } else if ((int)$profile['PoinLevel']<=50000) {
                  echo 'Geek';
                } else if ((int)$profile['PoinLevel']>50000) {
                  echo 'Freak';
                }
                ?></p>
                <div class="line"></div>
                <small class="text-uc text-xs text-muted">Deposit</small>
                <p>
                  <?  if ((int)$profile['deposit']==null) {
                    echo 'tidak ada deposit';
                  } else  {
                    echo 'Rp. '; 
                    echo  $profile['deposit'];
                  }                     

                  ?>
                </p>

                <div class="line"></div>
                <small class="text-uc text-xs text-muted">Reputation</small>

                <p class="m-t-sm">
                  <div class="sparkline inline" data-type="bar" data-height="15" data-bar-width="15" data-bar-spacing="5" data-stacked-bar-color="['#149625', '#eee']">
                    <?=$Bar;?>
                  </div>
                </p>
              </div>
              <div class="line"></div>
              <small class="text-uc text-xs text-muted">Pin Barcode</small>
              <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl='+<?php echo  $profile['Barcode']; ?>" height="100%" width="100%"/>
              <form class="form" id="frmupdate" role="form" action="<?php echo base_url() ?>member/update" method="POST">
                <div class="form-group" style = "display:none">
                  <input type="text" class="form-control" name="contact" value=<?=$profile['ID'];echo rand(100, 200);?>>
                </div>
                
                <div class="form-group">
                  <input type="hidden" name="hidden" value=<?=$profile['ID'];?>>
                  <input type="submit" class="btn btn-success" id="exampleInputPassword2" value="reload">
                </div>

              </form>
            </div>
            <div class="line"></div>
            <?if(isset($info)) {?>
            <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <i class="fa fa-ban-circle"></i><?=$info;?>
            </div>
            <? } if(isset($warning)) {?>
            <div class="alert alert-warning">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <i class="fa fa-ban-circle"></i><?=$warning;?>
            </div>
            <? } ?>


          </div>
        </section>
      </section>
    </aside>
    <aside class="col-lg-4 b-l">
      <section class="vbox">
        <header class="header bg-light bg-gradient">
          <ul class="nav nav-tabs nav-white">
            <li class="active"><a href="#friends" data-toggle="tab">My Friends</a></li>
            <li class=""><a href="#requests" data-toggle="tab">Friend Requests</a></li>
          </ul>
        </header>
        <section class="scrollable">
          <div class="tab-content">
            <div class="tab-pane active" id="friends">
              <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                <?if ($friend_list) {
                  foreach ($friend_list as $key) {?>
                  <li class="list-group-item">
                    <a href="#" class="thumb-sm pull-left m-r-sm">
                      <img src="<?=base_url(); ?>/asset/images/avatar_default.jpg" class="img-circle">
                    </a>
                    <a href="#" class="clear">
                      <strong class="block"><?=$key['Name'];?></strong>
                      <small>Join date: <?=$key['Joindate'];?></small>
                    </a>
                  </li>
                  <? }
                } else {?>
                <li class="list-group-item">
                  <strong class="block">No Friends</strong>
                </li>
                <?}?>
              </ul>
            </div>
            <div class="tab-pane" id="requests">
              <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                <?if ($friend_req_list) {
                  foreach ($friend_req_list as $key) {?>
                  <li class="list-group-item">
                    <a href="#" class="thumb-sm pull-left m-r-sm">
                      <img src="<?=base_url(); ?>/asset/images/avatar_default.jpg" class="img-circle">
                    </a>
                    <a href="#" class="clear">
                      <strong class="block"><?=$key['Name'];?></strong>
                      <small>Join date: <?=$key['Joindate'];?></small>
                    </a>
                  </li>
                  <? }
                } else {?>
                <li class="list-group-item">
                  <strong class="block">You don't have friend request</strong>
                </li>
                <?}?>
              </ul>
            </div>
          </div>
        </section>
      </section>              
    </aside>
    <aside class="bg-white">
      <section class="vbox">
        <header class="header bg-light bg-gradient">
          <ul class="nav nav-tabs nav-white">
            <li class="active"><a href="#post" data-toggle="tab">My Tags</a></li>
          </ul>
        </header>
        <section class="scrollable">
          <div class="tab-content">
            <div class="tab-pane active" id="post">
              <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                <?if ($post_list) {
                  foreach ($post_list as $key) {?>
                  <li class="list-group-item" href="#email-content" data-toggle="class:show">
                    <a href="#" class="thumb-sm pull-left m-r-sm">
                      <img src="images/avatar_default.jpg" class="img-circle">
                    </a>
                    <a href="#" class="clear">
                      <small class="pull-right"><?=$key->Times;?></small>
                      <strong class="block"><?=$key->Type;?></strong>
                      <small><?=$key->Description;?></small>
                    </a>
                  </li>
                  <?}
                } else {?>
                <li class="list-group-item">
                  <strong class="block">No tags yet</strong>
                </li>
                <?}?>
              </ul>
            </div>
          </div>
        </section>
      </section>
    </aside>
  </section>
</section>
</section>