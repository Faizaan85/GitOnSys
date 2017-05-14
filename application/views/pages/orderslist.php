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
				<th class="thRow order" data-colname="OmId">Order</th>
				<th class="thRow" data-colname="OmCompanyName">Name</th>
				<th class="thRow" data-colname="OmLpo">LPO</th>
				<th class="thRow tickCross" data-colname="OmStatus">Status</th>
				<th class="thRow tickCross" data-colname="OmStore1">Store 1</th>
				<th class="thRow tickCross" data-colname="OmStore2">Store 2</th>
				<th class="thRow tickCross" data-colname="OmPrinted">Printed ?</th>
				<th class="thRow" data-colname="OmCreatedOn">Date</th>
				<th class="thRow" data-colname="OmCreatedBy">By</th>
				<?php
				  	if(($this->session->level)>=7)
					{
						echo '<th class="thRow options" data-colname="">Options</th>';
					}
				?>
			</tr>
		</thead>
		<!-- <tfoot>
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
				<th>Options</th>
			</tr>
		</tfoot> -->
	</table>
</div>
