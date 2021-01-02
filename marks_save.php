<?php include('header_dashboard.php'); ?>
<?php include('session.php'); ?>
<?php $get_id = $_GET['id']; ?>
<?php 
	  $post_id = $_GET['post_id'];
	  if($post_id == ''){
	  ?>
		<script>
		window.location = "assignment_student.php<?php echo '?id='.$get_id; ?>";
		</script>
	  <?php
	  }
	
 ?>
 

    
<div class="span3" id="">
	<div class="row-fluid">
				      <!-- block -->
                        <div id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">
                                <div id="" class="muted pull-left"><h4><i class="icon-plus-sign"></i> Add Assigment</h4></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
								<form >
                        <div class="control-group">
                            <label class="control-label" for="inputEmail">File</label>
                            <div class="controls">
				
									
								
                            </div>
                        </div>
                        <div class="control-group">
                      
                            <div class="controls">
                                <input type="text" name="name" value="<?php echo $row['firstname'] ?>"  class="input">
                            </div>
                        </div>
                        <div class="control-group">
                          
                            <div class="controls">
							<textarea id="assigntextare" placeholder="Description" name="desc" required></textarea>
                             <!--   <input type="text" name="desc" Placeholder="Description"  class="input" required> -->
                            </div>
                        </div>

                        <div class="control-group">
                      
                            <div class="controls">
                                <input type="text" name="maxmarks" Placeholder="Max Marks"  class="input">
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
			<?php
                              		    
										$query = mysqli_query($conn,"select  student.id,student.firstname,student.lastname,student.username,assignment.maxmarks FROM student,assignment where student.assignment_id = '$post_id'  ")or die(mysqli_error());
										while($row = mysqli_fetch_array($query)){
										$id  = $row['assignment_id'];
									?>                              
										

	</div>
</div>