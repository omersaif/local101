<?php include('header_dashboard.php'); ?>
<?php include('session.php'); ?>
    <body>
		<?php include('navbar_teacher.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php include('teacherinfo_sidebar.php'); ?>
                <div class="span6" id="content">
                     <div class="row-fluid">
					    <!-- breadcrumb -->
				
									
					     <ul class="breadcrumb">
						<?php
						$school_year_query = mysqli_query($conn,"select * from school_year order by school_year DESC")or die(mysqli_error());
						$school_year_query_row = mysqli_fetch_array($school_year_query);
						$school_year = $school_year_query_row['school_year'];
						?>
							<li><a href="#">Teachers</a><span class="divider">/</span></li>
							<li><a href="#"><b>Profile</b></a></li>
						</ul>
						 <!-- end breadcrumb -->
					 
                        <!-- block -->
                        <div id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">
                                <div id="" class="muted pull-left"></div>
                            </div>
                            <form class="form-horizontal" id="teacherinfo">
										<div class="control-group">
											<label class="control-label" for="inputName">Name</label>
											<div class="controls">
											<input type="text" name="inputName" id="inputName" placeholder="">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="inputDesig">Designation</label>
											<div class="controls">
												<select name="designation" id="designation">
													<option></option>
													<option>Asst.Professor</option>
													<option>Professor</option>
													
												</select>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="inputProficiency">Qualification</label>
											<div class="controls">
											<input type="text" name="qualificationName" id="qualificationName" placeholder="">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="inputProficiency">Proficiency</label>
											<div class="controls">
											<input type="text" name="inputProficiency" id="inputProficiency" placeholder="">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="teachingExperiece">Teaching Experience</label>
											<div class="controls">
											<input type="text" name="teachingExperiece" id="teachingExperiece" placeholder="">
										</div>
									</div>
										<div class="control-group">
											<label class="control-label" for="projectsHandled">Project's Handled</label>
											<div class="controls">
											<input type="text" name="projectsHandled" id="projectsHandled" placeholder="">
										</div>
									</div>
										<div class="control-group">
											<label class="control-label" for="publication">Publication</label>
											<div class="form-group">
											<table class="table table-bordered" id="dynamic_field">
											<div class='publications'>
												<input type="text" class="publication" name="publication" id="publication" placeholder=""><button  style="background: green; color: white; font-weight: bold;" class="addInput">Add More</button>
											</div>
										</div>
									</div>
										<div class="control-group">
                                          <div class="controls">
												<button name="save" class="btn btn-success"><i class="icon-save"></i> Save</button>
                                          </div>
                                        </div>
								</form>
								<script>
									let index = 0;
									document.querySelector('.addInput').addEventListener('click', function(event){
										event.preventDefault();
										addInput();
									})
									function addInput() {
										var myDiv = document.createElement("div");
										myDiv.classList.add(`publication_${index}`);
	 									myDiv.innerHTML = `
											<br>
											<input type="text" class="publication" name="publiation" placeholder=""><button class='removeIcon' onclick="removeInput('${index}')">Delete</button>
										`;
										document.querySelector('.publications').appendChild(myDiv);
										index++;
										return false;
									}
									function removeInput(index) {
										document.querySelector(`.publication_${index}`).remove();
										return false;
									}
									document.querySelector('.teacherinfo').addEventListener('cubmit', function(event){
										event.preventDefault();
										console.log("DO IT Tomorrow");
									})
								</script>
								
</div>
</div>
<?php include('footer.php'); ?>	
</div>
				
            
		
        </div>
		<?php include('script.php'); ?>
    
    </body>
</html>
