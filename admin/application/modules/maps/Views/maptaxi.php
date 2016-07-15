
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Map</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
                <div class="panel panel-default">
					<div class="panel-body">
                        <div class="col-md-2">
                        <form action="<?php echo base_url(); ?>maps" method="post" role="form">
                            <div class="form-group">
                                <label>Location of <?=$datatype;?></label>
                                <select name="type" class="form-control">
                                    <option>Choose Type</option>
                                    <option value="semut">User Semut</option>
                                    <option value="ambulance">Ambulance</option>
                                    <option value="taxi">Taxi</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Search Data</button>
                            </div>
                        </form>
                        </div>
                        <div class="col-md-10">
				            <div id='peta'></div>
                        </div>
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
		