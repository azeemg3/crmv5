<?php 
require_once'../inc.func.php';
$cm->get_header("../");
$cm->user_auth("accounts", $_SESSION['sessionId'], "../");
?>
<script>
document.title='Day Book';
</script>
<body onLoad="get_day_book()">
<div class="content-wrapper">
<section class="content-header" style="border-bottom:1px solid;padding-bottom: 14px;">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>
    <section class="content">
	<h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Day Book</span></h2>
	<div class="panel panel-default">
  		<div class="panel-body">
        <form id="form">
        <div class="col-sm-2">
        	<div class="form-group">
                <input type="text" name="dt_frm" class="form-control input-sm date" placeholder="Date From" value="<?php echo $cm->today(); ?>">
            </div>
        </div>
        <div class="col-sm-2">
        	<div class="form-group">
                <input type="text" name="dt_to" class="form-control input-sm date" placeholder="Date To" value="<?php echo $cm->today(); ?>">
            </div>
        </div>
        <div class="col-sm-1">
        	<button type="button" onClick="get_day_book()" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Search</button>
        </div>
        <div class="col-md-3">
             <button type="submit" class="btn btn-sm btn-default" formaction="print_daybook" formmethod="post" formtarget="_blank">
             <i class="glyphicon glyphicon-print"></i></button>
             <button type="button" class="btn btn-sm btn-default" onClick="get_acc_ledger()">
             <i class="glyphicon glyphicon-download-alt"></i></button>
        </div>
        <!-- col-lg-2-->
        </form>
        <div class="clearfix"></div>
        <div class="test"></div>
          <div class="table-responsive">
          	<table class="table table-bordered table-striped">
            	<thead>
                	<tr>
                    	<td colspan="10"><strong>Day Book Date: (<?php echo $cm->today(); ?>)</strong></td>
                    </tr>
                </thead>
                <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
                    <td width="10%">Date</td>
                    <td>Voucher</td>
                    <td width="12%">Invoice Number</td>
                    <td width="15%">Trans A/C</td>
                    <td>Description</td>
                    <td>Debit</td>
                    <td>Credit</td>
                    <td width="10%">Balance</td>
               </tr>
               <tbody id="get_ob">
               </tbody>
               <?php 
			   $balance="";
			   /*
			    $ob_result=$cm->selectData("trans_acc","1"); 
			   		while($ob_row=$ob_result->fetch_assoc())
					{
						$balance+=$administrator->ob('01-08-2017','01-08-2017',$ob_row['trans_acc_id']);
						echo '
							 <tr>
						   <td></td>
						   <td></td>
						   <td></td>
						   <td>'.$ob_row['trans_acc_name'].'</td>
							<td>Opening Balance As At '.$cm->today().'</td>
							<td>'.(($administrator->ob('01-08-2017','01-08-2017',$ob_row['trans_acc_id'])>0)?'
							'.number_format(abs($administrator->ob('01-08-2017','01-08-2017',$ob_row['trans_acc_id'])),2).'':"").'</td>
							<td>'.(($administrator->ob('01-08-2017','01-08-2017',$ob_row['trans_acc_id'])<0)?'
							'.number_format(abs($administrator->ob('01-08-2017','01-08-2017',$ob_row['trans_acc_id'])),2).'':"").'</td>
							<td>'.$cm->show_bal($balance).'</td>
						   </tr>
						';
					}*/
			   ?>
               <tbody id="get_daily_trans">
               </tbody>
               <?php
			   /*$bal="";
			   $result=$cm->selectData("trans","1");
			   while($row=$result->fetch_assoc())
			   {
				   if($row['dr_cr']=='dr'){$bal+=$row['amount'];}
				   elseif($row['dr_cr']=='cr'){$bal+='-'.$row['amount'];}
				   echo '<tr>
				   	<td>'.$row['trans_date'].'</td>
					<td></td>
					<td></td>
					<td>'.$cm->u_value("trans_acc","trans_acc_name","trans_acc_id=".$row['trans_acc_id']."").'</td>
					<td>'.$row['narration'].'</td>
					<td>'.(($row['dr_cr']=='dr')?''.$row['amount'].'':"----").'</td>
					<td>'.(($row['dr_cr']=='cr')?''.$row['amount'].'':"----").'</td>
					<td>'.$cm->show_bal($bal+$balance).'</td>
				   </tr>';
			   }*/
			   ?>
          </table>
          </div>
          <!-- responsive-->  
		</div>
	<!--panel panel-default-->
	</div>
    <!--panel-body-->
    </section>
</div>
<!-- container-->
<?php 
$cm->get_footer("../")
?>
