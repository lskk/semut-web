<?=$this->load->view('includes/header');?>
	<div class="clearfix"></div>
	<section class="vbox">
	    <?=$this->load->view('includes/top_nav');?>
	    <section>
	      <section class="hbox stretch">
	        <!-- .aside -->
	        <?=$this->load->view('includes/menu_side');?>
	        <!-- /.aside -->
	        <section id="content">
	          <?=$this->load->view($main_content);?>
	          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
	        </section>
	      </section>
	    </section>
	</section>
<?=$this->load->view('includes/footer');?>