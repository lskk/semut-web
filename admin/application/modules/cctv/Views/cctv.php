    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Cctv</li>
			</ol>
		</div><!--/.row-->
				
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">List of CCTV</div>
					<div class="panel-body">
                            
                        <div class="col-md-12">
                            <a href="cctv/create"><button class="btn btn-primary"><span class="glyphicon glyphicon-plus-sign"></span>   Add New CCTV</button></a>
                        </div>
                        <div class="col-md-12">
                        <hr>
						<table data-toggle="table" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="asc">
						    <thead>
						    <tr>
						        <th data-field="name" data-sortable="true">Name</th>
						        <th data-field="city"  data-sortable="true">City</th>
						        <th data-field="action" data-sortable="false">Actions</th>
						    </tr>
						    </thead>
                            <tbody>
                                <?php if ($lists){foreach ($lists as $unit) {?>
                                <tr>
                                    <td><?php echo $unit->Name; ?></td>
                                    <td><?php echo $unit->City; ?></td>
                                    <td><a href="cctv/detail/<?=$unit->ID;?>"><span class="glyphicon glyphicon-menu-hamburger"></span>&nbsp;Edit Detail</a></td>
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