<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>LSKK PARKING SYSTEM</title>

    <script>
    		/*setInterval(function(){
    			var img = document.getElementById('myImg');
				img.src = '<?=base_url(); ?>/asset/lskkparking/update.jpeg?t='+new Date().getTime();
    		}, 1000)*/
			
			
			setInterval(function(){
                //alert('interval');
				var img = document.getElementById('myImg');
				img.src = '<?=base_url(); ?>/asset/lskkparking/update.jpeg?t='+new Date().getTime();
                $.get('<?=base_url('parking/get_lot_data')?>', function(data) {
                    //alert('get '+data);
                    dt = $.parseJSON(data);
                      for(i=0;i<dt.length;i++){
                            var c = document.getElementById("myCanvas");
                            var context = c.getContext("2d");
                            var lot = document.getElementById("lot");
                            var car = document.getElementById("car");
                            var nocar = document.getElementById("nocar");
                            context.drawImage(lot, 0, 0);
                            
                            var size = 40;
                            var x = 10;
                            var y = 40;
                            var g = 40;
                            var xPosDuration = 240;
                            var xPosPay = 250;

                            for(var i=0;i<8;i++){
                                //var m = Math.floor((Math.random() * 2) + 1);
                                var m = dt[i].lot_stat;
                                context.fillText("Lot-"+(i+1),x+(g*i),200);
                                if(m == 1) {
                                    context.drawImage(car, x+(g*i),y);
                                    context.fillText("Duration: "+seconds2time(dt[i].duration),x+(g*i), xPosDuration);
                                    context.fillText("Pay: Rp. "+dt[i].lot_pay,x+(g*i), xPosPay);
                                }
                                else {
                                    context.drawImage(nocar,x+(g*i),y);
                                }
                                x = x + size;
                            }
                        }
                });
			}, 5000) //every 5 seconds check to db

		function seconds2time (seconds) {
			var hours   = Math.floor(seconds / 3600);
			var minutes = Math.floor((seconds - (hours * 3600)) / 60);
			var seconds = seconds - (hours * 3600) - (minutes * 60);
			var time = "";

			if (hours != 0) {
			  time = hours+":";
			}
			if (minutes != 0 || time !== "") {
			  minutes = (minutes < 10 && time !== "") ? "0"+minutes : String(minutes);
			  time += minutes+":";
			}
			if (time === "") {
			  time = seconds+"s";
			}
			else {
			  time += (seconds < 10) ? "0"+seconds : String(seconds);
			}
			return time;
		}
    </script>

    <!-- Bootstrap Core CSS -->
    <link href="<?=base_url(); ?>/asset/lskkparking/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?=base_url(); ?>/asset/lskkparking/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?=base_url(); ?>/asset/lskkparking/dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?=base_url(); ?>/asset/lskkparking/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?=base_url(); ?>/asset/lskkparking/bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?=base_url(); ?>/asset/lskkparking/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>

<body onload="setInterval()">

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
           <!-- header -->
           <?=$this->load->view('includes/header');?>

           <!-- side bar -->
            <?=$this->load->view('includes/sidebar');?>
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                         <div class="panel-heading">
                            CCTV
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <center><img width="480" height="320" id="myImg" src="<?=base_url(); ?>/asset/lskkparking/update.jpeg"></center>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
		
		<div id="page-wrapper">
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Parking Map
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <center>	
								<img id="lot" src="<?=base_url(); ?>asset/lskkparking/empty.jpg" hidden>
								<img id="car" src="<?=base_url(); ?>asset/lskkparking/red-car.png" hidden>
								<img id="nocar" src="<?=base_url(); ?>asset/lskkparking/no_car.jpg" hidden>
								<br>
								<canvas id="myCanvas" width="650" height="300" style="border:1px solid #c3c3c3;">Your browser does not support the HTML5 canvas tag.</canvas>
							</center>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?=base_url(); ?>/asset/lskkparking/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=base_url(); ?>/asset/lskkparking/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?=base_url(); ?>/asset/lskkparking/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?=base_url(); ?>/asset/lskkparking/bower_components/raphael/raphael-min.js"></script>
    <script src="<?=base_url(); ?>/asset/lskkparking/bower_components/morrisjs/morris.min.js"></script>
    <script src="<?=base_url(); ?>/asset/lskkparking/js/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
