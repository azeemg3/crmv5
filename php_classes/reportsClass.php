<?php
class reports extends crm
{
	public function fetch_rep_date($search_date, $days)
	{
		if(date_default_timezone_set("Asia/karachi")==true)
		{
			date_default_timezone_set("Asia/karachi");
		}
		else
		{
			date_default_timezone_set("Asia/Dubai");
		}
		$date =$prev_date = date("d-m-Y", strtotime('-'.$days.' days', strtotime($search_date)) );
		/*$old_date = date("d-m-Y", strtotime($search_date) );
		$prev_date = date("d-m-Y", strtotime('-30 days', strtotime('15-12-2017')) );*/
		return $date;
	}
}
?>