//bulk_upload_email_img// JavaScript Document
// check exsisting query
function check_ex_query()
{
	$(".content-tabs").css("display", "block");
}
function date_birth(date_o_b)
{
    var str=date_o_b.split('-');    
    var firstdate=new Date(str[2],str[1],str[0]);
    var today = new Date();        
    var dayDiff = Math.ceil(today.getTime() - firstdate.getTime()) / (1000 * 60 * 60 * 24 * 365);
    var age = parseInt(dayDiff);
   $(".age").val(age);
}
// selct custormer profile types
$(".customer-profile").on("click", function(){
	if($(this).val()=='industry'){ $(".industry-types").toggle(); }
	if($(this).val()=='size-location'){ $(".size-locations").toggle(); }
	if($(this).val()=='ideal-use'){ $(".idle-users").toggle(); }
});
// append offices lcations
function office_locations()
{
	$('.office-locations').append('<div class="rem-office-loc"><div class="clearfix"></div><div class="col-md-2">'+
                            	'<div class="form-group">'+
                                    '<input type="text" class="form-control input-sm" placeholder="Location" name="location[]">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-2">'+
                            	'<div class="form-group">'+
                                    '<input type="text" class="form-control input-sm" placeholder="Wherehouse" name="wherehouse[]">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-2">'+
                            	'<div class="form-group">'+
                                    '<input type="text" class="form-control input-sm" placeholder="Manufacturing Unit" name="manufacturing_unit[]">'+
                                '</div>'+
                            '</div>'+
							'<div class="col-md-2">'+
                            	'<div class="form-group">'+
                                    '<input type="text" class="form-control input-sm" placeholder="Dispaly Center" name="display_center[]">'+
                                '</div>'+
                            '</div>'+
							'<div class="clearfix"></div>'+
                            '<div class="col-md-8">'+
                            	'<div class="form-group">'+
                                    '<input type="text" class="form-control input-sm" placeholder="Other Details" name="other_details[]">'+
                                '</div>'+
                            '</div>'+
							'<div class="col-md-2">'+
                            	'<div class="form-group">'+
                                    '<button type="button" class="btn btn-primary btn-sm rem-off-loc"><i class="fa fa-remove"></i></button>'+
                                '</div>'+
                            '</div></div>');
}
$(document).on('click','.rem-off-loc',function() {
 	$(this).parents('.rem-office-loc').remove();
});
//customer profile certification & license
function cer_license()
{
	$(".div-certification-lic").append('<div class="rem-cer-lic"><div class="col-md-2">'+
                                	'<div class="form-group">'+
                                    	'<input type="text" class="form-control input-sm" placeholder="Certification" name="certificaton[]">'+
                                    '</div>'+
                                '</div>'+
                                '<div class="col-md-2">'+
                                	'<div class="form-group">'+
                                    	'<input type="text" class="form-control input-sm" placeholder="Lienses" name="license[]">'+
                                    '</div>'+
                                '</div>'+
								'<div class="clearfix"></div>'+
								'<div class="col-md-8">'+
        							'<div class="form-group">'+
          								'<input type="text" class="form-control input-sm" placeholder="Other Details" name="other_det[]">'+
        							'</div>'+
      							'</div>'+
                                '<div class="col-md-2">'+
                                	'<div class="form-group">'+
                                    	'<button class="btn btn-primary btn-sm rem-cer-lic">'+
                                        '<i class="fa fa-remove"></i></button>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="clearfix"></div></div>');
}
$(document).on('click','.rem-cer-lic',function() {
 	$(this).parents('.rem-cer-lic').remove();
});
//next 
 $('.btnNext').click(function(){
	 x=confirm('Are  Your Sure?');
	 if(!x)
	 {
		 return false;
	 }
	 var formData=$(this).parents("form");
	 $.ajax({
		 url:"marketing/ajax_call/save_add_book?tab="+$(this).val()+"&address_id="+$("#address_id").val(),
		 type:"POST",
		 data:$(formData).serialize(),
		 success: function(data)
		 {
			 rec=data.split(",");
			 if(rec[0]=='address_id'){ $("#address_id").val(rec[1]); }
			 if(rec[0]==1062){alert("Already Exist....");}
			 if(rec[0]==1 || rec[0]=='address_id')
			 {
				$('.nav-tabs > .active').next('li').find('a').trigger('click');
  			    $('body').animate({scrollTop:0}, 'slow'); 
			 }
		 }
	 });
});
$('.btnPrevious').click(function(){
  $('.nav-tabs> .active').prev('li').find('a').trigger('click');
});
//only save the information
$('.btnSave').click(function(){
	 x=confirm('Are  Your Sure?');
	 if(!x)
	 {
		 return false;
	 }
	 var formData=$(this).parents("form");
	 $.ajax({
		 url:"marketing/ajax_call/save_add_book?tab="+$(this).val()+"&address_id="+$("#address_id").val(),
		 type:"POST",
		 data:$(formData).serialize(),
		 success: function(data)
		 {
			 rec=data.split(",");
			 if(rec[0]=='address_id'){ $("#address_id").val(rec[1]); }
			 if(rec[0]==1062){alert("Already Exist....");}
			 if(rec[0]==1 || rec[0]=='address_id')
			 {
				$('.nav-tabs > .active').next('li').find('a').trigger('click');
  			    $('body').animate({scrollTop:0}, 'slow'); 
			 }
		 }
	 });
});
// nested next 
//next 
$('.nested_btnNext').click(function(){
	 x=confirm('Are  Your Sure?');
	 if(!x)
	 {
		 return false;
	 }
	 var formData=$(this).parents("form");
	 $.ajax({
		 url:"marketing/ajax_call/save_add_book?tab="+$(this).val()+"&address_id="+$("#address_id").val(),
		 type:"POST",
		 data:$(formData).serialize(),
		 success: function(data)
		 {
			 rec=data.split(",");
			 if(rec[0]=='address_id'){ $("#address_id").val(rec[1]); }
			 if(rec[0]==1062){alert("Already Exist....");}
			 if(rec[0]==1 || rec[0]=='address_id')
			 {
				$('.nav-tabs > .active').next('li').find('a').trigger('click');
  			    $('body').animate({scrollTop:0}, 'slow'); 
			 }
		 }
	 });
  $('.nav-tabs > .active').next('li').find('a').trigger('click');
   $('body').animate({scrollTop:0}, 'slow');
});
$('.btnPrevious').click(function(){
  $('.nav-tabs > .active').prev('li').find('a').trigger('click');
});

