

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

  <div class="container">
    <div class="col-lg-12">

	<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label>Packege Name</label>
	<input type="text" class="form-control" placeholder="Package Name" name="package_name">
  </div>

  <div class="form-group">
    <label for="exampleInputFile">File input</label>
    <input type="hidden" name="image_path" value="1">
    <input type="file" name="file">
  </div>
  
    <label>Packege Details</label>
  <textarea class="form-control" rows="5" placeholder="Package Details" name="package_details"></textarea>
  <button type="submit" value="upload" style="background-color:#354c8c; float:right; color:#fff; margin-top:5px;">Add</button>
</form>  

       </div>
    </div>



</body>
</html>