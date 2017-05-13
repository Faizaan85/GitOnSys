<div class="container">
    <div class="row">
		<div class="col-md-2">
        	<p><?php echo $title; ?></p>
		</div>
		<div class="col-md-2">
			<button type="button" id="reload" class="btn btn-info" data-state=TRUE>Auto Reload</button>
		</div>
		<div class="col-md-2">
			<button id="s1" class="btn btn-success">Store 1</button>
		</div>
		<div class="col-md-2">
			<button id="s2" class="btn btn-success">Store 2</button>
		</div>
		<div class="col-md-2">
			<button id="printed" class="btn btn-success <?php
			echo ((($this->session->level)<7)? "hidden" : ""); ?>">Printed</button>
		</div>

    </div>
	<table id="orderlist"></table>

</div>
