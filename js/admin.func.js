// JavaScript Document
function get_airlineList()
{
	$.ajax({
		url:"../ajax_call/get_airline_list",
		type:"POST",
		data:$("#airlineForm").serialize(),
		success: function(data)
		{
			rec=data.split("~");
			if(rec[0]==1){alert("Already Exist!"); return false;}
			else if(rec[0]==2)
			{
				alert("country Added Successfully");
				$(".get_airlines").html(data);
				document.getElementById("airlineForm").reset();
			}
		}
	});
}
function get_airlineSeat()
{
	$.ajax({
		url:"../ajax_call/get_airlineSeat_list",
		type:"POST",
		data:$("#airlineSeatForm").serialize(),
		success: function(data)
		{
			rec=data.split("~");
			if(rec[0]==1){alert("Already Exist!"); return false;}
			else if(rec[0]==2)
			{
				alert("country Added Successfully");
				$(".get_airlineSeat").html(data);
				document.getElementById("airlineSeatForm").reset();
			}
		}
	});
}
function get_airline_travelClass()
{
	$.ajax({
		url:"../ajax_call/get_airline_travelClass",
		type:"POST",
		data:$("#airline_travelForm").serialize(),
		success: function(data)
		{
			rec=data.split("~");
			if(rec[0]==1){alert("Already Exist!"); return false;}
			else if(rec[0]==2)
			{
				alert("country Added Successfully");
				$(".get_airline_travelList").html(data);
				document.getElementById("airlineSeatForm").reset();
			}
		}
	});
}
function get_airline_membership()
{
	$.ajax({
		url:"../ajax_call/get_airline_membership",
		type:"POST",
		data:$("#airline_membForm").serialize(),
		success: function(data)
		{
			rec=data.split("~");
			if(rec[0]==1){alert("Already Exist!"); return false;}
			else if(rec[0]==2)
			{
				alert("country Added Successfully");
				$(".get_airline_membership").html(data);
				document.getElementById("airline_membForm").reset();
			}
		}
	});
}
// fetch all the spo's branches wise
$(".selected_branch").on("change", function()
{
	$.ajax({
		url:"ajax_call/search_spo?branch_id="+$(this).val(),
		success: function(data)
		{
			$(".fetch_spo").html('<option value="">--Select--</option>'+data);
		}
	});
});
// fetch team leader according to branches
function fetch_teams(thisVal)
{
	$.ajax({
		url:"ajax_call/fetch_teamLeaders?branch_id="+thisVal,
		success: function(data)
		{
			$(".teamLeaders").html(data);
		}
	});
}
// off on notification
function notifiation_toggle(thisVal)
{
	$.ajax({
		url:"ajax_call/alert_norification?alert="+thisVal,
		success: function(data)
		{
		}
	});
}
// add email marketing groups
function e_mar_group(formData)
{
	$.ajax({
		url:"ajax_call/get_e_marketing_groups",
		type:"POST",
		data:$("#"+formData).serialize(),
		success: function(data)
		{
			rec=data.split('~');
			if(data==2){alert("Something Wrong with You!");}
			else if(data==3){alert("Already Exist");}
			else{alert("Operation Successfully"); $(".get_e_marketing_groups").html(data);}
			document.getElementById("eForm").reset();
			$("#email-mar-group").modal('hide');
		}
	});
}
//edit email group marketing
function edit_e_mar_group(thisVal)
{
	$("#email-mar-group").modal();
	$.ajax({
		url:"ajax_call/edit_e_mar_group?id="+thisVal,
		dataType:"JSON",
		success: function(data)
		{
			$("#email-mar-group input[name$='group_id']").val(thisVal);	
			$("#email-mar-group input[name$='group_name']").val(data.group_name);			
		}
	});
}
// add new documents related to office
function add_new_off_doc(formData)
{
	$("#add-new-off-doc").modal();
	if(formData!=undefined)
	{

		$.ajax({
			url:"ajax_call/get_off_doc",
			type:"POST",
			data:$("#"+formData).serialize(),
			success:function(data)
			{
				if(data!==2)
				{
					alert("Operation Successfully....");
					$("#add-new-off-doc").modal('hide');
					document.getElementById(formData).reset();
					$(".get_off_doc").html(data);
				}
				else
				{
					alert('Something Wrong with your query....');
				}
			}
		})
	}
}
// edit official documents
function edit_off_doc(id)
{
	$("#add-new-off-doc").modal();
	$.ajax({
		url:"ajax_call/edit_off_doc?id="+id,
		dataType:"JSON",
		success:function(data)
		{
			$("#add-new-off-doc input[name$='id']").val(data.id);
			$("#add-new-off-doc input[name$='doc_name']").val(data.doc_name);
			$("#add-new-off-doc select[name$='doc_type']").val(data.doc_type);
			$("#add-new-off-doc input[name$='alert_date']").val(data.alert_date);
			$("#add-new-off-doc input[name$='due_date']").val(data.due_date);
			$("#add-new-off-doc input[name$='exp_date']").val(data.exp_date);
			$("#add-new-off-doc input[name$='rec_email']").val(data.rec_email);
		},
		cache:false,
	})
}