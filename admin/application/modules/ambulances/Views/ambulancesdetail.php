    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>"><span class="glyphicon glyphicon-home"></span></a></li>
                <li><a href="<?php echo base_url(); ?>ambulances">Ambulances</a></li>
				<li class="active">Detail Ambulance</li>
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
					<div class="panel-body tabs">
					
						<ul class="nav nav-pills">
							<li class="active"><a href="#pilltab1" data-toggle="tab">Detail Item</a></li>
							<li><a href="#pilltab2" data-toggle="tab">Edit Item</a></li>
						</ul>
		
						<div class="tab-content">
							<div class="tab-pane fade in active" id="pilltab1">
                                <? if($units){?>
								<table>
                                    <tr>
                                        <td>Company Name</td>
                                        <td>:<?=$units->RSName;?></td>
                                    </tr>
                                    <tr>
                                        <td>Kota</td>
                                        <td>:<?=$units->Name;?></td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>:<?=$units->Address;?></td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td>:<?=$units->PhoneNumber;?></td>
                                    </tr>
                                    <tr>
                                        <td>No Polisi</td>
                                        <td>:<?=$units->NoPol;?></td>
                                    </tr>
                                </table>
							
                                <?}else{?>
                                <div class="alert bg-warning" role="alert">
                                    <span class="glyphicon glyphicon-warning-sign"></span> "No data result." <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                                </div>
                                <?}?>
							</div>	
							<div class="tab-pane fade" id="pilltab2">
				                <form action="<?php echo base_url(); ?>ambulances/edit" method="post" role="form">
                                    <input type="hidden" name="id" value="<?=$units->ID;?>">
                                    <div class="form-group">
                                        <label for="rsname">Company Name</label>
                                        <input class="form-control" name="rsname" value="<?=$units->RSName;?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <select name="city" class="form-control">
                                            <option value="<?=$units->CityID;?>"><?=$units->Name;?></option>
                                            <?php foreach ($cities as $city) {?>
                                                <option value="<?php echo $city->ID;?>"><?php echo $city->Name;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea name="address" class="form-control" rows="3"><?=$units->Address;?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input class="form-control" name="phone" value="<?=$units->PhoneNumber;?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="map">Click Location</label>
                                        <div id="map"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="latitude">Latitude</label>
                                        <input class="form-control" name="latitude" id="latitude" value="<?=$units->Latitude;?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="longitude">Longitude</label>
                                        <input class="form-control" name="longitude" id="longitude" value="<?=$units->Longitude;?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="nopol">No. Polisi</label>
                                        <input class="form-control" name="nopol" value="<?=$units->NoPol;?>">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
							</div>
						</div>
                        
					</div>
				</div><!--/.panel-->
			</div><!-- /.col-->
			
		</div><!-- /.row -->
		
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