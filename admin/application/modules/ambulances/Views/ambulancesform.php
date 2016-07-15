
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>"><span class="glyphicon glyphicon-home"></span></a></li>
                <li><a href="<?php echo base_url(); ?>ambulances">Ambulances</a></li>
				<li class="active">Create New Ambulance</li>
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
                                <label for="rsname">Company Name</label>
                                <input class="form-control" name="rsname" placeholder="Hospital/ Clinic/ Organitation">
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
                                <label for="address">Address</label>
                                <textarea name="address" class="form-control" rows="3" placeholder="Address"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input class="form-control" name="phone" placeholder="exp. 022-111111">
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
                                <label for="nopol">No. Polisi</label>
                                <input class="form-control" name="nopol" placeholder="D 0000 AA">
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
    var map = L.map('map').setView([-6.9268,107.6035], 14);

L.tileLayer('http://{s}.tiles.mapbox.com/v3/mapbox.streets/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
    maxZoom: 18
}).addTo(map);
    

});
</script>