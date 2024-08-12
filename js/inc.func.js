var call_page="";
var path="";
var comm_path="";
var page="";
function call_ajax(url, form, callDiv)
{
	path=url;
	call_page="."+callDiv;
	var form="#"+form;
	var page=1;
	$("#loader").show();
	$.ajax({
			url:path+"?page="+page,
			type:"POST",
			data:$(form).serialize(),
			cache:false,
			success: function(data)
			{
				$(call_page).html(data);
				$("#loader").hide();
			}
			
	});
}
$("table").on("click", 'ul li', function(){
	page=$(this).attr("p");
	if(path!=""){
	$("#loader").show();
	}
	$.ajax({
			url:path+"?page="+page,
			type:"POST",
			data:$("#form").serialize(),
			cache:false,
			success: function(data)
			{
				$(call_page).html(data);
				$("#loader").hide();
			}
	});
});

$('li').on('click', 'li', function() {
    $('li').removeClass('active');
});
$(".clickthis").on("click", function()
{
	console.log($(this).parents("li"));
});
// create new lead
$(".createLead").on("click", function(){
	var code=$("#c_code").val();
    var mobile=$("#mobile").val();
    if(mobile=="" || mobile.length<5)
    {
        $(".empty-field").show();
		return false;
    }
   
        $.ajax({
                url:"ajax_call/createLead?mobile="+mobile+"&code="+code,
				cache:false,
                success:function(data)
                {
                   $("#primary").html(data);
				   //$("#primary").parents(".content-wrapper").find("h2").hide();
				   $(".empty-field").hide();
                }
               });
    
});


// supplier term and conditions
function s_term_c(val)
{
	$("#term-condition").modal();
	$.ajax({
		url:"lead-tabs/term-cond-proc?vendor_id="+val,
		success: function(data)
		{
			rec=data.split("~");
			$("#term-cond-head").html(rec[0]);
			$("#term-cond-det").html(rec[1]);
		}
	});
}
// empty fields 
function empty_fields(thisForm)
{
	document.getElementById(thisForm).reset();
}
//add new vendors etc
function add_acc()
{
	$("#transacc").modal({ backdrop: 'static'});
	vendor_name=$("#new-transacc input[name$='acc_name']").val();
	if(vendor_name!=""){
	$.ajax({
		url:"savetransacc",
		type:"POST",
		data:$("#new-transacc").serialize(),
		success: function(data)
		{
			rec=data.split("~");
			if(rec[0]==1)
			{
				alert("Operation Successfull!");
				document.getElementById("new-transacc").reset();
				$("#transacc").modal('hide');
				call_ajax("ajax_call/get_transacc", "", "get_transacc");
			}
			if(rec[0]==2){alert("Something Wrong With You!")}
			if(rec[0]==1062){alert("Account Already Exist...")}
		}
	});
	}
}
// update transaction account
function update_trans_acc(trans_acc_id)
{
	$("#transacc").modal({ backdrop: 'static'});
	$("#transacc input[name$='trans_acc_id']").val(trans_acc_id);
	$.ajax({
		url:"update_transacc?trans_acc_id="+trans_acc_id,
		dataType:"JSON",
		success: function(data)
		{
			$("#transacc select[name$='trans_acc_type']").val(data['trans_acc_type']);
			$("#transacc input[name$='trans_acc_name']").val(data['trans_acc_name']);
			$("#transacc select[name$='dr_cr']").val(data['dr_cr']);
			$("#transacc input[name$='trans_acc_address']").val(data['trans_acc_address']);
			$("#transacc input[name$='amount']").val(data['amount']);
		}
	});
}
// delete recoeds
function del_rec(root,type, id)
{
	 var x=confirm('Do you want to delete it?');
	if(!x)
	{
		return false;
	}
	$("#"+id).load(root+"del_rec?del_rec="+id+"&type="+type);
	$("#"+id).hide();
}
// read images url and display images
function readURL_img(input, id) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#'+id)
				.attr('src', e.target.result)
				.width(50)
				.height(50);
		};

		reader.readAsDataURL(input.files[0]);
	}
}

 // load messages
