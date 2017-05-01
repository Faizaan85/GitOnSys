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
				var liHideState="";
				if($("#s1").hasClass("btn-primary"))
				{
					liHideState = (val['OmStore1']!=0)? "hidden" : "";
				}
				if($("#s2").hasClass("btn-primary"))
				{
					liHideState = (val['OmStore2']!=0)? "hidden" : "";
				}
				varStatus = [
					(val['OmStatus']==1)? "btn-success" : "btn-primary",
					(val['OmStore1']==0)? "label-primary" : "label-success",
					(val['OmStore2']==0)? "label-primary" : "label-success",
					(val['OmPrinted']==0)? "btn-default" : "btn-success"
				]

				varUl = `<li class="list-group-item `+liHideState+`">
							<p>Order #:`+val["OmId"]+`</p>
							<p>Name :`+ val["OmCompanyName"]+`</p>
							<span class="label `+varStatus[1] +` s1 pull-right">Store 1</span>
							<p>LPO :`+ val["OmLpo"]+`</p>
							<span class="label `+varStatus[2] +` s2 pull-right">Store 2</span>
							<br>
							<a href="order/`+ val["OmId"]+`" target="_blank" class="btn ` + varStatus[0] + `" role="button">Open</a>
  		   					<a href="order/`+val["OmId"]+`/print" class="btn ` + varStatus[3] + `" role="button">Print</a>
  	   					</li>`;
				$("#"+UlId).append(varUl);
			});

		},
		error: function(res)
		{
			alert(res);
		}
	});
}
function stop_autoload(myVar)
{
	clearInterval(myVar);
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


});
