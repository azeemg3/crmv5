<?php
class lead extends crm
{
	private $tourSale;
	public function __construct(){
		$this->tourSale=new tourSale();
	}
	function countLead($userId, $userBranch, $status)
	{
		if($status=="all")
		{
			return $this->count_val('lead', 'id', 'spo='.$userId.' AND branch_id='.$userBranch.' AND status!="Trashed"');
		}
		else
		{
			return $this->count_val('lead', 'id', 'status="pending" AND spo='.$userId.' AND branch_id='.$userBranch.'');
		}
	}
	// count all leads
	public function countAllLeads($userBranch, $status)
	{
		if($status=="all")
		{
			return $this->count_val('lead', 'id', 'branch_id='.$userBranch.' AND status!="Trashed"');
		}
		else
		{
			return $this->count_val('lead', 'id', 'status="'.$status.'" AND branch_id='.$userBranch.'');
		}
	}
	function saveLead($columns, $values, $contact_name, $mobile,  $message, $email)
	{
		$this->insertData("lead", $columns, $values);
		$this->message_api($mobile, $message);
		$this->send_lead_mail($contact_name, $email);
	}
	// all spo while lead creation
	public function all_branch_spo($spo="")
	{
		$lsit="";
		$result=$this->selectData("user", "branch_id=".$_SESSION['branch_id']."");
		while($row=$result->fetch_assoc())
		{
			$list.='<option '.(($spo==$row['id'])? 'selected="selected"':"").'  value="'.$row['id'].'">'.$row['name'].'</option>';
		}
		return $list;
	}
	// send email while creating new lead
	function send_lead_mail($contact_name, $email)
		{
			
			$sign_log=$this->u_value("branches", "sign_logo", "status='active' AND branch_id=".$_SESSION['branch_id']."");
			$branch_name=strtoupper($this->u_value("branches", "branch_name", "status='active' AND branch_id=".$_SESSION['branch_id'].""));
			$address=$this->u_value("branches", "address", "status='active' AND branch_id=".$_SESSION['branch_id']."");
			$branch_email=$this->u_value("branches", "branch_email", "status='active' AND branch_id=".$_SESSION['branch_id']."");
			$phone_line=$this->u_value("branches", "phone_line", "status='active' AND branch_id=".$_SESSION['branch_id']."");
			$mobile=$this->u_value("branches", "mobile", "status='active' AND branch_id=".$_SESSION['branch_id']."");
			$web=$this->u_value("branches", "web", "status='active' AND branch_id=".$_SESSION['branch_id']."");
			$id=$this->u_value("adress_book", "id", "email='$email'");
			$email_header=$this->u_value("branches", "email_header", "status='active' AND branch_id=".$_SESSION['branch_id']."");
			$Efrom =$this->u_value("branches", "branch_email", "branch_id=".$_SESSION['branch_id']."");
			$Ename =strtoupper($this->u_value("branches", "branch_name", "branch_id=".$_SESSION['branch_id'].""));
				$Emessage = '<html><body>';
				$Emessage .= "
				<div style='width:100%; margin:auto; height:auto; font-family:Calibri; '>
					<table align='center' border='0' style='margin:auto;'>
						<tr>
						<td><img src='http://toursvision.com/crmv4/branch_logo/".$email_header."' /></td>
						</tr>
						<tr>
						<td>
						<span style='color:green; font-size:18px;'>Thanks You ".strtoupper($contact_name).",\n".strtoupper($Ename)." warmly thankfull and appreciates your support and trust on us.\nYou can be confident that we are committed to your satisfaction. For further details & query please do'nt hesitate to call ".$phone_line." or visit ".$web."</span>
						</td>
						</tr>
						<tr>
						<td>
						<br>
						<p style='color:#548dd4'>".nl2br('Regards & Thanks<br>
				'.$branch_name.' | '.$address.' | Office: '.$phone_line.' | Mob: '.$mobile.' | 
				<a href="http://'.$web.'/" target="_blank">Visit Web Site</a>
				')."		
				</p>
				<img src='http://www.toursvision.com/crmv4/branch_logo/".$sign_log."'>
				</td>
				</tr>
			</table>

</div></html></body>";
					$Eto =$email;
					$Esubject =$Ename;
					$Eheaders ="From: \"Sales\" <$Efrom>\r\n";
					$Eheaders .= "Reply-To:".$Efrom."\r\n";
					$Eheaders .= "MIME-Version: 1.0\r\n";
					$Eheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
					mail($Eto, $Esubject, $Emessage, $Eheaders);
		}
	// spo lead status
	function spo_leads($userId, $userBranch)
	{
		$countLeads='
				<div class="panel panel-default">
            <div class="panel-body">
            <div class="col-lg-2 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow-gradient">
                <div class="inner">
				<h3>'.$this->countLead($userId, $userBranch, 'pending').'</h3>
                    <p>Pending Leads</p>
					<div class="icon">
					  <i class="ion ion-person-add"></i>
					</div>
                </div>
                <a href="myLeads?status=pending" class="small-box-footer">Leads <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-2 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-blue-gradient">
                <div class="inner">
				<h3>'.$this->countLead($userId, $userBranch, 'new').'</h3>
                  <p>Take Over</p>
				  <div class="icon">
					  <i class="ion ion-person-add"></i>
					</div>
                </div>
                <a href="myLeads?status=new" class="small-box-footer">Leads <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-2 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-teal-gradient">
                <div class="inner">
				<h3>'.$this->countLead($userId, $userBranch, 'process').'</h3>
                  <p>In Process</p>
				  <div class="icon">
					  <i class="ion ion-person-add"></i>
					</div>
                </div>
                <a href="myLeads?status=process" class="small-box-footer">Leads <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-2 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green-gradient">
			  <h3>'.$this->countLead($userId, $userBranch, 'successfull').'</h3>
                <div class="inner">
                  <p>Successfull</p>
				  <div class="icon">
					  <i class="ion ion-person-add"></i>
					</div>
                </div>
                <a href="myLeads?status=successfull" class="small-box-footer">Leads <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-2 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red-gradient">
                <div class="inner">
				<h3>'.$this->countLead($userId, $userBranch, 'unsuccessfull').'</h3>
                  <p>UnSuccessfull</p>
				  <div class="icon">
					  <i class="ion ion-person-add"></i>
					</div>
                </div>
                <a href="myLeads?status=unsuccessfull" class="small-box-footer">Leads <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-2 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-orange">
			  <h3>'.$this->countLead($userId, $userBranch, 'all').'</h3>
                <div class="inner">
                  <p>Total Leads</p>
				  <div class="icon">
					  <i class="ion ion-person-add"></i>
					</div>
                </div>
                <a href="#" class="small-box-footer">Leads <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
    <!--panel-body-->
                </div>
		';
		return $countLeads;
	}
	// sale type e.g ticket, other sale, tour etc
	function saleType()
	{
		$list="";
		$saleType=array("Ticket"=>"ticket","Other Sale"=>"other_sale", "Tour Sale"=>"tour");
		foreach($saleType as $key=>$val)
		{
			$list.='<option  value="'.$val.'">'.$key.'</option>';
		}
		return $list;
	}
	// ticket_sale of the clients
	function ticket_sale($result)
	{
		$data=""; $count=1; $id="";$total=0;
		while($row=$result->fetch_assoc())
		{
			$id=$row['id'];
			$total+=$row['recieved'];
			$data.='
					<tr id="ticket-'.$row['id'].'">
						<td>'.$count++.'</td>
						<td>'.$row['issue_date'].'</td>
						<td>'.$this->emptyWord($row['invoice_no']).'</td>
						<td>'.$row['airline_code'].'-'.$row['ticket_no'].'</td>
						<td>'.$this->u_value('user', "name", "id=".$row['userId']."").'</td>
						<td>'.$row['passName'].'</td>
						<td>'.$row['sector'].'</td>
						<td>'.$row['accDetails'].'</td>
						<td>'.$this->show_bal($row['recieved']).'</td>
						<td>
						'.((date('d-m-Y', strtotime($row['create_date']))==$this->today()?'<a class="btn btn-app btn-xs" onClick="edit_ticket_sale(\''.$row['id'].'\')"><span class="fa fa-fw fa-edit"></span></a> ':'
						'.(($this->user_access('edit', ''.$_SESSION['sessionId'].''))? '<a class="btn btn-app btn-xs" onClick="edit_ticket_sale(\''.$row['id'].'\')"><span class="fa fa-fw fa-edit"></span></a>': "N/A").'')).'
						<a class="btn btn-app btn-xs" onclick="sale_view(\'ticket\',\'ticket_view\',\''.$row['id'].'\')">
						<i class="fa fa-eye"></i></a>
						<a class="btn btn-app btn-xs" onClick="del_rec(\'../\', \'ticket-sale\', \'ticket-'.$row['id'].'\')"><span class="fa fa-fw fa-trash"></span></a>
						</td>
					</tr>';
					
		}
			$data.='
					<tr>
						<td colspan="8" align="right"><strong>Total</strong></td>
						<td colspan="2">'.$this->show_bal($total).'</td>
					</tr>
					';
		$data.=$this->nothing_found($id, 12);
		return $data;
	}
	// other sale of the clients
	function other_sale($result)
	{
		$data=""; $count=1; $id=""; $total=0;
		while($row=$result->fetch_assoc())
		{
			$id=$row['id'];
			$total+=$row['recieved'];
			$data.='
					<tr>
						<td>'.$count++.'</td>
						<td>'.$row['issue_date'].'</td>
						<td>'.$this->emptyWord($row['invoice_no']).'</td>
						<td>'.$row['passport_num'].'</td>
						<td>'.$row['ser_type'].'</td>
						<td>'.$this->u_value('user', "name", "id=".$row['userId']."").'</td>
						<td>'.$row['passName'].'</td>
						<td>'.$row['sales_detail'].'</td>
						<td>'.$row['accDetails'].'</td>
						<td>'.$this->show_bal($row['recieved']).'</td>
						<td>
						'.((date('d-m-Y', strtotime($row['create_date']))==$this->today())?'<a class="btn btn-app btn-xs" onclick="edit_other_sale(\''.$row['id'].'\')"><i class="fa fa-fw fa-edit"></i></a>':'
						'.(($this->user_access('edit', ''.$_SESSION['sessionId'].''))?'<a class="btn btn-app btn-xs" onclick="edit_other_sale(\''.$row['id'].'\')"><i class="fa fa-fw fa-edit"></i></a>':'N/A').'
						').' 
						<a class="btn btn-app btn-xs" onclick="sale_view(\'other_sale\',\'other_sale_view\',\''.$row['id'].'\')">
						<i class="fa fa-eye"></i></a>
						</td>
					</tr>
				';
		}
		$data.='
				<tr>
					<td colspan="9" align="right"><strong>Total</strong></td>
					<td colspan="2">'.$this->show_bal($total).'</td>
				</tr>
				';
		$data.=$this->nothing_found($id, 13);
		return $data;
	}
	// refund agail client details
	function refund($result)
	{
		$data=""; $count=1; $id=""; $ser_char=0;
		while($row=$result->fetch_assoc())
		{
			$id=$row['id']; $psf=0;
			if($row['ref_type']=="full" && $row['status']=='approved')
			{
				$rec=$this->u_value("add_sale", "recieved", "airline_code='".$row['airline_code']."' AND ticket_no='".$row['ticket_no']."'");
				$nc=$this->u_value("add_sale", "netCost", "airline_code='".$row['airline_code']."' AND ticket_no='".$row['ticket_no']."'");
				$psf=$rec-$nc;
				$ser_char=$row['services_charges'];
			}
			$data.='
					<tr>
						<td>'.$count++.'</td>
						<td>'.$row['passName'].'</td>
						<td>'.$row['phone'].'</td>
						<td>'.$row['sector'].'</td>
						<td>'.$row['airline_code'].'-'.$row['ticket_no'].'</td>
						<td>'.$row['create_date'].'</td>
						<td>'.$this->cr_balance($psf).'</td>
						<td>'.$this->cr_balance($row['net']-$ser_char).'</td>
						<td>'.$this->cr_balance($row['net']+$psf-$ser_char).'</td>
						<td><a class="btn btn-app btn-xs" onClick="edit_refund(\''.$row['id'].'\')"><span class="fa fa-fw fa-edit"></span></a> 
						  <a class="btn btn-app btn-xs" onclick="sale_view(\'refund\',\'refund_view\',\''.$row['id'].'\')">
						  <i class="fa fa-eye"></i></a></td>
					</tr>
				';
		}
		$data.=$this->nothing_found($id, 13);
		return $data;
	}
	// refunds against client details
	function refund_payment($result)
	{
		$data=""; $count=1; $id="";
		while($row=$result->fetch_assoc())
		{
			$id=$row['id'];
			$data.='
					<tr>
						<td>'.$row['app_date'].'</td>
						<td>'.$this->u_value("branches", "branch_name", "branch_id=".$row['branch']."").'</td>
						<td>'.$this->u_value("user", "name", "id=".$row['userId']."").'</td>
						<td>'.$this->serial($row['id']).'</td>
						<td></td>
						<td>'.$row['remark'].'</td>
						<td>'.$row['payment_type'].'</td>
						<td>'.$this->show_bal($row['amount']).'</td>
						<td>0.00</td>
						<td>N/A</td>
					</tr>
				';
		}
		$data.=$this->nothing_found($id, 13);
		return $data;
	}
	// receipt of the clients agains payment received
	function payment_receipt($result)
	{
		$data=""; $count=1; $id=""; $total=0;
		while($row=$result->fetch_assoc())
		{
			$id=$row['id'];
			$total+=$row['amount'];
			$data.='
					<tr>
						<td>'.$row['app_date'].'</td>
						<td>'.$this->u_value('branches', 'branch_name', 'branch_id='.$row['branch'].'').'</td>
						<td>'.$this->u_value('user', 'name', 'id='.$row['userId'].'').'</td>
						<td>RV-'.$this->serial($row['TPRV']).'</td>
						<td>'.$row['recieve'].'</td>
						<td>'.$row['remarks'].'</td>
						<td>'.$row['payment_type'].'</td>
						<td>0.00</td>
						<td>'.$this->cr_balance($row['amount']).'</td>
						<td><a target="_blank" href="accounts/print_receipt?id='.$row['id'].'" class="btn btn-app btn-xs"><i class="fa fa-eye"></i> </a></td>
					</tr>
				';
		}
		$data.='
				<tr>
				 <td colspan="8" align="right"><strong>Total</strong></td>
				 <td colspan="2">'.$this->cr_balance($total).'</td>
				</tr>
			';
		//$data.=$this->nothing_found($id, 13);
		return $data;
	}
	// all the attached document
	function att_document($result)
	{
		$data="";$count=1; $id="";
		while($row=$result->fetch_assoc())
		{
			$id=$row['doc_id'];
			$data.='
					<tr id="'.$row['doc_id'].'">
						<td>'.$count++.'</td>
						<td>'.$row['leadId'].'</td>
						<td>'.$row['doc_type'].'</td>
						<td>'.$row['e_number'].'</td>
						<td>'.$row['passName'].'</td>
						<td><a onClick="view_doc(\''.$row['doc_name'].'\')">View Document</a></td>
						<td><a class="btn btn-app btn-xs" onclick="del_rec(\'\', \'att_doc\', \''.$row['doc_id'].'\')">
						<i class="fa fa-trash-o"></i>
				</a></td>
					</tr>
				';
		}
		$data.=$this->nothing_found($id, 7);
		return $data;
	}
	// change leads satus when client matured c_l_s=change lead status
	function c_l_s($leadId)
	{
		if($this->u_value("lead", "status", "id=".$leadId."")=='new')
		{
			$this->update("lead", "status='process', proc_date='".$this->current_dt()."'", "id=".$leadId." and status!='process'");
		}
	}
	// count pending leads
	function p_L($userSessionId)
	{
		$pl=$this->count_val("lead", "id", "status='pending' AND spo=".$userSessionId." or spo='0' AND 
		branch_id=".$_SESSION['branch_id']."");
		
		return $pl;
	}
	// net slae against lead 
	function l_net_sale($leadId)
	{
		$ticket_sale=$this->u_total("add_sale", 'recieved', 'leadId='.$leadId.'');
		$other_sale=$this->u_total("other_sale", 'recieved', 'leadId='.$leadId.'');
		$tourSale=$this->tourSale->sum_t_t_inv($leadId);
		$net_sale=$ticket_sale+$other_sale+$tourSale;
		return $net_sale;
	}
	// lead ledger summary
	function ledger_summary($leadId)
	{
		$ser_char=0;
		$type=$this->u_value("lead", "dr_cr", "id=".$leadId."");
		if($type=='dr')
		{
			$ob=$this->u_total("lead", "opening_balance", "id=".$leadId."");
		}
		else
		{
			$ob='-'.$this->u_total("lead", "opening_balance", "id=".$leadId."");
		}
		$payment=$this->u_total("payment_reciept", "amount", "leadId=".$leadId." AND status='approved'");
		//calculate refund services charges
		$ser_char=$this->u_total("refund", "services_charges", "leadId=".$leadId." AND status='approved'");
		$refund=$this->u_total("refund", "net", "leadId=".$leadId." AND status='approved'")+$this->l_psf($leadId)-$ser_char;
		$rp=$this->u_total("refund_payment","amount", "leadId=".$leadId." AND status='approved'");
		$net=$ob+($this->l_net_sale($leadId))-$payment-$refund+$rp;
		return $this->show_bal($net);
	}
	// total lead conversation 
	function count_lead_cons($userId)
	{
	    $total_msg=0;
		$total_msg+=$this->count_val("spo_leadconservation", "id", "userId=".$userId." AND status='unread' GROUP BY userId");
		if($total_msg>0){return $total_msg;}
		else{return 0;}
	}
	// client spo
	function client_spo($mobile, $message)
	{
		$this->message_api($mobile, $message);
	}
	// message to spo's against lead
	function desk_lead_msg($userId)
	{
		$msg="";
		$result=$this->selectData("spo_leadconservation", "userId=".$userId." AND status='unread' GROUP BY conservation_frm ORDER BY id DESC");
		while($row=$result->fetch_assoc())
		{
			$msg.='
				<li><!-- start message -->
                        <a href="#" onclick="desk_lead_msg(\''.$this->serial($row['leadId']).'\', \''.$row['conservation_frm'].'\')">
                          <div class="pull-left">
                            '.$this->u_value("user", "name", "id=".$row['conservation_frm']."").':
                          </div>
                          <div class="clearfix"></div>
                          <p>'.$row['conservation'].'</p>
                        </a>
                      </li><!-- end message -->
				';
		}
		return $msg;
	}
	function desk_lead_msg_alert($userId)
	{
		$msg="";
		$result=$this->selectData("spo_leadconservation", "userId=".$userId." AND status='unread'  GROUP BY conservation_frm ORDER BY id DESC");
		while($row=$result->fetch_assoc())
		{
			$msg.='
				<div class="col-md-4 alert alert-info alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-warning"></i> Alert!</h4>
					<a href="#" onclick="desk_lead_msg(\''.$this->serial($row['leadId']).'\', \''.$row['conservation_frm'].'\')">
					  <div class="pull-left">
						You have New Message From: <b>'.$this->u_value("user", "name", "id=".$row['conservation_frm']."").'</b>
					  </div>
					</a>
				</div>
				<div class="clearfix"></div>
				';
		}
		return $msg;
	}
	// modal desk lead message
	function desk_moadal_lead_msg()
	{
		$data='<div class="modal fade" id="desk_ticket_message" role="dialog">
		<div class="modal-dialog"> 
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">×</button>
			  <input type="hidden" name="user_id" id="user_id">
			</div>
			<div class="col-md-12"> 
			  <!-- DIRECT CHAT DANGER -->
			  <div class="direct-chat direct-chat-primary">
			  <div class="box-footer">
				  <form  id="leadForm-message">
					<div class="input-group">
					  <input type="text" name="conservation" placeholder="Type Message ..." class="form-control lead-message">
					  <span class="input-group-btn ticket-btn">
					  </span> </div>
				  </form>
				</div>
				<!-- /.box-footer--> 
				<div class="box-header with-border">
				  <h3 class="box-title">Lead Message (<span id="desk_lead_id"></span>) 
				  <span id="lead_client_name" style="color:brown;"></span></h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body"> 
				  <!-- Conversations are loaded here -->
				  <div class="direct-chat-messages ticket_messageunique" style="overflow:inherit !important;"> 
		   
				  </div>
				  <!--/.direct-chat-messages--> 
				</div>
				<!-- /.box-body -->
			  </div>
			  <!--/.direct-chat --> 
			</div>
			<div class="clearfix"></div>
		  </div>
		  <!--modal-content--> 
		</div>
		</div>';
		return $data;
	}
	function lead_ub_net($leadId)
	{
		$lead_bet_balance=$this->u_total("ub_client_details", "ub_v_t_s_price", "leadId=".$leadId."")+
		$this->u_total("ub_hotels_sale", "ub_h_t_s_price" ,"leadId=".$leadId."")+
		$this->u_total("ub_transports", "ub_t_t_s_price" ,"leadId=".$leadId."")+
		$this->u_total("ub_others", "ub_o_t_s_price" ,"leadId=".$leadId."")+
		$this->u_total("ub_pkg", "t_sale_price" ,"leadId=".$leadId."");
		return $lead_bet_balance;
	}
	// Lead Transfering message
	public function lead_transfer_alert($leadId)
	{
		$msg='<div class="lead-transfer alert alert-success alert-dismissable" style="display:none;">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4>	<i class="icon fa fa-check"></i> Alert!</h4>
				Lead Transfer Successfully.... <a onclick="history.go(-1)" class="btn btn-info"><i class="fa fa-arrow-left"></i> Go Back</a>
			  </div>';
		return $msg;
	}
	// opening balance effect in ledger account
	function lead_ob($dt_frm, $dt_to, $leadId)
	{
		date_default_timezone_set("Asia/Karachi");
		$ob="";
		if($this->u_value("lead", "dr_cr", "id=".$leadId."")=='dr')
		{
			$ob=$this->u_value("lead", "opening_balance", "id=".$leadId."");
		}
		if($this->u_value("lead", "dr_cr", "id=".$leadId."")=='cr')
		{
			$ob='-'.$this->u_value("lead", "opening_balance", "id=".$leadId."");
		}
		$old_date =$dt_frm;
		$new_date = date("d-m-Y", strtotime($old_date) );
		$prev_date = date("d-m-Y", strtotime('-1 days', strtotime($new_date)) );
		$date1=date("d-m-Y", strtotime("01-01-2017"));
		$ticket=$this->u_total("add_sale", "recieved", "STR_TO_DATE(issue_date, '%d-%m-%Y') BETWEEN  
		STR_TO_DATE('".$date1."', '%d-%m-%Y') AND STR_TO_DATE('".$prev_date."', '%d-%m-%Y') AND 
		leadId=".$leadId."");
		$other_sale=$this->u_total("other_sale", "recieved", "STR_TO_DATE(issue_date, '%d-%m-%Y') BETWEEN  
		STR_TO_DATE('".$date1."', '%d-%m-%Y') AND STR_TO_DATE('".$prev_date."', '%d-%m-%Y') AND 
		leadId=".$leadId."");
		$tourSale=$this->tourSale->lead_tour_ledger($date1,$prev_date, $leadId);
		$psf=$this->l_psf($leadId,$date1, $prev_date);
		$receipt=$this->u_total("payment_reciept", "amount", "STR_TO_DATE(app_date, '%d-%m-%Y') BETWEEN  
		STR_TO_DATE('".$date1."', '%d-%m-%Y') AND STR_TO_DATE('".$prev_date."', '%d-%m-%Y') AND leadId=".$leadId." AND status='approved'");
		$refund=$this->u_total("refund", "net", "STR_TO_DATE(app_date, '%d-%m-%Y') BETWEEN  
		STR_TO_DATE('".$date1."', '%d-%m-%Y') AND STR_TO_DATE('".$prev_date."', '%d-%m-%Y') AND leadId=".$leadId." AND status='approved'")+$psf-$this->u_total("refund", "services_charges", "STR_TO_DATE(app_date, '%d-%m-%Y') BETWEEN  
		STR_TO_DATE('".$date1."', '%d-%m-%Y') AND STR_TO_DATE('".$prev_date."', '%d-%m-%Y') AND leadId=".$leadId." AND status='approved'");
		$payments=$this->u_total("refund_payment","amount", "STR_TO_DATE(app_date, '%d-%m-%Y') BETWEEN  
		STR_TO_DATE('".$date1."', '%d-%m-%Y') AND STR_TO_DATE('".$prev_date."', '%d-%m-%Y') AND leadId=".$leadId." AND status='approved'");
		$ser_ch=$this->l_ser_char($leadId);
		$bal=floatval($ob)+floatval($ticket)+floatval($other_sale)+floatval($tourSale)-floatval($receipt)-floatval($refund+$payments);
		return $bal;
		//return $this->show_bal_format($ob);
	}
	// lead wise spo service charges 
	function l_ser_char($leadId, $df="", $dt="")
	{
		$sWhere="";
		$whereArray=array();
		if(!empty($leadId)) $whereArray[]="leadId=".$leadId." AND status='approved'";
		if(!empty($df) && !empty($dt)) $whereArray[]="STR_TO_DATE(refund.app_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$df."', '%d-%m-%Y') AND 
			STR_TO_DATE('".$dt."', '%d-%m-%Y')";
			$sWhere=implode(" AND ",$whereArray);
		$ser_char=0;$rc=0;$rp=0;
		$query=$this->selectMultiData("refund.net AS refNet,refund.ref_type, refund.airline_code, refund.ticket_no", "refund", "{$sWhere}");
		while($row=$query->fetch_assoc())
		{
			$rp=$this->u_value("refund_payment", "amount", "airline_code='".$row['airline_code']."' AND ticket_no='".$row['ticket_no']."'");
			if($rp>0)
			{
				$rc=$row['refNet'];
				$ser_char+=$rc-$rp;
			}
		}
		return $ser_char;
	}
	// lead wise psf (previous profit from customers)
	function l_psf($leadId, $df="", $dt="")
	{
		$sWhere="";
		$whereArray=array();
		if(!empty($leadId)) $whereArray[]="leadId=".$leadId."";
		if(!empty($df) && !empty($dt)) $whereArray[]="STR_TO_DATE(refund.app_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$df."', '%d-%m-%Y') AND STR_TO_DATE('".$dt."', '%d-%m-%Y')";
		$sWhere=implode(" AND ",$whereArray);
		$rec=0;$nc=0;$psf=0;
		$query=$this->selectMultiData("refund.ref_type, refund.net, refund.airline_code, refund.ticket_no", "refund", 
		"{$sWhere}");
		while($row=$query->fetch_assoc())
		{
			if($row['ref_type']=='full' && !empty($row['net']))
			{
			 $rec=$this->u_value("add_sale", "recieved", "airline_code='".$row['airline_code']."' AND 
			 ticket_no='".$row['ticket_no']."'");
			 $nc=$this->u_value("add_sale", "netCost", "airline_code='".$row['airline_code']."' AND 
			 ticket_no='".$row['ticket_no']."'");
			 $psf+=$rec-$nc;
			}
		}
		return $psf;
	}
	// branch wise previous psf refund
	function branch_prev_psf($df="", $dt="")
	{
		$sWhere="";
		$whereArray=array();
		if($this->user_access('branch_admin', $_SESSION['sessionId']))
		{
			$whereArray[]="branch=".$_SESSION['branch_id']."";
		}
		else
		{
			$whereArray[]="userId=".$_SESSION['sessionId']."";
		}
		if(!empty($df) && !empty($dt)) $whereArray[]="STR_TO_DATE(refund.app_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$df."', '%d-%m-%Y') AND STR_TO_DATE('".$dt."', '%d-%m-%Y')";
		$sWhere=implode(" AND ",$whereArray);
		$rec=0;$nc=0;$psf=0; $sc=0;
		$query=$this->selectMultiData("refund.ref_type, refund.net, refund.airline_code, refund.ticket_no,
		refund.services_charges", "refund", "{$sWhere}");
		while($row=$query->fetch_assoc())
		{
			if($row['ref_type']=='full' && !empty($row['net']))
			{
			 $rec=$this->u_value("add_sale", "recieved", "airline_code='".$row['airline_code']."' AND 
			 ticket_no='".$row['ticket_no']."'");
			 $nc=$this->u_value("add_sale", "netCost", "airline_code='".$row['airline_code']."' AND 
			 ticket_no='".$row['ticket_no']."'");
			 $psf+=$rec-$nc;
			}
			$sc+=$row['services_charges'];
		}
		return $psf-($sc);
	}
	// branch wise previous psf refund
	function spo_prev_psf($df="", $dt="", $userId)
	{
		$sWhere="";
		$whereArray=array();
		if(!empty($userId)) $whereArray[]="userId=".$userId."";
		if(!empty($df) && !empty($dt)) $whereArray[]="STR_TO_DATE(refund.app_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('".$df."', '%d-%m-%Y') AND STR_TO_DATE('".$dt."', '%d-%m-%Y')";
		$sWhere=implode(" AND ",$whereArray);
		$rec=0;$nc=0;$psf=0; $sc=0;
		$query=$this->selectMultiData("refund.ref_type, refund.net, refund.airline_code, refund.ticket_no,
		refund.services_charges", "refund", "{$sWhere}");
		while($row=$query->fetch_assoc())
		{
			if($row['ref_type']=='full' && !empty($row['net']))
			{
			 $rec=$this->u_value("add_sale", "recieved", "airline_code='".$row['airline_code']."' AND 
			 ticket_no='".$row['ticket_no']."'");
			 $nc=$this->u_value("add_sale", "netCost", "airline_code='".$row['airline_code']."' AND 
			 ticket_no='".$row['ticket_no']."'");
			 $psf+=$rec-$nc;
			}
			$sc+=$row['services_charges'];
		}
		return $psf-($sc);
	}
}
?>