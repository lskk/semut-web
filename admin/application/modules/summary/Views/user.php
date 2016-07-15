    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">User Semut Activity Log</li>
			</ol>
		</div><!--/.row-->
        
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">User Activity /Month</h2>
			</div>
		</div><!--/.row-->
				
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Summary on <?php echo $bulan.'  '.$tahun;?></div>
					<div class="panel-body">
                        <form action="summary" method="post" role="form">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Month</label>
                                <select name="month" class="form-control">
                                    <option value="<?php echo $bulan;?>"><?php echo $bulan;?></option>
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Select Year</label>
                                <select name="year" class="form-control">
                                    <option value="<?php echo $tahun;?>"><?php echo $tahun;?></option>        
                                    <?php for ($i=$years1; $i <= $years; $i++) { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Search Data</button>
                                <button type="reset" class="btn btn-default">Reset</button>
                            </div>
                            </div>
                        </form>
                        <div class="col-md-12">
                        <hr>
						<table data-toggle="table" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						    <thead>
						    <tr>
						        <th data-field="id" data-sortable="true">User ID</th>
						        <th data-field="name"  data-sortable="true">Name</th>
						        <th data-field="email" data-sortable="true">Email</th>
						        <th data-field="phone"  data-sortable="false">Phone</th>
						        <th data-field="log" data-sortable="true">Login/ Month</th>
						    </tr>
						    </thead>
                            <tbody>
                                <?php foreach ($users as $user) {?>
                                <tr>
                                    <td><?php echo $user['UserID']; ?></td>
                                    <td><?php echo $user['Name']; ?></td>
                                    <td><?php echo $user['Email']; ?></td>
                                    <td><?php echo $user['Phone']; ?></td>
                                    <td><?php echo $user['log'];  ?></td>
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