    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>"><span class="glyphicon glyphicon-home"></span></a></li>
                <li><a href="<?php echo base_url(); ?>taxiarmada">Taxi</a></li>
				<li class="active">Detail Taxi</li>
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
							<li class="active"><a href="#pilltab1" data-toggle="tab">Detail Taxi</a></li>
							<li><a href="#pilltab2" data-toggle="tab">Edit Item</a></li>
						</ul>
		
						<div class="tab-content">
							<div class="tab-pane fade in active" id="pilltab1">
                                <? if($units){?>
								<table>
                                    <tr>
                                        <td>Taxi Number</td>
                                        <td>:<?=$units->Number;?></td>
                                    </tr>
                                    <tr>
                                        <td>No. Polisi</td>
                                        <td>:<?=$units->Nopol;?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><hr></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><strong>Drivers</strong></td>
                                    </tr>
                                    <?php if ($drivers){foreach ($drivers as $driver) {?>
                                    <tr>
                                        <td><?=$driver->NIP;?></td>
                                        <td>-<?=$driver->Name;?></td>
                                    </tr>
                                    <?php }} ?>
                                </table>
							
                                <?}else{?>
                                <div class="alert bg-warning" role="alert">
                                    <span class="glyphicon glyphicon-warning-sign"></span> "No data result." <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                                </div>
                                <?}?>
							</div>	
							<div class="tab-pane fade" id="pilltab2">
				                <form action="<?php echo base_url(); ?>taxiarmada/edit" method="post" role="form">
                                    <input type="hidden" name="id" value="<?=$units->ID;?>">
                                    <div class="form-group">
                                        <label for="number">Taxi Number</label>
                                        <input class="form-control" name="number" value="<?=$units->Number;?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="nopol">No. Polisi</label>
                                        <input class="form-control" name="nopol" value="<?=$units->Nopol;?>">
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
