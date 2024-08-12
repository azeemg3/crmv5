// JavaScript Document
leadId=$("#leadId").val();
lead_acc_sum();
lead_conv();
	function fop(val, fop)
	{
		if(val=="online")
		{
			$(".rec-banks").show();
			$(".rec-cash").hide();
			$(".rec-cash").find("select").attr("disabled","disabled");
			$(".rec-banks").find("select").removeAttr("disabled","disabled");
			$("#"+fop).html('<div class="col-md-4"><div class="form-group"><input type="text" name="bank_branch" placeholder="Bank Branch" class="form-control input-sm"></div></div><!--col-md-4--><div class="col-md-4"><div class="form-group"><input type="text" name="ref_number" placeholder="Bank Receipt" class="form-control input-sm"></div></div><!--col-md-4-->');
		}
		else if(val=="cheque")
		{
			$(".rec-banks").show();
			$(".rec-cash").hide();
			$(".rec-cash").find("select").attr("disabled","disabled");
			$(".rec-banks").find("select").removeAttr("disabled","disabled");
			$("#"+fop).html('<div class="col-md-4"><div class="form-group"><input type="text" name="bank_branch" placeholder="Bank Branch" class="form-control input-sm"></div></div><!--col-md-4--><div class="col-md-4"><div class="form-group"><input type="text" name="ref_number" placeholder="Cheque Number" class="form-control input-sm"></div></div><!--col-md-4-->');
		}
		else if(val=="pay_order")
		{
			$(".rec-banks").show();
			$(".rec-cash").hide();
			$(".rec-cash").find("select").attr("disabled","disabled");
			$(".rec-banks").find("select").removeAttr("disabled","disabled");
			$("#"+fop).html('<div class="col-md-4"><div class="form-group"><input type="text" name="" placeholder="Bank Branch" class="form-control input-sm"></div></div><!--col-md-4--><div class="col-md-4"><div class="form-group"><input type="text" name="ref_number" placeholder="Pay Order" class="form-control input-sm"></div></div><!--col-md-4-->');
		}
		else if(val=="demand_draft")
		{
			$(".rec-banks").show();
			$(".rec-cash").hide();
			$(".rec-cash").find("select").attr("disabled","disabled");
			$(".rec-banks").find("select").removeAttr("disabled","disabled");
			$("#"+fop).html('<div class="col-md-4"><div class="form-group"><input type="text" name="bank_branch" placeholder="Bank Branch" class="form-control input-sm"></div></div><!--col-md-4--><div class="col-md-4"><div class="form-group"><input type="text" name="ref_number" placeholder="Demand Draft" class="form-control input-sm"></div></div><!--col-md-4-->');
		}
		else if(val=="card")
		{
			$(".rec-banks").show();
			$(".rec-cash").hide();
			$(".rec-cash").find("select").attr("disabled","disabled");
			$(".rec-banks").find("select").removeAttr("disabled","disabled");
			$("#"+fop).html('<div class="col-md-4"><div class="form-group"><select class="form-control input-sm" name="card_type"><option value="visa">Visa Card</option><option value="master">Master Card</option></select></div></div><!--col-md-4--><div class="col-md-4"><div class="form-group"><input type="text" name="card_comp" placeholder="Card Company" class="form-control input-sm"></div></div><!--col-md-4--><div class="col-md-4"><div class="form-group"><input type="text" name="ref_number" placeholder="Card Number" class="form-control input-sm"></div></div><!--col-md-4-->');
		}
		else
		{
			$("#"+fop).html('');
			$(".rec-banks").find("select").attr("disabled","disabled");
			$(".rec-cash").find("select").removeAttr("disabled","disabled");
			$(".rec-banks").hide();
			$(".rec-cash").show();
		}
	}
