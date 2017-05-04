function load_orders(UlId)
{
	var usrlvl = (parseInt($('#username').attr("data-level"))>6)? "" : "hidden";
	$.ajax({
		type: "GET",
		url: "orders/get_orderlist",
		success: function(res)
		{
			var orders = JSON.parse(res);
			$.each(orders,function(key, val)
			{
				// All status variables in 1 array with ternary operation
				var liHideState="";
				if($("#s1").hasClass("btn-primary"))
				{
					liHideState = (val['OmStore1']!=0)? "hidden" : "";
				}
				if($("#s2").hasClass("btn-primary"))
				{
					liHideState = (val['OmStore2']!=0)? "hidden" : "";
				}
				if($("#printed").hasClass("btn-default"))
				{
					liHideState = (val['OmPrinted']!=0)? "hidden" : "";
				}
				varStatus = [
					(val['OmStatus']==1)? "btn-success" : "btn-primary",
					(val['OmStore1']==0)? "label-primary" : "label-success",
					(val['OmStore2']==0)? "label-primary" : "label-success",
					(val['OmPrinted']==0)? "btn-default" : "btn-success"
				];
				var orderDate = val["OmCreatedOn"].split("-");
				orderDate = orderDate[2] +"/"+orderDate[1]+"/"+orderDate[0];

				varUl = `<li class="list-group-item `+liHideState+`" data-omid="`+val["OmId"]+`">
					<h5 class="pull-right">Date: `+ orderDate +`</h5>
							<p>Order #:`+val["OmId"]+`</p>

							<button class="del `+usrlvl+` btn btn-danger btn-xs pull-right" onClick="delete_click(`+val["OmId"]+`)">
								<span class="glyphicon glyphicon-trash"></span>
							</button>
							<p>Name :`+ val["OmCompanyName"]+`</p>
							<span class="label `+varStatus[1] +` s1 pull-right">Store 1</span>
							<p>LPO :`+ val["OmLpo"]+`</p>
							<span class="label `+varStatus[2] +` s2 pull-right">Store 2</span>
							<br>
							<a href="order/`+ val["OmId"]+`" target="_blank" class="btn ` + varStatus[0] + `" role="button">Open</a>
  		   					<a href="order/`+val["OmId"]+`/print" class="pri btn ` + varStatus[3] + ` `+usrlvl+`" role="button"  >Print</a>
  	   					</li>`;
				$("#"+UlId).append(varUl);
			});

		},
		error: function(res)
		{
			console.log(res);
		}
	});
}
function stop_autoload(myVar)
{
	clearInterval(myVar);
}
function delete_click(omid)
{
	console.log("delete button clicked");
	var liEl = $('li[data-omid="'+omid+'"]');
	var omid = parseInt($(liEl).attr('data-omid'));
	var usrlvl = parseInt($('#username').attr("data-level"));
	// Put confirm dialogue box here
	if (confirm('Are you sure you want to Delete Order:'+omid+'? This Action cannot be reversed.'))
	{
    	console.log('Thanks for confirming');
		$.ajax(
			{
				type: "POST",
				url: "orders/delete_order",
				dataType: "json",
				data:
				{
					omid: omid,
					usrlvl: usrlvl
				},
				success: function(res)
				{
					console.log(res);
					$(liEl).addClass("hidden");
					$(liEl).remove();
				}
			});
	}
	else
	{
    	console.log('Why did you press cancel? You should have confirmed');
		return false;
	}
}
$(document).ready(function()
{
	// Load orders list.
	// Calling a function load_orders
	var BtnReload = $("#reload");
	// Needed to call load function once or else it waits for x seconds before first call.
	load_orders("orderlist");
	// autoreload loop begins.
	setInterval(function()
	{
		if(BtnReload.attr("data-state") == "TRUE")
		{
			$('#orderlist').empty();
			load_orders("orderlist");
		}
		else
		{
			clearInterval();
		}
	}, 10000);
	// Event: Reload.Button.Click
	BtnReload.on('click',function()
	{
		$(this).attr("data-state","FALSE").removeClass("btn-success").addClass("btn-warning");
	});
	// #Auto Reload section done above
	// Store Button click Event
	$("#s1,#s2").on('click',function()
	{
		var btnId = $(this).attr("id");
		if($(this).hasClass("btn-success"))
		{
			$("span."+btnId+".label-success").parent().addClass("hidden");
			$(this).removeClass("btn-success").addClass("btn-primary");
		}
		else
		{
			$("span."+btnId+".label-success").parent().removeClass("hidden");
			$(this).removeClass("btn-primary").addClass("btn-success");
		}

		// $("span."+btnId).parent().addClass("hidden");
		console.log("hope it workd.");
	});
	// Printed Button click event
	$("#printed").on('click',function()
	{
		if($(this).hasClass("btn-success")) // Already Showing all orders
		{
			$("a.pri.btn-success").parent().addClass("hidden");
			$(this).removeClass("btn-success").addClass("btn-default");
		}
		else // Currently Showing Only unprinted orders
		{
			$("a.pri.btn-success").parent().removeClass("hidden");
			$(this).removeClass("btn-default").addClass("btn-success");
		}
	});
});
