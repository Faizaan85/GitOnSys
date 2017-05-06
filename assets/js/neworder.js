// JavaScript Document
//shorcuts.
var $my_global_order = [];
var $my_counter = 0;

shortcut.add("F2", function()
{
    $("#save").click();
});
shortcut.add("F4", function()
{
    $("#cancel").click();
});
shortcut.add("F9", function()
{
    $("#Part_no").focus();
});

//bootstrap-selects
$('.selectpicker').selectpicker({
  style: 'btn-success',
  size: 10
});


//functions
function disp_data($i)
{
        document.getElementById($i);//here also what to do.

}
function setfocus(objectid)// this is for the textbox to get focus onload.
{
        document.getElementById(objectid).focus();
        console.log(objectid);


}
function Toggle_Hide_Show(eid)
{
        if(document.getElementById(eid).className=="tab_cell_show")
        {
            document.getElementById(eid).className="tab_cell_hidden";
        }
        else
        {
            document.getElementById(eid).className="tab_cell_show";
        }

        //document.getElementById('hideShow').style.visibility='hidden';
}
function GetProductTrans(part_no)
{
        var custnum="ALL";
        var str1="Item_Trans.php?part_no=";
        var str2= str1.concat(part_no,"&cust=ALL");
        window.open(str2,'_self');
        //document.getElementById(part_no.concat("1")).innerHTML=str2;
}


function whichButton(keyCode,str)
{
	//alert("got a key = " + keyCode);
	if (keyCode == 13 && str=="Add_Row")
	{
		addRow('Output');
		var followingInput = document.getElementById("Part_no");
		followingInput.focus();
	}
	else if (keyCode == 13 && str=="Qty_R")
	{
		// this means ENTER key was pressed at Part No input box
		//SEND A HTTP REQUEST WITH AJAX
		var partNo = $('#Part_no').val();
		if($.trim(partNo) == "")
		{
			return;
		}
		$.getJSON("items/get_part_details/"+partNo ,function(data)
        {
	            // console.log(data);
		}).done(function(data){
			// Success Return
			$('#Desc_').val(data.DESC);
			$('#Supplier_no').val(data.SSNO);
			$('#Price_').val(data.SALES_PRIC);
			$('#Price_').attr("data-tgp",data.UNIT_COST);
		}).fail(function(){
			// Failed Return
			alert("Part Number NOT found.");
			$("#Part_no").focus();
		});
		var followingInput = document.getElementById(str);
		followingInput.focus();
	}
	else if (keyCode == 13)
	{
		var followingInput = document.getElementById(str);
		followingInput.focus();
	}
}
function CancelOrder()
{
    window.location.replace("neworder");
}
function clearInput()
{
	document.getElementById("Part_no").value="";
	document.getElementById("Supplier_no").value="";
	document.getElementById("Desc_").value="";
	document.getElementById("Qty_R").value="0";
	document.getElementById("Qty_L").value="0";
	document.getElementById("Total_").value="0";
	document.getElementById("Price_").value="";
    $('#Price_').attr("data-tgp","1");


}

function makexmlhttp()
{
	if (window.XMLHttpRequest)
  	{// code for IE7+, Firefox, Chrome, Opera, Safari
  		xmlhttp=new XMLHttpRequest();
  	}
	else
  	{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  	}
	return xmlhttp;
}
/*
function getDesc(str)
{
if (str=="")
  {
  document.getElementById("Desc_").value="abc";
  return;
  }
xmlhttp = makexmlhttp();
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("Desc_").value=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","getdesc.php?q="+str,true);
xmlhttp.send();
}*/



