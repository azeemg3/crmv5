<?php
class tourSale extends crm
{
	//tour sale invoice visa
	public $fetcol;
	function fetchData($query)
	{
		$row=mysql_fetch_array($query);
		return $row;
	}
	function col($col)
	{
		return $this->fetcol[$col];
	}
	function visaSupp()
	{
		$list="";
		$query=$this->selectData("tour_visa", "visaSuppName!='' GROUP BY visaSuppName");
		while($row=mysql_fetch_array($query))
		{
			$list.= '<option value="'.$row['visaSuppName'].'">';
		}
		return $list;
	}
	// tour hotel names
	function tour_hn()
	{
		$list="";
		$query=$this->selectData("tour_hotel", "hotelName!='' GROUP BY hotelName");
		while($row=mysql_fetch_array($query))
		{
			$list.= '<option value="'.$row['hotelName'].'">';
		}
		return $list;
	}
	//thour viss types
	function tour_vt()
	{
		$list="";
		$query=$this->selectData("tour_visa", "visaType!='' GROUP BY visaType");
		while($row=mysql_fetch_array($query))
		{
			$list.= '<option value="'.$row['visaType'].'">';
		}
		return $list;
	}
	//tour Vehicle type
	function tour_veht()
	{
		$list="";
		$query=$this->selectData("tour_transport", "transVehType!='' GROUP BY transVehType");
		while($row=mysql_fetch_array($query))
		{
			$list.= '<option value="'.$row['transVehType'].'">';
		}
		return $list;
	}
	// tour Tour Name
	function tour_tn()
	{
		$list="";
		$query=$this->selectData("tour_tour", "tourName!='' GROUP BY tourName");
		while($row=mysql_fetch_array($query))
		{
			$list.= '<option value="'.$row['tourName'].'">';
		}
		return $list;
		
	}
	// tour other services
	function tour_os()
	{
		$list="";
		$query=$this->selectData("tour_other", "serviceName!='' GROUP BY serviceName");
		while($row=mysql_fetch_array($query))
		{
			$list.= '<option value="'.$row['serviceName'].'">';
		}
		return $list;
	}
	function get_tvisa($uniqueId)
	{
		$data=""; $count=1; $id="";	
		$query=$this->selectData("tour_visa", "uniqueId='".$uniqueId."' AND uniqueId!=''");
		while($this->fetcol=$this->fetchData($query))
		{
			$id=$this->col('id');
			$data.= '<tr>
						<td>'.$count++.'</td>
						<td>'.$this->col('leadId').'</td>
						<td>'.$this->col('visaPassName').'</td>
						<td>'.$this->col('visaType').'</td>
						<td>'.$this->col('visaSuppName').'</td>
						<td>'.$this->col('visaQty').'</td>
						<td>'.$this->col('visaPp').'</td>
						<td>'.$this->col('visaSp').'</td>
						<td>'.($this->col('visaQty'))*($this->col('visaPp')).'</td>
						<td>'.($this->col('visaQty'))*($this->col('visaSp')).'</td>
						<td>
						<a onClick="e_v_t(\''.$this->col('id').'\', \'edit_tour_visa\')"><span class="glyphicon glyphicon-edit"></span></a> |
						<a onclick="del_tour(\'tourSale/ajax_call/getTour\', \'tourVisa\', \'tourVisaId\',
						\''.$this->col('id').'\')"><span class="glyphicon glyphicon-remove"></span></a>
						</td>
					</tr>
					';
		}
		$data.=$this->nothing_found($id, 11);
		return $data;
	}
	function get_tour_hotel($uniqueId)
	{
		$data=""; $count=1; $id="";
		$query=$this->selectData("tour_hotel", "uniqueId='".$uniqueId."' AND uniqueId!=''");
		while($this->fetcol=$this->fetchData($query))
		{
			$id=$this->col('id');
			$data.='
					<tr>
						<td>'.$count++.'</td>
						<td>'.$this->col('leadId').'</td>
						<td>'.$this->col('hotelPassName').'</td>
						<td>'.$this->col('hotelRoomType').'</td>
						<td>'.$this->col('hotelName').'</td>
						<td>'.$this->col('hotelSupp').'</td>
						<td>'.$this->col('hotelQty').'</td>
						<td>'.$this->col('hotelCheckin').'</td>
						<td>'.$this->col('hotelCheckout').'</td>
						<td>'.$this->col('hotelNights').'</td>
						<td>'.$this->col('hotelPp').'</td>
						<td>'.$this->col('hotelSp').'</td>
						<td>'.($this->col('hotelQty'))*($this->col('hotelNights'))*($this->col('hotelPp')).'</td>
						<td>'.($this->col('hotelQty'))*($this->col('hotelNights'))*($this->col('hotelSp')).'</td>
						<td>
							<a onClick="e_h_t(\''.$this->col('id').'\', \'edit_tour_hotel\')"><span class="glyphicon glyphicon-edit"></span></a> |
						<a onclick="del_tour(\'tourSale/ajax_call/getTour\', \'tourHotel\', \'tourHotelId\',
						\''.$this->col('id').'\')"><span class="glyphicon glyphicon-remove"></span></a>
						</td>
			
					</tr>
					';
		}
		$data.=$this->nothing_found($id, 15);
		return $data;
	}
	function get_tour_trans($uniqueId)
	{
		$data=""; $count=1; $id="";
		$query=$this->selectData("tour_transport", "uniqueId='".$uniqueId."' AND uniqueId!=''");
		while($this->fetcol=$this->fetchData($query))
		{
			$id=$this->col('id');
			$data.='<tr>
						<td>'.$count++.'</td>
						<td>'.$this->col('leadId').'</td>
						<td>'.$this->col('transPassName').'</td>
						<td>'.$this->col('transVehType').'</td>
						<td>'.$this->col('transSector').'</td>
						<td>'.$this->col('transQty').'</td>
						<td>'.$this->col('trans_date').'</td>
						<td>'.$this->col('transSupp').'</td>
						<td>'.$this->col('transPp').'</td>
						<td>'.$this->col('transSp').'</td>
						<td>'.$this->col('transQty')*($this->col('transPp')).'</td>
						<td>'.$this->col('transQty')*($this->col('transSp')).'</td>
						<td>
							<a onClick="e_t_trans(\''.$this->col('id').'\', \'edit_tour_trans\')">
							<span class="glyphicon glyphicon-edit"></span></a> |
						<a onclick="del_tour(\'tourSale/ajax_call/getTour\', \'tourTrans\', \'tourTransId\',
						\''.$this->col('id').'\')"><span class="glyphicon glyphicon-remove"></span></a>
						</td>
					</tr>';
		}
		$data.=$this->nothing_found($id, 15);
		return $data;
	}
	function get_tour_tour($uniqueId)
	{
		$data=""; $count=1; $id="";
		$query=$this->selectData("tour_tour","uniqueId='".$uniqueId."' AND uniqueId!=''");
		while($this->fetcol=$this->fetchData($query))
		{
			$id=$this->col('id');
			$data.='
					<tr>
						<td>'.$count++.'</td>
						<td>'.$this->col('leadId').'</td>
						<td>'.$this->col('tourPassName').'</td>
						<td>'.$this->col('tourName').'</td>
						<td>'.$this->col('tourQty').'</td>
						<td>'.$this->col('tourDate').'</td>
						<td>'.$this->col('tourSupp').'</td>
						<td>'.$this->col('tourPp').'</td>
						<td>'.$this->col('tourSp').'</td>
						<td>'.$this->col('tourQty')*($this->col('tourPp')).'</td>
						<td>'.$this->col('tourQty')*($this->col('tourSp')).'</td>
						<td>
							<a onClick="e_t_tour(\''.$this->col('id').'\', \'edit_tour_tour\')">
							<span class="glyphicon glyphicon-edit"></span></a> |
						<a onclick="del_tour(\'tourSale/ajax_call/getTour\', \'tourTour\', \'tourTourId\',
						\''.$this->col('id').'\')"><span class="glyphicon glyphicon-remove"></span></a>
						</td>
					</tr>
				';
		}
		$data.=$this->nothing_found($id, 15);
		return $data;
	}
	function get_tour_other($uniqueId)
	{
		$data=""; $count=1; $id="";
		$query=$this->selectData("tour_other","uniqueId='".$uniqueId."' AND uniqueId!=''");
		while($this->fetcol=$this->fetchData($query))
		{
			$id=$this->col('id');
			$data.='
					<tr>
						<td>'.$count++.'</td>
						<td>'.$this->col('leadId').'</td>
						<td>'.$this->col('otherPassName').'</td>
						<td>'.$this->col('serviceName').'</td>
						<td>'.$this->col('serDate').'</td>
						<td>'.$this->col('serSupp').'</td>
						<td>'.$this->col('serQty').'</td>
						<td>'.$this->col('serPp').'</td>
						<td>'.$this->col('serSp').'</td>
						<td>'.$this->col('serQty')*($this->col('serPp')).'</td>
						<td>'.$this->col('serQty')*($this->col('serSp')).'</td>
						<td>
							<a onClick="e_t_o(\''.$this->col('id').'\', \'edit_tour_other\')"><span class="glyphicon glyphicon-edit"></span></a> |
						<a onclick="del_tour(\'tourSale/ajax_call/getTour\', \'tourOther\', \'tourOtherId\',
						\''.$this->col('id').'\')"><span class="glyphicon glyphicon-remove"></span></a>
						</td>
					</tr>
				';
		}
		$data.=$this->nothing_found($id, 15);
		return $data;
	}
	//***********************************view tour sale invoce **********************************************
	function get_view_tvisa($uniqueId)
	{
		$data=""; $count=1; $id="";	
		$query=$this->selectData("tour_visa", "uniqueId='".$uniqueId."' AND uniqueId!=''");
		while($this->fetcol=$this->fetchData($query))
		{
			$id=$this->col('id');
			$data.= '<tr>
						<td>'.$count++.'</td>
						<td>'.$this->col('leadId').'</td>
						<td>'.$this->col('visaPassName').'</td>
						<td>'.$this->col('visaType').'</td>
						<td>'.$this->col('visaSuppName').'</td>
						<td>'.$this->col('visaQty').'</td>
						<td>'.$this->col('visaPp').'</td>
						<td>'.$this->col('visaSp').'</td>
						<td>'.($this->col('visaQty'))*($this->col('visaPp')).'</td>
						<td>'.($this->col('visaQty'))*($this->col('visaSp')).'</td>
						<td>
						<a onClick="e_v_t(\''.$this->col('id').'\', \'Vedit_tour_visa\')"><span class="glyphicon glyphicon-edit"></span></a> |
						<a onclick="del_v_tour(\'tourSale/ajax_call/getTour\', \'tourVisa\', \'VtourVisaId\',
						\''.$this->col('id').'\')"><span class="glyphicon glyphicon-remove"></span></a>
						</td>
					</tr>
					';
		}
		$data.=$this->nothing_found($id, 11);
		return $data;
	}
	function get_view_tour_hotel($uniqueId)
	{
		$data=""; $count=1; $id="";
		$query=$this->selectData("tour_hotel", "uniqueId='".$uniqueId."' AND uniqueId!=''");
		while($this->fetcol=$this->fetchData($query))
		{
			$id=$this->col('id');
			$data.='
					<tr>
						<td>'.$count++.'</td>
						<td>'.$this->col('leadId').'</td>
						<td>'.$this->col('hotelPassName').'</td>
						<td>'.$this->col('hotelRoomType').'</td>
						<td>'.$this->col('hotelName').'</td>
						<td>'.$this->col('hotelSupp').'</td>
						<td>'.$this->col('hotelQty').'</td>
						<td>'.$this->col('hotelCheckin').'</td>
						<td>'.$this->col('hotelCheckout').'</td>
						<td>'.$this->col('hotelNights').'</td>
						<td>'.$this->col('hotelPp').'</td>
						<td>'.$this->col('hotelSp').'</td>
						<td>'.($this->col('hotelQty'))*($this->col('hotelNights'))*($this->col('hotelPp')).'</td>
						<td>'.($this->col('hotelQty'))*($this->col('hotelNights'))*($this->col('hotelSp')).'</td>
						<td>
							<a onClick="e_h_t(\''.$this->col('id').'\', \'Vedit_tour_hotel\')">
							<span class="glyphicon glyphicon-edit"></span></a> |
						<a onclick="del_v_tour(\'tourSale/ajax_call/getTour\', \'tourHotel\', \'VtourHotelId\',
						\''.$this->col('id').'\')"><span class="glyphicon glyphicon-remove"></span></a>
						</td>
			
					</tr>
					';
		}
		$data.=$this->nothing_found($id, 15);
		return $data;
	}
	function get_view_tour_trans($uniqueId)
	{
		$data=""; $count=1; $id="";
		$query=$this->selectData("tour_transport", "uniqueId='".$uniqueId."' AND uniqueId!=''");
		while($this->fetcol=$this->fetchData($query))
		{
			$id=$this->col('id');
			$data.='<tr>
						<td>'.$count++.'</td>
						<td>'.$this->col('leadId').'</td>
						<td>'.$this->col('transPassName').'</td>
						<td>'.$this->col('transVehType').'</td>
						<td>'.$this->col('transSector').'</td>
						<td>'.$this->col('transQty').'</td>
						<td>'.$this->col('trans_date').'</td>
						<td>'.$this->col('transSupp').'</td>
						<td>'.$this->col('transPp').'</td>
						<td>'.$this->col('transSp').'</td>
						<td>'.$this->col('transQty')*($this->col('transPp')).'</td>
						<td>'.$this->col('transQty')*($this->col('transSp')).'</td>
						<td>
							<a onClick="e_t_trans(\''.$this->col('id').'\', \'Vedit_tour_trans\')">
							<span class="glyphicon glyphicon-edit"></span></a> |
						<a onclick="del_v_tour(\'tourSale/ajax_call/getTour\', \'tourTrans\', \'VtourTransId\',
						\''.$this->col('id').'\')"><span class="glyphicon glyphicon-remove"></span></a>
						</td>
					</tr>';
		}
		$data.=$this->nothing_found($id, 15);
		return $data;
	}
	function get_view_tour_tour($uniqueId)
	{
		$data=""; $count=1; $id="";
		$query=$this->selectData("tour_tour","uniqueId='".$uniqueId."' AND uniqueId!=''");
		while($this->fetcol=$this->fetchData($query))
		{
			$id=$this->col('id');
			$data.='
					<tr>
						<td>'.$count++.'</td>
						<td>'.$this->col('leadId').'</td>
						<td>'.$this->col('tourPassName').'</td>
						<td>'.$this->col('tourName').'</td>
						<td>'.$this->col('tourQty').'</td>
						<td>'.$this->col('tourDate').'</td>
						<td>'.$this->col('tourSupp').'</td>
						<td>'.$this->col('tourPp').'</td>
						<td>'.$this->col('tourSp').'</td>
						<td>'.$this->col('tourQty')*($this->col('tourPp')).'</td>
						<td>'.$this->col('tourQty')*($this->col('tourSp')).'</td>
						<td>
							<a onClick="e_t_tour(\''.$this->col('id').'\', \'Vedit_tour_tour\')">
							<span class="glyphicon glyphicon-edit"></span></a> |
						<a onclick="del_v_tour(\'tourSale/ajax_call/getTour\', \'tourTour\', \'VtourTourId\',
						\''.$this->col('id').'\')"><span class="glyphicon glyphicon-remove"></span></a>
						</td>
					</tr>
				';
		}
		$data.=$this->nothing_found($id, 15);
		return $data;
	}
	function get_view_tour_other($uniqueId)
	{
		$data=""; $count=1; $id="";
		$query=$this->selectData("tour_other","uniqueId='".$uniqueId."' AND uniqueId!=''");
		while($this->fetcol=$this->fetchData($query))
		{
			$id=$this->col('id');
			$data.='
					<tr>
						<td>'.$count++.'</td>
						<td>'.$this->col('leadId').'</td>
						<td>'.$this->col('otherPassName').'</td>
						<td>'.$this->col('serviceName').'</td>
						<td>'.$this->col('serDate').'</td>
						<td>'.$this->col('serSupp').'</td>
						<td>'.$this->col('serQty').'</td>
						<td>'.$this->col('serPp').'</td>
						<td>'.$this->col('serSp').'</td>
						<td>'.$this->col('serQty')*($this->col('serPp')).'</td>
						<td>'.$this->col('serQty')*($this->col('serSp')).'</td>
						<td>
							<a onClick="e_t_o(\''.$this->col('id').'\', \'Vedit_tour_other\')"><span class="glyphicon glyphicon-edit"></span></a> |
						<a onclick="del_v_tour(\'tourSale/ajax_call/getTour\', \'tourOther\', \'VtourOtherId\',
						\''.$this->col('id').'\')"><span class="glyphicon glyphicon-remove"></span></a>
						</td>
					</tr>
				';
		}
		$data.=$this->nothing_found($id, 15);
		return $data;
	}
	// total tour sale invoice
	function sum_t_t_inv($leadId)
	{
		$tv=0;$th=0;$ttrans=0;$ttour=0;$tother=0;
		$query=$this->selectData("tour_sale_invoice", "leadId=".$leadId."");
		//$uId=$this->u_value("tour_sale_invoice", "uniqueId", "");
		while($this->fetcol=$this->fetchData($query))
		{
			$tv+=$this->u_total("tour_visa", "t_visaSp", "uniqueId='".$this->col('uniqueId')."'");
			$th+=$this->u_total("tour_hotel", "t_hotelSp", "uniqueId='".$this->col('uniqueId')."'");
			$ttrans+=$this->u_total("tour_transport", "t_transSp", "uniqueId='".$this->col('uniqueId')."'");
			$ttour+=$this->u_total("tour_tour", "t_tourSp", "uniqueId='".$this->col('uniqueId')."'");
			$tother+=$this->u_total("tour_other", "t_serSp", "uniqueId='".$this->col('uniqueId')."'");
		}
		$total=$tv+$th+$ttrans+$ttour+$tother;
		return $total;
	}
	function tour_det_inv($uniqueId)
	{
		$data=""; $i=1; $j=1; $k=1; $l=1;
		$total_visa="";$total_hotel="";$total_trans=""; $total_tour="";$total_ser="";
		//Fetch email in det tour visa
		$data.='
				<div style="width:100%; border: 1px solid gainsboro;border-radius: 4px;padding: 10px;" class="print_data">';
				if($this->u_total('tour_visa', 'visaSp', 'uniqueId="'.$uniqueId.'"')>0)
				{
		$data.='
				<h4 style="font-family:Trebuchet MS, Arial, Helvetica, Verdana, sans-serif">Visa:</h4>
				<table border="1" style="border:1px solid lightgray; border-collapse: collapse; font-family:Trebuchet MS, Arial, Helvetica, Verdana, sans-serif; font-size:12px;" width="90%" cellpadding="5">
					<thead>
						<tr style="background:#cdcccc;">
							<th style="border:1px solid lightgray;">#</th>
							<th style="border:1px solid lightgray">Passenger Name</th>
							<th style="border:1px solid lightgray">Visa Type</th>
							<th style="border:1px solid lightgray">Qty</th>
							<th style="border:1px solid lightgray">Price</th>
							<th style="border:1px solid lightgray">Total Price</th>
						</tr>';
						// tour visa 
						$q_tv=$this->selectData("tour_visa", "uniqueId='".$uniqueId."'");
						while($this->fetcol=$this->fetchData($q_tv))
						{
							$data.='<tr style="border:1px solid lightgray; text-align:center;">
									<td style="border:1px solid lightgray">'.$i++.'</td>
									<td style="border:1px solid lightgray">'.$this->col('visaPassName').'</td>
									<td style="border:1px solid lightgray">'.$this->col('visaType').'</td>
									<td style="border:1px solid lightgray">'.$this->col('visaQty').'</td>
									<td style="border:1px solid lightgray">'.$this->col('visaSp').'</td>
									<td style="border:1px solid lightgray">'.($this->col('visaQty'))*($this->col('visaSp')).'</td>
									</tr>
								';
								$total_visa+=($this->col('visaQty'))*($this->col('visaSp'));
						 $data.='
						 		<tr style="border:1px solid lightgray">
									<td colspan="6">'.$this->col('visa_desc').'</td>
								</tr>
						 	';
						}
				$data.='
					</thead>
				</table>';
				}
				if($this->u_total('tour_hotel', 'hotelSp', 'uniqueId="'.$uniqueId.'"')>0)
				{
				$data.='
				<h4 style="font-family:Trebuchet MS, Arial, Helvetica, Verdana, sans-serif">Hotel:</h4>
				<table border="1" style="border:1px solid lightgray; border-collapse: collapse; font-size:12px; font-family:Trebuchet MS, Arial, Helvetica, Verdana, sans-serif" width="90%" cellpadding="5">
					<thead>
						<tr style="border:1px solid lightgray;background:#cdcccc;">
							<th style="border:1px solid lightgray">#</th>
							<th style="border:1px solid lightgray">Passenger Name</th>
							<th style="border:1px solid lightgray">Room Type</th>
							<th style="border:1px solid lightgray">Hotel Name</th>
							<th style="border:1px solid lightgray">Qty</th>
							<th style="border:1px solid lightgray">Check In</th>
							<th style="border:1px solid lightgray">Check Out</th>
							<th style="border:1px solid lightgray">Nights</th>
							<th style="border:1px solid lightgray">Price</th>
							<th style="border:1px solid lightgray">Total Price</th>
						</tr>';
						//tour hotel 
						$q_th=$q_tv=$this->selectData("tour_hotel", "uniqueId='".$uniqueId."'");
						while($this->fetcol=$this->fetchData($q_th))
						{
							$data.='
									<tr style="border:1px solid lightgray; text-align:center;">
										<td style="border:1px solid lightgray">'.$j++.'</td>
										<td style="border:1px solid lightgray">'.$this->col('hotelPassName').'</td>
										<td style="border:1px solid lightgray">'.$this->col('hotelRoomType').'</td>
										<td style="border:1px solid lightgray">'.$this->col('hotelName').'</td>
										<td style="border:1px solid lightgray">'.$this->col('hotelQty').'</td>
										<td style="border:1px solid lightgray">'.$this->col('hotelCheckin').'</td>
										<td style="border:1px solid lightgray">'.$this->col('hotelCheckout').'</td>
										<td style="border:1px solid lightgray">'.$this->col('hotelNights').'</td>
										<td style="border:1px solid lightgray">'.$this->col('hotelSp').'</td>
										<td style="border:1px solid lightgray">'.($this->col('hotelQty'))*($this->col('hotelNights'))*($this->col('hotelSp')).'</td>
									</tr>
								';
								$total_hotel+=($this->col('hotelQty'))*($this->col('hotelNights'))*($this->col('hotelSp'));
								$data.='
						 		<tr style="border:1px solid lightgray">
									<td colspan="10" style="border:1px solid lightgray">'.$this->col('hotel_desc').'</td>
								</tr>
						 	';
						}
				$data.='		
					</thead>
				</table>';
				}
				if($this->u_total('tour_transport', 'transSp', 'uniqueId="'.$uniqueId.'"')>0)
				{
				$data.='
				<h4 style="font-family:Trebuchet MS, Arial, Helvetica, Verdana, sans-serif">Transport:</h4>
				<table border="1" style="border:1px solid lightgray; border-collapse: collapse; font-size:12px; font-family:Trebuchet MS, Arial, Helvetica, Verdana, sans-serif" width="90%" cellpadding="5">
					<thead>
						<tr style="border:1px solid lightgray;background:#cdcccc;">
							<th style="border:1px solid lightgray">#</th>
							<th style="border:1px solid lightgray">Passenger Name</th>
							<th style="border:1px solid lightgray">Vehicle Type</th>
							<th style="border:1px solid lightgray">Sector</th>
							<th style="border:1px solid lightgray">Time</th>
							<th style="border:1px solid lightgray">Qty</th>
							<th style="border:1px solid lightgray">Price</th>
							<th style="border:1px solid lightgray">Total Price</th>
						</tr>';
						//tour tranport
						$q_tt=$this->selectData("tour_transport", "uniqueId='".$uniqueId."'");
						while($this->fetcol=$this->fetchData($q_tt))
						{
							$data.='
									<tr style="border:1px solid lightgray; text-align:center;">
										<td style="border:1px solid lightgray">'.$k++.'</td>
										<td style="border:1px solid lightgray">'.$this->col('transPassName').'</td>
										<td style="border:1px solid lightgray">'.$this->col('transVehType').'</td>
										<td style="border:1px solid lightgray">'.$this->col('transSector').'</td>
										<td style="border:1px solid lightgray">'.$this->col('transQty').'</td>
										<td style="border:1px solid lightgray">'.$this->col('trans_date').'</td>
										<td style="border:1px solid lightgray">'.$this->col('transSp').'</td>
										<td style="border:1px solid lightgray">'.$this->col('transQty')*($this->col('transSp')).'</td>
									</tr>
								';
							$total_trans+=$this->col('transQty')*($this->col('transSp'));
							$data.='
						 		<tr style="border:1px solid lightgray">
									<td colspan="8" style="border:1px solid lightgray">'.$this->col('trans_desc').'</td>
								</tr>';
						}
					$data.='
					</thead>
				</table>';
				}
				if($this->u_total('tour_tour', 'tourSp', 'uniqueId="'.$uniqueId.'"')>0)
				{
				$data.='
				<h4 style="font-family:Trebuchet MS, Arial, Helvetica, Verdana, sans-serif">Tour:</h4>
				<table border="1" style="border:1px solid lightgray; border-collapse: collapse;font-size:12px; font-family:Trebuchet MS, Arial, Helvetica, Verdana, sans-serif" width="90%" cellpadding="5">
					<thead>
						<tr style="border:1px solid lightgray;background:#cdcccc;">
							<th style="border:1px solid lightgray">#</th>
							<th style="border:1px solid lightgray">Passenger Name</th>
							<th style="border:1px solid lightgray">Tour Name</th>
							<th style="border:1px solid lightgray">Time</th>
							<th style="border:1px solid lightgray">Qty</th>
							<th style="border:1px solid lightgray">Price</th>
							<th style="border:1px solid lightgray">Total Price</th>
						</tr>';
						//tour plan
						$q_ttour=$this->selectData("tour_tour", "uniqueId='".$uniqueId."'");
						while($this->fetcol=$this->fetchData($q_ttour))
						{
							$data.='
									<tr style="border:1px solid lightgray; text-align:center">
										<td style="border:1px solid lightgray">'.$k++.'</td>
										<td style="border:1px solid lightgray">'.$this->col('tourPassName').'</td>
										<td style="border:1px solid lightgray">'.$this->col('tourName').'</td>
										<td style="border:1px solid lightgray">'.$this->col('tourDate').'</td>
										<td style="border:1px solid lightgray">'.$this->col('tourQty').'</td>
										<td style="border:1px solid lightgray">'.$this->col('tourSp').'</td>
										<td style="border:1px solid lightgray">'.$this->col('tourQty')*($this->col('tourSp')).'</td>
									</tr>
									';
							$total_tour+=$this->col('tourQty')*($this->col('tourSp'));
							$data.='
						 		<tr style="border:1px solid lightgray">
									<td colspan="7" style="border:1px solid lightgray">'.$this->col('tour_desc').'</td>
								</tr>';
						}
				$data.='
					</thead>
				</table>';
				}
				if($this->u_total('tour_other', 'serSp', 'uniqueId="'.$uniqueId.'"')>0)
				{
				$data.='
				<h4 style="font-family:Trebuchet MS, Arial, Helvetica, Verdana, sans-serif">Other Services:</h4>';
				}
				$data.='<table border="1" style="border:1px solid lightgray; border-collapse: collapse;font-size:12px; font-family:Trebuchet MS, Arial, Helvetica, Verdana, sans-serif" width="90%" cellpadding="5">';
				if($this->u_total('tour_other', 'serSp', 'uniqueId="'.$uniqueId.'"')>0)
				{
					$data.='
					<thead>
						<tr style="border:1px solid lightgray; text-align:center;background:#cdcccc;">
							<th style="border:1px solid lightgray">#</th>
							<th style="border:1px solid lightgray">Passenger Name</th>
							<th style="border:1px solid lightgray">Service Name</th>
							<th style="border:1px solid lightgray">Time</th>
							<th style="border:1px solid lightgray">Qty</th>
							<th style="border:1px solid lightgray">Price</th>
							<th style="border:1px solid lightgray">Total Price</th>
						</tr>';
						//tour other services
						$q_to=$this->selectData("tour_other", "uniqueId='".$uniqueId."'");
						while($this->fetcol=$this->fetchData($q_to))
						{
							$data.='
									<tr style="border:1px solid lightgray; text-align:center">
										<td style="border:1px solid lightgray">'.$l++.'</td>
										<td style="border:1px solid lightgray">'.$this->col('otherPassName').'</td>
										<td style="border:1px solid lightgray">'.$this->col('serviceName').'</td>
										<td style="border:1px solid lightgray">'.$this->col('serDate').'</td>
										<td style="border:1px solid lightgray">'.$this->col('serSupp').'</td>
										<td style="border:1px solid lightgray">'.$this->col('serSp').'</td>
										<td style="border:1px solid lightgray">'.$this->col('serQty')*($this->col('serSp')).'</td>
									</tr>
								';
								$total_ser+=$this->col('serQty')*($this->col('serSp'));
								$data.='
						 		<tr style="border:1px solid lightgray">
									<td colspan="7" style="border:1px solid lightgray">'.$this->col('other_desc').'</td>
								</tr>';
						}
				$data.='
					</thead>';
	}
					$data.='
						<tr style="font-family:Trebuchet MS, Arial, Helvetica, Verdana, sans-serif">
							<td colspan="6" align="right" style="font-size:20px; text-align:right;">
							Invoice Net
							</td>
							<td style="font-size:20px; text-align:right">
								'.(number_format($total_visa+$total_hotel+$total_trans+$total_tour+$total_ser)).'
								</td>
						</tr>
				</table>';
				$data.='
				<br>
				</div>
			';
			
			return $data;
	}
	function tour_summery_inv($uniqueId)
	{
		$data="";
		$data.="
		<style>
			div{ font-family:cursive;}
		</style>";
		$total_visa="";$total_hotel="";$total_trans=""; $total_tour="";$total_ser="";
		$data.='
				<div style="width:90%; margin:0 auto; border: 1px solid gainsboro;border-radius: 4px;padding: 10px; min-height:700px;" class="print_data">
					<div style="width:50%; float:left">Invoice Date: '.$this->today().'</div>
					<div style="width:50%; float:right; text-align:right">Family Head: 
					'.$this->u_value("tour_sale_invoice", "f_head_name", "uniqueId='".$uniqueId."'").'</div>';
					if($this->u_total('tour_visa', 'visaSp', 'uniqueId="'.$uniqueId.'"')>0)
					{
					$data.='
					<h4>Visa:</h4>
					<table width="100%" style="border-collapse:collapse; font-family:cursive">
						<tr style="background:#cdcccc;">
							<td width="20%">Passenger Name</td>
							<td width="10%">Visa Type</td>
							<td align="center">Remarks</td>
						</tr>';
						$q_tv=$this->selectData("tour_visa", "uniqueId='".$uniqueId."'");
						while($this->fetcol=$this->fetchData($q_tv))
						{
							$data.='
									<tr>
										<td>'.$this->col('visaPassName').'</td>
										<td>'.$this->col('visaType').'</td>
										<td align="center">'.$this->col('visa_desc').' </td>
									</tr>
								';
								$total_visa+=$this->col('visaQty')*($this->col('visaSp'));
						}
					$data.='	
					</table>
					<hr>';
					}
					if($this->u_total('tour_hotel', 'hotelSp', 'uniqueId="'.$uniqueId.'"')>0)
					{
					$data.='
					<h4>Hotel:</h4>
					<table width="100%" style="border-collapse:collapse; font-family:cursive">
						<tr style="background:#cdcccc;">
							<td width="20%">Passenger Name</td>
							<td width="15%">Room Name</td>
							<td align="center">Remarks</td>
						</tr>';
						$q_tv=$this->selectData("tour_hotel", "uniqueId='".$uniqueId."'");
						while($this->fetcol=$this->fetchData($q_tv))
						{
							$data.='
									<tr>
										<td>'.$this->col('hotelPassName').'</td>
										<td>'.$this->col('hotelName').'</td>
										<td align="center">
										'.$this->col('hotel_desc').'
										</td>
									</tr>
								';
								$total_hotel+=$this->col('hotelQty')*($this->col('hotelSp')*($this->col('hotelNights')));
						}
					$data.='	
					</table>
					<hr>';
					}
					if($this->u_total('tour_transport', 'transSp', 'uniqueId="'.$uniqueId.'"')>0)
					{
					$data.='
					<h4>Transport:</h4>
					<table width="100%" style="border-collapse:collapse; font-family:cursive">
						<tr style="background:#cdcccc;">
							<td width="20%">Passenger Name</td>
							<td width="15%">Vehicle Type</td>
							<td align="center">Remarks</td>
						</tr>';
						$q_tv=$this->selectData("tour_transport", "uniqueId='".$uniqueId."'");
						while($this->fetcol=$this->fetchData($q_tv))
						{
							$data.='
									<tr>
										<td>'.$this->col('transPassName').'</td>
										<td>'.$this->col('transVehType').'</td>
										<td align="center">
										'.$this->col('trans_desc').'
										</td>
									</tr>
								';
								$total_trans+=$this->col('transQty')*$this->col('transSp');
						}
					$data.='	
					</table>
					<hr>';
					}
					if($this->u_total('tour_tour', 'tourSp', 'uniqueId="'.$uniqueId.'"')>0)
					{
					$data.='
					<h4>Tour:</h4>
					<table width="100%" style="border-collapse:collapse; font-family:cursive">
						<tr style="background:#cdcccc;">
							<td width="20%">Passenger Name</td>
							<td width="15%">Tour Name</td>
							<td align="center">Remarks</td>
						</tr>';
						$q_tv=$this->selectData("tour_tour", "uniqueId='".$uniqueId."'");
						while($this->fetcol=$this->fetchData($q_tv))
						{
							$data.='
									<tr>
										<td>'.$this->col('tourPassName').'</td>
										<td>'.$this->col('tourName').'</td>
										<td align="center">
										'.$this->col('tour_desc').'
										</td>
									</tr>
								';
								$total_tour+=$this->col('tourQty')*$this->col('tourSp');
						}
					$data.='	
					</table>
					<hr>';
					}
					if($this->u_total('tour_other', 'serSp', 'uniqueId="'.$uniqueId.'"')>0)
					{
					$data.='
					<h4>Other:</h4>
					<table width="100%" style="border-collapse:collapse; font-family:cursive">
						<tr style="background:#cdcccc;">
							<td width="20%">Passenger Name</td>
							<td width="15%">Service Name</td>
							<td align="center">Remarks</td>
						</tr>';
						$q_tv=$this->selectData("tour_other", "uniqueId='".$uniqueId."'");
						while($this->fetcol=$this->fetchData($q_tv))
						{
							$data.='
									<tr>
										<td>'.$this->col('otherPassName').'</td>
										<td>'.$this->col('serviceName').'</td>
										<td align="center">
										'.$this->col('other_desc').'</td>
									</tr>
								';
								$total_ser+=$this->col('serQty')*$this->col('serSp');
						}
					$data.='	
					</table>
					<hr>';
					}
					$data.='
					<div style="float:right;">Invoice Net: '.($total_visa+$total_hotel+$total_trans+$total_tour+$total_ser).'</div>
				</div>
			';
			return $data;
	}
	// Tour sale invoice email 
function tour_inv_email($subject, $email, $descr, $data)
{
	$branch_name=$this->u_value("branches", "branch_name", "branch_id=".$_SESSION['branch_id']."");
	$branch_address=$this->u_value("branches", "address", "branch_id=".$_SESSION['branch_id']."");
	$phone_line=$this->u_value("branches", "phone_line", "status='active' AND branch_id=".$_SESSION['branch_id']."");
	$mobile=$this->u_value("branches", "mobile", "status='active' AND branch_id=".$_SESSION['branch_id']."");
	$web=$this->u_value("branches", "web", "status='active' AND branch_id=".$_SESSION['branch_id']."");
	$logo=$this->u_value("branches", "branch_logo", "branch_id=".$_SESSION['branch_id']."");
	$Efrom =$this->u_value("branches", "branch_email", "branch_id=".$_SESSION['branch_id']."");
	$sign_log=$this->u_value("branches", "sign_logo", "status='active' AND branch_id=".$_SESSION['branch_id']."");
	$Emessage = '<html><body>';
	$Emessage.='<div style="width:100%; margin:auto;">';
	$Emessage.='<div style="float:left;"><img src="branch_logo/'.$logo.' ?>" /></div>';
	$Emessage.='<div style="float:left; text-align:center; width:80%;">
    			<h2>'.$this->u_value("branches", "branch_name", "branch_id=".$_SESSION['branch_id']."").'</h2>
        		<p>'.$this->u_value("branches", "address", "branch_id=".$_SESSION['branch_id']."").'</p>
    			</div>';
	$Emessage.='<div style="clear:both;"></div><hr>';
	$Emessage.=$data;
	$Emessage.='<p style="font-size:20px;">This is Electronic Tour Invoice</p>';				
	$Emessage.='</div>';
	$Emessage.="<p style='color:#548dd4; width:100%; margin:auto;'>".nl2br('Regards & Thanks<br>
				'.$branch_name.' | '.$branch_address.' | Office: '.$phone_line.' | Mob: '.$mobile.' | 
				<a href="http://'.$web.'/" target="_blank">Visit Web Site</a>
				')."		
				</p>
				<div style='width:100%; margin:auto;'><img src='http://www.toursvision.com/crmv2/branch_logo/".$sign_log."'>";
	$Emessage.='</html></body>';
	$Eto =$email;
	$Esubject =$subject;
	$Eheaders ="From: \"Sales\" <$Efrom>\r\n";
	$Eheaders .= "Reply-To:".$Efrom."\r\n";
	$Eheaders .= "MIME-Version: 1.0\r\n";
	$Eheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	return mail($Eto, $Esubject, $Emessage, $Eheaders);
}
	function acc_tour_inv_det($uniqueId)
	{
		
		$data=""; $i=1; $j=1; $k=1; $l=1;
		$total_visa="";$total_hotel="";$total_trans=""; $total_tour="";$total_ser="";
		//Fetch email in det tour visa
		$data.='
				<span><strong>Spo:</strong> '.$this->u_value("user", "name", "id=".$this->u_value('tour_sale_invoice', 'spo', 'uniqueId="'.$uniqueId.'"')."").'</span>
				<div style="width:100%; border: 1px solid gainsboro;border-radius: 4px;padding: 10px;" class="print_data">
				<h4 style="font-family:Trebuchet MS, Arial, Helvetica, Verdana, sans-serif">Visa:</h4>
				<table border="1" style="border:1px solid lightgray; border-collapse: collapse; font-family:Trebuchet MS, Arial, Helvetica, Verdana, sans-serif; font-size:12px;" width="90%" cellpadding="5">
					<thead>
						<tr style="background:#cdcccc; text-align:center;">
							<th style="border:1px solid lightgray;">#</th>
							<th style="border:1px solid lightgray">Passenger Name</th>
							<th>Supplier Name</th>
							<th style="border:1px solid lightgray">Visa Type</th>
							<th style="border:1px solid lightgray">Qty</th>
							<th style="border:1px solid lightgray">
								<span data-toggle="tooltip" data-placement="top"  data-original-title="Purchase Price">P.P</span>
							</th>
							<th style="border:1px solid lightgray">
								<span data-toggle="tooltip" data-placement="top"  data-original-title="Sale Price">S.P</span>
							</th>
							<th style="border:1px solid lightgray">
								<span <span data-toggle="tooltip" data-placement="top"  data-original-title="Total Purchase Price">T.P.P</span>
							</th>
							<th style="border:1px solid lightgray">
								<span <span data-toggle="tooltip" data-placement="top"  data-original-title="Total Sale Price">
								T.S.P
								</span>
							</th>
						</tr>';
						// tour visa 
						$q_tv=$this->selectData("tour_visa", "uniqueId='".$uniqueId."'");
						while($this->fetcol=$this->fetchData($q_tv))
						{
							$data.='<tr style="border:1px solid lightgray; text-align:center;">
									<td style="border:1px solid lightgray">'.$i++.'</td>
									<td style="border:1px solid lightgray">'.$this->col('visaPassName').'</td>
									<td style="border:1px solid lightgray">'.$this->col('visaSuppName').'</td>
									<td style="border:1px solid lightgray">'.$this->col('visaType').'</td>
									<td style="border:1px solid lightgray">'.$this->col('visaQty').'</td>
									<td style="border:1px solid lightgray">'.$this->col('visaPp').'</td>
									<td style="border:1px solid lightgray">'.$this->col('visaSp').'</td>
									<td style="border:1px solid lightgray">'.($this->col('visaQty'))*($this->col('visaPp')).'</td>
									<td style="border:1px solid lightgray">'.($this->col('visaQty'))*($this->col('visaSp')).'</td>
									</tr>
								';
								$total_visa+=($this->col('visaQty'))*($this->col('visaSp'));
						 $data.='
						 		<tr style="border:1px solid lightgray">
									<td colspan="9">'.$this->col('visa_desc').'</td>
								</tr>
						 	';
						}
				$data.='
					</thead>
				</table>
				<h4 style="font-family:Trebuchet MS, Arial, Helvetica, Verdana, sans-serif">Hotel:</h4>
				<table border="1" style="border:1px solid lightgray; border-collapse: collapse; font-size:12px; font-family:Trebuchet MS, Arial, Helvetica, Verdana, sans-serif" width="90%" cellpadding="5">
					<thead>
						<tr style="border:1px solid lightgray;background:#cdcccc;">
						   <th style="border:1px solid lightgray">#</th>
						   <th style="border:1px solid lightgray">Passenger Name</th>
						   <th>Supplier Name</th>
						   <th style="border:1px solid lightgray">Room Type</th>
						   <th style="border:1px solid lightgray">Hotel Name</th>
						   <th style="border:1px solid lightgray">Qty</th>
						   <th style="border:1px solid lightgray">Check In</th>
						   <th style="border:1px solid lightgray">Check Out</th>
						   <th style="border:1px solid lightgray">Nights</th>
						   <th style="border:1px solid lightgray">
							<span data-toggle="tooltip" data-placement="top"  data-original-title="Purchase Price">P.P</span>
						  </th>
						   <th style="border:1px solid lightgray">
						   <span data-toggle="tooltip" data-placement="top"  data-original-title="Sale Price">S.P</span>
						   </th>
						   <th style="border:1px solid lightgray">
						   <span data-toggle="tooltip" data-placement="top"  data-original-title="Total Purchase Price">T.P.P</span>
						   </th>
						   <th style="border:1px solid lightgray">
						   <span data-toggle="tooltip" data-placement="top"  data-original-title="Total Sale Price">T.S.P</span>
						   </th>
						   
						</tr>';
						//tour hotel 
						$q_th=$q_tv=$this->selectData("tour_hotel", "uniqueId='".$uniqueId."'");
						while($this->fetcol=$this->fetchData($q_th))
						{
							$data.='
									<tr style="border:1px solid lightgray; text-align:center;">
										<td style="border:1px solid lightgray">'.$j++.'</td>
										<td style="border:1px solid lightgray">'.$this->col('hotelPassName').'</td>
										<td style="border:1px solid lightgray">'.$this->col('hotelSupp').'</td>
										<td style="border:1px solid lightgray">'.$this->col('hotelRoomType').'</td>
										<td style="border:1px solid lightgray">'.$this->col('hotelName').'</td>
										<td style="border:1px solid lightgray">'.$this->col('hotelQty').'</td>
										<td style="border:1px solid lightgray">'.$this->col('hotelCheckin').'</td>
										<td style="border:1px solid lightgray">'.$this->col('hotelCheckout').'</td>
										<td style="border:1px solid lightgray">'.$this->col('hotelNights').'</td>
										<td style="border:1px solid lightgray">'.$this->col('hotelPp').'</td>
										<td style="border:1px solid lightgray">'.$this->col('hotelSp').'</td>
										<td style="border:1px solid lightgray">'.($this->col('hotelQty'))*($this->col('hotelNights'))*($this->col('hotelPp')).'</td>
										<td style="border:1px solid lightgray">'.($this->col('hotelQty'))*($this->col('hotelNights'))*($this->col('hotelSp')).'</td>
									</tr>
								';
								$total_hotel+=($this->col('hotelQty'))*($this->col('hotelNights'))*($this->col('hotelSp'));
								$data.='
						 		<tr style="border:1px solid lightgray">
									<td colspan="13" style="border:1px solid lightgray">'.$this->col('hotel_desc').'</td>
								</tr>
						 	';
						}
				$data.='		
					</thead>
				</table>
				<h4 style="font-family:Trebuchet MS, Arial, Helvetica, Verdana, sans-serif">Transport:</h4>
				<table border="1" style="border:1px solid lightgray; border-collapse: collapse; font-size:12px; font-family:Trebuchet MS, Arial, Helvetica, Verdana, sans-serif" width="90%" cellpadding="5">
					<thead>
						<tr style="border:1px solid lightgray;background:#cdcccc;">
							<th style="border:1px solid lightgray">#</th>
							<th style="border:1px solid lightgray">Passenger Name</th>
							<th>Supplier Name</th>
							<th style="border:1px solid lightgray">Vehicle Type</th>
							<th style="border:1px solid lightgray">Sector</th>
							<th style="border:1px solid lightgray">Time</th>
							<th style="border:1px solid lightgray">Qty</th>
							<th style="border:1px solid lightgray">
							<span data-toggle="tooltip" data-placement="top"  data-original-title="Purchase Price">P.P</span></th>
							<th style="border:1px solid lightgray">
							<span data-toggle="tooltip" data-placement="top"  data-original-title="Sale Price">S.P</span></th>
							<th style="border:1px solid lightgray">
							<span data-toggle="tooltip" data-placement="top"  data-original-title="Total Purchase Price">T.P.P</span></th>
							<th style="border:1px solid lightgray">
							<span data-toggle="tooltip" data-placement="top"  data-original-title="Total Sale Price">T.S.P</span></th>
						</tr>';
						//tour tranport
						$q_tt=$this->selectData("tour_transport", "uniqueId='".$uniqueId."'");
						while($this->fetcol=$this->fetchData($q_tt))
						{
							$data.='
									<tr style="border:1px solid lightgray; text-align:center;">
										<td style="border:1px solid lightgray">'.$k++.'</td>
										<td style="border:1px solid lightgray">'.$this->col('transPassName').'</td>
										<td style="border:1px solid lightgray">'.$this->col('transSupp').'</td>
										<td style="border:1px solid lightgray">'.$this->col('transVehType').'</td>
										<td style="border:1px solid lightgray">'.$this->col('transSector').'</td>
										<td style="border:1px solid lightgray">
										'.$this->col('trans_date').' '.$this->col('hour').':'.$this->col('mintue').'
										</td>
										<td style="border:1px solid lightgray">'.$this->col('transQty').'</td>
										<td style="border:1px solid lightgray">'.$this->col('transPp').'</td>
										<td style="border:1px solid lightgray">'.$this->col('transSp').'</td>
										<td style="border:1px solid lightgray">'.$this->col('transQty')*($this->col('transPp')).'</td>
										<td style="border:1px solid lightgray">'.$this->col('transQty')*($this->col('transSp')).'</td>
								';
							$total_trans+=$this->col('transQty')*($this->col('transSp'));
							$data.='
						 		<tr style="border:1px solid lightgray">
									<td colspan="11" style="border:1px solid lightgray">'.$this->col('trans_desc').'</td>
								</tr>';
						}
					$data.='
					</thead>
				</table>
				<h4 style="font-family:Trebuchet MS, Arial, Helvetica, Verdana, sans-serif">Tour:</h4>
				<table border="1" style="border:1px solid lightgray; border-collapse: collapse;font-size:12px; font-family:Trebuchet MS, Arial, Helvetica, Verdana, sans-serif" width="90%" cellpadding="5">
					<thead>
						<tr style="border:1px solid lightgray;background:#cdcccc;">
							<th style="border:1px solid lightgray">#</th>
							<th style="border:1px solid lightgray">Passenger Name</th>
							<th>Supplier Name</th>
							<th style="border:1px solid lightgray">Tour Name</th>
							<th style="border:1px solid lightgray">Time</th>
							<th style="border:1px solid lightgray">Qty</th>
							<th style="border:1px solid lightgray">
							<span data-toggle="tooltip" data-placement="top"  data-original-title="Purchase Price">P.P</span>
							</th>
							<th style="border:1px solid lightgray">
							<span data-toggle="tooltip" data-placement="top"  data-original-title="Sale Price">S.P</span>
							</th>
							<th style="border:1px solid lightgray">
							<span data-toggle="tooltip" data-placement="top"  data-original-title="Total Purchase Price">T.P.P</span></th>
							<th style="border:1px solid lightgray">
							<span data-toggle="tooltip" data-placement="top"  data-original-title="Total Sale Price">T.S.P</span>
							</th>
						</tr>';
						//tour plan
						$q_ttour=$this->selectData("tour_tour", "uniqueId='".$uniqueId."'");
						while($this->fetcol=$this->fetchData($q_ttour))
						{
							$data.='
									<tr style="border:1px solid lightgray; text-align:center">
										<td style="border:1px solid lightgray">'.$k++.'</td>
										<td style="border:1px solid lightgray">'.$this->col('tourPassName').'</td>
										<td style="border:1px solid lightgray">'.$this->col('tourSupp').'</td>
										<td style="border:1px solid lightgray">'.$this->col('tourName').'</td>
										<td style="border:1px solid lightgray">'.$this->col('tourDate').'</td>
										<td style="border:1px solid lightgray">'.$this->col('tourQty').'</td>
										<td style="border:1px solid lightgray">'.$this->col('tourPp').'</td>
										<td style="border:1px solid lightgray">'.$this->col('tourSp').'</td>
										<td style="border:1px solid lightgray">'.$this->col('tourQty')*($this->col('tourPp')).'</td>
										<td style="border:1px solid lightgray">'.$this->col('tourQty')*($this->col('tourSp')).'</td>
									</tr>
									';
							$total_tour+=$this->col('tourQty')*($this->col('tourSp'));
							$data.='
						 		<tr style="border:1px solid lightgray">
									<td colspan="10" style="border:1px solid lightgray">'.$this->col('tour_desc').'</td>
								</tr>';
						}
				$data.='
					</thead>
				</table>
				<h4 style="font-family:Trebuchet MS, Arial, Helvetica, Verdana, sans-serif">Other Services:</h4>
				<table border="1" style="border:1px solid lightgray; border-collapse: collapse;font-size:12px; font-family:Trebuchet MS, Arial, Helvetica, Verdana, sans-serif" width="90%" cellpadding="5">
					<thead>
						<tr style="border:1px solid lightgray; text-align:center;background:#cdcccc;">
							<th style="border:1px solid lightgray">#</th>
							<th style="border:1px solid lightgray">Passenger Name</th>
							<th style="border:1px solid lightgray">Supplier Name</th>
							<th style="border:1px solid lightgray">Service Name</th>
							<th style="border:1px solid lightgray">Time</th>
							<th style="border:1px solid lightgray">Qty</th>
							<th style="border:1px solid lightgray">
							<span data-toggle="tooltip" data-placement="top"  data-original-title="Purchase Price">P.P</span></th>
							<th style="border:1px solid lightgray">
							<span data-toggle="tooltip" data-placement="top"  data-original-title="Sale Price">S.P</span></th>
							<th style="border:1px solid lightgray">
							<span data-toggle="tooltip" data-placement="top"  data-original-title="Total Purchase Price">T.P.P</span></th>
							<th style="border:1px solid lightgray">
							<span data-toggle="tooltip" data-placement="top"  data-original-title="Total Sale Price">T.S.P</span></th>
						</tr>';
						//tour other services
						$q_to=$this->selectData("tour_other", "uniqueId='".$uniqueId."'");
						while($this->fetcol=$this->fetchData($q_to))
						{
							$data.='
									<tr style="border:1px solid lightgray; text-align:center">
										<td style="border:1px solid lightgray">'.$l++.'</td>
										<td style="border:1px solid lightgray">'.$this->col('otherPassName').'</td>
										<td style="border:1px solid lightgray">'.$this->col('serSupp').'</td>
										<td style="border:1px solid lightgray">'.$this->col('serviceName').'</td>
										<td style="border:1px solid lightgray">'.$this->col('serDate').'</td>
										<td style="border:1px solid lightgray">'.$this->col('serQty').'</td>										
										<td style="border:1px solid lightgray">'.$this->col('serPp').'</td>
										<td style="border:1px solid lightgray">'.$this->col('serSp').'</td>
										<td style="border:1px solid lightgray">'.$this->col('serQty')*($this->col('serPp')).'</td>
										<td style="border:1px solid lightgray">'.$this->col('serQty')*($this->col('serSp')).'</td>
									</tr>
								';
								$total_ser+=$this->col('serQty')*($this->col('serSp'));
								$data.='
						 		<tr style="border:1px solid lightgray">
									<td colspan="10" style="border:1px solid lightgray">'.$this->col('other_desc').'</td>
								</tr>';
						}
				$data.='
					</thead>';
					$data.='
						<tr style="font-family:Trebuchet MS, Arial, Helvetica, Verdana, sans-serif">
							<td colspan="9" style="font-size:20px; text-align:right;">
							Invoice Net 
							</td>
							<td style="font-size:20px;">
								 '.(number_format($total_visa+$total_hotel+$total_trans+$total_tour+$total_ser)).'
								</td>
						</tr>
				</table>
				<br>
				</div>
			';
			
			return $data;
	
	}
}
?>