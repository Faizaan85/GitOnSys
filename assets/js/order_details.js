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
        case "fz-danger":
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
                url: "./orders/order_item_state",
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
        var orderid = $('#omid').attr("data-omid");
        var state = "fz-success";
        var lqty = parseInt(tr.children(".LQty").html());
        var rqty = parseInt(tr.children(".RQty").html());
        var tqty = parseInt(tr.children(".TQty").html());
        // Calling function
        change_row_state(orderid, tr, state, lqty, rqty, tqty);
        ////console.log(tqty);
    });
    // When Item is NOT Available
    $('.delete').on('click',function()
    {
        // Setting up vars for function
        var tr = $(this).parent();
        var orderid = $('#omid').attr("data-omid");
        var state = "fz-danger";
        // Calling function
        change_row_state(orderid, tr, state);
    });
    // When Item QTY needs to be changed.
    $('.edit').on('click',function()
    {
        // Setting up vars for function
        var tr = $(this).parent();
        var orderid = $('#omid').attr("data-omid");
        var state = "edit";
        // Calling function
        change_row_state(orderid, tr, state);
        // Make Qty columns editable
        $(this).nextAll('.RQty').attr("contenteditable","true");
        $(this).nextAll('.LQty').attr("contenteditable","true");
        $(this).nextAll('.TQty').attr("contenteditable",true);
    });
	// Store1 or store2 button clicked
	$("#OmStore1,#OmStore2").on('click',function(e)
	{
		var storeNum = e.target.id;


	});

});


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
