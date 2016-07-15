<?
$available = (int)$company->AdsNumb - (int)$ads->NumberOfAds;
?>
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Ads</li>
			</ol>
		</div><!--/.row-->
				
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">List of Ads</div>
					<div class="panel-body">
                        <form action="ads" method="post" role="form">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label>Filter by Category</label>
                                <select name="category" class="form-control">
                                    <option value="<?php echo $catid;?>"><?php echo $catname;?></option>
                                    <?php foreach ($cats as $cat) {?>
                                        <option value="<?php echo $cat->ID;?>"><?php echo $cat->CatTitle;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Search Data</button>
                                <a href="<?php echo base_url(); ?>ads">All Category</a>
                            </div>
                        </form>
                            </div>
                        <div class="col-md-6">
                            <button class="btn btn-primary"><strong>Space : </strong><? echo $available." avaiable of ".$company->AdsNumb;?></button><br><br>
                            <?if($company->AdsNumb>$ads->NumberOfAds){?>
                            <a href="ads/create"><button class="btn btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> Create New Ads</button></a><?}else{?>
                            <button disabled class="btn btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> Create New Ads</button><?}?>
                        </div>
                        <div class="col-md-12">
                        <hr>
						<table data-toggle="table" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="asc">
						    <thead>
						    <tr>
						        <th data-field="title" data-sortable="true">Title</th>
						        <th data-field="description"  data-sortable="true">Description</th>
						        <th data-field="category" data-sortable="true">Category</th>
						        <th data-field="startdate"  data-sortable="true">Start Date</th>
						        <th data-field="expdate" data-sortable="true">Exp Date</th>
						        <th data-field="status" data-sortable="true">Status</th>
						        <th data-field="action" data-sortable="false">Actions</th>
						    </tr>
						    </thead>
                            <tbody>
                                <?php if ($units){foreach ($units as $unit) {?>
                                <tr>
                                    <td><?php echo $unit->Title; ?></td>
                                    <td><?php echo $unit->Description; ?></td>
                                    <td><?php echo $unit->CatTitle; ?></td>
                                    <td><?php echo $unit->StartDate; ?></td>
                                    <td><?php echo $unit->ExpiredDate;  ?></td>
                                    <td>
                                        <?php if($unit->Status==0){echo "Not Active";}else if($unit->Status==1){echo "Active";}else if($unit->Status==2){echo "Blocked";}  ?>
                                    </td>
                                    <td>
                                        <a href="ads/detail/<?=$unit->ID;?>"><span class="glyphicon glyphicon-menu-hamburger"></span>&nbsp;Detail</a> |
                                        <?php if($unit->Status==0){?>
                                        <a href="<?php echo base_url(); ?>ads/status/<?=$unit->ID;?>/1" onclick="return confirm('Are you sure activate this ads???')"><span class="glyphicon glyphicon-menu-hamburger"></span>&nbsp;Active</a>
                                        <?}else if($unit->Status==1){?>
                                        <a href="<?php echo base_url(); ?>ads/status/<?=$unit->ID;?>/0" onclick="return confirm('Are you sure deactivate this ads???')"><span class="glyphicon glyphicon-menu-hamburger"></span>&nbsp;Deactive</a> 
                                        <?}?>
                                    </td>
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