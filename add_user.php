<?php 
include('config.php');

/*	if(!$user->is_user_login()){
		$utils->safe_redirect('login.php');
	
	}
*/
		if($_SERVER['REQUEST_METHOD']=='POST'){
			
			
			$branch				=	$_POST['branch'];
			$users_name			=	$_POST['users_name'];
			$first_name			=	$_POST['first_name'];
			$last_name			 =	$_POST['last_name'];
			$email				 =	$_POST['email'];
			$password			  =	$_POST['password'];
			$role				  =	$_POST['role'];
			$status				=	$_POST['status'];
			$enc_pass			  =	$user->encrypt_pass($_POST['password']);

			$res	=	mysql_query("INSERT INTO add_users VALUES(
																	'',
																	'$branch',
																	'$users_name',
																	'$first_name',
																	'$last_name',
																	'$email',
																	'$enc_pass',
																	'$role',
																	'$status',
																	now(),
																	''
																	)") or die(mysql_error());
			if($res){
					echo "Form Complete";
			}else{
				echo "Form Not Complete";
			}	
		   }

include('includes/header.php');
?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Quick Example</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group col-md-6">
                      <label>Select Branch</label>
                      <select class="form-control" name="branch">
                        <option>option 1</option>
                        <option>option 2</option>
                        <option>option 3</option>
                        <option>option 4</option>
                        <option>option 5</option>
                      </select>
                    </div>
                   <div class="form-group col-md-6">
                      <label for="users_name">Users Name</label>
                      <input type="text" class="form-control" id="users_name" name="users_name" placeholder="Users Name">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="first_name">First Name</label>
                      <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="last_name">Last Name</label>
                      <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="email">Email address</label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                   <div class="form-group col-md-6">
                   <label for="">Role</label>
                      <div class="radio">
                        <label>
                          <input type="radio" name="role" id="role" value="admin">
                          Admin
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="role" id="role" value="users">
                          Users
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="role" id="role" value="teacher">
                          Teacher
                        </label>
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                    <label for="">Status</label>
                      <div class="radio">
                        <label>
                          <input type="radio" name="status" id="status" value="activated">
                          Activated
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="status" id="status" value="deactivated">
                          Deactivated
                        </label>
                      </div>
                    </div>              
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->
              <!-- Form Element sizes -->
              <!-- /.box -->
              <!-- /.box -->
              <!-- Input addon -->
              <!-- /.box -->
            </div><!--/.col (left) -->
            <!-- right column -->
            <!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php 
include('includes/footer.php');


?>