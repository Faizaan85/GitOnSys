<?php
	header('Access-Control-Allow-Origin: *');
	if($this->session->logged_in === NULL)
	{
		redirect('login');
	}
?>
<!doctype html>

<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $title; ?></title>
    <meta name="description" content="Order">
    <meta name="author" content="Faizaan Varteji">
	<?php
		$varsdefined = get_defined_vars();
		if(isset($varsdefined['autorefresh']))
		{
			if($autorefresh === TRUE)
			{
				echo ('<meta http-equiv="refresh" content="3; URL='. base_url().'orders">');
			}
		}
	?>


    <script src="<?php echo base_url(); ?>assets/js/jquery-3.2.0.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jqvalid/dist/jquery.validate.js"></script>
    <script src="<?php echo base_url();?>assets/js/shortcut.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-select.min.js"></script>
    <?php if (isset($varsdefined['js'])) : ?>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/<?php echo $js;?>"></script>
    <?php endif; ?>

    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-select.min.css" type="text/css">
    <style type="text/css">
	.fz-danger {
	    background-color: #e46666 !important;
	}
	.fz-success {
		background-color: #44d055 !important;
	}

    @media print
    {
        body,html{
            margin: 0;
            padding: 0;
        }
        .row1{


            font-size: small;
        }
        .row2{


            font-size: small;
        }
        table{
            font-size: x-small;
        }
    }
    @page
	{
        size: 6.3in 9.1in;
        position: relative;
    }

    </style>

    <script>
    shortcut.add("Shift++", function()
    {
        window.location.replace("neworder");
    },
    {
        'keycode':187
    });
    shortcut.add("F1", function()
    {
        $("#search").focus();
    });
    </script>

	<!--[if lt IE 9]>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
	<![endif]-->

</head>

<body>

	<nav class="navbar navbar-default hidden-print">
	    <div class="container-fluid">
	         <div class="navbar-header">
	            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
	            </button>
	            <a class="navbar-brand" href="#">Home</a>
	        </div>

	        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	            <ul class="nav navbar-nav">
	                <li class="dropdown">
	                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">All<span class="caret"></span></a>
	                    <ul class="dropdown-menu">
	                        <li><a href="#">Search</a></li>
	                        <li><a href="<?php echo base_url()?>orders">Orders</a></li>
	                        <li><a href="<?php echo base_url()?>neworder">New Orders</a></li>
	                    </ul>
	                </li>
                        <li><a href="<?php echo base_url()?>orders" accesskey="o">Orders</a></li>
	                <li><a href="<?php echo base_url()?>neworder" accesskey="n">New Order</a></li>
	            </ul>
	            <form <?php if($title!="Item Search") { echo ('target="_blank"');} ?> action="http://192.168.2.100/jquery_sandbox/item_search1.php" method="POST" class="navbar-form navbar-left">
                    <div class="form-group">
                        <input type="text" id="search" name="search_no1" class="form-control" placeholder="Search Order (F1)">
                    </div>
                        <button type="submit" class="btn btn-default" >Submit</button>
                </form>
				<!-- Right Side Navbar -->
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#">Link</a></li>
					<li class="dropdown">
						<a href="#" id="username" data-username="<?php echo ($this->session->username) ?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo ($this->session->username) ?><span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#">Profile</a></li>
							<li><a href="#">Settings</a></li>
							<li><a href="#">Something else here</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="<?php echo base_url()?>logout">Logout</a></li>
						</ul>
					</li>
				</ul>
	        </div><!--/.nav-collapse-->
	    </div>
	</nav>
