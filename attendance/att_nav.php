<div class="col-sm-12 main-nav">
<a href="../index" class="btn dashboard-icon">
          <span class="glyphicon glyphicon-dashboard"></span> Dashboard
        </a>
		<a href="add_staff" class="btn dashboard-icon <?php if (($fileName=="add_staff")) echo "active_nav"; ?>">Add New Staff</a>
		<a href="staff_list" class="btn dashboard-icon <?php if (($fileName=="staff_list")) echo "active_nav"; ?>">Staff List</a>
		<a href="attendance" class="btn dashboard-icon <?php if (($fileName=="attendance")) echo "active_nav"; ?>">Make Attendance</a>
		<a href="attendance_rep" class="btn dashboard-icon <?php if (($fileName=="attendance_rep")) echo "active_nav"; ?>">Attendance Report</a>
</div>