
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>"><span class="glyphicon glyphicon-home"></span></a></li>
                <li><a href="<?php echo base_url(); ?>cctv">Camera</a></li>
				<li class="active">Add New CCTV</li>
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
        </div>
        
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Create Item Form</div>
					<div class="panel-body">
                        <div class="col-md-12">
                        <form action="create" method="post" role="form">
                            <div class="form-group">
                                <label for="rsname">Camera Name</label>
                                <input class="form-control" name="name" placeholder="Name or Location cctv">
                            </div>
                            <div class="form-group">
                                <label for="city">City</label>
                                <select name="city" class="form-control">
                                    <option value="">City</option>
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
                                <input class="form-control" name="lat" id="latitude">
                            </div>
                            <div class="form-group">
                                <label for="longitude">Longitude</label>
                                <input class="form-control" name="lon" id="longitude">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-default">Reset</button>
                            </div>
                        </form>
                        </div>
					</div>
				</div>
			</div>
		</div><!--/.row-->			
	</div><!--/.main-->

<script type="text/javascript">

   $(function() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        alert('Geolocation is not supported by this browser.');
    }
        
    function showPosition(position) {
        //alert('Latitude: ' + position.coords.latitude + '<br>Longitude: ' + position.coords.longitude); 
       var map = L.map('map').setView([position.coords.latitude,position.coords.longitude], 15);

        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        var popup = L.popup();

        function onMapClick(e) {
            var latlon = e.latlng;
            $('#latitude').val(latlon.lat);
            $('#longitude').val(latlon.lng);
            popup
            .setLatLng(e.latlng)
            .setContent("You clicked the map at <br>" + e.latlng.toString()+"<br>as camera location")
            .openOn(map);
        }

        map.on('click', onMapClick);
    }
    
});
</script>