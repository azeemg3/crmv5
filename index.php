<?php
require_once'inc.func.php';
$cm->get_header();
$gs=$dashboard->daily_days_graph();
?>
<style>
	canvas {
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
	}
	.chart-container {
		width: 500px;
		margin-left: 40px;
		margin-right: 40px;
		margin-bottom: 40px;
	}
	.day_container {
		display: flex;
		flex-direction: row;
		flex-wrap: wrap;
		justify-content: center;
	}
	</style>
  <div class="content-wrapper" id="loadpage"> 
    <!-- Content Header (Page header) --> 
    <!-- Main content -->
    <section class="content">
      <section class="content-header" style="padding-bottom: 14px;padding-top:0px !important;">
        <h1> Dashboard <small>Control panel</small> </h1>
        <ol class="breadcrumb" style="padding:0px 5px !important;top:5px !important;;">
          <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </section>
      <!-- Small boxes (Stat box) -->
      <?php
		  if($cm->user_access('branch_admin', $_SESSION['sessionId'])){
		   echo $dashboard->allLeads($_SESSION['branch_id']);
		  }
		  else
		  {
			  echo $lead->spo_leads($_SESSION['sessionId'], $_SESSION['branch_id']);
		  }
		    ?>
      <!-- Calendar --> 
      <?php echo $dashboard->calendar(); ?> 
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.js"></script> 
      <script type="text/javascript" src="js/utills.js"></script>
      <!-- /.row --> 
      <!-- Main row -->
      <div class="row"> 
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable"> 
          <!-- Custom tabs (Charts with tabs)-->
          <div class="box box-primary">
            <div class="day_container"></div>
          </div>
          
          <div class="box box-primary">
            <div class="box-header"> <i class="ion ion-clipboard"></i>
              <h3 class="box-title">To Do List</h3>
              <div class="box-tools pull-right">
                <ul class="pagination pagination-sm inline">
                  <li><a href="#">&laquo;</a></li>
                  <li><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">&raquo;</a></li>
                </ul>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="todo-list">
                <li> 
                  <!-- drag handle --> 
                  <span class="handle"> <i class="fa fa-ellipsis-v"></i> <i class="fa fa-ellipsis-v"></i> </span> 
                  <!-- checkbox -->
                  <input type="checkbox" value="" name="">
                  <!-- todo text --> 
                  <span class="text">Design a nice theme</span> 
                  <!-- Emphasis label --> 
                  <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small> 
                  <!-- General tools such as edit or delete-->
                  <div class="tools"> <i class="fa fa-edit"></i> <i class="fa fa-trash-o"></i> </div>
                </li>
                <li> <span class="handle"> <i class="fa fa-ellipsis-v"></i> <i class="fa fa-ellipsis-v"></i> </span>
                  <input type="checkbox" value="" name="">
                  <span class="text">Make the theme responsive</span> <small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
                  <div class="tools"> <i class="fa fa-edit"></i> <i class="fa fa-trash-o"></i> </div>
                </li>
                <li> <span class="handle"> <i class="fa fa-ellipsis-v"></i> <i class="fa fa-ellipsis-v"></i> </span>
                  <input type="checkbox" value="" name="">
                  <span class="text">Let theme shine like a star</span> <small class="label label-warning"><i class="fa fa-clock-o"></i> 1 day</small>
                  <div class="tools"> <i class="fa fa-edit"></i> <i class="fa fa-trash-o"></i> </div>
                </li>
                <li> <span class="handle"> <i class="fa fa-ellipsis-v"></i> <i class="fa fa-ellipsis-v"></i> </span>
                  <input type="checkbox" value="" name="">
                  <span class="text">Let theme shine like a star</span> <small class="label label-success"><i class="fa fa-clock-o"></i> 3 days</small>
                  <div class="tools"> <i class="fa fa-edit"></i> <i class="fa fa-trash-o"></i> </div>
                </li>
                <li> <span class="handle"> <i class="fa fa-ellipsis-v"></i> <i class="fa fa-ellipsis-v"></i> </span>
                  <input type="checkbox" value="" name="">
                  <span class="text">Check your messages and notifications</span> <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 week</small>
                  <div class="tools"> <i class="fa fa-edit"></i> <i class="fa fa-trash-o"></i> </div>
                </li>
                <li> <span class="handle"> <i class="fa fa-ellipsis-v"></i> <i class="fa fa-ellipsis-v"></i> </span>
                  <input type="checkbox" value="" name="">
                  <span class="text">Let theme shine like a star</span> <small class="label label-default"><i class="fa fa-clock-o"></i> 1 month</small>
                  <div class="tools"> <i class="fa fa-edit"></i> <i class="fa fa-trash-o"></i> </div>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
              <button class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
            </div>
          </div>
          <!-- /.box --> 
          <!-- quick email widget -->
        </section>
        <!-- /.Left col --> 
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable "> 
          <div class="box box-info" style="height:400px;">
            <canvas id="myChart" width="400" height="380" style="padding:10px;"></canvas>
          </div>
          <!-- /.box --> 
          <?php if($cm->user_access('branch_admin', $_SESSION['sessionId'])){ ?>
           <div class="box box-info" style="height:400px;">
            <canvas id="myChart2" width="400" height="380" style="padding:10px;"></canvas>
          </div>
          <!-- /.box --> 
          <?php } ?>
          <!-- Chat box -->
          <!--<div class="box box-success">-->
            <!--<div class="box-header"> <i class="fa fa-comments-o"></i>
              <h3 class="box-title">Chat</h3>
              <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
                <div class="btn-group" data-toggle="btn-toggle" >
                  <button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i></button>
                </div>
              </div>
            </div>-->
            <!--<div class="box-body chat" id="chat-box"> -->
              <!-- chat item -->
             <!-- <div class="item"> <img src="dist/img/user4-128x128.jpg" alt="user image" class="online">-->
                <!--<p class="message"> <a href="#" class="name"> <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 2:15</small> Mike Doe </a> I would like to meet you to discuss the latest news about
                  the arrival of the new theme. They say it is going to be one the
                  best themes on the market </p>-->
                <!--<div class="attachment">
                  <h4>Attachments:</h4>
                  <p class="filename"> Theme-thumbnail-image.jpg </p>
                  <div class="pull-right">
                    <button class="btn btn-primary btn-sm btn-flat">Open</button>
                  </div>
                </div>-->
                <!-- /.attachment --> 
             <!-- </div>-->
              <!-- /.item --> 
              <!-- chat item -->
              <!--<div class="item"> <img src="dist/img/user3-128x128.jpg" alt="user image" class="offline">-->
                <!--<p class="message"> <a href="#" class="name"> <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:15</small> Alexander Pierce </a> I would like to meet you to discuss the latest news about
                  the arrival of the new theme. They say it is going to be one the
                  best themes on the market </p>-->
             <!-- </div>-->
              <!-- /.item --> 
              <!-- chat item -->
              <!--<div class="item"> <img src="dist/img/user2-160x160.jpg" alt="user image" class="offline">
                <p class="message"> <a href="#" class="name"> <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:30</small> Susan Doe </a> I would like to meet you to discuss the latest news about
                  the arrival of the new theme. They say it is going to be one the
                  best themes on the market </p>
              </div>-->
              <!-- /.item --> 
            <!--</div>-->
            <!-- /.chat -->
            <!--<div class="box-footer">
              <div class="input-group">
                <input class="form-control" placeholder="Type message...">
                <div class="input-group-btn">
                  <button class="btn btn-success"><i class="fa fa-plus"></i></button>
                </div>
              </div>
            </div>-->
          <!--</div>-->
          <!-- /.box (chat box) --> 
        </section>
        <!-- right col --> 
				
      </div>
      <!-- /.row (main row) --> 
