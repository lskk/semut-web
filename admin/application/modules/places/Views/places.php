    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Places</li>
			</ol>
		</div><!--/.row-->
				
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">List of Places</div>
					<div class="panel-body">
                        <form action="ambulances" method="post" role="form">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label>Filter by Type</label>
                                <select name="city" class="form-control">
                                    <option value="<?php echo $typeid;?>"><?php echo $typename;?></option>
                                    <?php foreach ($types as $type) {?>
                                        <option value="<?php echo $type->ID;?>"><?php echo $type->Name;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Search Data</button>
                                <a href="<?php echo base_url(); ?>places">All Type</a>
                            </div>
                        </form>
                            </div>
                        <div class="col-md-6">
                            <a href="places/create"><button class="btn btn-primary"><span class="glyphicon glyphicon-plus-sign"></span>   Add New Places</button></a>
                        </div>
                        <div class="col-md-12">
                        <hr>
						<table data-toggle="table" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" >
						    <thead>
						    <tr>
						        <th data-field="name" data-sortable="true">Name</th>
						        <th data-field="type"  data-sortable="true">Type</th>
						        <th data-field="description" data-sortable="false">Description</th>
						        <th data-field="address"  data-sortable="false">Address</th>
						        <th data-field="action" data-sortable="false">Actions</th>
						    </tr>
						    </thead>
                            <tbody>
                                <?php if ($units){foreach ($units as $unit) {?>
                                <tr>
                                    <td><?php echo $unit->Name; ?></td>
                                    <td><?php echo $unit->Type; ?></td>
                                    <td><?php echo $unit->Description; ?></td>
                                    <td><?php echo $unit->Address; ?></td>
                                    <td><a href="places/detail/<?=$unit->ID;?>"><span class="glyphicon glyphicon-menu-hamburger"></span>&nbsp;Edit Detail</a></td>
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