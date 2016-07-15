    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Taxi</li>
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
					<div class="panel-heading">List of Taxi</div>
					<div class="panel-body tabs">
                        
                        <ul class="nav nav-pills">
							<li class="active"><a href="#pilltab1" data-toggle="tab">Taxi List</a></li>
							<li><a href="#pilltab2" data-toggle="tab">Add New Taxi</a></li>
						</ul>
		
						<div class="tab-content">
							<div class="tab-pane fade in active" id="pilltab1">
                                <table data-toggle="table" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="asc">
                                    <thead>
                                    <tr>
                                        <th data-field="number" data-sortable="true">Taxi Number</th>
                                        <th data-field="nopol" data-sortable="false">No. Polisi</th>
                                        <th data-field="driver" data-sortable="true">Driver in Charge</th>
                                        <th data-field="action" data-sortable="false">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($units){foreach ($units as $unit) {?>
                                        <tr>
                                            <td><?php echo $unit->Number; ?></td>
                                            <td><?php echo $unit->Nopol;  ?></td>
                                            <td><?php echo $unit->DriverName; ?></td>
                                            <td><a href="taxiarmada/detail/<?=$unit->ID;?>"><span class="glyphicon glyphicon-menu-hamburger"></span>&nbsp;Detail</a></td>
                                        </tr>
                                        <?php }} ?>
                                    </tbody>
                                </table>
							</div>	
							<div class="tab-pane fade" id="pilltab2">
				                <form action="<?php echo base_url(); ?>taxiarmada/create" method="post" role="form">
                                    <div class="form-group">
                                        <label for="number">Number</label>
                                        <input class="form-control" name="number" placeholder="Taxi Number">
                                    </div>
                                    <div class="form-group">
                                        <label for="nopol">No. Polisi</label>
                                        <input class="form-control" name="nopol" placeholder="No Polisi">
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