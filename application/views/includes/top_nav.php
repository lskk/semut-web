
<? if ($this->session->userdata('logged_in')) { ?>

<header class="bg-dark dk header navbar navbar-fixed-top-xs">
  <div class="navbar-header aside-md">
    <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
      <i class="fa fa-bars"></i>
    </a>
    <a href="<?=base_url(); ?>" class="navbar-brand" ><img src="<?=base_url(); ?>/asset/images/logo.png" class="m-r-sm">Semut Web</a>
        <!--<a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".nav-user">
          <i class="fa fa-cog"></i>
        </a>-->
      </div> 
      <div width="100%" align="right" >
        
        <a href="" class="navbar-brand">
          <?           
          echo 'Rp. ';
          echo $profile['deposit'];  
          ?>
        </a>
      </div>  



    </header>
    <? } else { ?>
    <header class="bg-dark dk header navbar navbar-fixed-top-xs">
      <div class="navbar-header aside-md">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
          <i class="fa fa-bars"></i>
        </a>
        <a href="<?=base_url(); ?>" class="navbar-brand" ><img src="<?=base_url(); ?>/asset/images/logo.png" class="m-r-sm">Semut Web</a>
        <!--<a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".nav-user">
          <i class="fa fa-cog"></i>
        </a>-->
      </div>   
    </header>
    <?}?>

