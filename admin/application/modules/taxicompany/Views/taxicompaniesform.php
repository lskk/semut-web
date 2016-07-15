
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>"><span class="glyphicon glyphicon-home"></span></a></li>
                <li><a href="<?php echo base_url(); ?>taxicompany">Taxi Companies</a></li>
				<li class="active">Create New Taxi Company</li>
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
        </div>
        
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Create Item Form</div>
					<div class="panel-body">
                        <div class="col-md-12">
                        <form action="<?php echo base_url(); ?>taxicompany/create" method="post" role="form">
                            <div class="form-group">
                                <label for="name">Company Name</label>
                                <input class="form-control" name="name" placeholder="Taxi Company Name">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea name="address" class="form-control" rows="3" placeholder="Address"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input class="form-control" name="phone" placeholder="exp. 022-111111">
                            </div>
                            <div class="form-group">
                                <label for="city">City</label>
                                <select name="city" class="form-control">
                                    <option value="">City</option>
                                    <?php foreach ($cities as $city) {?>
                                        <option value="<?php echo $city->ID;?>"><?php echo $city->Name;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input class="form-control" name="username" placeholder="lowercase">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input class="form-control" name="password" placeholder="min 8 character">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-default">Reset</button>
                            </div>
                        </form>
                        </div>
					</div>
				</div>
			</div>
		</div><!--/.row-->			
	</div><!--/.main-->
