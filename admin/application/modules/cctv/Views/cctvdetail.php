    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>"><span class="glyphicon glyphicon-home"></span></a></li>
                <li><a href="<?php echo base_url(); ?>cctv">Camera</a></li>
				<li class="active">CCTV Details</li>
			</ol>
		</div><!--/.row-->	
			
		<div class="row">
			<div class="col-lg-12">
				<?php if(@$error): ?>
                <div class="alert bg-danger" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign"></span> <?php echo $error; ?> <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                </div>
                <?php endif; ?>

                <?php if(@$message): ?>
                <div class="alert bg-success" role="alert">
                    <span class="glyphicon glyphicon-check"></span> <?php echo $message; ?> <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                </div>
                <?php endif; ?>
			</div>
			
			<div class="col-lg-12">
				<div class="panel panel-default">
                    <div class="panel-heading">Edit Camera</div>
					<div class="panel-body">
                        <div class="col-md-12">
                        <form action="<?php echo base_url(); ?>cctv/edit" method="post" role="form">
                            <input type="hidden" name="id" value="<?=$units->ID;?>">
                            <div class="form-group">
                                <label for="rsname">Camera Name</label>
                                <input class="form-control" name="name" value="<?=$units->Name;?>">
                            </div>
                            <div class="form-group">
                                <label for="city">City</label>
                                <select name="city" class="form-control">
                                    <option value="<?=$units->CityID;?>"><?=$units->City;?></option>
                                    <?php foreach ($cities as $city) {?>
                                        <option value="<?php echo $city->ID;?>"><?php echo $city->Name;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="map">Click Location</label>
                                <div id="map"></div>
                            </div>
                            <div class="form-group">
                                <label for="latitude">Latitude</label>
                                <input class="form-control" name="lat" id="latitude" value="<?=$units->Latitude;?>">
                            </div>
                            <div class="form-group">
                                <label for="longitude">Longitude</label>
                                <input class="form-control" name="lon" id="longitude" value="<?=$units->Longitude;?>">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                        </div>
					</div>
				</div><!--/.panel-->
			</div><!-- /.col-->
			
		</div><!-- /.row -->
		
	</div><!--/.main-->

<script type="text/javascript">
   
   $(function() {
    window.base_url = <?php echo json_encode(base_url()); ?>;
    var camIcon = L.icon({
        iconUrl: base_url+'/assets/img/camera.png',
        iconSize:     [30, 43], 
        iconAnchor:   [15, 43],
        popupAnchor:  [0, -43]
    });

    var popup = L.popup();
    var lat = <?=$units->Latitude;?>;
    var lon = <?=$units->Longitude;?>;
    var map = L.map('map').setView([lat,lon], 15);
    

    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
    var marker = L.marker([lat, lon],{icon: camIcon}).addTo(map);
    marker.bindPopup('Current Location <br> Click other location to update new location').openPopup();
        
    function onMapClick(e) {
        var latlon = e.latlng;
        $('#latitude').val(latlon.lat);
        $('#longitude').val(latlon.lng);
        popup
        .setLatLng(e.latlng)
        .setContent("You clicked the map at " + e.latlng.toString())
        .openOn(map);
    }

    map.on('click', onMapClick);
    
});
</script>