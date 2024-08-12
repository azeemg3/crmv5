<?php
require_once'../inc.func.php';
$cm->get_header("../")
?>
<script>
    document.title = 'Airline Seat';
</script>
<body onLoad="call_ajax('../ajax_call/get_airlineSeat_list', '', 'get_airlineSeat')">
    <div class="content-wrapper" id="loadpage">

        <section class="content-header" style="border-bottom: 1px solid;padding-bottom: 14px;">
            <h1>
                Dashboard
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
                <li class="">Administrator</li>
                 <li class="">Airline Seats</li>
            </ol>
        </section>
        <h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Airline Seat</span></h2>
        <div class="panel panel-default">
            <div class="panel-body">
            <form id="airlineSeatForm">
            <div class="col-md-3">
            	<div class="form-group">
                	<input type="text" name="seat_name" class="form-control input-sm" placeholder="Seat Name">
                </div>
            </div>
            <div class="col-md-3">
            	<div class="form-group">
                	<button type="button" class="btn btn-sm btn-success" onClick="get_airlineSeat()">Add</button>
                </div>
            </div>
            </form>
            </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped dataTable">
                        </thead>
                        <thead>
                            <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
                                <th>#</th>
                                <th>Seat Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="get_airlineSeat">

                        </tbody>
                    </table>
                </div>
            </div>
            <!--panel panel-default-->
        </div>
    <!-- container-->
<?php $cm->get_footer("../") ?>