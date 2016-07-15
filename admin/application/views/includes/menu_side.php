    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<ul class="nav menu">
			<li class="<? if ($this->uri->segment(1)=='member' || $this->uri->segment(1)=='') {echo 'active';}?>">
                <a href="<?php echo base_url(); ?>"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a>
            </li>
<!--Admin BSTS WebApp Menu-->
            <?php  if ($this->session->userdata('role')=='admin') { ?>
			<li class="<? if (($this->uri->segment(1)=='maps' && $this->uri->segment(2)=='')||($this->uri->segment(1)=='maps' && $this->uri->segment(2)=='index') ){echo 'active';}?>">
                <a href="<?php echo base_url(); ?>maps"><span class="glyphicon glyphicon-globe"></span> Maps</a>
            </li><!--
			<li class="parent">
                <a href="#"><span class="glyphicon glyphicon-stats"></span> Statistics
                    <span data-toggle="collapse" href="#sub-summary" class="icon pull-right">
                        <em class="glyphicon glyphicon-s glyphicon-plus"></em>
                    </span>
                </a>
                <ul class="children collapse" id="sub-summary">
					<li>
						<a class="" href="#">
							<span class="glyphicon glyphicon-stats"></span> User Semut
						</a>
					</li>
					<li>
						<a class="" href="<?php echo base_url(); ?>summary">
							<span class="glyphicon glyphicon-stats"></span> User Activity Log
						</a>
					</li>
				</ul>
            </li>-->
            <!--<li><a href="#"><span class="glyphicon glyphicon-user"></span> User Semut</a></li>-->
            <li class="<? if ($this->uri->segment(1)=='places') {echo 'active';}?>">
                <a href="<?php echo base_url(); ?>places"><span class="glyphicon glyphicon-cog"></span> Places</a>
            </li>
            <li class="<? if ($this->uri->segment(1)=='cctv') {echo 'active';}?>">
                <a href="<?php echo base_url(); ?>cctv"><span class="glyphicon glyphicon-cog"></span> CCTV</a>
            </li>
            <!--<li><a href="<?php echo base_url(); ?>ambulances"><span class="glyphicon glyphicon-cog"></span> Ambulance</a></li>
            <li class="<? if ($this->uri->segment(1)=='taxicompany') {echo 'active';}?>">
                <a href="<?php echo base_url(); ?>taxicompany"><span class="glyphicon glyphicon-cog"></span> Taxi Company</a>
            </li>
            <li class="<? if ($this->uri->segment(1)=='adscompany') {echo 'active';}?>">
                <a href="<?php echo base_url(); ?>adscompany"><span class="glyphicon glyphicon-cog"></span> Ads Company</a>
            </li>-->
<!--Taxi administrator menu-->
            <?php } else if($this->session->userdata('role')=='taxi') {?>
            <li><a href="<?php echo base_url(); ?>maptaxi"><span class="glyphicon glyphicon-dashboard"></span> Taxi Monitoring</a></li>
			<li><a href="<?php echo base_url(); ?>taxiarmada"><span class="glyphicon glyphicon-cog"></span> Taxi Management</a></li>
			<li><a href="<?php echo base_url(); ?>taxidriver"><span class="glyphicon glyphicon-user"></span> Driver Management</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-stats"></span>Transactions</a></li>
			<li><a href="#"><span class="glyphicon glyphicon-stats"></span> Statistics</a></li>
<!--Ads administrator menu-->
            <?php } else if($this->session->userdata('role')=='ads') {?>
            <li><a href="<?php echo base_url(); ?>adsmap"><span class="glyphicon glyphicon-dashboard"></span> Ads map View</a></li>
            <li><a href="<?php echo base_url(); ?>adssubscrib"><span class="glyphicon glyphicon-cog"></span> Subscription</a></li>
            <li><a href="<?php echo base_url(); ?>ads"><span class="glyphicon glyphicon-cog"></span> Ads management</a></li>
			<li><a href="#"><span class="glyphicon glyphicon-stats"></span> Statistics</a></li>
<!--Ambulance administrator menu-->
            <?php } else if($this->session->userdata('role')=='ambulance') {?>
			<li><a href="#"><span class="glyphicon glyphicon-stats"></span> Emergency History</a></li>
            <?php }?>
			<li role="presentation" class="divider"></li>
		</ul>
		<div class="attribution">LSKK ITB &copy; 2015</div>
	</div><!--/.sidebar-->