<?php 
require_once'../inc.func.php';
$cm->get_header("../");
$userId="";
if(isset($_POST['spo']) && !empty($_POST['spo']))
{
	$userId=$_POST['spo'];
}
?>
<script>
document.title='Spo\'s Sale Graph';
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.js"></script> 
<script type="text/javascript" src="../js/utills.js"></script>
<div class="content-wrapper">
<section class="content-header" style="padding-bottom: 14px;">
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
<h2 class="text-center bg-green-gradient" style="margin:0px;padding:10px 0px;">
<span class="main-heading">Spo's Sale Graph</span></h2>
<div class="panel panel-default">
  <div class="panel-body">
  	<div class="col-md-2">
     <div class="form-group">
     <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
     <select name="spo" class="form-control input-sm">
     	<option value="">Select Spo</option>
        <?php echo $cm->spo($userId, $_SESSION['branch_id']); ?>
     </select>
     </div>
    </div>
    <!--col-md-2-->
    <div class="col-md-2">
     <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Search</button>
    </div>
    <!--col-md-2-->
    </form>
    <div class="clearfix"></div>
  	<div class="box box-info">
      <canvas id="myChart"></canvas>
    </div>
  </div>
<!--panel panel-default-->
	</div>
    <!--panel-body-->
    </section>
</div>
<!-- container-->
<script>	  
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['JAN', "FEB", "MARCH", "APRIL", "MAY", "JUNE", "JULY","AUG", "SEP","OCT", "NOV", "DEC",],
        datasets: [{
            label: 'Sale Graph',
            data: [<?php echo $administrator->monthly_spo_sg('01-01-'.date('Y').'', '31-01-'.date('Y').'', $userId); ?>,
				<?php echo $administrator->monthly_spo_sg('01-02-'.date('Y').'', '28-02-'.date('Y').'',$userId); ?>,
				<?php echo $administrator->monthly_spo_sg('01-03-'.date('Y').'', '31-03-'.date('Y').'', $userId); ?>,
				<?php echo $administrator->monthly_spo_sg('01-04-'.date('Y').'', '30-04-'.date('Y').'', $userId); ?>,
				<?php echo $administrator->monthly_spo_sg('01-05-'.date('Y').'', '31-05-'.date('Y').'', $userId); ?>,
				<?php echo $administrator->monthly_spo_sg('01-06-'.date('Y').'', '30-06-'.date('Y').'', $userId); ?>,
				<?php echo $administrator->monthly_spo_sg('01-07-'.date('Y').'', '31-07-'.date('Y').'', $userId); ?>,
				<?php echo $administrator->monthly_spo_sg('01-08-'.date('Y').'', '31-08-'.date('Y').'', $userId); ?>,
				<?php echo $administrator->monthly_spo_sg('01-09-'.date('Y').'', '30-09-'.date('Y').'', $userId); ?>,
				<?php echo $administrator->monthly_spo_sg('01-10-'.date('Y').'', '31-10-'.date('Y').'', $userId); ?>,
				<?php echo $administrator->monthly_spo_sg('01-11-'.date('Y').'', '30-11-'.date('Y').'', $userId); ?>,
				<?php echo $administrator->monthly_spo_sg('01-12-'.date('Y').'', '31-12-'.date('Y').'', $userId); ?>,	
				],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
				'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
				'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        },
		legend: { display: false }
    }
});
</script>
<?php $cm->get_footer("../") ?>