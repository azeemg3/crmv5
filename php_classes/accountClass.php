<?php
class account extends crm
{
	// Fetch all payment receipts
	function payment_receipt($result)
	{
		$data="";
		while($row=$result->fetch_assoc())
		{
		$data.='
			<tr>
				<td>'.$this->u_value("user", "name", "id=".$row['app_by']."").'</td>
				<td>
				'.((!empty($row['bank_id']))?''.$this->u_value('banks','bank_name','bank_id='.$row['bank_id'].'').'':"").'
				'.((empty($row['bank_id']))?'N/A':"").'
				</td>
				<td>'.$row['create_date'].'</td>
				<td>'.$row['payment_type'].'</td>
				<td>'.$row['recieve'].' C/O '.$row['refrence'].' RN:'.$row['id'].' LID:'.$row['leadId'].'</td>
				<td>'.$this->dr_balance($row['amount']).'</td>
				<td>N/A</td>
			</tr>		
			';
		}
		return $data;
	}
	function paymentIn($result)
	{
		$data="";
		while($row=$result->fetch_assoc())
		{
		$data.='
			<tr>
				<td>'.$this->u_value("user", "name", "id=".$row['userId']."").'</td>
				<td>
				'.((!empty($row['bank_id']))?''.$this->u_value('banks','bank_name','bank_id='.$row['bank_id'].'').'':"").'
				'.((empty($row['bank_id']))?'N/A':"").'
				</td>
				<td>'.$row['create_date'].'</td>
				<td>'.$this->fop_return($row['pay_type']).'</td>
				<td>'.$row['details'].'</td>
				<td>'.number_format($row['amount']).'</td>
				<td>N/A</td>
			</tr>	
			';
		}
		return $data;
	}
	function refundPayment($result)
	{
		$data="";
		while($row=$result->fetch_assoc())
		{
			$data.='
				<tr>
					<td>'.$this->u_value("user", "name", "id=".$row['app_by']."").'</td>
					<td>N/A</td>
					<td>'.$row['create_date'].'</td>
					<td>'.$row['payment_type'].'</td>
					<td>'.$row['payment_to'].' C/O '.$row['refrence'].' RN:'.$row['id'].' LID:'.$row['leadId'].'</td>
					<td>'.$this->cr_balance($row['amount']).'</td>
					<td>N/A</td>
				</tr>
				';
		}
		return $data;
	}
	function paymentOut($result)
	{
		$data="";
		while($row=$result->fetch_assoc())
		{
			$data.='
				<tr>
					<td>'.$this->u_value("user", "name", "id=".$row['userId']."").'</td>
					<td>'.$row['pay_date'].'</td>
					<td>'.$row['pay_type'].'</td>
					<td>'.$row['detail'].'</td>
					<td>'.number_format($row['amount']).'</td>
					<td>N/A</td>
				</tr>
				';
		}
		return $data;
	}
	function totalAmountIn($date)
	{
		$net=$this->u_total("payment_reciept", "amount", "status='approved' AND branch=".$_SESSION['branch_id']." AND
		 STR_TO_DATE(app_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$this->today()."', '%d-%m-%Y') AND 
STR_TO_DATE('".$this->today()."', '%d-%m-%Y ')")+$this->u_total("paymentin", "amount", "branch=".$_SESSION['branch_id']." AND STR_TO_DATE(create_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$this->today()."', '%d-%m-%Y') AND 
STR_TO_DATE('".$this->today()."', '%d-%m-%Y ')");
		return ($net);
	}
	function totalAmountOut($date)
	{
		$net=$this->u_total("refund_payment", "amount", "status='approved' AND branch=".$_SESSION['branch_id']." AND
		 STR_TO_DATE(app_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$this->today()."', '%d-%m-%Y') AND 
STR_TO_DATE('".$this->today()."', '%d-%m-%Y ')")+$this->u_total("paymentout", "amount", "branch=".$_SESSION['branch_id']." AND STR_TO_DATE(pay_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$this->today()."', '%d-%m-%Y') AND 
STR_TO_DATE('".$this->today()."', '%d-%m-%Y ')");
		return ($net);
	}
	function closing_balance($date)
	{
		date_default_timezone_set("Asia/Karachi");
		 $old_date =$date;
		$new_date = date("d-m-Y", strtotime($old_date) );
		$prev_date = date("d-m-Y", strtotime('-1 days', strtotime($new_date)) );
		$date1=$this->u_value("payment_reciept", "app_date", "status='approved' ORDER BY id ASC");
		$date2=$this->u_value("paymentin", "create_date", "1 ORDER BY id ASC LIMIT 1");
		$amountIn=$this->u_total("payment_reciept", "amount", "STR_TO_DATE(app_date, '%d-%m-%Y') BETWEEN  
		STR_TO_DATE('".date(''.$date1.'')."', '%d-%m-%Y') AND STR_TO_DATE('".$prev_date."', '%d-%m-%Y') AND status='approved'")
		+$this->u_total("paymentin", "amount", "STR_TO_DATE(create_date, '%d-%m-%Y') BETWEEN  
		STR_TO_DATE('".date(''.$date2.'')."', '%d-%m-%Y') AND STR_TO_DATE('".$prev_date."', '%d-%m-%Y')");
		//refund payment
		$amountOut=$this->u_total("refund_payment", "amount", "STR_TO_DATE(app_date, '%d-%m-%Y') BETWEEN  
		STR_TO_DATE('".date(''.$date1.'')."', '%d-%m-%Y') AND STR_TO_DATE('".$prev_date."', '%d-%m-%Y') AND status='approved'")+
		($this->u_total("paymentout", "amount", "STR_TO_DATE(pay_date, '%d-%m-%Y') BETWEEN  
		STR_TO_DATE('".date(''.$date1.'')."', '%d-%m-%Y') AND STR_TO_DATE('".$prev_date."', '%d-%m-%Y')"));
		$bal=($amountIn)-($amountOut);
		return $bal;
	}
	function day_closing_bal()
	{
		$bal=$this->closing_balance($this->today())+$this->totalAmountIn($this->today())-($this->totalAmountOut($this->today()));
		return $this->show_bal($bal);
	}
	function search_reports($t_search, $o_search, $ub_search, $tsInv_search)
		{
			$fileName = basename($_SERVER['SCRIPT_FILENAME'], ".php");
		// Fetch Sale report
		$q_t_s=$this->selectMultiData("user.id, user.name, add_sale.*", "add_sale INNER JOIN user ON add_sale.salesStaff=user.id"," $t_search ORDER BY add_sale.id DESC");
		//fetch other sale report
		$q_o_s=$this->selectMultiData("user.id, user.name, other_sale.*", "other_sale INNER JOIN user ON other_sale.salesStaff=user.id","$o_search ORDER BY other_sale.id DESC");
		// Fetch umra business
		$q_u_b=$this->selectMultiData("user.id AS userId, user.name, ub_client_details.*", "ub_client_details INNER JOIN user ON 
		ub_client_details.salesStaff=user.id","$ub_search");
		// fetch Tour sale invoice
		$q_thour_s_inv=$this->selectData("tour_sale_invoice", "$tsInv_search ORDER BY id DESC");
		$count=1;
		$data="";
		while($row=$q_t_s->fetch_assoc())
		{
			$psf=$row['recieved']-$row['netCost'];
			$data.='
				<tr>
					<td onclick="acc_ticket_view(\''.$row['id'].'\', \'ticket\', \''.$row['leadId'].'\')">'.$this->serial($count++).'</td>
					<td><a onclick="acc_lead_det('.$row['leadId'].')">'.$this->serial($row['leadId']).'</a></td>
					<td width="12%">'.$row['issue_date'].'</td>
					<td>'.$row['create_date'].'</td>
					<td>'.$row['airline_code'].'-'.$row['ticket_no'].'</td>
					<td class="ticket_sale'.$row['id'].'">
					'.((!empty($row['invoice_no']))?'<span class="inv_no" data-id="'.$row['id'].'" data-type="ticket_sale">'.$row['invoice_no'].'</span>':''.(($fileName=='get_daily_sale_rep' || $fileName=='print_dsr' ||
					 $fileName=='print'  && empty($row['invoice_no']))?'N/A':
					''.((empty($row['invoice_no']))?'<button type="button" class="btn btn-xs btn-info inv_no"
					data-id="'.$row['id'].'" data-type="ticket_sale">+</button>':"").'').'').'
					
					</td>
					<td>'.ucwords($row['gds'].'/'.$this->u_value('trans_acc', "trans_acc_name", "trans_acc_id=".$row['vendor_id']."")).'</td>
					<td>'.strtoupper($row['passName']).'</td>
					<td>'.strtoupper($row['sector']).'</td>
					<td>'.strtoupper($row['accDetails']).'</td>
					<td>'.strtoupper($row['name']).'</td>
					<td>'.number_format($row['recieved']).'</td>
					<td>'.number_format($row['netCost']).'</td>
					<td>'.number_format($psf).'</td>
				</tr>
				';
			}
		$data.='
			<tr>
				<td colspan="14"><h4>Other Sale:</h4></td>
			</tr>
             <tr>
				<th>#</th>
				<th title="Lead ID">L.Id</th>
				<th width="12%">Issue Date</th>
				<th>Time</th>
				<th>Passport</th>
				<th><span data-toggle="tooltip" data-placement="top" title="Invoice No">Inv.No</span></th>
				<th title="Supplier Name">S.Name</th>
				<th>Passenger</th>
				<th title="Sales Details">S.D</th>
				<th>A/c Details</th>
				<th>Spo</th>
				<th>Received</th>
				<th>Net</th>
				<th>PSF</th>
			</tr>
		';
		while($os_row=$q_o_s->fetch_assoc())
		{
			$psf=$os_row['recieved']-$os_row['netCost'];
			$data.='
				<tr>
					<td onclick="acc_other_view(\''.$os_row['id'].'\', \'other\', \''.$os_row['leadId'].'\')">'.$this->serial($count++).'</td>
					<td><a onclick="acc_lead_det('.$os_row['leadId'].')">'.$this->serial($os_row['leadId']).'</a></td>
					<td>'.$os_row['issue_date'].'</td>
					<td>'.$os_row['create_date'].'</td>
					<td>'.$os_row['passport_num'].'</td>
					<td class="other_sale'.$os_row['id'].'">
					'.((!empty($os_row['invoice_no']))?'<span class="inv_no" data-id="'.$os_row['id'].'" data-type="other_sale">'.$os_row['invoice_no'].'</span>':''.(($fileName=='get_daily_sale_rep' || $fileName=='print_dsr' || $fileName=='print' && empty($os_row['invoice_no']))?'N/A':'
						'.((empty($os_row['invoice_no']))?'<button type="button" class="btn btn-xs btn-info inv_no"
					data-id="'.$os_row['id'].'" data-type="other_sale">+</button>':"").' 
					 ').'').'
					 
					</td>
					<td>'.strtoupper($this->u_value('trans_acc', "trans_acc_name", "trans_acc_id=".$os_row['vendor_id']."")).'</td>
					<td>'.strtoupper($os_row['passName']).'</td>
					<td>'.strtoupper($os_row['sales_detail']).'</td>
					<td>'.strtoupper($os_row['accDetails']).'</td>
					<td>'.strtoupper($os_row['name']).'</td>
					<td>'.number_format($os_row['recieved']).'</td>
					<td>'.number_format($os_row['netCost']).'</td>
					<td>'.number_format($psf).'</td>
				</tr>
				';
			}
		$data.='
			<tr>
				<td colspan="14"><h4>UB:</h4></td>
			</tr>
			 <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
				<th>#</th>
				<th><span data-toggle="tooltip" data-placement="top" title="Lead Id">L.Id</span></th>
				<th width="12%">Issue Date</th>
				<th>Time</th>
				<th><span data-toggle="tooltip" data-placement="top" title="UB NO">U.N</span></th>
				<th><span data-toggle="tooltip" data-placement="top" title="Invoice No">Inv.No</span></th>
				<th>Client Name</th>
				<th>Passenger</th>
				<th>Sector</th>
				<th>A/c Details</th>
				<th>Spo</th>
				<th>Received</th>
				<th>Net</th>
				<th>PSF</th>
			</tr>
		';
		while($row=$q_u_b->fetch_assoc())
		{
			// total sale price 
			$h_t_s_price=$this->u_total("ub_hotels_sale", "ub_h_t_s_price" ,"client_id=".$row['ub_client_id']."");
			$t_t_s_price=$this->u_total("ub_transports", "ub_t_t_s_price" ,"client_id=".$row['ub_client_id']."");
			$o_t_s_price=$this->u_total("ub_others", "ub_o_t_s_price" ,"client_id=".$row['ub_client_id']."");
			$pkg_t_s_price=$this->u_total("ub_pkg", "t_sale_price" ,"client_id=".$row['ub_client_id']."");
			//total purchase price 
			$h_t_p_price=$this->u_total("ub_hotels_sale", "ub_h_t_p_price" ,"client_id=".$row['ub_client_id']."");
			$t_t_p_price=$this->u_total("ub_transports", "ub_t_t_p_price" ,"client_id=".$row['ub_client_id']."");
			$o_t_p_price=$this->u_total("ub_others", "ub_o_t_p_price" ,"client_id=".$row['ub_client_id']."");
			$pkg_t_p_price=$this->u_total("ub_pkg", "t_purchase_price" ,"client_id=".$row['ub_client_id']."");
			$data.='
				<tr>
					<td>'.$count++.'</td>
					<td><a onclick="acc_lead_det('.$row['leadId'].')">'.$this->serial($row['leadId']).'</a></td>
					<td>'.$row['ub_issue_date'].'</td>
					<td></td>
					<td>'.$row['ub_no'].'</td>
					<td class="ub'.$row['id'].'">
					'.((!empty($row['invoice_no']))?'<span class="inv_no" data-id="'.$row['id'].'" data-type="ub">'.$row['invoice_no'].'</span>':"").' 
					'.((empty($row['invoice_no']))?'<button type="button" class="btn btn-xs btn-info inv_no"
				 data-id="'.$row['id'].'" data-type="ub">+</button>':"").'</td>
					<td>'.$row['ub_client_name'].'</td>
					<td></td>
					<td></td>
					<td></td>
					<td>'.$row['name'].'</td>
					<td>';
					$data.= number_format($row['ub_v_t_s_price']+ $h_t_s_price+$t_t_s_price+$o_t_s_price+$pkg_t_s_price).'</td>
					<td>';
					$data.= ''.number_format($row['ub_v_t_p_price']+$h_t_p_price+$t_t_p_price+$o_t_p_price)+$pkg_t_p_price.'';
					$data.= '</td>
					<td>';
					$data.= ''.number_format($row['ub_v_t_s_price']+ $h_t_s_price+ $t_t_s_price+$o_t_s_price+$pkg_t_s_price - 
					($row['ub_v_t_p_price']+$h_t_p_price+$t_t_p_price+$o_t_p_price+$pkg_t_p_price)).'';
					$data.= '</td>
				</tr>
			';
			
		}
		$data.='
			<tr>
				<td colspan="14"><h4>Tour Sale:</h4></td>
			</tr>
			 <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
				<th>#</th>
				<th><span data-toggle="tooltip" data-placement="top" title="Lead Id">L.Id</span></th>
				<th width="12%">Issue Date</th>
				<th>Time</th>
				<th>Family Head</th>
				<th><span data-toggle="tooltip" data-placement="top" title="Invoice No">Inv.No</span></th>
				<th><span data-toggle="tooltip" data-placement="top" title="Visa Amount">V.A</span></th>
				<th><span data-toggle="tooltip" data-placement="top" title="Hotel Amount">H.A</span></th>
				<th><span data-toggle="tooltip" data-placement="top" title="Transport Amount">T.A</span></th>
				<th><span data-toggle="tooltip" data-placement="top" title="Tour Amount">T.A</span></th>
				<th><span data-toggle="tooltip" data-placement="top" title="Other Amount">O.A</span></th>
				<th>Received</th>
				<th>Net</th>
				<th>PSF</th>
			</tr>
		';
		//total tour invoice sale
		$tourInvS=0;
		//total tour invoice purchase
		$tourInvP=0;
		while($row=$q_thour_s_inv->fetch_assoc())
		{
			$tSv=$this->u_total("tour_visa", "t_visaSp", "uniqueId='".$row['uniqueId']."'");
			$tPv=$this->u_total("tour_visa", "t_visaPp", "uniqueId='".$row['uniqueId']."'");
			$tSh=$this->u_total("tour_hotel", "t_hotelSp", "uniqueId='".$row['uniqueId']."'");
			$tPh=$this->u_total("tour_hotel", "t_hotelPp", "uniqueId='".$row['uniqueId']."'");
			$tSt=$this->u_total("tour_transport", "t_transSp", "uniqueId='".$row['uniqueId']."'");
			$tPt=$this->u_total("tour_transport", "t_transPp", "uniqueId='".$row['uniqueId']."'");
			$tStr=$this->u_total("tour_tour", "t_tourSp", "uniqueId='".$row['uniqueId']."'");
			$tPtr=$this->u_total("tour_tour", "t_tourPp", "uniqueId='".$row['uniqueId']."'");
			$tSother=$this->u_total("tour_other", "t_serSp", "uniqueId='".$row['uniqueId']."'");
			$tPother=$this->u_total("tour_other", "t_serPp", "uniqueId='".$row['uniqueId']."'");
			$tourInvS+=($tSv+$tSh+$tSt+$tStr+$tSother);
			$tourInvP+=($tPv+$tPh+$tPt+$tPtr+$tPother);
			$psf=($tSv+$tSh+$tSt+$tStr+$tSother)-($tPv+$tPh+$tPt+$tPtr+$tPother);
		$data.='
				<tr>
					<td onclick="acc_tour_inv_det(\'acc_tour_inv_det\', \''.$row['uniqueId'].'\')">'.$this->serial($count++).'</td>
					<td>'.$this->serial($row['leadId']).'</td>
					<td>'.$row['issue_date'].'</td>
					<td>'.$row['date'].'</td>
					<td>'.$row['f_head_name'].'</td>
					<td class="tour'.$row['id'].'">
					'.((!empty($row['invoice_no']))?'<span class="inv_no" data-id="'.$row['id'].'" data-type="tour">'.$row['invoice_no'].'</span>':''.(($fileName=='get_daily_sale_rep' || $fileName=='print_dsr' || $fileName=='print' && empty($row['invoice_no']))?'N/A':'
						'.((empty($row['invoice_no']))?'<button type="button" class="btn btn-xs btn-info inv_no"
					data-id="'.$row['id'].'" data-type="tour">+</button>':"").'
					').'').'
					 
					</td>
					<td>'.(($tSv>0)? ''.$this->amount_format($tSv).'/'.$this->amount_format($tPv).'': '').'    
					'.(($tSv<=0)? '0.00': '').'</td>
					<td>'.(($tSh>0)? ''.$this->amount_format($tSh).'/'.$this->amount_format($tPh).'': '').'    
					'.(($tSh<=0)? '0.00': '').'</td>
					<td>'.(($tPt>0)? ''.$this->amount_format($tSt).'/'.$this->amount_format($tPt).'': '').'    
					'.(($tSt<=0)? '0.00': '').'</td>
					<td>'.(($tStr>0)? ''.$this->amount_format($tStr).'/'.$this->amount_format($tPtr).'': '').'    
					'.(($tStr<=0)? '0.00': '').'</td>
					<td>'.(($tSother>0)? ''.$this->amount_format($tSother).'/'.$this->amount_format($tPother).'': '').'    
					'.(($tSother<=0)? '0.00': '').'</td>
					<td>'.$this->amount_format(($tSv+$tSh+$tSt+$tStr+$tSother)).'</td>
					<td>'.$this->amount_format(($tPv+$tPh+$tPt+$tPtr+$tPother)).'</td>
					<td>'.$this->amount_format($psf).'</td>
				</tr>
			';
		}
		// hotel 
					$total_ub_sale=$this->u_total("add_sale", "recieved", "$t_search")+$this->u_total("other_sale", "recieved", "$o_search")+
									$this->u_total("ub_client_details", "ub_v_t_s_price", $ub_search)+
									$this->ub_c_h_t_o("ub_hotels_sale", "ub_h_t_s_price", $ub_search)+ 
									$this->ub_c_h_t_o("ub_transports", "ub_t_t_s_price", $ub_search)+
									$this->ub_c_h_t_o("ub_others", "ub_o_t_s_price", $ub_search)+
									$this->ub_c_h_t_o("ub_pkg", "t_sale_price", $ub_search)+$tourInvS;
					$total_ub_purchase=$this->u_total("add_sale", "netCost", "$t_search")+$this->u_total("other_sale", "netCost", "$o_search")+
										$this->u_total("ub_client_details", "ub_v_t_p_price", $ub_search)+
										$this->ub_c_h_t_o("ub_hotels_sale", "ub_h_t_p_price", $ub_search)+ 
										$this->ub_c_h_t_o("ub_transports", "ub_t_t_p_price", $ub_search)+
										$this->ub_c_h_t_o("ub_others", "ub_o_t_p_price", $ub_search)+
										$this->ub_c_h_t_o("ub_pkg", "t_purchase_price", $ub_search)+$tourInvP;
				$data.='
				<tr>
					<td align="right" colspan="11" style="text-align:right;">Total:</td>
					<td>';
					$data.= number_format($total_ub_sale);
					$data.= '</td>
					<td>';
					$data.= number_format($total_ub_purchase);
					$data.= '</td>
					<td>';
					$data.= number_format($total_ub_sale-$total_ub_purchase);
					$data.= '</td>
				</tr>
			';
			return $data;
		}
		// totals of client details , hotel sale, transport, other date wise in sale reports 
		function ub_c_h_t_o($sTable, $col, $ub_search)
		{
			$query=$this->selectMultiData("ub_client_details.ub_issue_date, sum($sTable.$col) AS val", 
			"$sTable INNER JOIN ub_client_details ON $sTable.client_id=ub_client_details.ub_client_id","$ub_search");
			$row=$query->fetch_assoc();
			return $row['val'];
			
		}
		// transaction accounts list
		function trans_acc($trans_id="")
		{
			$list="";
			if(!empty($trans_id) && $trans_id!=0)
			{
				$where="trans_acc_id!=".$trans_id." AND branch_id=".$_SESSION['branch_id']."";
			}
			else
			{
				$where="branch_id=".$_SESSION['branch_id']."";
			}
			$result=$this->selectData("trans_acc","{$where}");
			while ($row=$result->fetch_assoc()) 
			{
				$list.='<option value="'.$row['trans_acc_id'].'">'.$row['trans_acc_name'].'</option>';
			}
			return $list;
		}
		function succ_acc($leadId)
		{
			$tourSale=new tourSale();
			$tsi=$tourSale->sum_t_t_inv($leadId);
			if($this->u_value("lead", "dr_cr", "id=".$leadId."")=='dr')
			{
				$ob=$this->u_value("lead", "opening_balance", "id=".$leadId."");
			}
			if($this->u_value("lead", "dr_cr", "id=".$leadId."")=='cr')
			{
				$ob='-'.$this->u_value("lead", "opening_balance", "id=".$leadId."");
			}
			$net_b=(($ob)+$this->u_total("add_sale", "recieved", "leadId=".$leadId."")+ lead::lead_ub_net($leadId)+$this->u_total("other_sale", "recieved", "leadId=".$leadId."")-$this->u_total("refund", "net", "leadId=".$leadId."")-$this->u_total("payment_reciept", "amount", "leadId=".$leadId." AND status='approved'")+$this->u_total("refund_payment", "amount", "leadId=".$leadId." AND status='approved'")+$tsi)-lead::l_psf($leadId)+lead::l_ser_char($leadId);
			if($net_b==0)
			{
				$this->update("lead", "status='successfull'", "id=".$leadId."");
			}
			if($net_b>0){$this->update("lead", "status='process'", "id=".$leadId."");}
			return $net_b;
		}
		// Alert receive spo when accounts department approved the receipts
		function receipt_app_alert($userId)
		{
			$alert='';
			$result=$this->selectData("payment_reciept","userId=".$userId." AND status='approved' AND desk_alert='no' AND branch=".$_SESSION['branch_id']."");
			while($row=$result->fetch_assoc())
			{
				$alert.='
						<div class="col-md-4 alert alert-success alert-dismissable alert-rec-app">
							<h4><i class="icon fa fa-check"></i> Alert! ('.$this->u_value('lead', 'contact_name', 'id='.$row['leadId'].'').')</h4>
								Receipt Has Been Approved (Receipt: Rv-'.$row['trans_code'].', Lead No: '.$row['leadId'].')
								<button onclick="update_desk_alert(\''.$row['id'].'\', \'yes\')" data-dismiss="alert" aria-hidden="true" class="btn btn-xs btn-success pull-right"><i class="fa fa-check"></i></button>
					   </div>
					   <div class="clearfix"></div>
						';
			}
			return $alert;
		}
		// Alert receive spo when when Accounts department void the receipt
		function receipt_void_alert($userId)
		{
			$alert='';
			$result=$this->selectData("payment_reciept","userId=".$userId." AND status='cancel' AND desk_alert='no' AND branch=".$_SESSION['branch_id']."");
			if($result)
			{
			while($row=$result->fetch_assoc())
			{
				$alert.='
						<div class="col-md-4 alert alert-danger alert-dismissable alert-rec-app">
							<h4><i class="icon fa fa-check"></i> Alert! ('.$this->u_value('lead', 'contact_name', 'id='.$row['leadId'].'').')</h4>
								Receipt Has Been Void (Receipt: Rv-'.$row['trans_code'].', Lead No: '.$row['leadId'].')
								<button onclick="update_desk_alert(\''.$row['id'].'\', \'yes\')" data-dismiss="alert" aria-hidden="true" class="btn btn-xs btn-danger pull-right"><i class="fa fa-check"></i></button>
					   </div>
					   <div class="clearfix"></div>
						';
			}
			return $alert;
			}
			
		}
		function receipt_pending_alert()
		{
			$alert='';
			if($this->user_access('accounts', $_SESSION['sessionId']))
			{
			$result=$this->selectData("payment_reciept","status='pending' branch=".$_SESSION['branch_id']."");
			if($result)
			{
				while($row=$result->fetch_assoc())
				{
					$alert.='
							<div class="col-md-4 alert bg-blue-gradient alert-dismissable alert-rec-app">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<h4><i class="icon fa fa-check"></i> Alert! ('.$this->u_value('user', 'name', 'id='.$row['userId'].'').')</h4>
									New Receipt Created (Receipt: Rv-'.$row['trans_code'].', Lead No: '.$row['leadId'].')
						   </div>
						   <div class="clearfix"></div>
							';
				}
			}
			}
			return $alert;
			
		}
		// spo shows to accounts
	function acc_spo($spo, $branch)
	{
		$list="";
		if($this->user_access("account-spo",$_SESSION['sessionId']))
		{
			$result=$this->selectData("user", "branch_id=".$branch."");
		}
		else
		{
			$result=$this->selectData("user", "branch_id=".$branch." AND id=".$_SESSION['sessionId']."");
		}
		if($result)
		{
			while($row=$result->fetch_assoc())
			{
				$list.='<option '.(($spo==$row['id'])? 'selected="selected"':"").'  value="'.$row['id'].'">'.$row['name'].'</option>';
			}
			return $list;
		}
	}
	// count current month days 
	public function month_days($date)
	{
		$td=date('t',strtotime($date));
		$d=date('d',strtotime($date));
		$m=date('m',strtotime($date));
		if($td==31 && $d==16)
		{
			$nd= 15;
		}
		elseif($td==31 && $d==01)
		{
			if($m==01)
			{
				$nd= 16;
			}
			else
			{
				$nd=15;
			}
		}
		elseif($td==30 && $d==01)
		{
			$nd= 16;
		}
		elseif($td==30 && $d==16)
		{
			$nd= 15;
		}
		elseif($td==28 && $d==01)
		{
			$nd= 16;
		}
		elseif($td==28 && $d==16)
		{
			$nd= 15;
		}
		elseif($td==29 && $d==01)
		{
			$nd= 16;
		}
		elseif($td==29 && $d==16)
		{
			$nd= 16;
		}
		elseif($td==30)
		{
			$nd= 15;
		}
		return $nd;
	}
	public function month_days_sub($date)
	{
		$days=date('t',strtotime($date));
		if($days==31)
		{
			$nd= -1;
		}
		elseif($days==30)
		{
			$nd= 0;
		}
		
		return $nd;
	}
}
?>