    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Taxi Driver</li>
			</ol>
		</div><!--/.row-->
				
		<div class="row">
            <div class="col-lg-12">
				<?php if(@$error): ?>
                <div class="alert bg-danger" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign"></span> <?php echo $error; ?> 
                </div>
                <?php endif; ?>

                <?php if(@$message): ?>
                <div class="alert bg-success" role="alert">
                    <span class="glyphicon glyphicon-check"></span> <?php echo $message; ?> 
                </div>
                <?php endif; ?>
			</div>
            
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">List of Driver</div>
					<div class="panel-body tabs">
                        
                        <ul class="nav nav-pills">
							<li class="active"><a href="#pilltab1" data-toggle="tab">Driver List</a></li>
							<li><a href="#pilltab2" data-toggle="tab">Add New Driver</a></li>
						</ul>
		
						<div class="tab-content">
							<div class="tab-pane fade in active" id="pilltab1">
                                <table data-toggle="table" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="asc">
                                    <thead>
                                    <tr>
                                        <th data-field="nip" data-sortable="true">NIP</th>
                                        <th data-field="name" data-sortable="true">Name</th>
                                        <th data-field="phone" data-sortable="false">Phone Number</th>
                                        <th data-field="address" data-sortable="false">Address</th>
                                        <th data-field="txnumber" data-sortable="true">Taxi Number</th>
                                        <th data-field="action" data-sortable="false">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($units){foreach ($units as $unit) {?>
                                        <tr>
                                            <td><?php echo $unit->NIP; ?></td>
                                            <td><?php echo $unit->Name;  ?></td>
                                            <td><?php echo $unit->PhoneNumber; ?></td>
                                            <td><?php echo $unit->Address; ?></td>
                                            <td><?php echo $unit->TaxiNumber; ?></td>
                                            <td><a href="taxidriver/detail/<?=$unit->ID;?>"><span class="glyphicon glyphicon-menu-hamburger"></span>&nbsp;Detail</a></td>
                                        </tr>
                                        <?php }} ?>
                                    </tbody>
                                </table>
							</div>	
							<div class="tab-pane fade" id="pilltab2">
				                <form action="<?php echo base_url(); ?>taxidriver/create" method="post" role="form">
                                    <div class="form-group">
                                        <label for="nip">NIP</label>
                                        <input class="form-control" name="nip" placeholder="NIP">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input class="form-control" name="name" placeholder="Driver Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input class="form-control" name="phone" placeholder="exp. 08888888">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea name="address" class="form-control" rows="3" placeholder="Address"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="taxi">Taxi</label>
                                        <select name="taxi" class="form-control">
                                            <option>--Choose taxi--</option>
                                            <?php foreach ($taxies as $taxi) {?>
                                                <option value="<?php echo $taxi->ID;?>"><?php echo "Number = ".$taxi->Number." | NoPol = ".$taxi->Nopol;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
                                    </div>
                                </form>
							</div>
						</div>
                        
					</div>
				</div>
			</div>
		</div><!--/.row-->			
	</div><!--/.main-->