$(".industry-based-on").on("click",function(){
	if($(this).val()=='product')
	{
		$(".pb").css("display","block");
		$(".sb input[type=checkbox]").removeAttr('checked');
		$(".sb").hide();
	}
	else
	{
		$(".sb").css("display","block");
		$(".pb").hide();
		$(".pb input[type=checkbox]").removeAttr('checked');
	}
});
// Decesion making process  show no of department
$(".select_dep").on("change", function()
{
	$(".count-dep-people").show();
	$(".count-dep-people").after("<div class='clearfix'></div><div class='"+$(this).val().replace(/[^a-z0-9\s]/gi, '')
	.replace(/[_\s]/g, '')+"'>");
	//$('.'+$(this).val()).not(':last').remove();
	$('.'+$(this).val().replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '')).not(':last').remove();
});
$(".count-dep-people").on("keyup","input", function(){
	//$("."+$(".select_dep").find(":selected").val()).remove();
	//$(".count-dep-people").after("<div class='clearfix'></div><div class='append-dep'></div>");
	//$(".select_dep").find(":selected").html('<div class="clearfix"></div><h5>azeem<i class="fa fa-angle-double-right"></i>'+
	//'</h5>');
	//alert($(".select_dep").find(":selected").val())
	$("."+$(".select_dep").find(":selected").val().replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '')).html('<div class="clearfix"></div><h5><i class="fa fa-angle-double-right"></i>'+
	''+$(".select_dep").find(":selected").text()+''+
	'</h5>')
	for(i=0;i<$(this).val(); i++)
	{
		$("."+$(".select_dep").find(":selected").val().replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '')).append(''+
		'<input type="hidden" name="dep_name[]" value="'+$(".select_dep").find(":selected").text()+'">'+
		'<input type="hidden" name="total_person[]" value="'+$(".dec_total_person").val()+'"></div>'+
			'<div class="col-md-2">'+
                        	'<div class="form-group">'+
                            	'<input type="text" class="form-control input-sm" placeholder="Name" name="person_name[]">'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-md-2">'+
                        	'<div class="form-group">'+
                            	'<input type="text" class="form-control input-sm" placeholder="Desigination" name="desigination[]">'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-md-2">'+
                        	'<div class="form-group">'+
                            	'<select class="form-control input-sm" name="role[]">'+
                                	'<option value="">Select Role..</option>'+
                                    '<option>Controler</option>'+
                                    '<option>Decider</option>'+
                                    '<option>Buyer</option>'+
                                    '<option>user</option>'+
                                    '<option>Intiater</option>'+
                                    '<option>Influener</option>'+
                                    '<option>GateKeeper</option>'+
                                    '<option>None</option>'+
                                '</select>'+
                            '</div>'+
                        '</div><div class="clearfix"></div>');
	}
});
// update Qualifying Prospects 
$('.update_qp').click(function(){
	x=confirm('Are  Your Sure?');
	 if(!x)
	 {
		 return false;
	 }
	 var formData=$(this).parents("form");
	 $.ajax({
		 url:"marketing/ajax_call/update_add_book?tab="+$(this).val()+"&address_id="+$("#address_id").val(),
		 type:"POST",
		 data:$(formData).serialize(),
		 success: function(data)
		 {
			 if(data==1){$(".modal-pop").modal();}
			 else{alert("Something Wrong With your Query.......");}
			 
		 }
	 });
	 
});
// update the data and goes to next step
$(".update_btn_next").click(function(){
	$(".modal-pop").modal('hide');
	$('.nav-tabs > .active').next('li').find('a').trigger('click');
  	$('body').animate({scrollTop:0}, 'slow');
});
//Qualifying prosepects customer profile fiancial wealt sum
// company finacially wealth
function comp_f_wealth()
{
	brand_val=$(".f_brand_val").val();
	assets_val=$(".f_assets_val").val();
	comp_finacialy_wealth=Number(brand_val)+Number(assets_val);
	$(".f_comp_finacialy_wealth").val(comp_finacialy_wealth);
}
// check already clietn exist with thei cnic numerb
function check_cnic(thisVal)
{
	$.ajax({
		url:"marketing/ajax_call/check_cnic?cnic="+thisVal,
		success: function(data)
		{
			rec=data.split(",");
			if(thisVal!="" && rec[0]==thisVal)
			{
				$(".check-cnic").modal({ backdrop: 'static' });
				$(".exist_add_id").val(rec[1]);
			}
		}
	});
}
// check already phone exist with thei cnic numerb
function check_exist_val(col, thisVal)
{
	$.ajax({
		url:"marketing/ajax_call/check_ex_val?"+col+"="+thisVal,
		success: function(data)
		{
			rec=data.split(",");
			if(thisVal!="" && rec[0]==thisVal)
			{
				$(".check-ex-val").modal({ backdrop: 'static' }).find("h4").after('Already Exist Information Against This Val..... ');
				$(".check-ex-val").closest("h4").html("");
				$(".exist_add_id").val(rec[1]);
			}
		}
	});
}
/*======================sending bulk email in pop up=========================*/
function send_bulk_emails()
{
	$(".bulk_email_pop_up").modal({ backdrop: 'static' });
}
function send_sel_email()
{
	$(".sel_email_pop_up").modal({ backdrop: 'static' });
	$("#lead_email").hide();
	var selected ="";
	$('.chkbox:checked').each(function() {
     	//alert(selected.push($(this).val()));
		selected+=$(this).val()+',';
		});
		selected = selected.substring(0,selected.length-1);
		document.getElementById("emails").value=selected;
}
// bulk emails
function send_emails(thisVal, emailForm)
{
	//t=$('.cke_wysiwyg_frame').contents().find("p").html();
	for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }
	//$("#"+emailForm).find("#editor2").val(t);
	$.ajax({
		url:"marketing/ajax_call/email_action?action="+thisVal,
		data:$("#"+emailForm).serialize(),
		type:"POST",
		success: function(data)
		{
			if(data==1)
			{
				$(".alread-process").modal();
				$(".sel_email_pop_up, .bulk_email_pop_up").modal('hide');
			}
			else
			{
				$(".sel_email_pop_up, .bulk_email_pop_up").modal('hide');
				$(".modal-pop").modal();
			}
		}
	});
}
function uni_sms(thisVal)
{
	if(thisVal!='sendNow'){ $("#uni_mobile").val(thisVal); }
	$("#uni_sms").modal({ backdrop: 'static' });
	if(thisVal=='sendNow'){
		$.ajax({
		url:"marketing/ajax_call/send_add_sms?sms_type=uni",
		type:"POST",
		data:$("#uniForm").serialize(),
		success: function(data)
		{
			$("#uni_sms").modal('hide');
			$(".modal-pop").modal();
			document.getElementById("uniForm").reset();
		}
		});
	}
}
// selected mobile numbers from address book
function sel_add_book_mobile()
{
	$("#uni_sms").modal({ backdrop: 'static' });
	var selected ="";
	$('.chkbox:checked').each(function() {
		selected+=$(this).attr("mob")+',';
		});
		selected = selected.substring(0,selected.length-1);
		document.getElementById("uni_mobile").value=selected;
}
// send unique emails
function uni_emails(thisVal)
{
	$(".sel_email_pop_up").modal({ backdrop: 'static' });
	$("#emails").val(thisVal);
	
}
//sms logs message details pop up
function msg_det_mdl(id)
{
	$("#msg_det_mdl").modal();
	$.ajax({
		url:"marketing/ajax_call/get_msg_det?id="+id,
		success: function(data)
		{
			$("#msg_det_mdl").find("p").text(data);
		}
	});
}
$(document).on("change", "#upload_email_img", function() {
	var allData="";
	var file_data = $("#upload_email_img").prop("files")[0];
	var form_data = new FormData();
	allData+=$('.cke_wysiwyg_frame').contents().find('body').html();
	
	form_data.append("file", file_data)
	$.ajax({
                url: "marketing/ajax_call/upload_img",
                //dataType: 'script',
                contentType: false,
                processData: false,
                data: form_data,                         // Setting the data attribute of ajax with file_data
                type: 'post',
				success: function(data)
				{
					allData+="<a href='#'><img  src='https://www.crmv4.groupoperation.com/marketing/emails_images/"+data+"'></a>";
					$('.cke_wysiwyg_frame').contents().find('body').html(allData);
				}
       })
});
//bulk emails images
$(document).on("change", "#bulk_upload_email_img", function() {
	var file_data = $("#bulk_upload_email_img").prop("files")[0];
	var form_data = new FormData();  
	form_data.append("file", file_data)
	$.ajax({
                url: "marketing/ajax_call/upload_img",
                //dataType: 'script',
                contentType: false,
                processData: false,
                data: form_data,                         // Setting the data attribute of ajax with file_data
                type: 'post',
				success: function(data)
				{
					$('.cke_wysiwyg_frame').contents().find('body').html("< href='#'><img  src='https://www.crmv4.groupoperation.com/marketing/emails_images/"+data+"'></a>");
				}
       })
})
// bulk email text view
function bulk_email_view(id)
{
	$(".bulk_email_pop_up").modal();
	$.ajax({
		url:"marketing/ajax_call/view_bulk_email_content?id="+id,
		success: function(data)
		{
			$(".email_content").html(data);
		}
	});
}
function count_group_sms(gId)
{
	$.ajax({
		url:"../ajax_call/get_group_sms?gId="+gId,
		success: function(data)
		{
			$("#get_group_sms").html('<div class="callout callout-info">'+
    						'<h4>Total SMS in this Groups are ('+data+')</h4>'+
  							'</div>');
		}
		});
}

