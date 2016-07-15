		<section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="<?=base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
                <li class="active">Dashboard</li>
              </ul>
              <section class="panel panel-default">
                <div class="row m-l-none m-r-none bg-light lter">
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                    <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-info"></i>
                      <i class="fa fa-users fa-stack-1x text-white"></i>
                    </span>
                    <a class="clear" href="#">
                      <span class="h3 block m-t-xs"><strong><?=$friends;?></strong></span>
                      <small class="text-muted text-uc">Friends</small>
                    </a>
                  </div>
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-warning"></i>
                      <i class="fa fa-user fa-stack-1x text-white"></i>
                    </span>
                    <a class="clear" href="#">
                      <span class="h3 block m-t-xs"><strong id="bugs"><?=$friend_reqs;?></strong></span>
                      <small class="text-muted text-uc">Friend Request</small>
                    </a>
                  </div>
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light">                     
                    <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-info"></i>
                      <i class="fa fa-map-marker fa-stack-1x text-white"></i>
                    </span>
                    <a class="clear" href="#">
                      <span class="h3 block m-t-xs"><strong id="firers"><?=$reports;?></strong></span>
                      <small class="text-muted text-uc">Tags</small>
                    </a>
                  </div>
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-success"></i>
                      <i class="fa fa-map-marker fa-stack-1x text-white"></i>
                    </span>
                    <a class="clear" href="#">
                      <span class="h3 block m-t-xs"><strong><?=$poins->Poin;?></strong></span>
                      <small class="text-muted text-uc">Poins</small>
                    </a>
                  </div>
                </div>
              </section>
              <div class="row">
                <div class="col-md-4">
                  <section class="panel panel-default portlet-item">
                    <header class="panel-heading">
                      Member Reputation Ranking <span class="badge bg-info">5</span>                    
                    </header>
                    <section class="panel-body">
                      <?if ($p_rank) {
                        foreach ($p_rank as $item) {?>
                          <article class="media">
                            <div class="pull-left">
                              <span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x text-info"></i>
                                <i class="fa fa-user fa-stack-1x text-white"></i>
                              </span>
                            </div>
                            <div class="media-body">                        
                              <a href="#" class="h4"><?=$item->Name;?></a>
                              <small class="block m-t-xs"><?=$item->Poin;?>  poins</small>
                              <em class="text-xs">Join date <span class="text-danger"><?=$item->Joindate;?></span></em>
                            </div>
                          </article>
                          <div class="line pull-in"></div>
                        <?}
                      } else {?>
                        <article class="media">
                        <div class="media-body">                        
                          No data found
                        </div>
                      </article>
                      <?}?>
                    </section>
                  </section>
                </div>
                <div class="col-md-4">
                  <section class="panel panel-default portlet-item">
                    <header class="panel-heading">
                      Member Poins Ranking <span class="badge bg-info">5</span>                    
                    </header>
                    <section class="panel-body">
                      <?if ($r_rank) {
                        foreach ($r_rank as $item) {?>
                          <article class="media">
                            <div class="pull-left">
                              <span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x text-info"></i>
                                <i class="fa fa-user fa-stack-1x text-white"></i>
                              </span>
                            </div>
                            <div class="media-body">                        
                              <a href="#" class="h4"><?=$item['Name'];?></a><br><br>
                              <div class="sparkline inline" data-type="bar" data-height="15" data-bar-width="15" data-bar-spacing="5" data-stacked-bar-color="['#149625', '#eee']">
                                <?=$item['Bar'];?>
                              </div><br>
                              <em class="text-xs">Join date <span class="text-danger"><?=$item['Joindate'];?></span></em>
                            </div>
                          </article>
                          <div class="line pull-in"></div>
                        <?}
                      } else {?>
                        <article class="media">
                        <div class="media-body">                        
                          No data found
                        </div>
                      </article>
                      <?}?>
                    </section>
                  </section>
                </div>
                
                <div class="col-md-4">
                  <section class="panel panel-default">
                    <header class="panel-heading font-bold">Video</header>
                    <div class="bg-light dk wrapper">
                      <video width="320" height="240" controls><source src="<?=base_url();?>/public/data/video/Semut_video.mp4">Your browser does not support the video tag.</video>
                    </div>
                      
                  </section>
                </div>
              </div>
            </section>
        </section>
          
