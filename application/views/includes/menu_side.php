		<aside class="bg-dark lter aside-md hidden-print" id="nav">          
          	<section class="vbox">
	            <header class="header lter text-center clearfix">
		            <div class="btn-group">
		            <? if ($this->session->userdata('logged_in')) { ?>
			            <a href="<?php echo base_url(); ?>member/profile">
			            <button type="button" class="btn btn-sm btn-dark btn-icon"><i class="fa fa-cog"></i></button>
			        	</a>
			            <a href="<?php echo base_url(); ?>member/logout">
			            <div class="btn-group">
			              	<button type="button" class="btn btn-sm btn-info">LogOut</button>
			            </div>
				        </a>
		            <? } else { ?>
			            <a href="<?php echo base_url(); ?>member">
			            <button type="button" class="btn btn-sm btn-dark btn-icon"><i class="fa fa-user"></i></button>
			            <div class="btn-group">
			              	<button type="button" class="btn btn-sm btn-info">Member Login</button>
			            </div>
				        </a>
    				<?}?>
		            </div>
	            </header>
	            <section class="w-f scrollable">
		            <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
		                <!-- nav -->
		                <nav class="nav-primary hidden-xs">
			            	<ul class="nav ">
			                    <li class="<? if ($this->uri->segment(1)=='' || $this->uri->segment(1)=='maps') {echo 'active';}?>">
			                      <a href="<?=base_url(); ?>maps"  class="<? if ($this->uri->segment(1)=='maps') {echo 'active';}?>">
			                        <i class="fa fa-globe icon">
			                          <b class="bg-success"></b>
			                        </i>
			                        <span>Home</span>
			                      </a>
			                    </li>
			            	<? if ($this->session->userdata('logged_in')) { ?> <!--Menu for if logged in as member-->
			                    <li  class="<? if ($this->uri->segment(1)=='member' && $this->uri->segment(2)=='') {echo 'active';}?>">
			                      <a href="<?=base_url(); ?>member"   class="<? if ($this->uri->segment(1)=='member' && $this->uri->segment(2)=='') {echo 'active';}?>">
			                        <i class="fa fa-dashboard icon">
			                          <b class="bg-danger"></b>
			                        </i>
			                        <span>LeaderBoard</span>
			                      </a>
			                    </li>
			                    <li  class="<? if ($this->uri->segment(1)=='member' && $this->uri->segment(2)=='profile') {echo 'active';}?>">
			                      <a href="<?=base_url(); ?>member/profile"   class="<? if ($this->uri->segment(1)=='member' && $this->uri->segment(2)=='profile') {echo 'active';}?>">
			                        <i class="fa fa-user icon">
			                          <b class="bg-warning"></b>
			                        </i>
			                        <span>Profile</span>
			                      </a>
			                    </li>
							<? }else{?><!--Menu for non member-->
			                    <li  class="<? if ($this->uri->segment(1)=='front') {echo 'active';}?>">
			                      <a href="<?=base_url(); ?>front"   class="<? if ($this->uri->segment(1)=='' || $this->uri->segment(1)=='front') {echo 'active';}?>">
			                        <i class="fa fa-dashboard icon">
			                          <b class="bg-danger"></b>
			                        </i>
			                        <span>LeaderBoard</span>
			                      </a>
			                    </li>
			                <?}?>
			                    <li class="<? if ($this->uri->segment(1)=='general' && $this->uri->segment(2)=='download') {echo 'active';}?>">
			                      <a href="<?=base_url(); ?>general/download"  class="<? if ($this->uri->segment(1)=='general' && $this->uri->segment(2)=='download') {echo 'active';}?>">
			                        <i class="fa fa-download icon">
			                          <b class="bg-info"></b>
			                        </i>
			                        <span>Download</span>
			                      </a>
			                    </li>
			                    <li class="<? if ($this->uri->segment(1)=='general' && $this->uri->segment(2)=='guestbook') {echo 'active';}?>">
			                      <a href="<?=base_url(); ?>general/guestbook"  class="<? if ($this->uri->segment(1)=='general' && $this->uri->segment(2)=='guestbook') {echo 'active';}?>">
			                        <i class="fa fa-edit icon">
			                          <b class="bg-warning"></b>
			                        </i>
			                        <span>Guest Book</span>
			                      </a>
			                    </li>
			                    <li class="<? if ($this->uri->segment(1)=='general' && $this->uri->segment(2)=='angkottracer') {echo 'active';}?>">
			                      <a href="<?=base_url(); ?>general/angkottracer"  class="<? if ($this->uri->segment(1)=='general' && $this->uri->segment(2)=='angkottracer') {echo 'active';}?>">
			                        <i class="fa fa-bar-chart-o">
			                          <b class="bg-info"></b>
			                        </i>
			                        <span>Angkot Statistik</span>
			                      </a>
			                    </li>
			                </ul>
		                </nav>
		                <!-- / nav -->
		            </div>
	            </section>
	            
	            <footer class="footer lt hidden-xs b-t b-dark">
	            	<p>
	            		<small>
	            			<a href="http://bsts.lskk.ee.itb.ac.id" target="_blank">BSTS</a>&nbsp;&nbsp; 
	            			<a href="http://lskk.ee.itb.ac.id" target="_blank">LSKK ITB</a>  &copy; <? echo date('Y');?>
	            		</small>
	            	</p>
	            </footer>
          	</section>
        </aside>