// unseuccessfull reasons
function close_un_suc()
{
	$("#un-reason").modal({backdrop: 'static'});
}
//open other closing lead
function add_reason(val)
{
	if(val=="other")
	{
		$("#add-reason").html('<textarea class="form-control input-sm" name="other_reason" cols="3" rows="3"></textarea>');
	}
	else
	{
		$("#add-reason").html('');
	}
}
// lead priority levels
$(".lead-pr").on("click",function()
{
	var lp=$(this).val().split("-");
	var x=confirm('Are You Sure?');
	if(!x){ return false;}
	$('input.lead-pr').not(this).prop('checked', false);
	$(this).load("lead-tabs/lead_priority?lp="+lp[0]+"&leadId="+lp[1]);
});
// add lead details 
function add_leadDetail(type, formData, callDiv)
{
	if(type=='receipt'){frmData=$("#"+formData).serializeArray();}
	else {frmData=$("#"+formData).serialize()}
	$("#this-loader").modal({backdrop:'static'});
	$("."+callDiv).parents(".box-solid").children(".overlay").css("display","block");
	$.ajax({
		url:"lead-tabs/lead-details/save_detail?type="+type+"&leadId="+leadId,
		type:"POST",
		data:frmData,
		success: function(data)
		{
			rec=data.split("~");
			if(rec[0]==1)
			{
				$("."+callDiv).html(data);
				lead_acc_sum();
				$("."+callDiv).parents(".box-body").css("display","block");
				$("."+callDiv).parents(".box-body").parent().find("i").removeClass("fa-plus").addClass("fa-minus");
				$("."+callDiv).parents(".box-solid").removeClass("collapsed-box");
				$("."+callDiv).parents(".box-solid").children(".overlay").css("display","none");
				document.getElementById(formData).reset();
				$("#this-loader").modal('hide');
				$("#success-loader").modal();
			}
			else
			{
				$("#this-loader").modal('hide');
				$("#error-loader").modal();
				$("."+callDiv).parents(".box-solid").children(".overlay").css("display","none");
			}
			
		},
		cache:false,
	});
}
// get sale details
function get_sale(type, callDiv)
{
	$("."+callDiv).parents(".box-solid").children(".overlay").css("display","block");
	$("."+callDiv).parents(".box-solid").children(".box-header").children(".box-tools").children(".btn-box-tool").removeAttr("onClick");
	form=$("."+callDiv).parents(".box-body").parent().find("form").attr("id");
	$.ajax({
		url:"lead-tabs/lead-ledger/get_sale?type="+type+"&leadId="+leadId,
		type:"POST",
		data:$("#"+form).serialize(),
		cache:false,
		success: function(data)
		{
			$("."+callDiv).html(data);
			$("."+callDiv).parents(".box-solid").children(".overlay").css("display","none");
		}
	});
}
// edit lead details e.g sale  etc
function edit_ticket_sale(id)
{
	$("#edit_ticket").modal({ backdrop: 'static'});
	$.ajax({
		url:"lead-tabs/lead-details-editor/get_ticket_sale?id="+id,
		dataType:"JSON",
		success: function(data)
		{
			$("#edit_ticket input[name$='id']").val(data.id);
			$("#edit_ticket select[name$='branch']").val(data.branch);
			$("#edit_ticket select[name$='salesStaff']").val(data.salesStaff);
			$("#edit_ticket input[name$='issue_date']").val(data.issue_date);
			$("#edit_ticket select[name$='gds']").val(data.gds);
			$("#edit_ticket select[name$='stock_used']").val(data.stock_used);
			$("#edit_ticket input[name$='other_stack']").val(data.other_stack);
			$("#edit_ticket input[name$='airline_code']").val(data.airline_code);
			$("#edit_ticket input[name$='ticket_no']").val(data.ticket_no);
			$("#edit_ticket input[name$='sector']").val(data.sector);
			$("#edit_ticket input[name$='passName']").val(data.passName);
			$("#edit_ticket input[name$='phone']").val(data.phone);
			$("#edit_ticket select[name$='passType']").val(data.passType);
			$("#edit_ticket input[name$='recieved']").val(data.recieved);
			$("#edit_ticket input[name$='netCost']").val(data.netCost);
			$("#edit_ticket textarea[name$='accDetails']").val(data.accDetails);
			$("#edit_ticket select[name$='airline_id']").val(data.airline_id);
			$("#edit_ticket input[name$='base_fare']").val(data.base_fare);
			$("#edit_ticket input[name$='airline_taxes']").val(data.airline_taxes);
			$("#edit_ticket input[name$='acomission']").val(data.acomission);
			if(data.vendor_id>0)
			{
				$("#e-other_stock-t").show();
				$("#edit_ticket select[name$='vendor_id']").val(data.vendor_id);
			}
			else{$("#e-other_stock-t").hide();}
			lead_acc_sum();
		}
	});
}
// eidt lead other sale details e.g 
function edit_other_sale(id)
{
	$("#edit_other_sale").modal({backdrop:'static'});
	$.ajax({
		url:"lead-tabs/lead-details-editor/get_other_sale?id="+id,
		dataType:"JSON",
		success: function(data)
		{
			$("#edit_other_sale input[name$='id']").val(data.id);
			$("#edit_other_sale select[name$='branch']").val(data.branch);
			$("#edit_other_sale select[name$='salesStaff']").val(data.salesStaff);
			$("#edit_other_sale input[name$='issue_date']").val(data.issue_date);
			$("#edit_other_sale select[name$='stock_used']").val(data.stock_used);
			$("#edit_other_sale input[name$='supl_name']").val(data.supl_name);
			$("#edit_other_sale input[name$='ser_type']").val(data.ser_type);
			$("#edit_other_sale textarea[name$='sales_detail']").val(data.sales_detail);
			$("#edit_other_sale input[name$='passName']").val(data.passName);
			$("#edit_other_sale input[name$='phone']").val(data.phone);
			$("#edit_other_sale select[name$='passType']").val(data.passType);
			$("#edit_other_sale input[name$='recieved']").val(data.recieved);
			$("#edit_other_sale input[name$='netCost']").val(data.netCost);
			$("#edit_other_sale input[name$='passport_num']").val(data.passport_num);
			$("#edit_other_sale select[name$='vendor_id']").val(data.vendor_id);
			$("#edit_other_sale textarea[name$='accDetails']").val(data.accDetails);
			if(data.vendor_id>0)
			{
				$("#other_stock-es").show();
				$("#other_stock-es select[name$='vendor_id']").val(data.vendor_id);
			}
			else{$("#e-other_stock-t").hide();}
			lead_acc_sum();
		}
	});
}
// eidt lead other sale details e.g 
function edit_refund(id)
{
	$("#edit_refund").modal({backdrop:'static'});
	$.ajax({
		url:"lead-tabs/lead-details-editor/get_refund?id="+id,
		dataType:"JSON",
		success: function(data)
		{
			$("#edit_refund input[name$='id']").val(data.id);
			$("#edit_refund input[name$='recFrm']").val(data.recFrm);
			$("#edit_refund input[name$='phone']").val(data.phone);
			$("#edit_refund input[name$='airline_code']").val(data.airline_code);
			$("#edit_refund input[name$='ticket_no']").val(data.ticket_no);
			$("#edit_refund input[name$='conjuction']").val(data.conjuction);
			$("#edit_refund input[name$='passName']").val(data.passName);
			$("#edit_refund input[name$='sector']").val(data.sector);
			$('#edit_refund').find(':radio[name=ref_type][value="'+data.ref_type+'"]').prop('checked', true);
			$("#edit_refund input[name$='refund_sec']").val(data.refund_sec);
			$("#edit_refund textarea[name$='remark']").val(data.remark);
			$("#edit_refund input[name$='services_charges']").val(data.services_charges);
			$("#edit_refund input[name$='invoice_number']").val(data.invoice_number);
			$("#edit_refund select[name$='refund_against']").val(data.refund_against);
			if($("#edit_refund select[name$='refund_against']").val(data.refund_against)!=="ticket")
			{
				$("#edit_refund input[name$='airline_code']").attr("disabled", "disabled");
				$("#edit_refund input[name$='ticket_no']").attr("disabled", "disabled");
				$("#edit_refund input[name$='sector']").attr("disabled", "disabled");
				$("#edit_refund input[name$='refund_sec']").attr("disabled", "disabled");
			}
			lead_acc_sum();
		}
	});
}
// view leads sale detials
function sale_view(type, modelDiv, id)
{
	$("#"+modelDiv).modal();
	$.ajax({
		url:"lead-tabs/lead-details-view/action?type="+type+"&id="+id,
		cache:false,
		success: function(data)
		{
			$("."+modelDiv).html(data);
		}
	});
	
}
// lead account summary
function lead_acc_sum()
{
	$("#lead_acc_sum").load('lead-tabs/lead_acc_sum?leadId='+leadId);
}
// xo details etc****************************************************************
function flight_details(){
		 $("#addFlight").append('<div class="ten-per-1">'+
								'<input type="text" style="width: 50%;"  name="flight_frm[]"><input type="text" style="width: 50%;" name="flight_to[]">'+
     							'</div>'+
								'<div class="ten-per-1">'+
								'<input type="text" style="width: 100%;" name="fare_bais[]">'+
								'</div>'+
								'<div class="ten-per-1">'+
									'<input type="text" style="width: 100%;" name="carrier[]">'+
								'</div>'+
								'<div class="ten-per-1">'+
									'<input type="text" style="width: 100%;" name="flightNo[]">'+
								'</div>'+
								'<div class="ten-per-1">'+
									'<input type="text"  style="width: 100%;" name="class[]">'+
								'</div>'+
								'<div class="ten-per-1">'+
									'<input type="text" class="date"  style="width: 100%;" name="xo_date[]">'+
								'</div>'+
								'<div class="ten-per-1">'+
									'<input type="text"  style="width: 100%;" name="dep_time[]">'+
								'</div>'+
								'<div class="ten-per-1">'+
									'<input type="text" style="width: 100%;" name="ar_time[]">'+
								'</div>'+
								'<div class="ten-per-1">'+
									'<input type="text" style="width: 100%;" name="status[]">'+
								'</div>'+
								'<div class="ten-per-1">'+
									'<input type="text" style="width: 100%;" name="airLine_data[]">'+
								'</div>')
							
							$(".date" ).datepicker({
									format:"dd-mm-yyyy" 
								});
							
}
function xoSum()
{
	var basic_fare=$(".basic_fare").val();
	var tax1=$(".tax1").val(); var tax2=$(".tax2").val(); var tax3=$(".tax3").val(); var tax4=$(".tax4").val();
	var tax5=$(".tax5").val();
	var incentive=$(".incentive").val();
	var commission=$(".commission").val();
	total=document.getElementById("total").value=Number(basic_fare)+Number(tax1)+Number(tax2)+Number(tax3)+Number(tax4)+Number(tax5);
	
	netpayable=document.getElementById("net_payable").value=total-incentive-commission;
}
function addPass(){
  $("#addPass").append('<div class="clearfix"></div><div class="col-sm-5" style="padding:5px;">'+
						'<input class="form-control" type="text" name="passName[]">'+
					   '</div>'+
					   '<div class="col-sm-5" style="padding:5px;">'+
					   '<input type="text"  name="pass_detail[]" class="form-control">'+
					   '</div><div class="clearfix"></div><br>');
}
// add xo sale
function xo_sale()
{
	
		var x=confirm('Are You Sure you want to continue?');
		if(!x)
		{
			flase;
		}
	
	$.ajax({
		url:"save_xo?leadId="+leadId,
		type:"POST",
		data:$("#xo_form").serializeArray(),
		success: function(data)
		{
			if(sup_name !=""){
			$(".record").fadeIn(1000).fadeOut(5000);
			$( '#xo_form' ).each(function(){
					this.reset();
					alert("OPeration Successfully");
				});
			}
		}
	});
}
//lead conversation 
function lead_conv()
{
	$.ajax({
		url:"lead-tabs/lead-details/get_conversation?leadId="+leadId,
		data:$("#lead_conv").serialize(),
		type:"POST",
		dataType:"JSON",
		success: function(data)
		{
			for(i in data)
			{
				if(data[i].name==null){
			$(".lead-chat-msg").last().prepend('<span style="padding: 5px;color:#cc2127;font-size: 20px;font-family: monospace;">'+data[i].con_date+'</span><div class="direct-chat-text" style="background:'+data[i].color+'">'+data[i].comment+'</div>');
				}
				else{
				$(".lead-chat-msg").last().prepend('<span style="padding: 5px;color:#cc2127;font-size: 20px;font-family: monospace;">'+data[i].con_date+' ('+data[i].name+')</span><div class="direct-chat-text" style="background:'+data[i].color+'">'+data[i].comment+'</div>');	
				}
			}
			document.getElementById("lead_conv").reset();
		}
	});
}
/*$(".lead-comment").keydown(function(e){
	if (e.keyCode == 13) 
    {
      lead_conv();
	  return false;
    }
});
*/
$(".lead-message").keydown(function(e){
		if (e.keyCode == 13) 
		{
		  //ticket_message();
		  return false;
		}
	});
