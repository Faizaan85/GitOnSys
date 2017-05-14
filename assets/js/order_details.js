function change_row_state($orderid, $tr, $state, $lqty, $rqty, $tqty)
{
    if($tqty === undefined)
    {
        $lqty = -1;
        $rqty = -1;
        $tqty = -1;
    }
    var $id = $tr.attr("id"); // This will give Id of the item
    var $setstate = -1;
    switch ($state)
    {
        case "fz-success":
            $setstate = 1;
            break;
        case "edit":
            $setstate = 0;
            break;
        case "fz-danger hidden-print":
            $setstate = 2;
            break;
        default:
            $setstate = -1;
    }

    $data = {};
    // If edit then also send new R,L and Total Qty
    if ($tr.attr("class")==="edit" && $state === "fz-success")
    {
        $data = {
            oiid: $id,
            oiomid: $orderid,
            oileftqty: $lqty,
            oirightqty: $rqty,
            oitotalqty: $tqty,
            status: $setstate
        };
    }
    else
    {
        $data = {
            oiid: $id,
            oiomid: $orderid,
            status: $setstate
        };
    }
    if ($tr.attr("class") != $state && $setstate != -1)
    {
        $.ajax({
                type: "POST",
                url: "../orders/order_item_state",
                dataType: 'json',
                data: $data,
                success: function(res)
                {
                    $tr.attr("class",$state);
                    console.log(res);
                }
            });
    }
}

$(document).ready(function()
{
    $('#print').click(function(event) {
        /* Act on the event */
        window.print();
    });
    // When Item is Ready.
    $('.done').on('click',function()
    {
        // Setting up vars for function
        var tr = $(this).parent();
		var trid = tr.attr('id'); //This will take the id of the row. e.g 22
        var orderid = $('#omid').attr("data-omid");
        var state = "fz-success";

		//the result will be e.g. #txtLqty22.val()
        var lqty = parseInt($('#txtLqty'+trid).val());
        var rqty = parseInt($('#txtRqty'+trid).val());
        var tqty = parseInt($('#txtTqty'+trid).val());


		var txtedits = $('.edit-toggle');
		var bolisdisabled = $('.edit').attr('data-editstate');
        // Calling function
        change_row_state(orderid, tr, state, lqty, rqty, tqty);
        ////console.log(tqty);

		$('#txtLqty'+trid).attr('disabled',!bolisdisabled);
		$('#txtRqty'+trid).attr('disabled',!bolisdisabled);
		$('#txtTqty'+trid).attr('disabled',!bolisdisabled);

		$('td.edit').attr('data-editstate','false');
    });
    // When Item is NOT Available
    $('.delete').on('click',function()
    {
        // Setting up vars for function
        var tr = $(this).parent();
        var orderid = $('#omid').attr("data-omid");
        var state = "fz-danger hidden-print";

        // Calling function
        change_row_state(orderid, tr, state);
    });
    // When Item QTY needs to be changed.
    $('.edit').on('click',function()
    {
        // Setting up vars for function
        var tr = $(this).parent();
		// Taking the Id of the tr and putting it in trid
		var trid = tr.attr("id");
        var orderid = $('#omid').attr("data-omid");
        var state = "edit";

		var bolisdisabled = $(this).attr('data-editstate');
		// Calling function
        change_row_state(orderid, tr, state);

		$('#txtLqty'+trid).attr('disabled',!bolisdisabled);
		$('#txtRqty'+trid).attr('disabled',!bolisdisabled);
		$('#txtTqty'+trid).attr('disabled',!bolisdisabled);
		$(this).attr('data-editstate','true');

		console.log((!bolisdisabled).toString());
    });
	$(".qty").change(function(event)
	{
		// Cannot use ID, there will be rows with same ID
		var tr = $(this).parent().parent(); //parent is td and parent of that is tr
		var trid = tr.attr("id");

        console.log("qty changed");
		$("#txtTqty"+trid).val(parseInt($("#txtLqty"+trid).val())+parseInt($("#txtRqty"+trid).val()));
	});
	// Store1 or store2 button clicked
	$("#OmStore1,#OmStore2").on('click',function(e)
	{
		var storeName = e.target.id;
		var orderId = $("#omid").attr("data-omid");
		var state = ($("#"+storeName).attr("data-state") == 0)? 1 : 0;
		var bgColor = (state == 0)? "#337ab7" : "#5cb85c";
		$.ajax({
                type: "POST",
                url: "../orders/set_store_state",
                dataType: 'json',
                data: {
					orderid: orderId,
					storename: storeName,
					status: state
				},
                success: function(res)
                {
					// primary color #337ab7 (blue color)
					//  success color #5cb85c (green color)
					$("#"+storeName).attr("data-state",state).css("background-color",bgColor); // Also need to chang class but cant figure how.
                }
            });

	});

});


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
