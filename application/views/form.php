</html>
<!DOCTYPE html>
<html lang="en" class="bg-dark">
<head>
  <meta charset="utf-8" />
  <title>Semut | Web</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet" href="<?=base_url(); ?>/asset/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="<?=base_url(); ?>/asset/css/animate.css" type="text/css" />
  <link rel="stylesheet" href="<?=base_url(); ?>/asset/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="<?=base_url(); ?>/asset/css/font.css" type="text/css" />
  <link rel="stylesheet" href="<?=base_url(); ?>/asset/css/app.css" type="text/css" />
  <!--[if lt IE 9]>
    <script src="js/ie/html5shiv.js"></script>
    <script src="js/ie/respond.min.js"></script>
    <script src="js/ie/excanvas.js"></script>
  <![endif]-->
</head>
<body>
  <section id="content" class="m-t-lg wrapper-md animated fadeInUp">    
    <div class="container aside-xxl">
      <a class="navbar-brand block" href="<?=base_url(); ?>"><img src="<?=base_url(); ?>/asset/images/logo_large.png">  Semut Web</a>
      <section class="panel panel-default bg-white m-t-lg">
        <?=$this->load->view($main_content);?>
      </section>
    </div>
    <div class="clearfix"></div>
  </section>
  <!-- footer -->
  <footer id="footer">
    <div class="text-center padder">
      <p><small><a href="http://bsts.lskk.ee.itb.ac.id" target="_blank">BSTS</a>&nbsp;&nbsp; <a href="http://lskk.ee.itb.ac.id" target="_blank">LSKK ITB</a>  &copy; 2015</small></p>
    </div>
  </footer>
  <!-- / footer -->
  <script src="<?=base_url(); ?>/asset/js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="<?=base_url(); ?>/asset/js/bootstrap.js"></script>
  <!-- App -->
  <script src="<?=base_url(); ?>/asset/js/app.js"></script>
  <script src="<?=base_url(); ?>/asset/js/app.plugin.js"></script>
  <script src="<?=base_url(); ?>/asset/js/slimscroll/jquery.slimscroll.min.js"></script>
  
</body>
</html>