function addRow(tableID)
{
    var addrowform = $("#AddRowForm");
    var price_tgp = parseFloat($("#Price_").attr("data-tgp"));

    addrowform.validate();

    var partno =document.getElementById("Part_no").value;
    partno = partno.toUpperCase();

//Supplier no
    var supplierno= document.getElementById("Supplier_no").value;
//Description
    var desc = document.getElementById("Desc_").value;
//QTY_R
    var qtyr =  document.getElementById("Qty_R").value;
    if (qtyr=="")
    {
        qtyr = 0;
    }
//QTY_L
    var qtyl =  document.getElementById("Qty_L").value;
    if (qtyl=="")
    {
	qtyl=0;
    }

//Total_

    var qtyt =  parseInt(document.getElementById("Total_").value);
    if(qtyt <= 0 || qtyt === null)
    {
            alert("Invalid Total Quantity");
            $('#Total_').focus();
    }
    else
    {
    //Price_
        var price = parseFloat($("#Price_").val()).toFixed(2);
    // Amount
        var amount = parseFloat(parseFloat(qtyt)*price).toFixed(2);
    //Validation
        console.log(supplierno);
        if(addrowform.valid() === false ||  price_tgp >= price || desc=="")
        {
            alert("Invalid Item");
            return;
        }
    //Adding to global variable
        $my_global_order.push([partno,supplierno,desc,qtyr,qtyl,qtyt,price]);
        var markup = "<tr><td class='record'> </td><td>" + partno + "</td><td>" + supplierno + "</td><td>" + desc + "</td><td>" + qtyr + "</td><td>" + qtyl + "</td><td>" + qtyt + "</td><td>" + price + "</td><td class='amount'>" + amount + "</td></tr>";
        var tableid = document.getElementById(tableID);
    //Adding to table.
        $(tableid).append(markup);


        var total = 0.00;
        $(".record").each(function(i)
        {
            total = parseFloat(total) + parseFloat($(this).siblings(".amount").html());
            ////console.log(total);
            $(this).html(i+1);
        });
        $("#total").val( parseFloat(total).toFixed(2));
    }
}

$(document).ready(function()
{
    $('#Qname').on('loaded.bs.select',function(e){
        $('#OrderForm').find('button[data-id=Qname]').focus();
    });
    $(window).bind('beforeunload', function()
    {
		if($my_global_order.length>0 && $("#save").attr("disabled")=="false")
		{
			return 'Are you sure you want to leave?';
		}
    });

    //important function below, it selects all text in QTY field when focusin
    $("input[type=number]").focus(function()
    {
        $(this).select();
    });
	//left or right qty change.
	$(".qty").change(function(event)
	{
        ////console.log("qty changed");
		$("#Total_").val(parseInt($("#Qty_L").val())+parseInt($("#Qty_R").val()));
	});
	//total qty change

	//remove record function
	$("#Output").on('click','.record',function(){
		var indexval = $(this,"td:first").html() - 1;
		////console.log(indexval);
		$my_global_order.splice(indexval,1);
		$(this).parent().remove();
		////console.log($my_global_order);
        var total = 0.00;
        $(".record").each(function(i)
        {
            total = parseFloat(total) + parseFloat($(this).siblings(".amount").html());
            ////console.log("i : "+ i);
            $(this).html(i+1);
        });
        $("#total").val( parseFloat(total).toFixed(2));
	});
	//save order function
	$("#save").on('click',function()
	{
		if($(this).attr("disabled"))
		{
			console.log("already saved");
			return false;
		}
        var orderform = $( "#OrderForm" );
        orderform.validate();
        if(orderform.valid()===false || $my_global_order.length === 0)
        {
            console.log("cant save");
            return;
        }
		//console.log($my_global_order);
		//console.log("order var above");
		$(this).attr("disabled","true");
		$.ajax(
		{
	        type: "POST",
	        url: "orders/save_order",
	        dataType: 'json',
	        data:
			{
	            name: $('#Qname').val().toUpperCase(),
	            lpo: $('#Lpo').val().toUpperCase(),
	            date: $('#Cdate').val(),
				username: $('#username').attr("data-username"),
	            orderdata: $my_global_order
	        },
	        success: function(res)
	        {
				// #something is a Div. so i will append the order number.
	            $("#something").attr("class","alert fz-success alert-dismissable fade in").append("Number: <strong>"+res+"</strong>");
				console.log(res);
	            window.location.replace("print/"+res);

	        }
	    });


	});
	//testing function
	$("#total").on('click',function()
	{
		console.log($('#username').attr("data-username"));

	});

	$('#Part_no').focusout(function(){

	});
});
/*
	//SEND A HTTP REQUEST WITH AJAX
	var no_len =$('#Part_no').val();
	//alert(event.which);

	$.ajax({
	url: 'getdesc.php',
	data: 'q='+$('#Part_no').val(),
	dataType: 'json',
	success: function(data)
	{
		var desc=data[0]+" /- "+data[1];
		var ssno=data[1];

		// UPDATE HTML CONTENT
		$('#Desc_').val(desc);
		$('#Desc_').load()
		//$('#Price_').val(ssno);
	}

	});
	*/



//jquery stuff
