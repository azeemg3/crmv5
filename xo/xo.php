<?php
require_once'../common/acc_top.php';
require_once'nav.php';
?>
<script>
document.title='Payment & Xo';
</script>
<div class="clearfix"></div>
<div class="container">
	<h2><span class="main-heading">View Xo</span></h2>
	<div class="panel panel-default">
  		<div class="panel-body">
  			<h3>Pending Xo:</h3>
            <ul class="list-group">
                <li class="list-group-item">
                <a href="pending_xo">Open Pending Xo <span class="glyphicon glyphicon-plus-sign"></span></a>
                </li>
            </ul>
            <h3>Xo Reports:</h3>
            <ul class="list-group">
                <li class="list-group-item">
                <a href="all_xo">OPen All Xo <span class="glyphicon glyphicon-plus-sign"></span></a></li>
            </ul>
		</div>
	<!--panel panel-default-->
	</div>
    <!--panel-body-->
</div>
<!-- container-->

<?php
require_once'../common/acc_footer.php';
?>