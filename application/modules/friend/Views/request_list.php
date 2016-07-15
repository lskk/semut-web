    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>"><span class="glyphicon glyphicon-home"></span></a></li>
				<li><a href="<?php echo base_url(); ?>friend">Friends</a></li>
				<li class="active">Request List</li>
			</ol>
		</div><!--/.row-->
				
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Friend Requests List </div>
					<div class="panel-body">
                        <div class="col-md-12">
						<table data-toggle="table" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="asc">
						    <thead>
						    <tr>
						        <th data-field="name"  data-sortable="true">Name</th>
						        <th data-field="email" data-sortable="true">Email</th>
						        <th data-field="join"  data-sortable="true">Join Date</th>
						        <th data-field="action" data-sortable="false">Action</th>
						    </tr>
						    </thead>
                            <tbody>
                                <?php foreach ($friends as $friend) {?>
                                <tr>
                                    <td><?php echo $friend['Name']; ?></td>
                                    <td><?php echo $friend['Email']; ?></td>
                                    <td><?php echo $friend['Joindate']; ?></td>
                                    <td><button class="btn btn-primary" type="button" onclick="accept_request(<?=$friend['ID'];?>)">Accept Request</button></td>
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

		<script type="text/javascript">
		var _base_url = '<?= site_url() ?>';

		function accept_request(id) {
		  i = confirm('Are you sure to accept this request?');
		  if (i) {
		  	window.location = _base_url + '/friend/accept_request/' + id;
		  }
		}
		</script>