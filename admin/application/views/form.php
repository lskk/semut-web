<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>BSTS - Login Page</title>
    
        <!-- Bootstrap framework -->
            <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/bootstrap/css/bootstrap.min.css" />
            <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/bootstrap/css/bootstrap-responsive.min.css" />
        <!-- theme color-->
            <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/blue.css" />
        <!-- tooltip -->    
			<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/lib/qtip2/jquery.qtip.min.css" />
        <!-- main styles -->
            <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/style.css" />
    
        <!-- Favicons and the like (avoid using transparent .png) -->
            <link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/favicon.ico" />
            <link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>/assets/icon.png" />
    
        <link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
    
        <!--[if lte IE 8]>
            <script src="js/ie/html5.js"></script>
			<script src="js/ie/respond.min.js"></script>
        <![endif]-->
		
    </head>

<body class="login_page">

<?php $this->load->view($main_content);?>

</body>
</html>
