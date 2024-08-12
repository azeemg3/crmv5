<?php
require_once'inc.func.php';
$cm->get_header("")
?>
<script>
    document.title = 'Country List';
</script>
<body onLoad="call_ajax('ajax_call/get_countries', '', 'get_countries')">
    <div class="content-wrapper" id="loadpage">

        <section class="content-header" style="border-bottom: 1px solid;padding-bottom: 14px;">
            <h1>
                Dashboard
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
                <li class="">Dashboard</li>
                 <li class="">Management</li>
            </ol>
        </section>
        <h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Country List</span></h2>
        <div class="panel panel-default">
            <div class="panel-body">
            <form id="cntryForm">
            <div class="col-md-3">
            	<div class="form-group">
                	<input type="text" name="country_name" class="form-control input-sm" placeholder="country Name">
                </div>
            </div>
            <div class="col-md-3">
            	<div class="form-group">
                	<button type="button" class="btn btn-sm btn-success" onClick="country()">Add</button>
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
                                <th>Country Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="get_countries">

                        </tbody>
                    </table>
                </div>
            </div>
            <!--panel panel-default-->
        </div>
        <!--panel-body-->
    </div>
    <!-- container-->
<?php $cm->get_footer("") ?>