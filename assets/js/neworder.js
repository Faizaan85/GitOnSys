// JavaScript Document
//shorcuts.
var $my_global_order = [];
var $my_counter = 0;
var $mode = "new"; //possible modes new,edit.

function calcTotal(colName, resultName)
{
	var v_total = 0.00;
	$("."+colName).each(function(i)
	{
		if(i>0)
		{
			v_total = parseFloat(v_total) + parseFloat($(this).attr("data-value"));
		}
	});
	$("#"+resultName).val( parseFloat(v_total).toFixed(2));
}

function orderTable(tabName)
{

	$(tabName).tabulator({
		height:"300px",
		index:"partno",
		// selectable:1,
		// fitColumns:true,
		columns:[
			{
				title:"Sr.",
				field:"select",
				width:100,
				sortable:true
			},
			{
				title:"Part No",
				field:"partno",
				width:125,
				sortable:true,
				onClick:function(e, cell, val, row)
				{
					$(tabName).tabulator("deleteRow", val);
					calcTotal("record","total");
				}
			},
			{
				title:"Supplier No",
				field:"supplierno",
				width:200,
				sortable:true
			},
			{
				title:"Description",
				field:"description",
				width:300,
				sortable:true,
				editable:true
			},
			{
				title:"Qty R",
				field:"qtyr",
				sortable:true,
				width:100,
				editor:"number",
				align:"center",
				editable:true,
				mutator:function(val, type, row)
				{
					if(isNaN(parseInt(val)))
					{
						return 0;
					}
					else
					{
						return (parseInt(val)<0)? 0:parseInt(val);
					}

				}
			},
			{
				title:"Qty L",
				field:"qtyl",
				sortable:true,
				width:100,
				editor:"number",
				align:"center",
				editable:true,
				mutator:function(val, type, row)
				{
					if(isNaN(parseInt(val)))
					{
						return 0;
					}
					else
					{
						return (parseInt(val)<0)? 0:parseInt(val);
					}
				}
			},
			{
				title:"Total",
				field:"totalqty",
				sortable:true,
				width:100,
				editor:"number",
				align:"center",
				editable:true,
				mutator:function(val, type, row)
				{
					var v_qtyr = (parseInt(row.qtyr)<0)? 0:parseInt(row.qtyr);
					var v_qtyl = (parseInt(row.qtyl)<0)? 0:parseInt(row.qtyl);
					var v_qtyt = (isNaN(parseInt(val)))? 0:parseInt(val);
					if((v_qtyr + v_qtyl)>0 && (v_qtyr + v_qtyl) != v_qtyt)
					{

						return (v_qtyr+v_qtyl);
					}
					else
					{

						return (parseInt(v_qtyt)<=0)? 1:parseInt(v_qtyt);
					}

				}
			},
			{
				title:"Price",
				field:"price",
				sortable:true,
				formatter:"money",
				width:100,
				editor:"number",
				align:"center",
				editable:true,
				mutator:function(val, type, row)
				{
					var v_val = parseFloat(val);
					var v_tgp = parseFloat(row.tgp);
					return (v_val<=v_tgp)? (v_tgp*0.4)+v_tgp : v_val;
				}
			},
			{
				title:"Amount",
				field:"amount",
				sortable:true,
				formatter:"money",
				width:100,
				align:"center",
				mutator:function(val, type, row)
				{
					var v_price = parseFloat(row.price);
					var v_qtyt = parseInt(row.totalqty);
					return parseFloat(v_price*v_qtyt).toFixed(2);
				},
				cssClass:"record"
			},
			{
				title:"tgp",
				field:"tgp",
				visible:false
			},
			{
				title:"state",
				field:"state",
				visible:false
			},
			{
				title:"oiid",
				field:"oiid",
				visible:false
			}
		],
		rowSelectionChanged:function(data, rows){
		//data - array of data objects for the selected rows in order of selection
    	//rows - array of jQuery elements for the selected rows in order of selection
    	},
		cellEdited:function(id, field, value, oldValue, data, cell, row){
			// there are 3 possibilities here.
			// 1. new order is being created, so if mode is new then always add insert as state.
			if($mode==="new")
			{
				$(tabName).tabulator("updateData",[{partno:data.partno, supplierno:data.supplierno, description:data.description, qtyr:data.qtyr, qtyl:data.qtyl, totalqty:data.totalqty, price:data.price, amount:data.amount, tgp:data.tgp, state:"insert", oiid:0}]);
			}
			// 2. editing an order. if item already exists from previous save.
			if($mode==="edit" && data.state==="existing")
			{
				$(tabName).tabulator("updateData",[{partno:data.partno, supplierno:data.supplierno, description:data.description, qtyr:data.qtyr, qtyl:data.qtyl, totalqty:data.totalqty, price:data.price, amount:data.amount, tgp:data.tgp, state:"update", oiid:data.oiid}]);
			}
			// 3. editing an order. if NEW item added.
			if($mode==="edit" && data.state==="insert")
			{
				$(tabName).tabulator("updateData",[{partno:data.partno, supplierno:data.supplierno, description:data.description, qtyr:data.qtyr, qtyl:data.qtyl, totalqty:data.totalqty, price:data.price, amount:data.amount, tgp:data.tgp, state:"insert", oiid:0}]);
			}
			calcTotal("record","total");

		},
	});
}



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
    $('#Price_').attr("data-tgp","-1");


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
    var v_addrowform = $("#AddRowForm");
    var v_price_tgp = parseFloat($("#Price_").attr("data-tgp"));
    v_addrowform.validate();
    var v_partno =document.getElementById("Part_no").value;
    v_partno = v_partno.toUpperCase();
