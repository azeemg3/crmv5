// JavaScript Document
$(".done_tour_inv").on("click", function()
{
	var x=confirm('Are You Sure?');
	if(!x)
	{
		fasle;
	}
	uniqueId=$("#uniqueId").val();
	branch=$("#tourBranch").val();
	spo=$("#tourSpo").val();
	issue_date=$("#tsinv_issue_date").val();
	family_headName=$("#tsinv_famlyHead_name").val();
	ts_passportNo=$("#ts_passportNo").val();
	if(family_headName=="")
	{
		alert("Please Add Family Head Name");
		return false;
	}
	$("#myLoader").modal();
	
	$.ajax({
		url:"tourSale/ajax_call/get_uniqueId?uniqueId="+uniqueId+"&branch="+branch+"&spo="+spo+"&leadId="+leadId,
		type:"POST",
		data:{issue_date:issue_date, family_name:family_headName, ts_passportNo:ts_passportNo},
		success: function(data)
		{
			uid=$("#uniqueId").val(data);
			$("#myLoader").modal('hide');
			//tour_sale_inv();
			//lead_acc_status();
			lead_acc_sum();
			alert("Tour Invoice Created Successfully");
			get_sale('tour_sale', 'get_tourSale_unique');
			$("#tourVisaId, #tourHotelId, #tourTransId, #tourTourId, #tourOtherId").empty();
			$("#tsinv_famlyHead_name").val('');
			var callDiv='get_tourSale_unique';
			$("."+callDiv).parents(".box-body").css("display","block");
			$("."+callDiv).parents(".box-body").parent().find("i").removeClass("fa-plus").addClass("fa-minus");
			$("."+callDiv).parents(".box-solid").removeClass("collapsed-box");
			$("."+callDiv).parents(".box-solid").children(".overlay").css("display","none");
		}
	});
});
function tour_add(formData, thistour, urlData, callDiv)
{
	uniqueId=$("#uniqueId").val();
	branch=$("#tourBranch").val();
	spo=$("#tourSpo").val();
	$.ajax({
		url:"tourSale/saveTour?tour="+thistour+"&uniqueId="+uniqueId+"&branch="+branch+"&spo="+spo+"&leadId="+leadId,
		type:"POST",
		data:$('#'+formData).serialize(),
		success: function(data)
		{
			alert(data);
			document.getElementById(formData).reset();
			$("."+callDiv).show();
			get_tour(urlData, callDiv, thistour);
			$(".modal").modal('hide');
		}
	});
}
function get_tour(urlData, callDiv, thistour)
{
	uniqueId=$("#uniqueId").val();
	$.ajax({
		url:urlData+"?tour="+thistour+"&uniqueId="+uniqueId,
		success: function(data)
		{
			$("#"+callDiv).html(data);
		}
	});
}
// edit visa tour
function e_v_t(id, thisdiv)
{
	$("#"+thisdiv).modal();
	$.ajax({
			url:"tourSale/editTour?thistour=visaTour&id="+id,
			dataType:"JSON",
			success: function(data)
			{
				$("#"+thisdiv+" input[name$='id']").val(data['id']);
				$("#"+thisdiv+" input[name$='visaPassName']").val(data['visaPassName']);
				$("#"+thisdiv+" input[name$='visaType']").val(data['visaType']);
				$("#"+thisdiv+" select[name$='vendor']").val(data['vendor']);
				$("#"+thisdiv+" input[name$='visaQty']").val(data['visaQty']);
				$("#"+thisdiv+" input[name$='visaPp']").val(data['visaPp']);
				$("#"+thisdiv+" input[name$='visaSp']").val(data['visaSp']);
				$("#"+thisdiv+" input[name$='t_visaPp']").val(data['t_visaPp']);
				$("#"+thisdiv+" input[name$='t_visaSp']").val(data['t_visaSp']);
				$("#"+thisdiv+" input[name$='visa_desc']").val(data['visa_desc']);
				$("#"+thisdiv+" input[name$='visa_passportNo']").val(data['visa_passportNo']);
			}
		});
}
// edit tour hotel 
function e_h_t(id, thisdiv)
{
	$("#"+thisdiv).modal();
	$.ajax({
		url:"tourSale/editTour?thistour=tourHotel&id="+id,
		dataType:"JSON",
		success: function(data)
		{
			$("#"+thisdiv+" input[name$='id']").val(data['id']);
			$("#"+thisdiv+" input[name$='hotelPassName']").val(data['hotelPassName']);
			$("#"+thisdiv+" select[name$='hotelRoomType']").val(data['hotelRoomType']);
			$("#"+thisdiv+" input[name$='hotelName']").val(data['hotelName']);
			$("#"+thisdiv+" select[name$='vendor']").val(data['vendor']);
			$("#"+thisdiv+" input[name$='hotelQty']").val(data['hotelQty']);
			$("#"+thisdiv+" input[name$='hotelCheckin']").val(data['hotelCheckin']);
			$("#"+thisdiv+" input[name$='hotelCheckout']").val(data['hotelCheckout']);
			$("#"+thisdiv+" input[name$='hotelNights']").val(data['hotelNights']);
			$("#"+thisdiv+" input[name$='hotelPp']").val(data['hotelPp']);
			$("#"+thisdiv+" input[name$='hotelSp']").val(data['hotelSp']);
			$("#"+thisdiv+" input[name$='t_hotelPp']").val(data['t_hotelPp']);
			$("#"+thisdiv+" input[name$='t_hotelSp']").val(data['t_hotelSp']);
			$("#"+thisdiv+" input[name$='hotel_desc']").val(data['hotel_desc']);
		}
	});
}
//edit Tour transport 
function e_t_trans(id, thisdiv)
{
	$("#"+thisdiv).modal();
	$.ajax({
		url:"tourSale/editTour?thistour=tourTrans&id="+id,
		dataType:"JSON",
		success: function(data)
		{
			$("#"+thisdiv+" input[name$='id']").val(data['id']);
			$("#"+thisdiv+" input[name$='transPassName']").val(data['transPassName']);
			$("#"+thisdiv+" input[name$='transVehType']").val(data['transVehType']);
			$("#"+thisdiv+" input[name$='transSector']").val(data['transSector']);
			$("#"+thisdiv+" input[name$='transQty']").val(data['transQty']);
			$("#"+thisdiv+" input[name$='trans_date']").val(data['trans_date']);
			$("#"+thisdiv+" select[name$='vendor']").val(data['vendor']);
			$("#"+thisdiv+" input[name$='transPp']").val(data['transPp']);
			$("#"+thisdiv+" input[name$='transSp']").val(data['transSp']);
			$("#"+thisdiv+" input[class$='tTransPp']").val(data['t_transPp']);
			$("#"+thisdiv+" input[class$='tTransSp']").val(data['t_transSp']);
			$("#"+thisdiv+" input[name$='trans_desc']").val(data['trans_desc']);
		}
	});
}
//edit Tour Tours
function e_t_tour(id, thisdiv)
{
	$("#"+thisdiv).modal();
	$.ajax({
		url:"tourSale/editTour?thistour=tourTour&id="+id,
		dataType:"JSON",
		success: function(data)
		{
			$("#"+thisdiv+" input[name$='id']").val(data['id']);
			$("#"+thisdiv+" input[name$='tourPassName']").val(data['tourPassName']);
			$("#"+thisdiv+" input[name$='tourName']").val(data['tourName']);
			$("#"+thisdiv+" input[name$='tourQty']").val(data['tourQty']);
			$("#"+thisdiv+" input[name$='tourDate']").val(data['tourDate']);
			$("#"+thisdiv+" select[name$='vendor']").val(data['vendor']);
			$("#"+thisdiv+" input[name$='tourPp']").val(data['tourPp']);
			$("#"+thisdiv+" input[name$='tourSp']").val(data['tourSp']);
			$("#"+thisdiv+" input[class$='tTourPp']").val(data['t_tourPp']);
			$("#"+thisdiv+" input[class$='tTourSp']").val(data['t_tourSp']);
			$("#"+thisdiv+" input[name$='tour_desc']").val(data['tour_desc']);
		}
	});
}
// edit tour other services
function e_t_o(id, thisdiv)
{
	$("#"+thisdiv).modal();
	$("#"+thisdiv).find(".edit_hour").removeClass("col-lg-1").addClass("col-lg-3");
	$("#"+thisdiv).find(".edit_min").removeClass("col-lg-1").addClass("col-lg-3");
	$.ajax({
		url:"tourSale/editTour?thistour=tourOther&id="+id,
		dataType:"JSON",
		success: function(data)
		{
			$("#"+thisdiv+" input[name$='id']").val(data['id']);
			$("#"+thisdiv+" input[name$='otherPassName']").val(data['otherPassName']);
			$("#"+thisdiv+" input[name$='serviceName']").val(data['serviceName']);
			$("#"+thisdiv+" input[name$='serQty']").val(data['serQty']);
			$("#"+thisdiv+" input[name$='serDate']").val(data['serDate']);
			$("#"+thisdiv+" select[name$='hour']").val(data['hour']);
			$("#"+thisdiv+" select[name$='mintue']").val(data['mintue']);
			$("#"+thisdiv+" select[name$='vendor']").val(data['vendor']);
			$("#"+thisdiv+" input[name$='serPp']").val(data['serPp']);
			$("#"+thisdiv+" input[name$='serSp']").val(data['serSp']);
			$("#"+thisdiv+" input[class$='tSerPp']").val(data['t_serPp']);
			$("#"+thisdiv+" input[class$='tSerSp']").val(data['t_serSp']);
			$("#"+thisdiv+" input[name$='other_desc']").val(data['other_desc']);
			
		}
	});
}
//count tour invoice
function cnightTourhotel(thisdiv)
{
	var oneDay = 24*60*60*1000;
	var checkin=$("#"+thisdiv).find(".hotelCheckin").datepicker('getDate');
	var checkout=$("#"+thisdiv).find(".hotelCheckout").datepicker('getDate');
	var days=(checkout-checkin)/oneDay;
	$("#"+thisdiv).find(".hotelNights").val(days);
	p=$("#"+thisdiv).find(".hotelPp").val();
	qty=$("#"+thisdiv).find(".hotelQty").val();
	nights=$("#"+thisdiv).find(".hotelNights").val();
	pp=(p)*(qty)*(nights);
	s=$("#"+thisdiv).find(".hotelSp").val();
	sp=(s)*(qty)*(nights);
	tPp=$("#"+thisdiv).find(".tHotelPp").val(pp);
	tSp=$("#"+thisdiv).find(".tHotelSp ").val(sp);
}
// delete tour
function del_tour(urlData, thistour, callDiv,  id)
{
	var x=confirm('Do you want to delete it?');
	if(!x)
	{
		return false;
	}
	uniqueId=$("#uniqueId").val();
	$.ajax({
		url:urlData+"?tour="+thistour+"&uniqueId="+uniqueId+"&id="+id,
		success: function(data)
		{
			$("#"+callDiv).html(data);
		}
	});
}
function del_v_tour(urlData, thistour, callDiv,  id)
{
	var x=confirm('Do you want to delete it?');
	if(!x)
	{
		return false;
	}
	uniqueId=$("#uniqueId").val();
	$.ajax({
		url:urlData+"?tour="+thistour+"&uniqueId="+uniqueId+"&id="+id,
		success: function(data)
		{
			$("#"+callDiv).hide();
		}
	});
}
// visa calculation sp (sale price) pp(purchase price) 
function visaTCal(thisdiv)
{
	q=$("#"+thisdiv).find(".visaQty").val();
	pp=$("#"+thisdiv).find(".visaPp").val()*q;
	sp=$("#"+thisdiv).find(".visaSp").val()*q;
	tPp=$("#"+thisdiv).find(".tVisaPp").val(pp);
	tSp=$("#"+thisdiv).find(".tVisaSp").val(sp);
}
// hotal calculaton sale price and purhcase price (hotel total sale calculation)
function hTsCal(thisdiv)
{
	p=$("#"+thisdiv).find(".hotelPp").val();
	qty=$("#"+thisdiv).find(".hotelQty").val();
	nights=$("#"+thisdiv).find(".hotelNights").val();
	pp=(p)*(qty)*(nights);
	s=$("#"+thisdiv).find(".hotelSp").val();
	sp=(s)*(qty)*(nights);
	tPp=$("#"+thisdiv).find(".tHotelPp").val(pp);
	tSp=$("#"+thisdiv).find(".tHotelSp ").val(sp);
}
// transport calculaton sale and purchase price tour transport 
function tTransportCal(thisdiv)
{
	qty=$("#"+thisdiv).find(".transQty").val();
	pp=$("#"+thisdiv).find(".transPp").val()*(qty);
	sp=$("#"+thisdiv).find(".transSp").val()*(qty);
	tPp=$("#"+thisdiv).find(".tTransPp").val(pp);
	tSp=$("#"+thisdiv).find(".tTransSp ").val(sp);	
}
// tour calculation sale and purchase price funciton name tour calculation 
function tTourCal(thisdiv)
{
	p=$("#"+thisdiv).find(".tourPp").val();
	qty=$("#"+thisdiv).find(".tourQty").val();
	pp=p*qty
	sp=$("#"+thisdiv).find(".tourSp").val()*qty;
	tPp=$("#"+thisdiv).find(".tTourPp").val(pp);
	tSp=$("#"+thisdiv).find(".tTourSp").val(sp);	
}
// other services calculation sale and purchase fun othSerCal(other service calculation)
function othSerCal(thisdiv)
{
	qty=$("#"+thisdiv).find(".serQty").val();
	pp=$("#"+thisdiv).find(".serPp").val() * qty;
	sp=$("#"+thisdiv).find(".serSp").val()*qty;
	tPp=$("#"+thisdiv).find(".tSerPp").val(pp);
	tSp=$("#"+thisdiv).find(".tSerSp").val(sp);	
}
//update_tour_inv
function update_tour(formData, thistour, callDiv, urlData, hideModal)
{
	branch=$("#tourBranch").val();
	spo=$("#tourSpo").val();
	var uniqueId=$("#view_tour_sale_edit input[name$='uniqueId']").val();
	$.ajax({
		url:"tourSale/saveTour?tour="+thistour+"&uniqueId="+uniqueId+"&spo="+spo+"&branch="+branch+"&leadId="+leadId,
		data:$("#"+formData).serialize(),
		type:"POST",
		success: function(data)
		{
			alert(data);
			get_tour_view(urlData, callDiv, thistour, uniqueId);
			$("#"+hideModal).modal('hide');
		}
	});
}
// view tour sale invoice details 
function v_ts_inv_det(uniqueId)
{
	$("#view_tour_sale_edit").modal();
	$("#view_tour_sale_edit input[name$='uniqueId']").val(uniqueId);
	get_tour_view("tourSale/ajax_call/view_getTour", "VtourVisaId", "tourVisa", uniqueId);
	get_tour_view("tourSale/ajax_call/view_getTour", "VtourHotelId", "tourHotel", uniqueId);
	get_tour_view("tourSale/ajax_call/view_getTour", "VtourTransId", "tourTrans", uniqueId);
	get_tour_view("tourSale/ajax_call/view_getTour", "VtourTourId", "tourTour", uniqueId);
	get_tour_view("tourSale/ajax_call/view_getTour", "VtourOtherId", "tourOther", uniqueId);
	$(".print_det").attr("href","tourSale/print_tour_inv?tour=det&uniqueId="+uniqueId);
	$(".print_summ").attr("href","tourSale/print_tour_inv?tour=summ&uniqueId="+uniqueId);
}
function get_tour_view(urlData, callDiv, thistour, uniqueId)
{
	$.ajax({
		url:urlData+"?tour="+thistour+"&uniqueId="+uniqueId,
		success: function(data)
		{
			$("#"+callDiv).html(data);
		}
	});
}
// done after view editing
$(".view_done_btn").on("click", function()
{
	$("#view_tour_sale_edit").modal('hide');
	get_sale('tour_sale', 'get_tourSale_unique');
	lead_acc_sum();
});
// tour email in different format
function tour_e_frmt(thisdiv){
	$("#"+thisdiv).modal();
}
//tour sale invoice email sending
function send_tour_email(thisdiv)
{
	uniqueId=$("#view_tour_sale_edit"+" input[name$='uniqueId']").val();
	var x=confirm('Are you Sure?');
	if(!x)
	{
		return false;
	}
	formData=$("#"+thisdiv).find("form").attr("id");
		$.ajax({
			url:"tourSale/send_email?tour="+thisdiv+"&uniqueId="+uniqueId,
			type:"POST",
			data:$("#"+formData).serialize(),
			success: function(data)
			{
				document.getElementById(formData).reset();
				alert(data);
				$("#"+thisdiv).modal('hide');
			}
		});
}
// tour sale invoice details accounts
function acc_tour_inv_det(thisdiv, uniqueId)
{
	$("#"+thisdiv).modal();
	$.ajax({
		url:"../tourSale/ajax_call/get_acc_inv_det?uniqueId="+uniqueId,
		success: function(data)
		{
			$("#get_acc_inv_det").html(data);
			$(document).ready(function(){
    			$('[data-toggle="tooltip"]').tooltip();
				});
		}
	});
}













