<div class="container-fluid">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>Part #</th>
					<th>Supplier #</th>
					<th>Company #</th>
					<th>Equpment</th>
					<th>Description</th>
					<th>Sales Price</th>
					<th>Stock</th>
					<th>Order</th>
					<th class="hidden">Cost</th>
				</tr>
			</thead>
			<tbody id="resulttable">
				<?php foreach($searchresults as $resultrow) :?>
					<tr>
						<td><?php echo $resultrow['PART_NO']; ?></td>
						<td><?php echo $resultrow['SSNO']; ?></td>
						<td><?php echo $resultrow['CO_NAME']; ?></td>
						<td><?php echo $resultrow['EQUIPMENT']; ?></td>
						<td><?php echo $resultrow['DESC']; ?></td>
						<td><?php echo $resultrow['SALES_PRIC']; ?></td>
						<td><?php echo $resultrow['QTY_HAND']; ?></td>
						<td><?php echo $resultrow['QTY_ORDER']; ?></td>
						<td class="hidden"><?php echo $resultrow['UNIT_COST']; ?></td>
					</tr>
				<?php endforeach; ?>
				
			</tbody>
		</table>
	</div>
</div>