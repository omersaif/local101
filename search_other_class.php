	      <!-- block -->
                        <div class="block" id="search_class">
                            <div class="navbar navbar-inner block-header">
                                <div id="" class="muted pull-left"><strong>Search Past Academic Year</strong></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
								<form class='changeYear'>	
										<div class="control-group">
											<label>Academic Year:</label>
                                          <div class="controls">
                                            <select name="school_year" class="school_year" class="span8" required>
                                             	<option></option>
											<?php
											$query = mysqli_query($conn,"select * from school_year order by school_year DESC");
											while($row = mysqli_fetch_array($query)){
											
											?>
											<option <?php if($_GET['year'] === $row['school_year']){
												echo 'selected';
											} ?>><?php echo $row['school_year']; ?></option>
											<?php } ?>
                                            </select>
                                          </div>
                                        </div>
											<div class="control-group">
                                          <div class="controls">
												<button type='submit' name="search" class="btn btn-info"><i class="icon-search"></i> Search</button>
                                          </div>
                                        </div>
                                </form>
                                <script> 
                                	document.querySelector('.changeYear').addEventListener('submit', function(event) {
                                		event.preventDefault();
                                		window.location.href = `search_class.php?year=${document.querySelector('.school_year').value}&dashboard=1`;
                                	})
                                </script>
								</div>
                            </div>
                        </div>
                        <!-- /block -->