function load_orders(UlId)
{
	$.ajax({
		type: "GET",
		url: "orders/get_orderlist",
		success: function(res)
		{
			var orders = JSON.parse(res);
			$.each(orders,function(key, val)
			{
				// All status variables in 1 array with ternary operation
				varStatus = [
					(val['OmStatus']==1)? "btn-success" : "btn-primary",
					(val['OmStore1']==0)? "label-primary" : "label-success",
					(val['OmStore2']==0)? "label-primary" : "label-success",
				]

				varUl = `<li class="list-group-item">
						<p>Order #:`+val["OmId"]+`</p>
						<p>Name :`+ val["OmCompanyName"]+`</p>
						<span class="label `+varStatus[1] +` pull-right">Store 1</span>
						<p>LPO :`+ val["OmLpo"]+`</p>
						<span class="label `+varStatus[2] +` pull-right">Store 2</span>
						<br>
						<a href="order/`+ val["OmId"]+`" target="_blank" class="btn ` + varStatus[0] + ` role="button">Open</a>
  		   				<a href="order/`+val["OmId"]+`/print" class="btn btn-default" role="button">Print</a>
  	   					</li>`;
				$("#"+UlId).append(varUl);
			});
		},
		error: function()
		{

		}
	});

}
$(document).ready(function()
{
	// Load orders list.
	// Calling a function load_orders
	load_orders("orderlist");

});
