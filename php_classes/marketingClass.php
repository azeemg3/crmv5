<?php
class marketing extends crm
{
	// Techniques for prospectus
	function pros_tech($tech="")
	{
		$list='';
		$array=array('Exhaustive Study of Product Line','Referrals','Center of Influence','Junior Salespeople','Other Sellers',
		'Cold Canvassing','Prepaid Prospects List','Publications','Direct Mail & Technical Studies','Personal Relations',
		'Telephone',"Company's Previous Records",'Social Media', 'Facebook','What\'s App', 'Sms Marketing', 'Email Marketing', 'Client Meeting', 'other','OLX');
		foreach($array as $pros)
		{
			$list.='<option '.(($tech==$pros)?'selected':"").' value="'.$pros.'">'.$pros.'</option>';
		}
		return $list;
	}
	// fetch Persoanl information 
	function persoanl_u_val($col,$address_id)
	{
		$val="";
		$val=$this->u_value("ab_personal_info", "".$col."", "address_id=".$address_id."");
		return $val;
	}
	// fetch business information
	function business_u_val($col, $address_id)
	{
		$val=$this->u_value("ab_bus_info", "".$col."", "address_id=".$address_id."");
		return $val;
	}
	// fetch travel information
	function travel_u_val($col, $address_id)
	{
		$val=$this->u_value("ab_travel_info", "".$col."", "address_id=".$address_id."");
		return $val;
	}
	// fetch qualifying Prospects
	function qp_cus_profile($col, $address_id)
	{
		$val=$this->u_value("qp_customer_profile", "".$col."", "address_id=".$address_id."");
		return $val;
	}
	// fetch need of the custoer profile
	function qp_needs($col, $address_id)
	{
		$val=$this->u_value("qp_needs", "".$col."", "address_id=".$address_id."");
		return $val;
	}
	// fetch decesion making process
	function qp_decision_making_process($col, $address_id)
	{
		$val=$this->u_value("qp_decision_making_process", "".$col."", "address_id=".$address_id."");
		return $val;
	}
	// fetch competetion data
	function qp_competetion($col, $address_id)
	{
		$val=$this->u_value("qp_competetion", "".$col."", "address_id=".$address_id."");
		return $val;
	}
	// departments
	function departments($did="")
	{
		$list="";
		$array=array('Management','Marketing','Human Resource Management','Supply Chain', 'Operations', 'Finance & Accounts','None');
		foreach($array as $dep)
		{
			$list.='<option value="'.$dep.'" '.(($did==$dep)?'selected':"").'>'.$dep.'</option>';
		}
		return $list;
	}
	// heads of department
	function dep_heads($did="")
	{
		$list="";
		$array=array('CEO', 'Manager Director','Director','General Manager','Administrator Staff','Secretory', 
		'Director', 'General Manager',
		'Vice Presedent','Presedent','Country Manager','Manager','Assistant Manager','Brand Manager','Product Manager',
		'National Sale Manager','Regional Sale Manager','Zonal Sale Manager','Area Sale Manager',
		'Territory Manager','Business Development Manager & Executive','Sales Man',
		'Sale Manager','Medical Representative', 'Senior Manager',
		'Head Of Department','General Manager','Director','Senior Manager','Manager','Assistant Manager','Training Manager','Hr Executive','Recruitment Specialist','Admin Manager', 
		'Purchase Manager','Head Of Department','General Manager Supply Chain','Manager','Assistan Manager','Executive','Operations','Director','General Manager','Manager','Assistant Manager','Executive','Operations','Finance & Accounts','Cheip Finance','General Manager','Senior Manager','Manager','Assistant Manager','Director Finance','Auditor','Internal Auditor','External Auditor','Taxation Manager','Executive');
		foreach($array as $key)
		{
			$list.='<option '.((strtoupper($did)==strtoupper($key))?'selected':"").' value="'.strtoupper($key).'" >'.strtoupper($key).'</option>';
		}
		return $list;
	}
	//functional department
	function functional_dep($fun_dep)
	{
		// fd=functional Department
		$fd=explode(",",$fun_dep);
		$list="";
		$array=array('Management','Marketing','Human Resource Management','Supply Chain', 'Operations', 'Finance & Accounts','None');
		foreach($array as $dep)
		{
			$list.='<li><a href="#" class="small" data-value="Sales" tabIndex="-1">
                <input type="checkbox" name="cp_size_loc_dep[]" value="'.$dep.'" '.((in_array($dep, $fd))?'checked':"").'/>
                &nbsp;'.$dep.'</a></li>';
		}
		return $list;
	}
	function business_type($type="")
	{
		$list="";
		$array=array('Manufacturing','Importer','Exporter','Indent agent', 'Trader', 'Distributer');
		foreach($array as $bt)
		{
			$list.='<option value="'.$bt.'" '.(($type==$bt)?'selected':"").'>'.$bt.'</option>';
		}
		return $list;
	}
	// List of volume of possibilties...................
	function vol_poss($val)
	{
		$list="";
		for($i=10000;$i<5000000; $i+=10000)
		{
			$list.='<option value="'.$i.'-'.($i+10000).'" '.(($val==$i)?'selected':"").'>
			'.$i.'-'.($i+10000).'
			</option>';
		}
		return $list;
	}
	//Purchase frequency 
	function pur_freq($val)
	{
		$list="";
		$array=array('Weekly', 'Fournightly', 'Monthly', 'Bi Monthly', 'Quarterly', 'Yearly');
		foreach($array as $value)
		{
			$list.='<option value="'.$value.'" '.(($val==$value)?'selected':"").'>'.$value.'</option>';
		}
		return $list;
	}
	// Departmengtal wise roles 
	function dep_role($value="")
	{
		$list="";
		$array=array("Controler","Decider","Buyer","user","Intiater","Influener","GateKeeper","None");
		foreach($array as $val)
		{
			$list.='<option value="'.$val.'" '.(($value==$val)?'selected':"").'>'.$val.'</option>';
		}
		return $list;
	}
	// industry base on
	function ind_base_on($ind="")
	{
		$list="";
		$array=array("Product Based"=>"product","Service Based"=>"service");
		foreach($array as $key=>$val)
		{
			$list.='<option value="'.$val.'" '.(($ind==$val)?'selected':"").'>'.$key.'</option>';
		}
		return $list;
	}
	// idle use case
	function idle_usecase($case="")
	{
		$list="";
		$array=array("Family/Relative","Friends","Trade Fellow");
		foreach($array as $val)
		{
			$list.='<option value="'.$val.'" '.(($val==$case)?'selected':"").'>'.$val.'</option>';
		}
		return $list;
	}
	//send bulk emails from address book
	function slected_emails($subject="", $emails="", $text="", $from="")
	{
		$sign_log=$this->u_value("branches", "sign_logo", "status='active' AND branch_id=".$_SESSION['branch_id']."");
		$branch_name=strtoupper($this->u_value("branches", "branch_name", "status='active' AND 
		branch_id=".$_SESSION['branch_id'].""));
		$address=$this->u_value("branches", "address", "status='active' AND branch_id=".$_SESSION['branch_id']."");
		$branch_email=$this->u_value("branches", "branch_email", "status='active' AND branch_id=".$_SESSION['branch_id']."");
		$phone_line=$this->u_value("branches", "phone_line", "status='active' AND branch_id=".$_SESSION['branch_id']."");
		$mobile=$this->u_value("branches", "mobile", "status='active' AND branch_id=".$_SESSION['branch_id']."");
		$web=$this->u_value("branches", "web", "status='active' AND branch_id=".$_SESSION['branch_id']."");
		$id=$this->u_value("adress_book", "id", "email='admin@toursvision.com'");
		$email_header=$this->u_value("branches", "email_header", "status='active' AND branch_id=".$_SESSION['branch_id']."");
		//$Efrom =$this->u_value("branches", "branch_email", "branch_id=".$_SESSION['branch_id']."");
		$Ename =strtoupper($this->u_value("branches", "branch_name", "branch_id=".$_SESSION['branch_id'].""));
				$Emessage = '<html><body>';
				$Emessage .= "
				<div style='width:100%; margin:auto; height:auto; font-family:Calibri; background-color:#f0f7ed; padding:10px;'>
					<table align='center' border='0' style='margin:auto; padding:20px;' cellpadding='15'>
						<tr>
						<td><img src='https://crmv4.groupoperation.com/branch_logo/".$email_header."' width='100%' /></td>
						</tr>
						<tr>
						<td>
						".$text."
						</td>
						</tr>
						<!--<tr>
						<td>
						<hr/>
						<a href='http://toursvision.com/crmv2/e-marketing/email_sub.php/?id=".base64_encode($id)."' target='_blank'>Unsubscribe</a>
						<br>
						<p style='color:#548dd4'>".nl2br('Regards & Thanks<br>
				'.$branch_name.' | '.$address.' | Office: '.$phone_line.' | Mob: '.$mobile.' | 
				<a href="http://'.$web.'/" target="_blank">Visit Web Site</a>
				')."		
				</p>
				<img src='http://www.toursvision.com/crmv2/branch_logo/".$sign_log."'>
				<hr>
				</td>
				</tr>-->
				<tr>
					<td  style='border: 1px solid white;padding: 4px;background: #fff;'  colspan='10'>
					<p style='color:#548dd4'>".nl2br('Regards & Thanks<br>
				'.$branch_name.'  '.$address.' <a href="http://'.$web.'/" target="_blank">'.$web.'</a>
				')."		
				</p>
					</td>
				</tr>
				<tr>
					<td align='center'  style='border: 1px solid white;padding: 4px;background: #01bad8;' colspan='10'>
					 <img src='https://crmv4.groupoperation.com/email-temp-img/email-footer-img.png' width='100' 
					 style='float:left;'>
						<h4>Call for Our Best Deals!</h4>
						<h3>".$phone_line." , Mob: ".$mobile."</h3>
					</td>
				</tr>
				<tr style='color:#ffff;'>
					<td  style='border: 1px solid white;padding: 4px;background: #fff;' align='center' colspan='10'>
					<a href='https://www.facebook.com/tourvision/'><img src='https://crmv4.groupoperation.com/email-temp-img/facebook.png' width='30'></a>
					<a href='https://twitter.com/tourvisiontrave?ref_src=twsrc%5Etfw'>
					<img src='https://crmv4.groupoperation.com/email-temp-img/twitter.png' width='30'></a>
					<a href='https://www.linkedin.com/company/tour-vision-travel/'><img src='https://crmv4.groupoperation.com/email-temp-img/linkedin.png' width='30'></a>
					<a href='https://api.whatsapp.com/send?phone=923111381888&amp;text=Website Visitor Here'><img src='https://crmv4.groupoperation.com/email-temp-img/whatsapp.png' width='30'></a>
					</td>
				</tr>
			</table>

</div></html></body>";
 				$eachEmail=explode(",",$emails);
				foreach($eachEmail as $email)
				{
					$Eto =$email;
					$Esubject =$subject;
					$Eheaders ="From: \"".$branch_name."\"<$from>\r\n";
					$Eheaders .= "Reply-To:".$from."\r\n";
					$Eheaders .= "MIME-Version: 1.0\r\n";
					$Eheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
					$Eheaders .= "X-Priority: 3\r\n";
  					$Eheaders .= "X-Mailer: PHP". phpversion() ."\r\n"; 
					if(mail($Eto, $Esubject, $Emessage, $Eheaders)==true){ $status=1; }
					else{$status=0;}
					$el['status']=$status;
					$el['branch']=$_SESSION['branch_id'];
					$el['email']=$email;
					$this->insert_array("email_sent_rep", $el, "email_date","NOW()");
				}
	}
	// send marekting message 
	function uni_mar_msg($subject, $mobiles, $msg)
	{
		$mobiles=explode(",",$mobiles);
		$total_sendor=count($mobiles);
		if($total_sendor>400)
		{
			$mobiles= implode(",", $mobiles);
			crm::message_api($mobiles, $msg);
		}
		else
		{
			foreach($mobiles as $mobile)
			{
				if($subject!=="")
				{
					$name=$this->u_value("ab_personal_info", "name", "mobile='".$mobile."'");
					if($name!=="")
					{$message=$subject." ".$name.",".$msg;}
					else {$message=$msg;}
				}
				else
				{
					$message=$msg;
				}
				crm::message_api($mobile, $message);
			}
		}
	}
	//send cron job hourly send 200 emails in per hour 
	function bulk_email()
		{
			$branch=$this->u_value("bulk_email_text", "branch", "status='in_process' AND type='address_book'");
			if(!empty($branch))
			{
			$query=$this->selectMultiData("address_book.*, ab_personal_info.*", "address_book INNER JOIN ab_personal_info ON address_book.address_id=ab_personal_info.address_id", "address_book.email_sent_rep=1  AND branch_id=".$branch." AND ab_personal_info.email!='' GROUP bY ab_personal_info.email LIMIT 50");
			$sign_log=$this->u_value("branches", "sign_logo", "status='active' AND branch_id=".$branch."");
			$branch_name=strtoupper($this->u_value("branches", "branch_name", "status='active' AND branch_id=".$branch.""));
			$address=$this->u_value("branches", "address", "status='active' AND branch_id=".$branch."");
			$branch_email=$this->u_value("branches", "branch_email", "status='active' AND branch_id=".$branch."");
			$phone_line=$this->u_value("branches", "phone_line", "status='active' AND branch_id=".$branch."");
			$mobile=$this->u_value("branches", "mobile", "status='active' AND branch_id=".$branch."");
			$web=$this->u_value("branches", "web", "status='active' AND branch_id=".$branch."");
			while($row=$query->fetch_assoc())
			{
				$id=$row['address_id'];
				$Emessage = '<html><body>';
				$Emessage .= "
				<div style='width:100%; margin:auto; height:auto; font-family:Calibri; background:#f0f7ed; padding:10px; '>
					<table align='center' border='0' style='margin:auto; padding:20px;' cellpadding='15'>
						<tr>
						<td><img src='https://crmv4.groupoperation.com/branch_logo/".$this->u_value("branches", "email_header", "status='active' AND branch_id=".$branch."")."' /></td>
						</tr>
						<tr>
						<td>
						<span style='color:green;'>
						".$this->u_value("bulk_email_text", "email_text", "branch=".$branch." AND status='in_process'")."
						<br>
						<a href='email_sub?id=".base64_encode($id)."' target='_blank'>Unsubscribe</a><br>
						</span>
						</td>
						</tr>
						<tr>
					<td  style='border: 1px solid white;padding: 4px;background: #fff;'  colspan='10'>
					<p style='color:#548dd4'>".nl2br('Regards & Thanks<br>
				'.$branch_name.'  '.$address.' <a href="http://'.$web.'/" target="_blank">'.$web.'</a>
				')."		
				</p>
					</td>
				</tr>
				<tr>
					<td align='center'  style='border: 1px solid white;padding: 4px;background: #01bad8;' colspan='10'>
					 <img src='https://crmv4.groupoperation.com/email-temp-img/email-footer-img.png' width='100' 
					 style='float:left;'>
						<h4>Call for Our Best Deals!</h4>
						<h3>".$phone_line." , Mob: ".$mobile."</h3>
					</td>
				</tr>
				<tr style='color:#ffff;'>
					<td  style='border: 1px solid white;padding: 4px;background: #fff;' align='center' colspan='10'>
					<a href='https://www.facebook.com/tourvision/'><img src='https://crmv4.groupoperation.com/email-temp-img/facebook.png' width='30'></a>
					<a href='https://twitter.com/tourvisiontrave?ref_src=twsrc%5Etfw'>
					<img src='https://crmv4.groupoperation.com/email-temp-img/twitter.png' width='30'></a>
					<a href='https://www.linkedin.com/company/tour-vision-travel/'><img src='https://crmv4.groupoperation.com/email-temp-img/linkedin.png' width='30'></a>
					<a href='https://api.whatsapp.com/send?phone=923111381888&amp;text=Website Visitor Here'><img src='https://crmv4.groupoperation.com/email-temp-img/whatsapp.png' width='30'></a>
					</td>
				</tr>
						
						
			</table>

</div>"."<br>";
					$from=$this->u_value("bulk_email_text", "email_from", "branch=".$branch." AND status='in_process'");
					$email=$this->u_value("ab_personal_info", "email", "address_id=".$row['address_id']."");
					$Eto =$email;
					$Esubject =$this->u_value("bulk_email_text", "subject", "status='in_process' AND branch=".$branch."");
					$Eheaders ="From: \"".$branch_name."\"<".$from.">\r\n";
					$Eheaders .= "Reply-To:azeemkhalidg3@gmail.com,".$from."\r\n";
					$Eheaders .= "MIME-Version: 1.0\r\n";
					$Eheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
					if(mail($Eto, $Esubject, $Emessage, $Eheaders)==true){ $status=1; }
					else{$status=0;}
					$email_text_id=$this->u_value("bulk_email_text", "id", "status='in_process'");
					$el['email_text_id']=$email_text_id;
					$el['status']=$status;
					$el['branch']=$branch;
					$el['email']=$row['email'];
					$this->insert_array("email_sent_rep", $el, "email_date","NOW()");
					$this->update("address_book", "email_sent_rep='0'", "address_id=".$id." AND branch_id=".$branch."");
				}
			
			//count email in process
			$email_in_pro=$this->count_val("address_book", "address_id", "email_sent_rep='1' AND branch_id=".$branch."");
			if($email_in_pro==0 || $email_in_pro="")
			{
				$this->update("bulk_email_text", "status='completed'", "status='in_process'");
				
			}
			}
		}
		//send cron job hourly send 200 emails in per hour 
	function lead_bulk_email()
		{
			$branch=$this->u_value("bulk_email_text", "branch", "status='in_process' AND type='lead'");
			if(!empty($branch))
			{
			$query=$this->selectMultiData("id,email", "lead", "email_sent_status=1  AND branch_id=".$branch." AND 
			email!='' GROUP bY email LIMIT 50");
			$sign_log=$this->u_value("branches", "sign_logo", "status='active' AND branch_id=".$branch."");
			$branch_name=strtoupper($this->u_value("branches", "branch_name", "status='active' AND branch_id=".$branch.""));
			$address=$this->u_value("branches", "address", "status='active' AND branch_id=".$branch."");
			$branch_email=$this->u_value("branches", "branch_email", "status='active' AND branch_id=".$branch."");
			$phone_line=$this->u_value("branches", "phone_line", "status='active' AND branch_id=".$branch."");
			$mobile=$this->u_value("branches", "mobile", "status='active' AND branch_id=".$branch."");
			$web=$this->u_value("branches", "web", "status='active' AND branch_id=".$branch."");
			while($row=$query->fetch_assoc())
			{
				$id=$row['id'];
				$Emessage = '<html><body>';
				$Emessage .= "
				<div style='width:100%; margin:auto; height:auto; font-family:Calibri; background:#f0f7ed; padding:10px; '>
					<table align='center' border='0' style='margin:auto; padding:20px;' cellpadding='15'>
						<tr>
						<td>
						<img src='https://crmv4.groupoperation.com/branch_logo/".$this->u_value("branches", "email_header", "status='active' AND branch_id=".$branch."")."' /></td>
						</tr>
						<tr>
						<td>
						<span style='color:green;'>
						".$this->u_value("bulk_email_text", "email_text", "branch=".$branch." AND status='in_process'")."
						<br>
						<!--<a href='email_sub?id=".base64_encode($id)."' target='_blank'>Unsubscribe</a>--><br>
						".$data."
						</span>
						</td>
						</tr>
						<tr>
							<td  style='border: 1px solid white;padding: 4px;background: #fff;'  colspan='10'>
							<p style='color:#548dd4'>".nl2br('Regards & Thanks<br>
							'.$branch_name.'  '.$address.' <a href="http://'.$web.'/" target="_blank">'.$web.'</a>')."		
							</p>
					</td>
				</tr>
				<tr>
					<td align='center'  style='border: 1px solid white;padding: 4px;background: #01bad8;' colspan='10'>
					 <img src='https://crmv4.groupoperation.com/email-temp-img/email-footer-img.png' width='100' 
					 style='float:left;'>
						<h4>Call for Our Best Deals!</h4>
						<h3>".$phone_line." , Mob: ".$mobile."</h3>
					</td>
				</tr>
						<tr style='color:#ffff;'>
					<td  style='border: 1px solid white;padding: 4px;background: #fff;' align='center' colspan='10'>
					<a href='https://www.facebook.com/tourvision/'><img src='https://crmv4.groupoperation.com/email-temp-img/facebook.png' width='30'></a>
					<a href='https://twitter.com/tourvisiontrave?ref_src=twsrc%5Etfw'>
					<img src='https://crmv4.groupoperation.com/email-temp-img/twitter.png' width='30'></a>
					<a href='https://www.linkedin.com/company/tour-vision-travel/'><img src='https://crmv4.groupoperation.com/email-temp-img/linkedin.png' width='30'></a>
					<a href='https://api.whatsapp.com/send?phone=923111381888&amp;text=Website Visitor Here'><img src='https://crmv4.groupoperation.com/email-temp-img/whatsapp.png' width='30'></a>
					</td>
				</tr>
						
						
			</table>

</div>"."<br>";
					$from=$this->u_value("bulk_email_text", "email_from", "branch=".$branch." AND status='in_process'");
					$Eto =$row['email'];
					$Esubject =$this->u_value("bulk_email_text", "subject", "status='in_process' AND branch=".$branch."");
					$Eheaders ="From: \"".$branch_name."\"<".$from.">\r\n";
					$Eheaders .= "Reply-To:azeemkhalidg3@gmail.com,".$from."\r\n";
					$Eheaders .= "MIME-Version: 1.0\r\n";
					$Eheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
					if(mail($Eto, $Esubject, $Emessage, $Eheaders)==true){ $status=1; }
					else{$status=0;}
					$email_text_id=$this->u_value("bulk_email_text", "id", "status='in_process'");
					$el['email_text_id']=$email_text_id;
					$el['status']=$status;
					$el['branch']=$branch;
					$el['email']=$row['email'];
					$this->update("lead", "email_sent_status='0'", "email='".$row['email']."' AND branch_id=".$branch."");
					$this->insert_array("email_sent_rep", $el, "email_date","NOW()");
			}
				//count email in process
				$email_in_pro=$this->count_val("lead", "id", "email_sent_status='1' AND branch_id=".$branch."");
				if($email_in_pro==0 || $email_in_pro="")
				{
					$this->update("bulk_email_text", "status='completed'", "status='in_process'");
					
				}
			}
		}
		// e marketing groups list
		function e_mar_group($group_id="")
		{
			$list="";
			$result=$this->selectData("e_mark_groups","branch_id=".$_SESSION['branch_id']."");
			while($row=$result->fetch_assoc())
			{
				$list.='<option '.(($row['group_id']==$group_id)?'selected':'').' value="'.$row['group_id'].'">'.$row['group_name'].'</option>';
			}
			return $list;
		}
}
?>