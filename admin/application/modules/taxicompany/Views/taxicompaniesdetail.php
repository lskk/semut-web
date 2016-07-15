    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>"><span class="glyphicon glyphicon-home"></span></a></li>
                <li><a href="<?php echo base_url(); ?>taxicompany">Taxi Companies</a></li>
				<li class="active">Detail Taxi Company</li>
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
							<li class="active"><a href="#pilltab1" data-toggle="tab">Detail Taxi Company</a></li>
							<li><a href="#pilltab2" data-toggle="tab">Edit Item</a></li>
						</ul>
		
						<div class="tab-content">
							<div class="tab-pane fade in active" id="pilltab1">
                                <? if($units){?>
								<table>
                                    <tr>
                                        <td>Company Name</td>
                                        <td>:<?=$units->Name;?></td>
                                    </tr>
                                    <tr>
                                        <td>Kota</td>
                                        <td>:<?=$units->Cityname;?></td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>:<?=$units->Address;?></td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td>:<?=$units->PhoneNumber;?></td>
                                    </tr>
                                </table>
							
                                <?}else{?>
                                <div class="alert bg-warning" role="alert">
                                    <span class="glyphicon glyphicon-warning-sign"></span> "No data result." <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                                </div>
                                <?}?>
							</div>	
							<div class="tab-pane fade" id="pilltab2">
				                <form action="<?php echo base_url(); ?>taxicompany/edit" method="post" role="form">
                                    <input type="hidden" name="id" value="<?=$units->ID;?>">
                                    <div class="form-group">
                                        <label for="name">Company Name</label>
                                        <input class="form-control" name="name" value="<?=$units->Name;?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <select name="city" class="form-control">
                                            <option value="<?=$units->CityID;?>"><?=$units->Name;?></option>
                                            <?php foreach ($cities as $city) {?>
                                                <option value="<?php echo $city->ID;?>"><?php echo $city->Cityname;?></option>
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
