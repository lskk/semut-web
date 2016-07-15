    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Friends</li>
			</ol>
		</div><!--/.row-->
				
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Friends List</div>
					<div class="panel-body">
                        <div class="col-md-12">
						<table data-toggle="table" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="asc">
						    <thead>
						    <tr>
						        <th data-field="name"  data-sortable="true">Name</th>
						        <th data-field="email" data-sortable="true">Email</th>
						        <th data-field="join"  data-sortable="true">Join Date</th>
						    </tr>
						    </thead>
                            <tbody>
                                <?php foreach ($friends as $friend) {?>
                                <tr>
                                    <td><?php echo $friend['Name']; ?></td>
                                    <td><?php echo $friend['Email']; ?></td>
                                    <td><?php echo $friend['Joindate']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
						</table>
                        </div>
					</div>
				</div>
			</div>
		</div><!--/.row-->			
	</div><!--/.main-->