<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['JAN', "FEB", "MARCH", "APRIL", "MAY", "JUNE", "JULY","AUG", "SEP","OCT", "NOV", "DEC",],
        datasets: [{
            label: 'Sale Graph',
            data: [<?php echo $administrator->monthly_sale('01-01-'.date('Y').'', '31-01-'.date('Y').''); ?>, 
			<?php echo $administrator->monthly_sale('01-02-'.date('Y').'', '28-02-'.date('Y').''); ?>, 
			<?php echo $administrator->monthly_sale('01-03-'.date('Y').'', '31-03-'.date('Y').''); ?>, 
			<?php echo $administrator->monthly_sale('01-04-'.date('Y').'', '30-04-'.date('Y').''); ?>, 
			<?php echo $administrator->monthly_sale('01-05-'.date('Y').'', '31-05-'.date('Y').''); ?>, 
			<?php echo $administrator->monthly_sale('01-06-'.date('Y').'', '30-06-'.date('Y').''); ?>,
			<?php echo $administrator->monthly_sale('01-07-'.date('Y').'', '31-07-'.date('Y').''); ?>,
			<?php echo $administrator->monthly_sale('01-08-'.date('Y').'', '31-08-'.date('Y').''); ?>,
			<?php echo $administrator->monthly_sale('01-09-'.date('Y').'', '30-09-'.date('Y').''); ?>,
			<?php echo $administrator->monthly_sale('01-10-'.date('Y').'', '31-10-'.date('Y').''); ?>,
			<?php echo $administrator->monthly_sale('01-11-'.date('Y').'', '30-11-'.date('Y').''); ?>,
			<?php echo $administrator->monthly_sale('01-12-'.date('Y').'', '31-12-'.date('Y').''); ?>],
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
<script>
var ctx = document.getElementById("myChart2").getContext('2d');

var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?php echo $dashboard->all_branch_spoList(); ?>],
        datasets: [{
            label: 'Sale Graph',
            data: [<?php echo $administrator->monthly_spo_sale('01-'.date('m').'-'.date('Y').'', date("t-m-Y")) ?>],
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
                    beginAtZero:true,
                }
            }],
			xAxes: [{
        stacked: false,
        beginAtZero: true,
        scaleLabel: {
            labelString: 'Month'
        },
        ticks: {
            stepSize: 1,
            min: 0,
            autoSkip: false
        }
    }]
        },
		legend: { display: false }
    }
});
</script>
    </section>
    <!-- /.content --> 
 </div>
  <!-- /.content-wrapper -->
  <?php 
$cm->get_footer();
?>
<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
<script>
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
      });
    </script>
    <script>
		function createConfig(position) {
			return {
				type: 'line',
				data: {
					labels: [<?php echo $gs[0]['days'] ?>],
					datasets: [{
						label: "Daily Sale",
						borderColor: window.chartColors.blue,
						backgroundColor: window.chartColors.blue,
						data: [<?php echo $gs[0]['ts'] ?>],
						fill: false,
					}]
				}
			};
		}

		window.onload = function() {
			var container = document.querySelector('.day_container');

			['nearest'].forEach(function(position) {
				var div = document.createElement('div');
				div.classList.add('chart-container');

				var canvas = document.createElement('canvas');
				div.appendChild(canvas);
				container.appendChild(div);

				var ctx = canvas.getContext('2d');
				var config = createConfig(position);
				new Chart(ctx, config);
			})
		};
	</script>