
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Taxi Map View</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
                <div class="panel panel-default">
					<div class="panel-body">
				        <div id='peta'></div>
                    </div>
                </div>
			</div>
		</div><!--/.row-->

	</div>	<!--/.main-->
    

<script>
$(function() {
    /*
    $.ajax({
      url:'http://localhost/admin/maps/get_all_semuter',
      success: function (result) {
          alert(result);
      },
      error: function () {
          alert('error!');
      }
  });*/
        var map = L.map('peta').setView([-6.9268,107.6035], 13);

        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
        maxZoom: 20
        }).addTo(map);
    
        var item = <?php echo json_encode( $datamap ); ?>;

        var marker;
        for(i=0;i<item.length;i++){
            marker = new L.marker([item[i].lat,item[i].lon]).addTo(map);
            marker.bindPopup("<strong>"+item[i].cname + "</strong><br>" + item[i].taxnum + " | " + item[i].nopol).openPopup();
        }

});

</script>
		