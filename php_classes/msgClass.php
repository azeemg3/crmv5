<?php
class message extends crm
{
	public function return_msg($data="")
	{
		if(isset($_SESSION['msg']))
		{ 
			$resp=$_SESSION['msg']; 
			if($resp=='1')
			{
				$msg='
				<div class="clearfix"></div>
				<div class="alert alert-success alert-dismissable col-md-6 col col-md-offset-3">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h4><i class="icon fa fa-check"></i> Alert!</h4>
						Operation Successfully....
					  </div>
				<div class="clearfix"></div>';	
			}
			elseif($resp=='2')
			{
				$msg='
				<div class="clearfix"></div>
				<div class="alert alert-danger alert-dismissable col-md-6 col col-md-offset-3">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h4><i class="icon fa fa-ban"></i> Alert!</h4>
						Something Wrong with your query....
					  </div>
				<div class="clearfix"></div>';	
			}
			elseif($resp=='1062')
			{
				$msg='
				<div class="clearfix"></div>
				<div class="alert alert-warning alert-dismissable col-md-6 col col-md-offset-3">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h4><i class="icon fa fa-ban"></i> Alert!</h4>
						You are Trying to Insert Duplicate Entry Try Again....
					  </div>
				<div class="clearfix"></div>';	
			}
			unset($_SESSION['msg']); 
			return $msg;
		}
	}
}
?>