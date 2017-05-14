<div class="container-fluid">
    <div class="row">
		<div class="col-md-2">
        	<p><?php echo $title; ?></p>
		</div>
		<div class="col-md-2">
			<button type="button" id="autoReload" class="btn btn-success" data-state=TRUE>Auto Reload</button>
		</div>
	</div>

	<table id="orderlist" class="table table-striped table-bordered" data-order='[[0,"desc"]]' data-page-length='25' cellspacing="0" width="100%">
		<thead>
			<tr>
				<th class="order">Order</th>
				<th>Name</th>
				<th>LPO</th>
				<th class="tickCross">Status</th>
				<th class="tickCross">Store 1</th>
				<th class="tickCross">Store 2</th>
				<th class="tickCross">Printed ?</th>
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