// lead message against ticket etc to spo's
function ticket_message(spo)
{
	$("#ticket_message").modal();
	$.ajax({
		url:"lead-tabs/lead-details/get_lead-message?leadId="+leadId+"&spo="+spo,
		data:$("#leadForm-message").serialize(),
		type:"POST",
		dataType:"JSON",
		cache:false,
		success: function(data)
		{
			if(data.length>1){$(".ticket_messageunique").empty();}
			for(i in data)
			{
			$(".ticket_messageunique").last().prepend('<div class="direct-chat-msg right" style="width:100% !important;">'+
              '<div class="direct-chat-info clearfix"> <span class="direct-chat-name pull-right">'+data[i].message_from+'</span>'+
			  '<span class="direct-chat-timestamp pull-left">'+data[i].date_time+'</span> </div>'+
              '<!-- /.direct-chat-info -->'+
              '<div class="direct-chat-text"> '+data[i].conservation+' </div>'+
              '<!-- /.direct-chat-text -->'+
            '</div>');
			}
			document.getElementById("leadForm-message").reset();
		}
	});
}
// desk lead message 
function desk_lead_msg(leadId, spo)
{
	$(".ticket-btn").html('<button type="button" class="btn btn-danger btn-flat" onClick="desk_lead_msg('+leadId+', '+spo+')">Send</button>');
	$("#desk_ticket_message").modal();
	$.ajax({
		url:"lead-tabs/lead-details/get_lead-message?leadId="+leadId+"&spo="+spo,
		data:$("#leadForm-message").serialize(),
		type:"POST",
		dataType:"JSON",
		cache:false,
		success: function(data)
		{
			$("#lead_client_name").text(data[0].client_name);
			$("#desk_lead_id").html('<a target="_blank" href="lead_details?leadId='+data[0].convLeadId+'">'+leadId+'</a>');
			if(data.length>1){$(".ticket_messageunique").empty();}
			for(i in data)
			{
			$(".ticket_messageunique").last().prepend('<div class="direct-chat-msg right" style="width:100% !important;">'+
              '<div class="direct-chat-info clearfix"> <span class="direct-chat-name pull-right">'+data[i].message_from+'</span>'+
			  '<span class="direct-chat-timestamp pull-left">'+data[i].date_time+'</span> </div>'+
              '<!-- /.direct-chat-info -->'+
              '<div class="direct-chat-text"> '+data[i].conservation+' </div>'+
              '<!-- /.direct-chat-text -->'+
            '</div>');
			}
			document.getElementById("leadForm-message").reset();
		}
	});
}
function set_reminder()
{
	$("#set_reminder").modal();
	if($(".lead-reminder-msg").val()==""){
	$(".lead-reminder-msg").val("Lead No:"+leadId);}
	else{
	$.ajax({
		url:"ajax_call/get_reminder?leadId="+leadId,
		data:$("#reminderForm").serialize(),
		type:"POST",
		success: function(data)
		{
			$("#set_reminder").modal('hide');
			document.getElementById("reminderForm").reset();
		}
	});
	}
}
//upload clients document 
$("#uploadimage").on('submit',(function(e) {
	e.preventDefault();
	$.ajax({
	url:"lead-tabs/lead-details/save_detail?type=att_doc&leadId="+leadId,
	type: "POST",            
	data: new FormData(this),
	contentType: false,
	cache: false,    
	processData:false,
	success: function(data)
	{
		rec=data.split('~');
		if(rec[1]==1){alert('Already Exist Document, Please Change name or Check your Existing Document');}
		if(rec[1]==2)
		{
			document.getElementById('uploadimage').reset();
			$(".get_document").parents(".box-body").css("display","block");
			$(".get_document").parents(".box-body").parent().find("i").removeClass("fa-plus").addClass("fa-minus");
			$(".get_document").parents(".box-solid").removeClass("collapsed-box");
			$(".get_document").parents(".box-solid").children(".overlay").css("display","none");
		}
		$(".get_document").html(rec[0]);
	}
	});
}));
// view document 
function view_doc(path)
{
	$("#document-modal").modal();
	$("#view-donc-img").attr('src','lead-tabs/lead-details/'+path);
	$("#download-doc-img").attr('href','lead-tabs/lead-details/'+path);
}
// count the total net cost e.g basic_fare+airline_taxes=net_cost
function net_cost(etf)
{
	var basic_fare=$("#"+etf+" .basic_fare").val();
	var taxes=$("#"+etf+" .airline_taxes").val();
	acomission=(basic_fare)*$("#"+etf+" .acomission_per").val()/100;
	$("#"+etf+" .acomission").val(acomission);
	other_char=$("#"+etf+" .tkt_other_char").val();
	$("#"+etf+" .netCost").val(Number(basic_fare)+Number(taxes)-Number(acomission)-Number(other_char));
}
function comm_per(etf)
{
	var basic_fare=$("#"+etf+" .basic_fare").val();
	var taxes=$("#"+etf+" .airline_taxes").val();
	//acomission=(basic_fare)*$("#"+etf+" .acomission_per").val()/100;
	acomission_per=$("#"+etf+" .acomission").val()*100/(basic_fare);
	$("#"+etf+" .acomission_per").val(acomission_per);
	$("#"+etf+" .netCost").val(Number(basic_fare)+Number(taxes)-Number(acomission));
}
// view lead summary details against the lead id number
function lead_details_modal(leadId)
{
	var allData;
	$("#lead_details_modal").modal();
	$.ajax({
		url:"ajax_call/lead_det_summary?leadId="+leadId,
		dataType:"JSON",
		success: function(data)
		{
			allData+='<tr><th>Lead Id</th> <td>'+data.leadData.id+'</td></tr>';
			allData+='<tr><th>Contact Name</th> <td>'+data.leadData.contact_name+'</td></tr>';
			allData+='<tr><th>Mobile</th> <td>'+data.leadData.mobile+'</td></tr>';
			allData+='<tr><th>Email</th> <td>'+data.leadData.email+'</td></tr>';
			allData+='<tr><th>Service Name</th> <td>'+data.leadData.service+'</td></tr>';
			allData+='<tr><th>Created By</th> <td>'+data.created_by+'</td></tr>';
			allData+='<tr><th>Taken Over By</th> <td>'+data.taken_overby+'</td></tr>';
			$("#lead_det_summary").html(allData);
			
		}
	});
}
$(".multiple_rec").delegate(".multiple_rec_app", "click", function(){
	
	$(".multiple_rec").append('<div class="parentRemove"><div class="col-lg-3 col-sm-4">'+
                    	'<div class="form-group">'+
                          '<label>Invoice Number / Ref No. </label>'+
                          '<input class="form-control input-sm fetch_sale_inv" name="refrence[]" type="text" placeholder="Invoice Number">'+
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
// remove added accommodation div
$(document).on('click','.remove',function() {
	var sum=0;
 	$(this).parents().closest(".parentRemove").remove();
	$(".get_inv_amount").each(function(){
				sum += +$(this).val();
			});
	$("#inv_total_amount").val(sum);
});
$(document).on('change','.get_inv_amount',function() {
	var sum=0;
	$(".get_inv_amount").each(function(){
				sum += +$(this).val();
			});
	$("#inv_total_amount").val(sum);
});
// fetch amont against given invoice number fsAmount(fetch Sale Amount)
$(document).on("change", ".fetch_sale_inv", function(){
	 var sum = 0;
	g=$(this);
	$.ajax({
		url:"ajax_call/fetch_sale_inv?inv_no="+$(this).val(),
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
$(document).on("change", ".fetch_sale_inv", function() {
    var sum = 0;
    $(".get_inv_amount").each(function(){
        sum += +$(this).val();
    });
    $("#inv_total_amount").val(sum);
});
//======================================Refund payment=========================================
$(".ref_multiple_rec").delegate(".ref_multiple_rec_app", "click", function(){
	
	$(".ref_multiple_rec").append('<div class="parentRemove"><div class="col-lg-3 col-sm-4">'+
                    	'<div class="form-group">'+
                          '<label>Invoice Number / Ref No. </label>'+
                          '<input class="form-control input-sm ref_fetch_sale_inv" name="refrence[]" type="text" placeholder="Invoice Number">'+
                       '</div></div>'+
					    '<div class="col-lg-3 col-sm-4">'+
                    	'<div class="form-group">'+
                          '<label>Amount *</label>'+
                          '<input class="form-control input-sm ref_get_inv_amount" name="amount[]"  id=""  type="text" placeholder="Amount *">'+
                       '</div>'+
                    '<!-- form--group-->'+
					'</div>'+
					'<div class="col-md-1">'+
					  '<div class="form-group">'+
					  	'<label style="visibility:hidden;">Tourvision</label>'+
						'<button type="button" class="btn btn-sm btn-primary ref_remove"><i class="fa fa-remove"></i></button>'+
					  '</div>'+
					'</div>'+
                    '</div><div class="clearfix"></div></div>');
});
// remove added accommodation div
$(document).on('click','.ref_remove',function() {
	var sum=0;
 	$(this).parents().closest(".parentRemove").remove();
	$(".ref_get_inv_amount").each(function(){
				sum += +$(this).val();
			});
	$("#ref_inv_total_amount").val(sum);
});
$(document).on('change','.ref_get_inv_amount',function() {
	var sum=0;
	$(".ref_get_inv_amount").each(function(){
				sum += +$(this).val();
			});
	$("#ref_inv_total_amount").val(sum);
});
// fetch amont against given invoice number fsAmount(fetch Sale Amount)
$(document).on("change", ".ref_fetch_sale_inv", function(){
	 var sum = 0;
	g=$(this);
	$.ajax({
		url:"ajax_call/fetch_sale_inv?inv_no="+$(this).val(),
		dataType:"JSON",
		success: function(data)
		{
			g.parents().closest(".col-lg-3").next(".col-lg-3").find(".ref_get_inv_amount").val(data);
			$(".ref_get_inv_amount").each(function(){
				sum += +$(this).val();
			});
			$("#ref_inv_total_amount").val(sum);
		}
	});
});
$(document).on("change", ".ref_fetch_sale_inv", function() {
    var sum = 0;
    $(".ref_get_inv_amount").each(function(){
        sum += +$(this).val();
    });
    $("#ref_inv_total_amount").val(sum);
});
//===============================================================================
// clinet account statement
function client_acc_satatment()
{		   $("#opening_balance").html("");
			$("#total_sales").html("");
			$("#debit_note").html("");
			$("#gross_sale").html("");
			$("#void-refund").html("");
			$("#net_sale").html("");
			$("#payment_receipt").html("");
			$("#payments").html("");
			$("#net_rec_pay").html("");
	var TicketSale="";
	var otherSale="";
	var base_fare=0;
	var total_taxes=0;
	var net_amount=0;
	var tourSale="";
	var total_other_sale=0;
	var total_ts=0;
	var rfnd="";
	var total_rfnd=0;
	var ref_amount=0;
	var receipt_payment="";
	var total_rec=0;
	var total_rp=0;
	$.ajax({
		url:"ajax_call/get_client_acc_stat",
		dataType:"JSON",
		data:$("#form").serialize(),
		type:"POST",
		success: function(data)
		{
			for(i=0; i<data.ticket_sale.length; i++)
			{
				TicketSale+='<tr>';
				TicketSale+='<td>'+data.ticket_sale[i]['issue_date']+'</td>';
				TicketSale+='<td>'+data.ticket_sale[i]['invoice_no']+'</td>';
				TicketSale+='<td>'+data.ticket_sale[i]['passName']+'</td>';
				TicketSale+='<td>'+data.ticket_sale[i]['airline_code']+'-'+data.ticket_sale[i]['ticket_no']+'</td>';
				TicketSale+='<td>'+data.ticket_sale[i]['sector']+'</td>';
				TicketSale+='<td>'+(data.ticket_sale[i]['recieved']-data.ticket_sale[i]['airline_taxes']).toLocaleString('en')+'</td>';
				TicketSale+='<td>'+Number(data.ticket_sale[i]['airline_taxes']).toLocaleString('en')+'</td>';
				TicketSale+='<td>'+Number(data.ticket_sale[i]['recieved']).toLocaleString('en')+'</td>';
				TicketSale+='</tr>';
				base_fare+=(data.ticket_sale[i]['recieved']-data.ticket_sale[i]['airline_taxes']);
				total_taxes+=Number(data.ticket_sale[i]['airline_taxes']);
				net_amount+=Number(data.ticket_sale[i]['recieved']);
			}
			TicketSale+='<tr>';
			 TicketSale+='<td colspan="5" align="right" style="padding:0px;"><h4>Invoice Total:</h4></td>';
			 TicketSale+='<td><b>'+base_fare.toLocaleString('en')+'</b></td>';
             TicketSale+='<td><b>'+(total_taxes).toLocaleString('en')+'</b></td>';
            TicketSale+='<td><b>'+net_amount.toLocaleString('en')+'</b></td>';
			 TicketSale+='</tr>';
			//other sale
			for(j=0; j<data.other_sale.length; j++)
			{
				otherSale+='<tr>';
				 otherSale+='<td>'+data.other_sale[j]['issue_date']+'</td>';
				 otherSale+='<td>'+data.other_sale[j]['invoice_no']+'</td>';
				 otherSale+='<td>'+data.other_sale[j]['passName']+' ('+data.other_sale[j]['passport_num']+')</td>';
				 otherSale+='<td>'+Number(data.other_sale[j]['recieved']).toLocaleString('en')+'</td>';
				otherSale+='<tr>';
				total_other_sale+=Number(data.other_sale[j]['recieved']);
			}
			//tour sale
			for(k=0; k<data.tour_sale.length; k++)
			{
				otherSale+='<tr>';
				 otherSale+='<td>'+data.tour_sale[k]['issue_date']+'</td>';
				 otherSale+='<td>'+data.tour_sale[k]['invoice_no']+'</td>';
				 otherSale+='<td>('+data.tour_sale[k]['f_head_name']+') ('+data.tour_sale[k]['ppn']+') ('+data.tour_sale[k]['visaType']+')</td>';
				 otherSale+='<td>'+Number(data.tour_sale[k]['total_tour_sale']).toLocaleString('en')+'</td>';
				otherSale+='</tr>';
				total_ts+=Number(data.tour_sale[k]['total_tour_sale']);
			}
			// debit note visa and tour sale
			 otherSale+='<tr>';
				 otherSale+='<td colspan="3" align="right" style="padding:0px;"><h4>Debit Note Total</h4></td>';
				 otherSale+='<td><b>'+Number(total_other_sale+total_ts).toLocaleString('en')+'</b></td>';
			otherSale+='</tr>';
			// refund
			for(m=0; m<data.refund.length; m++)
			{
				net_ref=Number(data.refund[m]['net_ref'])+Number(data.refund[m]['sc'])-Number(data.refund[m]['service_charges']);
				rfnd+='<tr>';
				 rfnd+='<td>'+data.refund[m]['ref_app_date']+'</td>';
				 rfnd+='<td></td>';
				 rfnd+='<td>'+data.refund[m]['inv_no']+'</td>';
				 rfnd+='<td>'+data.refund[m]['passName']+'</td>';
				 rfnd+='<td>'+data.refund[m]['ticket_no']+'</td>';
				 rfnd+='<td>'+data.refund[m]['sector']+'</td>';
				 rfnd+='<td>'+(net_ref).toLocaleString('en')+'</td>';
				rfnd+='</tr>';
				total_rfnd+=Number(net_ref);
				//ref_amount+=Number(data.refund[m]['net_ref']);
				
			}
			//refund 
			rfnd+='<tr>';
			 rfnd+='<td colspan="6" align="right" style="padding:0px;"><h4>Credit Note Total:</h4></td>';
			 rfnd+='<td>'+Number(total_rfnd).toLocaleString('en')+'</td>';
			rfnd+='</tr>';
			// payments and receipts
			for(n=0; n<data.receipts.length; n++)
			{
				receipt_payment+='<tr>';
				 receipt_payment+='<td>'+data.receipts[n]['app_date']+'</td>';
				 receipt_payment+='<td>TPRV-'+data.receipts[n]['TPRV']+'</td>';
				 receipt_payment+='<td></td>';
				 receipt_payment+='<td>'+data.receipts[n]['remarks']+'</td>';
				 receipt_payment+='<td>'+Number(data.receipts[n]['amount']).toLocaleString('en')+'</td>';
				 receipt_payment+='<td></td>';
				receipt_payment+='</tr>';
				total_rec+=Number(data.receipts[n]['amount']);
			}
			//refund payment
			for(p=0; p<data.refund_payment.length; p++)
			{
				receipt_payment+='<tr>';
				 receipt_payment+='<td>'+data.refund_payment[p]['app_date']+'</td>';
				 receipt_payment+='<td></td>';
				 receipt_payment+='<td>'+data.refund_payment[p]['refrence']+'</td>';
				 receipt_payment+='<td>'+data.refund_payment[p]['remark']+'</td>';
				 receipt_payment+='<td></td>';
				 receipt_payment+='<td>'+Number(data.refund_payment[p]['amount']).toLocaleString('en')+'</td>';
				receipt_payment+='</tr>';
				total_rp+=Number(data.refund_payment[p]['amount']);
			}
			receipt_payment+='<tr>';
			 receipt_payment+='<td colspan="4" align="right" style="padding:0px;"><h4>Total Receipts/Payments:</h4></td>';
			 receipt_payment+='<td><b>'+Number(total_rec).toLocaleString('en')+'</b></td>';
			 receipt_payment+='<td><b>'+Number(total_rp).toLocaleString('en')+'</b></td>';
			receipt_payment+='</tr>';
			$(".ticket_sale").html(TicketSale);
			$(".other_sale").html(otherSale);
			$(".rfnd").html(rfnd);
			$(".receipt-payment").html(receipt_payment);
			//summary
			$("#opening_balance").html(Number(data.opening_balace).toLocaleString('en'));
			$("#total_sales").html(net_amount.toLocaleString('en'));
			$("#debit_note").html(Number(total_other_sale+total_ts).toLocaleString('en'));
			$("#gross_sale").html(Number(data.opening_balace+net_amount+total_other_sale+total_ts).toLocaleString('en'));
			$("#void-refund").html(Number(total_rfnd).toLocaleString('en'));
			$("#net_sale").html(Number(data.opening_balace+net_amount+total_other_sale+total_ts-total_rfnd).toLocaleString('en'));
			$("#payment_receipt").html(Number(total_rec).toLocaleString('en'));
			$("#payments").html(Number(data.rc).toLocaleString('en'));
		$("#net_rec_pay").html(Number(data.opening_balace)+Number(net_amount)+Number(total_other_sale)+Number(total_ts)-Number(total_rfnd)-Number(total_rec+total_rp)).toLocaleString('en');
			$("#client_name").html(data.client_name);
			console.log();
		}
	});
}
// Types of refunds e.g ticket refund, other sale, tour sale
function sel_refund_type(thisVal, type)
{
	if(thisVal=='other_sale' || thisVal=='tour')
	{
	 $("#"+type+"refund_ac").attr("disabled", "disabled");
	 $("#"+type+"refund_tn").attr("disabled", "disabled");
	 $("#"+type+"refund_sector").attr("disabled", "disabled");
	 $("#"+type+"rfnd_sector").attr("disabled", "disabled");
	}
	else
	{
	 $("#"+type+"refund_ac").removeAttr("disabled");
	 $("#"+type+"refund_tn").removeAttr("disabled");
	 $("#"+type+"refund_sector").removeAttr("disabled");
	 $("#"+type+"rfnd_sector").removeAttr("disabled");	
	}
}
// fetch all sale details against ticket number
function fetch_ticket_det()
{
	rfndrefund_ac=$("#rfndrefund_ac").val();
	rfndrefund_tn=$("#rfndrefund_tn").val();
	$.ajax({
		url:"lead-tabs/lead-details/get_ticket_det?ac="+rfndrefund_ac+"&ticket_no="+rfndrefund_tn+"",
		dataType:"JSON",
		success: function(data)
		{
			$("#refund_form input[name$='passName']").val(data.passName);
			$("#refund_form input[name$='sector']").val(data.sector);
			$("#refund_form input[name$='phone']").val(data.phone);
			$("#refund_form input[name$='invoice_number']").val(data.invoice_no);
		}
	});
}
// fetch all sale details against ticket number
function fetch_ticket_det_rp()
{
	rfndrefund_ac=$("#rp_ac").val();
	rfndrefund_tn=$("#rp_tn").val();
	$.ajax({
		url:"lead-tabs/lead-details/get_ticket_det?ac="+rfndrefund_ac+"&ticket_no="+rfndrefund_tn+"",
		dataType:"JSON",
		success: function(data)
		{
			$("#refund_payment_form input[name$='payment_to']").val(data.passName);
			$("#refund_payment_form input[name$='refrence']").val(data.invoice_no);
		}
	});
}
// client feed backs in lead details..........
function client_feedback(leadId)
{
	$("#feedback-modal").modal();
	var i;
	$.ajax({
		url:"lead-tabs/get_client_feedback?leadId="+leadId,
		data:$("#feedback-form").serialize(),
		type:"POST",
		dataType:"JSON",
		success:function(data)
		{
			for(i in data)
			{
				$(".feedback_msg").last().prepend('<div class="direct-chat-info clearfix">'+ 
						'<span class="direct-chat-timestamp pull-left">'+data[i].feedback_date+'</span>'+ 
					'</div><div class="direct-chat-text">'+data[i].feedback+'</div>');
			}
		}
	});
}