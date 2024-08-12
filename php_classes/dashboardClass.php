<?php
class dashBoard extends crm
{
	public $administrator;
	private $lead;
	public function __construct(){
		$this->administrator=new administrator();
		$this->lead=new lead();
	}
	
	public function allLeads($userBranch)
	{
		$totalLeads='<div class="panel panel-default">
            <div class="panel-body" style="padding-bottom:0px !important;">
            <div class="col-lg-2 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow-gradient">
                <div class="inner">
					<h3>'.$this->lead->countAllLeads($userBranch, 'pending').'</h3>
                    <p>Pending</p>
					<div class="icon">
					  <i class="ion ion-person-add"></i>
					</div>
                </div>
                <a href="allLeads?status=pending" class="small-box-footer">Leads <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-2 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-blue-gradient">
                <div class="inner">
				  <h3>'.$this->lead->countAllLeads($userBranch, 'new').'</h3>
                  <p>Take Over</p>
				   <div class="icon">
					  <i class="ion ion-person-add"></i>
				   </div>
                </div>
                <a href="allLeads?status=new" class="small-box-footer">Leads <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-2 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-teal-gradient">
                <div class="inner">
				<h3>'.$this->lead->countAllLeads($userBranch, 'process').'</h3>
                  <p>In Process</p>
				   <div class="icon">
					  <i class="ion ion-person-add"></i>
				   </div>
                </div>
                <a href="allLeads?status=process" class="small-box-footer">Leads <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-2 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green-gradient">
                <div class="inner">
				<h3>'.$this->lead->countAllLeads($userBranch, 'successfull').'</h3>
                  <p>Successfull</p>
				  <div class="icon">
					  <i class="ion ion-person-add"></i>
				   </div>
                </div>
                <a href="allLeads?status=successfull" class="small-box-footer">Leads <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-2 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red-gradient">
                <div class="inner">
				<h3>'.$this->lead->countAllLeads($userBranch, 'unsuccessfull').'</h3>
                  <p>UnSuccessfull</p>
				  <div class="icon">
					  <i class="ion ion-person-add"></i>
				   </div>
                </div>
                <a href="allLeads?status=unsuccessfull" class="small-box-footer">Leads <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-2 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-orange">
			  <h3> '.$this->lead->countAllLeads($userBranch, 'all').'</h3>
                <div class="inner">
                  <p>Total</p>
				  <div class="icon">
					  <i class="ion ion-person-add"></i>
				   </div>
                </div>
                <a href="allLeads?status=" class="small-box-footer">Leads <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
    <!--panel-body-->
                </div>';
				return $totalLeads;
	}
	// calendar 
	function calendar()
	{
		$calendar='
					<div class="box box-solid bg-green-gradient">
                <div class="box-header">
                  <i class="fa fa-calendar"></i>
                  <h3 class="box-title">Calendar</h3>
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                    <!-- button with a dropdown -->
                    <div class="btn-group">
                      <button class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                      <ul class="dropdown-menu pull-right" role="menu">
                        <li><a href="#">Add new event</a></li>
                        <li><a href="#">Clear events</a></li>
                        <li class="divider"></li>
                        <li><a href="#">View calendar</a></li>
                      </ul>
                    </div>
                    <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div><!-- /. tools -->
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <!--The calendar -->
                  <div id="calendar" style="width: 100%"></div>
                </div><!-- /.box-body -->
              </div>
			';
			return $calendar;
	}
	//labels for daily sale report grahp
	public function daily_days_graph()
	{
		
		if(date_default_timezone_set("Asia/karachi")==true)
		{
			date_default_timezone_set("Asia/karachi");
		}
		else
		{
			date_default_timezone_set("Asia/Dubai");
		}
		$days="";
		$daily_ts="";
		$month=date("m");
		$year=date("Y");
		// this calculates the last day of the given month
		$last=cal_days_in_month(CAL_GREGORIAN, $month, $year);
	
		$date=new DateTime();
		$res=Array();
	
		// iterates through days
		for ($day=1;$day<=$last;$day++) {
				$date->setDate($year, $month, $day);
	
				$res[$day]=$date->format("M");
		}
		$i=1;
		$array=array();
		 foreach($res as $r)
		 {
  			//echo $r."".$i.",";
        $days.='"'.$r.$i.'",';
       
          $df=$i.'-'.$month.'-'.$year;
  			 $daily_ts.=$this->administrator->daily_graph_sale($df,$df).",";
        //$daily_ts.=$j."-".$month.'-'.$year.'<br>';
  				$i++;
  		 }
  		$array[]=array('days'=>$days, "ts"=>$daily_ts);
  		 return $array;
	}
	//spo labesl list implement in dashboard
	public function all_branch_spoList($branch="")
	{
		$list="";
		$result=$this->selectData("user","branch_id=".$_SESSION['branch_id']." AND status='active'");
		while($row=$result->fetch_assoc())
		{
			if($this->user_access("sale_posting", $row['id']))
			{
				$list.="'".$row['name']."'".",";
			}
		}
		return $list;
	}
}
?>