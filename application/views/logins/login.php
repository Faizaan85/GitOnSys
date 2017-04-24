<?php header('Access-Control-Allow-Origin: *'); ?>
<!doctype html>
<html lang="en">
    <head>
    	<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<meta name="description" content="">
    	<meta name="author" content="Faizaan Varteji">

    	<title><?php echo "Index" ?> </title>

    	<script src="<?php echo base_url(); ?>assets/js/jquery-3.2.0.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jqvalid/dist/jquery.validate.js"></script>
        <script src="<?php echo base_url();?>assets/js/shortcut.js"></script>
        <script src="<?php echo base_url();?>assets/js/bootstrap-select.min.js"></script>
    	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-select.min.css" type="text/css">

    </head>
    <body>
		<!-- Flash Messages -->
		<?php
			if($this->session->flashdata('user_registered'))
			{
				echo '<p class="alert alert-success">'.$this->session->flashdata('user_registered').'</p>';
			}
			if($this->session->flashdata('login_failed'))
			{
				echo '<p class="alert alert-success">'.$this->session->flashdata('login_failed').'</p>';
			}
		?>
        <div class="col-md-4 col-md-offset-4">
            <h2><?php echo $title; ?></h2>
            <?php echo validation_errors(); ?>
            <?php echo form_open('login'); ?>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    <a href="register" class="btn btn-default" role="button">Register</a>
                </div>
            <?php echo form_close(); ?>

        </div>

    </body>
</html>