//Supplier no
    var v_supplierno= document.getElementById("Supplier_no").value;
//Description
    var v_desc = document.getElementById("Desc_").value;
//QTY_R
    var v_qtyr =  document.getElementById("Qty_R").value;
    if (v_qtyr=="")
    {
        v_qtyr = 0;
    }
//QTY_L
    var v_qtyl =  document.getElementById("Qty_L").value;
    if (v_qtyl=="")
    {
		v_qtyl=0;
    }
//Total_
    var v_qtyt =  parseInt(document.getElementById("Total_").value);
    if(v_qtyt <= 0 || v_qtyt === null)
    {
            alert("Invalid Total Quantity");
            $('#Total_').focus();
    }
    else
    {
	    //Price_
	    var v_price = parseFloat($("#Price_").val()).toFixed(2);
	    // Amount
	    var v_amount = parseFloat(parseFloat(v_qtyt)*v_price).toFixed(2);
	    //Validation
	    // console.log(v_supplierno);
	    if(v_addrowform.valid() === false ||  v_price_tgp >= v_price || v_desc=="" || v_price_tgp == -1 || isNaN(v_price))
	    {
	        alert("Invalid Item");
	        return;
	    }
	    //Adding to global variable

		var v_flag = $('#'+tableID).tabulator('updateRow', v_partno,{ partno:v_partno, supplierno:v_supplierno, description:v_desc, qtyr:v_qtyr, qtyl:v_qtyl, totalqty:v_qtyt, price:v_price, amount:0, tgp: v_price_tgp, state:"update"});

		if(v_flag==false)
		{
			$my_counter +=1;
			$('#'+tableID).tabulator('addRow',{select:$my_counter, partno:v_partno, supplierno:v_supplierno, description:v_desc, qtyr:v_qtyr, qtyl:v_qtyl, totalqty:v_qtyt, price:v_price, amount:0, tgp: v_price_tgp, state:"insert", oiid:0});
		}



		calcTotal("record","total");

    }
}

$(document).ready(function()
{
	orderTable("#Output");

    $('#Qname').on('loaded.bs.select',function(e){
        $('#OrderForm').find('button[data-id=Qname]').focus();
    });
    $(window).bind('beforeunload', function()
    {
		if($my_global_order.length>0)
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
		var v_tabdata = $('#Output').tabulator("getData");
		console.log(v_tabdata.length);
        orderform.validate();

        if(orderform.valid()===false || v_tabdata.length === 0)
        {
            console.log("cant save");
            return;
        }

		//console.log("order var above");
		//$(this).attr("disabled","true");
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
	            orderdata: v_tabdata
	        },
	        success: function(res)
	        {
				// #something is a Div. so i will append the order number.
	            $("#something").attr("class","alert fz-success alert-dismissable fade in").append("Number: <strong>"+res+"</strong>");
	            // window.location.replace("order/"+res);
	            console.log(res);
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
