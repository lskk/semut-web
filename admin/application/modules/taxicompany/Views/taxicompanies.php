    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Taxi Companies</li>
			</ol>
		</div><!--/.row-->
				
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">List of Taxi Companies</div>
					<div class="panel-body">
                        <form action="taxicompany" method="post" role="form">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label>Filter by City</label>
                                <select name="city" class="form-control">
                                    <option value="<?php echo $cityid;?>"><?php echo $cityname;?></option>
                                    <?php foreach ($cities as $city) {?>
                                        <option value="<?php echo $city->ID;?>"><?php echo $city->Name;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Search Data</button>
                                <button type="reset" class="btn btn-default">Reset</button>
                            </div>
                        </form>
                            </div>
                        <div class="col-md-6">
                            <a href="taxicompany/create"><button class="btn btn-primary"><span class="glyphicon glyphicon-plus-sign"></span>   New Taxi Company</button></a>
                        </div>
                        <div class="col-md-12">
                        <hr>
						<table data-toggle="table" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="asc">
						    <thead>
						    <tr>
						        <th data-field="id" data-sortable="true">Company Name</th>
						        <th data-field="log" data-sortable="false">Address</th>
						        <th data-field="email" data-sortable="true">Phone</th>
						        <th data-field="name"  data-sortable="true">City</th>
						        <th data-field="action" data-sortable="false">Actions</th>
						    </tr>
						    </thead>
                            <tbody>
                                <?php if ($units){foreach ($units as $unit) {?>
                                <tr>
                                    <td><?php echo $unit->Name; ?></td>
                                    <td><?php echo $unit->Address;  ?></td>
                                    <td><?php echo $unit->PhoneNumber; ?></td>
                                    <td><?php echo $unit->Cityname; ?></td>
                                    <td><a href="taxicompany/detail/<?=$unit->ID;?>"><span class="glyphicon glyphicon-menu-hamburger"></span>&nbsp;Detail</a></td>
                                </tr>
                                <?php }} ?>
                            </tbody>
						</table>
                        </div>
					</div>
				</div>
			</div>
		</div><!--/.row-->			
	</div><!--/.main-->