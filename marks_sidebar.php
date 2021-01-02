<div class="span3" id="">
<?php $get_id = $_GET['id'];?>
<?php $student_id = $_GET['student_id'];?>
<?php 
	  $post_id = $_GET['post_id'];
	  if($post_id == ''){
	  ?>
		<script>
		window.location = "assignment_student.php<?php echo '?id='.$get_id; ?>";
		</script>
	  <?php
	  } else {
	  	$checkSql = mysqli_query($conn, "SELECT `fname`, `maxmarks` FROM `assignment` WHERE (`assignment_id` = $post_id)");
	  	while($row=mysqli_fetch_array($checkSql)) {
	  		$filename = $row['fname'];
	  		$maxmarks = $row['maxmarks'];
	  	}
	  	$checkSql = mysqli_query($conn, "SELECT `firstname`, `lastname`, `username`, `student_id` FROM `student` WHERE (`student_id` = $student_id)");
	  	while($row=mysqli_fetch_array($checkSql)) {
	  		$firstname = $row['firstname'];
	  		$lastname = $row['lastname'];
	  		$usn = $row['username'];
	  		$student_id = $row['student_id'];
	  	}
	  }
	
 ?>
 
	<div class="row-fluid">
				      <!-- block -->
                        <div id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">
                                <div id="" class="muted pull-left"><h4><i class="icon-plus-sign"></i> Input Marks</h4></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
								<form class="" action="marks_save.php<?php echo '?id='.$get_id; ?>" method="post" enctype="multipart/form-data" name="upload" >
                        <div class="control-group">
                            <label class="control-label" for="input">File Name</label>
                            <div class="controls"> 
                            </div>
                        </div>
                        <div class="control-group">
                      
                            <div class="controls">
                                <input type="text" name="name" Placeholder="File Name" value="<?php echo $filename; ?>" disabled class="input">
                            </div>
                        </div>
                        <div class="control-group">
                      		<label>Student Name:</label>
                            <div class="controls">
                                <input type="text" name="name" disabled value="<?php echo $firstname." ".$lastname; ?>" Placeholder="File Name"  class="input">
                            </div>
                        </div>
                        <div class="control-group">
                      		<label>USN:</label>
                            <div class="controls">
                                <input type="text" name="name" disabled value="<?php echo $usn; ?>" Placeholder="File Name"  class="input">
                            </div>
                        </div>
                        <div class="control-group">
                      		<label>Roll No:</label>
                            <div class="controls">
                                <input type="text" name="name" disabled value="<?php echo $usn; ?>" Placeholder="File Name"  class="input">
                            </div>
                        </div>
                        <div class="control-group">
                      		<label>Max Marks:</label>
                            <div class="controls">
                                <input type="text" value="<?php echo $student_id; ?>" disabled name="name" Placeholder="File Name"  class="input">
                            </div>
                        </div>
                        <div class="control-group">
											<label class="control-label" for="marksobtained">Marks Obtained</label>
											<div class="form-group">
											<table class="table table-bordered" id="dynamic_field">
											<div class='marksobtained'>
												<input type="text" class="marksobtained" name="marksobtained" id="marksobtained" placeholder=""><button  style="background: green; color: white; font-weight: bold;" class="addInput">Add More</button>
											</div>
										</div>
									</div>
                         	
                        <div class="control-group">
                            <div class="controls">

                                <button name="Upload" type="submit" value="Upload" class="btn btn-success" /><i class="icon-upload-alt"></i>&nbsp;Upload</button>
                            </div>
                        </div>
                    </form>
								</div>
                            </div>
                        </div>
                        <!-- /block -->
						

	</div>
</div>