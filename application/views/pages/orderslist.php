<div class="container-fluid">
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
	<table id="orderlist" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>Order</th>
				<th>Name</th>
				<th>LPO</th>
				<th>Status</th>
				<th>Store 1</th>
				<th>Store 2</th>
				<th>Printed ?</th>
				<th>Date</th>
				<th>By</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>Order</th>
				<th>Name</th>
				<th>LPO</th>
				<th>Status</th>
				<th>Store 1</th>
				<th>Store 2</th>
				<th>Printed ?</th>
				<th>Date</th>
				<th>By</th>
			</tr>
		</tfoot>
	</table>
</div>
