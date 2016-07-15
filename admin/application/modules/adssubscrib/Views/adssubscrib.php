<?
$available = (int)$units->AdsNumb - (int)$ads->NumberOfAds;
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Subscription</li>
			</ol>
		</div><!--/.row-->
				
		<div class="row">
            <div class="col-lg-12">
				<?php if(@$error): ?>
                <div class="alert bg-danger" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign"></span> <?php echo $error; ?> 
                </div>
                <?php endif; ?>

                <?php if(@$message): ?>
                <div class="alert bg-success" role="alert">
                    <span class="glyphicon glyphicon-check"></span> <?php echo $message; ?> 
                </div>
                <?php endif; ?>
			</div>
        </div><!--/.row-->
        <div class="row">    
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-body tabs">
                        
                        <ul class="nav nav-pills">
							<li class="active"><a href="#pilltab1" data-toggle="tab">Subscription Info</a></li>
							<li><a href="#pilltab2" data-toggle="tab">Upgrade Subscription</a></li>
						</ul>
		
						<div class="tab-content">
							<div class="tab-pane fade in active" id="pilltab1">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        You're in <?=$units->TypeName;?> Package Mode
                                    </div>
                                    <div class="panel-body">
                                        <p><strong>Space : </strong><?=$available;?> ads available of <?=$units->AdsNumb;?> ads</p>
                                        <p><strong>Exp Date : </strong> <?=$units->SubscriptionExp;?></p>
                                        <?if($request){?>
                                        <p><strong>You have pending upgrade request for : </strong> <?=$request->TypeName;?> Package</p>
                                        <?}?>
                                    </div>
                                </div>
							</div>	
							<div class="tab-pane fade" id="pilltab2">                                        
                                <div class="panel panel-gold panel-widget">
                                    <div class="row no-padding">
                                        <div class="col-sm-3 col-lg-4 widget-left">
                                            <em class="glyphicon glyphicon-pushpin glyphicon-l">&nbsp;Gold</em>
                                        </div>
                                        <div class="col-sm-9 col-lg-4 widget-right">
                                            <div class="large">50 Space</div>
                                            <div class="text-muted">Rp. 200.000 /year</div>
                                        </div>
                                        <div class="col-sm-9 col-lg-4 widget-right">
                                            <a href="adssubscrib/create/1"><button type="submit" class="btn btn-primary">Purchase</button></a>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="panel panel-silver panel-widget">
                                    <div class="row no-padding">
                                        <div class="col-sm-3 col-lg-4 widget-left">
                                            <em class="glyphicon glyphicon-pushpin glyphicon-l">&nbsp;Silver</em>
                                        </div>
                                        <div class="col-sm-9 col-lg-4 widget-right">
                                            <div class="large">25 Space</div>
                                            <div class="text-muted">Rp. 100.000 /year</div>
                                        </div>
                                        <div class="col-sm-9 col-lg-4 widget-right">
                                            <a href="adssubscrib/create/2"><button type="submit" class="btn btn-primary">Purchase</button></a>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="panel panel-bronze panel-widget">
                                    <div class="row no-padding">
                                        <div class="col-sm-3 col-lg-4 widget-left">
                                            <em class="glyphicon glyphicon-pushpin glyphicon-l">&nbsp;Bronze</em>
                                        </div>
                                        <div class="col-sm-9 col-lg-4 widget-right">
                                            <div class="large">10 Space</div>
                                            <div class="text-muted">Rp. 50.000 /year</div>
                                        </div>
                                        <div class="col-sm-9 col-lg-4 widget-right">
                                            <a href="adssubscrib/create/3"><button type="submit" class="btn btn-primary">Purchase</button></a>
                                        </div>
                                    </div>
                                </div>
							</div>
						</div>
                        
					</div>
				</div>
			</div>
            <div class="col-md-4">
                <div class="panel panel-green">
					<div class="panel-body">
						<div id="calendar"></div>
					</div>
				</div>
            </div>
		</div><!--/.row-->			
	</div><!--/.main-->