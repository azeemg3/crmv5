// JavaScript Document
function acc_cashBook(form)
{
	var form="#"+form;
	$.ajax({
			url:"ajax_call/get_cashBook",
			type:"POST",
			data:$(form).serialize(),
			cache:false,
			success: function(data)
			{
				
				rec=data.split("~");
				if(rec[0]==""){$("#amountIn").html('<tr><td colspan="" align="center">No Record Found</td></tr>'); }
				else{$("#amount_in").html(rec[0]);}
				if(rec[1]==""){$("#amount_out").html('<tr><td colspan="8" align="center">No Record Found</td></tr>'); }
				else{$("#amount_out").html(rec[1]);}
				$("#b_f").html(rec[2]);
				$("#c_in").html(rec[3]);
				$("#c_out").html(rec[4]);
				$("#c_a").html(rec[5]);
				$(form)[0].reset();
			}
			
	});
}
// accounts sale reports
function acc_get_sale_rep()
{
	$.ajax({
		url:"ajax_call/get_sale_report",
		data:$("#form").serialize(),
		type:"POST",
		cache:false,
		success: function(data)
		{
			rec=data.split("~");
			$("#acc_get_sale_report").html(data);
			$("#spo").html("<option value=''>Select...</option>"+rec[2]);
		}
	});
}
// Pop Up For new transaction --------------
function new_transaction()
{
	$("#transaction").modal({backdrop: 'static'});
}
// select to transaction account
$(".trans_from").on("change", function()
{
	$.ajax({
		url:"ajax_call/get_transacc_to?trans_id="+$(this).val(),
		success:function(data)
		{
			$(".trans_to").html('<option value="">Select A/C</option>'+data);
		}
	});
});
// fetch day book date wise
function get_day_book()
{
	$("#get_daily_trans").html("");
	$("#get_ob").html("");
	$.ajax({
		url:"ajax_call/get_day_book",
		type:"POST",
		data:$("#form").serialize(),
		dataType:"JSON",
		success: function(data)
		{
			ob="";
			daily_trans="";
			for(i=0; i<data.ob.length; i++)
			{
				ob+='<tr>';
				ob+='<td colspan="4" align="right">'+data.ob[i]['trans_acc_name']+'</td>';
				ob+='<td>'+data.ob[i]['description']+'</td>';
				ob+='<td>'+data.ob[i]['debit']+'</td>';
				ob+='<td>'+data.ob[i]['credit']+'</td>';
				ob+='<td>'+data.ob[i]['balance']+'</td>';
				ob+='</tr>';
			}
			$("#get_ob").html(ob);
			for(j=0; j<data.allData.length; j++)
			{
				daily_trans+='<tr>';
				daily_trans+='<td>'+data.allData[j]['trans_date']+'</td>';
				daily_trans+='<td>'+data.allData[j]['voucher']+'</td>';
				daily_trans+='<td></td>';
				daily_trans+='<td>'+data.allData[j]['trans_acc_name']+'</td>';
				daily_trans+='<td>'+data.allData[j]['narration']+'</td>';
				daily_trans+='<td>'+data.allData[j]['debit']+'</td>';
				daily_trans+='<td>'+data.allData[j]['credit']+'</td>';
				daily_trans+='<td>'+data.allData[j]['balance']+'</td>';
				daily_trans+='</tr>';
			}
			$("#get_daily_trans").html(daily_trans);
		}
		
	});
}
// Retreive tha dta accont ledger
function get_acc_ledger()
{
	$("#get_acc_ledger_ob").html("");
	$("#get_acc_ledger").html("");
	$.ajax({
		url:"ajax_call/get_acc_ledger",
		type:"POST",
		data:$("#form").serialize(),
		dataType:"JSON",
		success: function(data)
		{
			ob="";
			for(i=0; i<data.ob.length; i++)
			{
				ob+='<tr>';
				ob+='<td colspan="3" align="right">'+data.ob[i]['description']+'</td>';
				ob+='<td>'+data.ob[i]['debit']+'</td>';
				ob+='<td>'+data.ob[i]['credit']+'</td>';
				ob+='<td>'+data.ob[i]['balance']+'</td>';
				ob+='</tr>';
			}
			$("#get_acc_ledger_ob").html(ob);
			acc_ledger="";
			for(j=0; j<data.allData.length; j++)
			{
				acc_ledger+='<tr>';
				acc_ledger+='<td>'+data.allData[j]['trans_date']+'</td>';
				acc_ledger+='<td>'+data.allData[j]['voucher']+'</td>';
				acc_ledger+='<td>'+data.allData[j]['narration']+'</td>';
				acc_ledger+='<td>'+data.allData[j]['debit']+'</td>';
				acc_ledger+='<td>'+data.allData[j]['credit']+'</td>';
				acc_ledger+='<td>'+data.allData[j]['balance']+'</td>';
				acc_ledger+='</tr>';
			}
			$("#get_acc_ledger").html(acc_ledger);
		}
	});
}
// fetch the transaction account accordingly accoun type
$(".fetch_trans_acc").on("change", function(){
	$.ajax({
		url:"../ajax_call/search_transacc?acc_type="+$(this).val(),
		dataType:"JSON",
		success: function(data)
		{
			var sel_acc="";
			for(i=0; i<data.length; i++)
			{
				sel_acc+='<option value="'+data[i]['trans_acc_id']+'">'+data[i]['trans_acc_name']+'</option>';
			}
			$(".selected_trans_acc").html('<option value="">Select Ledger A/C</option>'+sel_acc);
		}
	});
});
// add OPening Balace
function open_OB(id)
{
	$("#OB").modal();
	$("#OB").show();
	document.getElementById("id").value=id;
	
}
function add_OB()
{
	$.ajax({
		url:"ajax_call/get_lead_ob",
		type:"POST",
		data:$("#form").serialize(),
		success: function(data)
		{
			rec=data.split("~");
			console.log($("#"+rec[0]).find(".amount").text(rec[1]));
			$("#OB").hide();
			$("#OB").modal('hide');
			document.getElementById("form").reset();
		}
	});
}
function acc_ticket_view(id, type, lid)
{
	$("#ticket_details_modal").modal();
	var lead="";
	var ticket="";
	$.ajax({
		url:"view_modals/get_acc_sale_det?type="+type+"&id="+id+"&leadId="+lid,
		dataType:"JSON",
		success: function(data)
		{
			lead+='<tr>';
			 lead+='<th colspan="3" style="text-align:center">Lead Details</th>';
			lead+='</tr>';
			lead+='<tr>';
			 lead+='<th>Lead Id</th><th>Contact Name</th><th>Mobile</th>';
			lead+='<tr>';
			 lead+='<td>'+data.lead.id+'</td><td>'+data.lead.contact_name+'</td><td>'+data.lead.mobile+'</td>';
			lead+='</tr>';
			$("#lead_view").html(lead);
			ticket+='<tr>';
			 ticket+='<th colspan="3" style="text-align:center">Ticket Details</th>';
			ticket+='</tr>';
			ticket+='<tr>';
			 ticket+='<td>Sale Staff</td><td colspan="2">'+data.saleStaff+'</td>';
			ticket+='</tr>'; 
			ticket+='<tr>';
			 ticket+='<td>Date Of Issue</td><td colspan="2">'+data.ticket.issue_date+'</td>';
			ticket+='</tr>';
			ticket+='<tr>';
			 ticket+='<td>Gds</td><td colspan="2">'+data.ticket.gds+'</td>';
			ticket+='</tr>';
			ticket+='<tr>';
			 ticket+='<td>Other Stock</td><td colspan="2">'+data.ticket.other_stack+'</td>';
			ticket+='</tr>';
			ticket+='<tr>';
			 ticket+='<td>Vendor</td colspan="2">'+data.vendor+'</td>';
			ticket+='</tr>';
			ticket+='<tr>';
			 ticket+='<td>Sector</td><td colspan="2">'+data.ticket.sector+'</td>';
			ticket+='</tr>';
			ticket+='<tr>';
			 ticket+='<td>Passenger Name</td><td colspan="2">'+data.ticket.passName+'</td>';
			ticket+='</tr>';
			ticket+='<tr>';
			 ticket+='<td>Received</td><td colspan="2">'+data.ticket.recieved+'</td>';
			ticket+='</tr>';
			ticket+='<tr>';
			 ticket+='<td>Airline Taxes</td><td colspan="2">'+data.ticket.airline_taxes+'</td>';
			ticket+='</tr>';
			ticket+='<tr>';
			 ticket+='<td>Net Cost</td><td colspan="2">'+data.ticket.netCost+'</td>';
			ticket+='</tr>';
			ticket+='<tr>';
			 ticket+='<td>A/c Details</td><td colspan="2">'+data.ticket.accDetails+'</td>';
			ticket+='</tr>';
			$("#ticket_det_summary").html(ticket);
		}
	});
}
function acc_other_view(id, type, lid)
{
	$("#otherSale_details_modal").modal();
	var lead="";
	var other="";
	$.ajax({
		url:"view_modals/get_acc_sale_det?type="+type+"&id="+id+"&leadId="+lid,
		dataType:"JSON",
		success: function(data)
		{
			lead+='<tr>';
			 lead+='<th colspan="3" style="text-align:center">Lead Details</th>';
			lead+='</tr>';
			lead+='<tr>';
			 lead+='<th>Lead Id</th><th>Contact Name</th><th>Mobile</th>';
			lead+='<tr>';
			 lead+='<td>'+data.lead.id+'</td><td>'+data.lead.contact_name+'</td><td>'+data.lead.mobile+'</td>';
			lead+='</tr>';
			$("#o_lead_view").html(lead);
			other+='<tr>';
			 other+='<th colspan="3" style="text-align:center">Ticket Details</th>';
			other+='</tr>';
			other+='<tr>';
			 other+='<td>Sale Staff</td><td colspan="2">'+data.saleStaff+'</td>';
			other+='</tr>'; 
			other+='<tr>';
			 other+='<td>Date Of Issue</td><td colspan="2">'+data.other.issue_date+'</td>';
			other+='</tr>';
			other+='<tr>';
			 other+='<td>Vendor</td><td colspan="2">'+data.vendor+'</td>';
			other+='</tr>';
			other+='<tr>';
			 other+='<td>Passenger Name</td><td colspan="2">'+data.other.passName+'</td>';
			other+='</tr>';
			other+='<tr>';
			 other+='<td>Received</td><td colspan="2">'+data.other.recieved+'</td>';
			other+='</tr>';
			other+='<tr>';
			 other+='<td>Net Cost</td><td colspan="2">'+data.other.netCost+'</td>';
			other+='</tr>';
			other+='<tr>';
			 other+='<td>A/c Details</td><td colspan="2">'+data.other.accDetails+'</td>';
			other+='</tr>';
			$("#otherSale_det_summary").html(other);
		}
		});
}
$(".acc_multiple_rec").delegate(".multiple_rec_app", "click", function(){
	
	$(".acc_multiple_rec").append('<div class="parentRemove"><div class="col-lg-3 col-sm-4">'+
                    	'<div class="form-group">'+
                          '<label>Invoice Number / Ref No. </label>'+
                          '<input class="form-control input-sm acc_fetch_sale_inv" name="refrence[]" type="text" placeholder="Invoice Number">'+
                       '</div></div>'+
					    '<div class="col-lg-3 col-sm-4">'+
                    	'<div class="form-group">'+
                          '<label>Amount *</label>'+
                          '<input class="form-control input-sm get_inv_amount" name="amount[]"  id="rec_amount"  type="text" placeholder="Amount *">'+
                       '</div>'+
                    '<!-- form--group-->'+
					'</div>'+
					'<div class="col-md-1">'+
					  '<div class="form-group">'+
					  	'<label style="visibility:hidden;">Tourvision</label>'+
						'<button type="button" class="btn btn-sm btn-primary remove"><i class="fa fa-remove"></i></button>'+
					  '</div>'+
					'</div>'+
                    '</div><div class="clearfix"></div></div>');
});
// Accounts fetch amont against given invoice number fsAmount(fetch Sale Amount)
$(document).on("change", ".acc_fetch_sale_inv", function(){
	 var sum = 0;
	g=$(this);
	$.ajax({
		url:"../ajax_call/fetch_sale_inv?inv_no="+$(this).val(),
		dataType:"JSON",
		success: function(data)
		{
			g.parents().closest(".col-lg-3").next(".col-lg-3").find(".get_inv_amount").val(data);
			$(".get_inv_amount").each(function(){
				sum += +$(this).val();
			});
			$("#inv_total_amount").val(sum);
		}
	});
});
// fetch amount against trave pro receipt voucher
function acc_fetch_rec_amount(tp_rv)
{
	$.ajax({
		url:'ajax_call/fetch_rec_amount?tp_rc='+tp_rv,
		success: function(data)
		{
			$("#acc_rec_amount").val(data);
		}
	});
}
// save aging account sale incoice data
function save_aging_inv()
{
	$.ajax({
		url:"ajax_call/save_aging_inv",
		type:"POST",
		data:$("form").serializeArray(),
		success: function(data)
		{
			if(data=='error')
			{
				$("#error-loader").modal();
			}
			else
			{
				$("#success-loader").modal({backdrop: 'static'});
				$("#form").hide();
			}
		}
	});
}
