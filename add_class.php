						<!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div id="" class="muted pull-left"><h4><i class="icon-plus-sign"></i> Add class</h4></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
								<form method="post" id="add_class">
									<div class="control-group">
											<label>Course:</label>
                                          <div class="controls">
                                            <select name="department"  class="" required>
                                             	<option value="" disabled selected>-select course-</option>
											<?php
											$query = mysqli_query($conn,"select * from course order by course_name");
											while($row = mysqli_fetch_array($query)){
											
											?>
											<option value="<?php echo $row['course_id']; ?>"><?php echo $row['course_name']; ?></option>
											<?php } ?>
                                            </select>
                                          </div>
                                        </div>

									  <div class="control-group">
											<label>Department:</label>
                                          <div class="controls">
                                            <select name="department"  class="" required>
                                             	<option value="" disabled selected>-select department-</option>
											<?php
											$query = mysqli_query($conn,"select * from department order by department_name");
											while($row = mysqli_fetch_array($query)){
											
											?>
											<option value="<?php echo $row['department_id']; ?>"><?php echo $row['department_name']; ?></option>
											<?php } ?>
                                            </select><!--checked -->
                                          </div>
                                        </div>
										<div class="control-group">
											<label>Class Name:</label>
                                          <div class="controls">
											<input type="hidden" name="session_id" class="session_id" value="<?php echo $session_id; ?>">
                                            <select name="class_id"  class="class_id" required>
                                             	<option value="" disabled selected>-select class-</option>
											<?php
											$query = mysqli_query($conn,"select * from class order by class_name");
											while($row = mysqli_fetch_array($query)){
											
											?>
											<option value="<?php echo $row['class_id']; ?>"><?php echo $row['class_name']; ?></option>
											<?php } ?>
                                            </select>
                                          </div>
                                        </div>
										
										<div class="control-group">
											<label>Subject:</label>
                                          <div class="controls">
                                            <select name="subject_id"  class="subject_id" required>
                                             	<option value="" disabled selected>-select subject-</option>
											<?php
											$query = mysqli_query($conn,"select * from subject order by subject_code");
											while($row = mysqli_fetch_array($query)){
											
											?>
											<option value="<?php echo $row['subject_id']; ?>"><?php echo $row['subject_code']; ?></option>
											<?php } ?>
                                            </select>
                                          </div>
                                        </div>
										
										<div class="control-group">
											<label>Academic Year:</label>
                                          <div class="controls">
                                          	<?php
												$sy;
												if(isset($_GET['year'])  && !empty($_GET['year'])) {
													$sy = $_GET['year'];
													$school_year_query = mysqli_query($conn,"select * from school_year where  school_year = '$sy'")or die(mysqli_error());
													$school_year_query_row = mysqli_fetch_array($school_year_query);
													$school_year = $school_year_query_row['school_year'];
												} else {
													$school_year_query = mysqli_query($conn,"select * from school_year")or die(mysqli_error());
													$school_year_query_row[0] = mysqli_fetch_array($school_year_query);
													$school_year = $school_year_query_row['school_year'];
													if(isset($_GET['dashboard']) && $_GET['dashboard'] == 1) {
															echo "<script>window.location.href='dasboard_teacher.php?year=$school_year';</script>";
	
													}
													
												}
											?>
											<input id="school_year" class="span5" type="text" class="school_year" name="school_year" value="<?php echo $_GET['year']?>" disabled>
                                          </div>
                                        </div>
											<div class="control-group">
                                          <div class="controls">
												<button name="save" class="btn btn-success"><i class="icon-save"></i> Save</button>
                                          </div>
                                        </div>
                                </form>
								
            <script>
			jQuery(document).ready(function($){
				$("#add_class").submit(function(e){
					const session_id = document.querySelector('.session_id').value;
					const class_id = document.querySelector('.class_id').value;
					const subject_id = document.querySelector('.subject_id').value;
					const school_year = document.querySelector('.school_year').value;
					$.ajax({
						type: "POST",
						url: "add_class_action.php",
						data: {
							session_id: session_id,
							class_id: class_id,
							subject_id: subject_id,
							school_year: school_year
						},
						beforeSend: function() {
							console.log('Adding Class');
						},
						success: function(html){
							console.log(html);
						//if(html=="true")
						//{
						//$.jGrowl("Class Already Exist", { header: 'Add Class Failed' });
						//}else{
						//	$.jGrowl("Classs Successfully  Added", { header: 'Class Added' });
						//	var delay = 500;
						//	setTimeout(function(){ window.location = 'dasboard_teacher.php'  }, delay);  
						//}
						}
					});
				});
			});
			</script>		

								</div>
                            </div>
                        </div>
                        <!-- /block -->
						
