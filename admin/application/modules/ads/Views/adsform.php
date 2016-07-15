
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>"><span class="glyphicon glyphicon-home"></span></a></li>
                <li><a href="<?php echo base_url(); ?>ads">Ads</a></li>
				<li class="active">Create New Ads</li>
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
                        <form action="<?php echo base_url(); ?>ads/create" method="post" role="form">
                            <div class="form-group">
                                <label for="title">Ads Title</label>
                                <input class="form-control" name="title" maxlength="50" placeholder="Max 50 character">
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="category" class="form-control">
                                    <option value="">--Choose Category--</option>
                                    <?php foreach ($cats as $cat) {?>
                                        <option value="<?php echo $cat->ID;?>"><?php echo $cat->CatTitle;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input class="form-control" name="description" maxlength="200" placeholder="max 200 character">
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
       //map 
        var map = L.map('map').setView([51.505, -0.09], 13);
        
        L.tileLayer('http://{s}.tiles.mapbox.com/v3/MapID/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
            maxZoom: 18
        }).addTo(map);
        /*
        map.on('click', function(e) {
            var latlng = e.latlng;
            markEntry(latlng.lat, latlng.lng);
        });

        function markEntry(lat, lng) {
            $('#latitude').val(lat);
            $('#longitude').val(lng);
        }*/
    });
</script>