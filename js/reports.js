// JavaScript Document
$(".selected_branch_rep").on("change", function()
{
	$.ajax({
		url:"../ajax_call/search_spo?branch_id="+$(this).val(),
		success: function(data)
		{
			$(".fetch_spo_rep").html('<option value="">--Select--</option>'+data);
		}
	});
});
function get_spo_position_rep()
{
	$("#loader").show();
	var rep="";
	var ob=0;
	var vr=0;
	var dn=0;
	var rec=0;
	var payment=0;
	var cb=0;
	var invoices=0;
	$.ajax({
		url:"ajax_call/get_spo_position_rep",
		data:$("#form").serialize(),
		type:"POST",
		dataType:"JSON",
		success: function(data)
		{
			//console.log(data[0]['all_data']['leadId']);
			for(i=0; i<data.length; i++)
			{
				if(data[i]['all_data']['cb']!=0)
				{
				rep+='<tr>';
				 rep+='<td>'+data[i]['all_data']['leadId']+'</td>';
				 rep+='<td>'+data[i]['all_data']['client_name']+'</td>';
				 rep+='<td>'+data[i]['all_data']['ob'].toLocaleString('en')+'</td>';
				 rep+='<td>'+Number(data[i]['all_data']['invoices']).toLocaleString('en')+'</td>';
				 rep+='<td>'+Number(data[i]['all_data']['refund']).toLocaleString('en')+'</td>';
				 rep+='<td>'+Number(data[i]['all_data']['debit_note']).toLocaleString('en')+'</td>';
				 rep+='<td>'+Number(data[i]['all_data']['receipts']).toLocaleString('en')+'</td>';
				 rep+='<td>'+Number(data[i]['all_data']['payments']).toLocaleString('en')+'</td>';
				 rep+='<td>'+Number(data[i]['all_data']['cb']).toLocaleString('en')+'</td>';
				rep+='</tr>';
				ob+=data[i]['all_data']['ob'];
				vr+=data[i]['all_data']['refund'];
				dn+=data[i]['all_data']['debit_note'];
				rec+=Number(data[i]['all_data']['receipts']);
				payment+=Number(data[i]['all_data']['payments']);
				cb+=data[i]['all_data']['cb'];
				invoices+=Number(data[i]['all_data']['invoices']);
				}	
			}
			rep+='<tr>';
			 rep+='<td colspan="3" align="right"><strong>'+Number(ob).toLocaleString('en')+'</strong></td>';
			 rep+='<td><strong>'+invoices.toLocaleString('en')+'</strong></td>';
			 rep+='<td><strong>'+Number(vr).toLocaleString('en')+'</strong></td>';
			 rep+='<td><strong>'+Number(dn).toLocaleString('en')+'</strong></td>';
			 rep+='<td><strong>'+Number(rec).toLocaleString('en')+'</strong></td>';
			 rep+='<td><strong>'+Number(payment).toLocaleString('en')+'</strong></td>';
			 rep+='<td><strong>'+Number(cb).toLocaleString('en')+'</strong></td>';
			rep+='</tr>';
			$("#get_spo_position_rep").html(rep);
			$("#loader").hide();
		},
		cache: false,
	});
}
function get_client_aging_rep()
{
	$("#loader").show();
	var rep="";
	$.ajax({
		url:"ajax_call/get_client_aging",
		type:"POST",
		dataType:"JSON",
		data:$("#form").serialize(),
		success: function(data)
		{
			for(i=0; i<data.length; i++)
			{
				if(data[i]['all_data']['ob']!=0)
				{
					rep+='<tr>';
					 rep+='<td>'+data[i]['all_data']['leadId']+'</td>';
					 rep+='<td>'+data[i]['all_data']['client_name']+'</td>';
					 rep+='<td>'+data[i]['all_data']['ob'].toLocaleString('en')+'</td>';
					 rep+='<td>'+data[i]['all_data']['one_month'].toLocaleString('en')+'</td>';
					 rep+='<td>'+data[i]['all_data']['two_month'].toLocaleString('en')+'</td>';
					 rep+='<td>'+data[i]['all_data']['third_month'].toLocaleString('en')+'</td>';
					rep+='</tr>';
				}
			}
			$("#get_client_aging_rep").html(rep);
			$("#loader").hide();
		},
		cache: false,
	});
}
function get_fn_aging_rep()
{
	$("#loader").show();
	var t_ob=0;
	var t_first=0;
	var t_second=0;
	var t_third=0;
	var t_four=0;
	var t_five=0;
	var t_cb=0;
	var rep="";
	$.ajax({
		url:"ajax_call/get_fn_aging_rep",
		type:"POST",
		dataType:"JSON",
		data:$("#form").serialize(),
		success: function(data)
		{
			if(data!="")
			{
			for(i=0; i<data.length; i++)
			{
					rep+='<tr style="text-align:center;">';
					 rep+='<td>'+data[i]['all_data']['leadId']+'</td>';
					 rep+='<td>'+data[i]['all_data']['client_name']+'</td>';
					 rep+='<td align="center">'+data[i]['all_data']['ob'].toLocaleString('en')+'</td>';
					 rep+='<td width="6%">'+data[i]['all_data']['one'].toLocaleString('en')+'</td>';
					 rep+='<td>'+data[i]['all_data']['two'].toLocaleString('en')+'</td>';
					 rep+='<td>'+data[i]['all_data']['three'].toLocaleString('en')+'</td>';
					 rep+='<td>'+data[i]['all_data']['four'].toLocaleString('en')+'</td>';
					 rep+='<td>'+data[i]['all_data']['five'].toLocaleString('en')+'</td>';
					 rep+='<td>'+data[i]['all_data']['cb'].toLocaleString('en')+'</td>';
					rep+='</tr>';
				t_ob+=data[i]['all_data']['ob'];
				t_first+=data[i]['all_data']['one'];
				t_second+=data[i]['all_data']['two'];
				t_third+=data[i]['all_data']['three'];
				t_four+=data[i]['all_data']['four'];
				t_five+=data[i]['all_data']['five'];
				t_cb+=data[i]['all_data']['cb'];
			}
			$(".t_ob").text(t_ob.toLocaleString('en'));
			$(".t_first").text(t_first.toLocaleString('en'));
			$(".t_second").text(t_second.toLocaleString('en'));
			$(".t_third").text(t_third.toLocaleString('en'));
			$(".t_four").text(t_four.toLocaleString('en'));
			$(".t_five").text(t_five.toLocaleString('en'));
			$(".t_cb").text(t_cb.toLocaleString('en'));
			$(".first_date").text(data[0]['first_date']);
			$(".sec_date").text(data[0]['sec_date']);
			$(".three_date").text(data[0]['three_date']);
			$(".four_date").text(data[0]['four_date']);
			$(".five_date").text(data[0]['five_date']);
			$(".six_date").text(data[0]['six_date']);
			}
			$("#loader").hide();
			$("#get_fn_aging_rep").html(rep);
		}
	});
}
// get spo accounts reports
function get_spo_acc_rep()
{
	$("#loader").show();
	var rep="";
	var ob=0;
	$.ajax({
		url:"ajax_call/get_spo_acc_rep",
		data:$("#form").serialize(),
		type:"POST",
		dataType:"JSON",
		success: function(data)
		{
			if(data!="")
			for(i=0; i<data.length; i++)
			{
				if(data[i]['all_data']['ob']!=0)
				{
				rep+='<tr>';
				 rep+='<td>'+data[i]['all_data']['leadId']+'</td>';
				 rep+='<td>'+data[i]['all_data']['spo']+'</td>';
				 rep+='<td>'+data[i]['all_data']['client_name']+'</td>';
				 rep+='<td>'+data[i]['all_data']['ob'].toLocaleString('en')+'</td>';
				 ob+=Number(data[i]['all_data']['ob']);
				}	
			}
			rep+='<tr>';
			 rep+='<td colspan="3" align="right"><strong>Total Outstanding</strong></td><td><strong>'+Number(ob).toLocaleString('en')+'</strong></td>';
			rep+='</tr>';
			$(".get_spo_acc_reports").html(rep);
			$("#loader").hide();
		},
		//cache: false,
	});
}
// Lead Reports
function lead_rep(p)
{
	$("#loader").show();
	var rows="";
	$.ajax({
		url:"ajax_call/get_lead_reports?page="+p,
		dataType:"JSON",
		data:$("#form").serialize(),
		type:"POST",
		success: function(data)
		{
			j=1;
			if(data[0]!="")
			{
			for(i=0; i<data[0].all_data.length; i++)
			{
				rows+="<tr>";
				 rows+="<td>"+Number(j++)+"</td>";
				 rows+="<td>"+data[0].all_data[i]['create_date']+"</td>";
				 rows+="<td>"+data[0].all_data[i]['id']+"</td>";
				 rows+="<td>"+data[0].all_data[i]['mobile']+"</td>";
				 rows+="<td>"+data[0].all_data[i]['contact_name']+"</td>";
				 rows+="<td>"+data[0].all_data[i]['createdBy']+"</td>";
				 rows+="<td>"+data[0].all_data[i]['takenOverBy']+"</td>";
				 rows+="<td>"+data[0].all_data[i]['work_since']+"</td>";
				 rows+="<td>"+data[0].all_data[i]['status']+"</td>";
				rows+="</tr>";
			}
			$(".get_lead_reports").html(rows);
			}
			else
			{
				$(".get_lead_reports").html("<tr> <td colspan='10' align='center'>No Record Found</td></tr>");
			}
			pagination(data[0].page, data[0].cp, data[0].pp, data[0].clickFunc);
			$("#loader").hide();
		}
	});
}
function pagination(total_rec, cur_page, per_page, clickFunc)
{
	no_ofPage=Math.ceil(total_rec/per_page);
	if (cur_page >= 5) 
	{
		start_loop = cur_page -3;
		end_loop = Number(cur_page)+Number(2);
		if(no_ofPage-1==cur_page)
		   {
			   end_loop=no_ofPage;
		   }
		   if(cur_page==no_ofPage)
		   {
			   end_loop=no_ofPage;
		   }
	}
	else 
	{
		start_loop = 1;
		if (no_ofPage > 5)
			end_loop=5;
		else
			end_loop =no_ofPage;
	}
	ul="";
	ul+='<ul class="pagination pull-right">';
	if(cur_page==1) 
	{
		ul+='<li p="1"  class="active" onclick="'+clickFunc+'(1)"><a>First</a></li>';
	}
	else
	{
		ul+='<li p="1" onclick="'+clickFunc+'(1)"><a>First</a></li>';
	}
	for (i = start_loop; i <= end_loop; i++) 
	{
		if (cur_page==i)
			ul+= "<li class='active' p='"+i+"' onclick='"+clickFunc+"("+i+")'><a>"+i+"</a></li><li>";
		else
			ul+= "<li p='"+i+"' onclick='"+clickFunc+"("+i+")'><a>"+i+"</a></li>";
	}
	if(cur_page==no_ofPage && cur_page!=1)
	{
		ul+='<li p="'+no_ofPage+'" class="active"><a>Last</a></li>';
	}
	else
	{
		ul+='<li p="'+no_ofPage+'" onclick="'+clickFunc+'('+no_ofPage+')"><a>Last</a></li>'; 
	}
		ul+="</ul>";
		$("#pagination").html(ul);
}