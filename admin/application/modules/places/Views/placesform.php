
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>"><span class="glyphicon glyphicon-home"></span></a></li>
                <li><a href="<?php echo base_url(); ?>places">Places</a></li>
				<li class="active">Add New Place</li>
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
                                <label for="name">Place Name</label>
                                <input class="form-control" name="name" placeholder="Place Name">
                            </div>
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select name="type" class="form-control">
                                    <option value="">Choose Type</option>
                                    <?php foreach ($types as $type) {?>
                                        <option value="<?php echo $type->ID;?>"><?php echo $type->Name;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input class="form-control" name="description" placeholder="Place Description">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea name="address" class="form-control" rows="3" placeholder="Address"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="map">Click Location</label>
                                <div id="map"></div>
                            </div>
                            <div class="form-group">
                                <label for="latitude">Latitude</label>
                                <input class="form-control" name="latitude" id="latitude">
                            </div>
                            <div class="form-group">
                                <label for="longitude">Longitude</label>
                                <input class="form-control" name="longitude" id="longitude">
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