$(document).ready(function()
{
	$('#print').click(function(event)
	{
		/* Act on the event */
		var orderId = $("#omid").attr("data-omid");
		$.ajax({
			type: "POST",
			url: "../orders/set_print_state",
			dataType: 'json',
			data: {
				orderid: orderId,
				status: 1
			},
			success: function(res)
			{
				// Set print button color
				//  success color #5cb85c (green color)
				$(this).css("background-color","#5cb85c");
			}
		});
		window.print();
	});
});
