<?php
require_once'../inc.func.php';
$cm->get_header("../");
$status="";
if(isset($_GET['status']) && $_GET['status']!=="update")
{
	$status=$_GET['status'];	
}
?>
<script>
    document.title = 'All Leads';
</script>
<body onLoad="call_ajax('ajax_call/get_access_log', '', 'get_access_log')">
    <div class="content-wrapper" id="loadpage">
        <section class="content-header" style="border-bottom: 1px solid;padding-bottom: 14px;">
            <h1>
                Dashboard
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Pages Log</span></h2>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="table-responsive">
                    <form id="form">
                        <input type="hidden" name="page" value="1">
                        <div class="col-lg-2 col-sm-3">
                            <div class="form-group">
                                <input type="tex" name="date_frm" class="form-control date input-sm" placeholder="Date From">
                            </div>
                        </div>
                        <!-- col-lg-2-->
                        <div class="col-lg-2 col-sm-3">
                            <div class="form-group">
                                <input type="tex" name="date_to" class="form-control date input-sm" placeholder="Date to">
                            </div>
                        </div>
                        <!-- col-lg-2-->
                        <div class="col-lg-2 col-sm-3">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary btn-sm" onClick="call_ajax('ajax_call/get_access_log', 'form', 'get_access_log')"><i class="fa fa-search"></i>Search</button>
                                <button type="reset"  class="btn btn-default btn-sm">Reset</button>
                            </div>
                        </div>
                        <!-- col-lg-2-->
                        </form>
                        <table class="table table-bordered table-striped" style="font-size:10px;">
                            </thead>
                            <thead>
                                <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
                                    <th>Date</th>
                                    <th>From Page</th>
                                    <th>To Page</th>
                                    <th>Ip Address</th>
                                    <th>Country</th>
                                    <th>User</th>
                                    <th>Branch</th>
                                    <th>Browser</th>
                                </tr>
                            </thead>
                            <tbody class="get_access_log">

                            </tbody>
                        </table>
                </div>
            </div>
            <!--panel panel-default-->
        </div>
        <!--panel-body-->
    </div>
    <!-- container-->
    <?php

    $cm->get_footer("../")
    ?>