function load_msg()
{
	$(".load-msg").load("ajax_call/load_message");
}
// show pending notification details
function pending_noti()
{
	$("#pending_noti").load("ajax_call/pending_noti");
}
function reminder_view(rem_id)
{
	$("#desk_rem_view").modal();
	$("#rem_det").load("ajax_call/get_reminder?rem_id="+rem_id);
	$("#rem_det").parent().children("h3").children("a").attr("href","create_reminder?id="+rem_id);
}
// create a funciton for editing
function edit_branch(edit_url, call_div, form, id)
{
	$("#"+call_div).modal({ backdrop: 'static' });
	path=edit_url+".php";
	if(id!=""){
	document.getElementById("branch").value="Update";
	}
	var form="#"+form;
	$.ajax({
			url:"ajax_call/"+path+"?page="+page+"&id="+id,
			type:"POST",
			data:$(form).serialize(),
			success: function(data)
			{
				rec=data.split("=");
				$("#id").val(rec[0]);
				$("#branch_name").val(rec[1]);
				$("#branch_location").val(rec[2]);
				document.getElementById("branch_logo").src="branch_logo/"+rec[3];
				$("#address").val(rec[4]);
				document.getElementById("sign_logo").src="branch_logo/"+rec[5];
				$("#branch_email").val(rec[6]);
				$("#phone_line").val(rec[7]);
				$("#mobile").val(rec[8]);
				$("#web").val(rec[9]);
				document.getElementById("email_header").src="branch_logo/"+rec[10];
				$("#msg_mask").val(rec[11]);
							
			}
	});
}
// Add  invoice numbers in sale reports
$("body").delegate( ".inv_no", "click", function() {
	$("#inv_no").modal({ backdrop: 'static' });
  	id=$(this).attr("data-id");
	type=$(this).attr("data-type");
	$("#inv_no input[name$='sale_id']").val(id);
	$("#inv_no input[name$='sale_type']").val(type);
});
function inv_no()
{
	id=$("#invForm input[name$='sale_id']").val();
	type=$("#invForm input[name$='sale_type']").val();
	$.ajax({
		url:"ajax_call/get_inv_no?type="+type+"&id="+id,
		type:"POST",
		data:$("#invForm").serialize(),
		success: function(data)
		{
			$("."+type+id).html(data);
			document.getElementById("invForm").reset();
			$("#inv_no").modal('hide');
		}
	});
}
function country()
{
	$.ajax({
		url:"ajax_call/get_countries",
		data:$("#cntryForm").serialize(),
		type:"POST",
		success: function(data)
		{
			rec=data.split("~");
			if(rec[0]==1){alert("Already Exist!"); return false;}
			else if(rec[0]==2)
			{
				alert("country Added Successfully");
				$(".get_countries").html(data);
				document.getElementById("cntryForm").reset();
			}
		}
	});
}
function city()
{
	$("#city_modal").modal({ backdrop: 'static' });
	$.ajax({
		url:"ajax_call/get_cities",
		data:$("#new-city").serialize(),
		type:"POST",
		success: function(data)
		{
			rec=data.split("~");
			if(rec[0]==1){alert("Already Exist!"); return false;}
			else if(rec[0]==2)
			{
				alert("City Added Successfully");
				$(".get_cities").html(data);
				document.getElementById("new-city").reset();
				$("#city_modal").modal('hide');
			}
		}
	});
}
// select cities country wise
function select_city(id)
{
	$("#city_id").load('ajax_call/citiesList?country_id='+id);
}
// update message api 
function update_msg_api(id)
{
	$("#myModal").modal();
	$.ajax({
		url:"ajax_call/get_message_api?id="+id,
		success: function(data)
		{
			$("#id").val(id);
			rec=data.split(',');
			$("#msg_mask").val(rec[1]);
			$("#api_id").val(rec[2]);
			$("#api_pswd").val(rec[3]);
			$("#myModal select[name$='branch']").val(rec[4]);
			$("#myModal .btn-change").val('Update');
		}
	});
}
/*==================Convert number in number_format========
function RemoveRougeChar(convertString){
        if(convertString.substring(0,1) == ","){
            return convertString.substring(1, convertString.length)                  
        }
        return convertString; 
    }
    
    $('input.number').on("keyup", function(e){
        var $this = $(this);
        var num = $this.val().replace(/[^0-9]+/g, '').replace(/,/gi, "").split("").reverse().join("");     
        var num2 = RemoveRougeChar(num.replace(/(.{3})/g,"$1,").split("").reverse().join(""));
        $this.val(num2);
});*/
///////////////////////End function 
/*===============================Transaction account actions==========*/
function trans_action()
{
	$.ajax({
		url:"get_trans_action",
		data:$("#trans_acc_form").serialize(),
		type:"POST",
		success: function(data)
		{
			if(data==1)
			{
				$(".success-load").show(); $(".error-load").hide();
				document.getElementById("trans_acc_form").reset();
			}
			else if(data==2){$(".error-load").show(); $(".success-load").hide();}
		}
	});
}
// logout redirect to login page
function logout(red)
{
	window.location=red;
}