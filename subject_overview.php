<?php include('header_dashboard.php'); ?>
<?php include('session.php'); ?>
<?php $get_id = $_GET['id']; ?>
<?php 
	include('dbcon.php');
	
	$sql="SELECT * FROM `class_subject_overview` WHERE teacher_class_id = $get_id";
	$result = mysqli_query($conn, $sql);
	while($row=mysqli_fetch_array($result)) {
		$fetedSyllabus = $row['syllabus'];
	}
?>
<style> 
    		.moduleFloating {
    			position: fixed;
    			width: 60vw;
    			height: 60vh;
    			top: 0;
    			right: 0;
    			left: 0;
    			bottom: 0;
    			margin: auto auto;
    			z-index: 10;
    			background: white;
    			border: 0;
    			border-radius: 12px;
    			box-shadow: 1px 1px 3px 1px grey;
    			transform: scale(0);
    			overflow-y: auto;
    		}
    		.moduleIn {
    			transform: scale(1);
    			transition: 0.2s;
    		}
    		.moduleOut {
    			transform: scale(0);
    			transition: 0.2s;
    		}
    		.moduleShowIn {
    			right: 0 !important;
    			transition: 0.2s;
    		}
    		.moduleShowOut {
    			right: -500px !important;
    			transition: 0.2s;
    		}
    		.closeButton, .closeButtonSideBar {
    			padding: 7px;
    			position: absolute;
    			right: 5px;
    			background: white;
    			border-radius: 4px;
    			top: 5px;
    		}
    		.closeButtonSideBar {
    			top: 50px;
				z-index: 15;
    		}
    		.closeButton:hover, .closeButtonSideBar:hover {
    			background: red;
    			color: white;
    			font-weight: bold;
    			cursor: pointer;
    		}
    		.saveModule {
    			padding: 7px;
    			background: lightgreen;
    			border-radius: 4px;
    			width: 50px;
    			text-align: center;
    		}
    		.saveModule:hover {
    			background: green;
    			color: white;
    			font-weight: bold;
    			cursor: pointer;
    		}
    		.topic {
    			margin-left: 30px;
    		}
    		.moduleDisplaySidebar {
    			position: fixed;
    			right: -500px;
    			top: 0;
    			box-shadow: 1px 1px 3px 1px grey;
    			bottom: 0;
    			width: 400px;
    			height: 100vh;
    			background: white;
    			z-index: 11;
    		}
    		.progressModule {
				margin: 0;
    			margin-top: 50px;
    			width: 90%;

				display: grid;
    			height: 25px; 
    			height: 25px;
    			display: grid;

    		}
    		.progressModule .moduleProgressNo {
    			border: 1px solid green;
    		}
    		.moduleProgressNo div {
    			background: green;
    			position: relative;
    			height: 25px;
    		}
			.moduleDetails {
				position: absolute;
				display: none;
				top:30px;
				width: 95%;
			}
			.moduleDetails div {
				height: 200px;
				padding: 15px;
				background: white;
				border: 0;
				border-radius: 8px;
				box-shadow: 1px 1px 1px 1px grey;
				margin: 10px;
				width: 90%;
				display: inline-block;
			}
			.modulePointer {
				position: absolute;
				display: none;
				width: 100%;
				width: 20px !important;
				height: 20px !important;
				background: white !important;
				box-sizing: border-box;
				border: 1px solid grey;
				border-top-color: grey;
				border-bottom-color: transparent;
				border-left-color: grey;
				border-right-color: transparent;
				transition: 0.5s;
			}
			.modulePointer {
				bottom: -30px;
				margin-left: 20px;
				z-index: 15;
				transform: rotate(45deg);
			}
    	</style>
    	<div class="moduleFloating"> 
    		<div style="position: relative;"><div class="closeButton">X</div></div>
    		<div style="padding: 10px;">
    			<div class="control-group">	
					<div class="form-group modules">
					<div class='module_0 module'>
						<p style='display: inline;'>Module: </p><input style='display: inline;' class='moduleName' type="text"><button class="btn btn-success addModule" onclick='addModule(0)'>Add Module</button><button class="btn btn-success addTopic" onclick='addTopic(0)'>Add Topic</button>
					</div>
					</div>
				</div>
            	<div class="saveModule">Save</div>  
    		</div>
    		<script> 
    			let module = 1;
    			let topic = 0;
    			let syllabusFinal;
    			function addModule(index) {
					let newModule = document.createElement('div');
    				newModule.innerHTML = `
					<div class='module_${module} module'>
						<p style='display: inline;'>Module: </p><input style='display: inline;' class='moduleName' type="text"><button class="btn btn-success addTopic" onclick='addTopic(${module})'>Add Topic</button><button onclick="removeModule(${module})" class="btn btn-danger">X</button>
					</div>
    				`;
    				document.querySelector('.modules').appendChild(newModule);
    				module++;
    				return false;
    			}
    			function addTopic(index) {
					let newTopic = document.createElement('div');
					newTopic.innerHTML = `
						<div class='topic topic_${topic}'>
							<p style='display: inline;'>Topic: </p><input class='topicName' style='display: inline;' type="text"><button class="btn btn-danger" onclick="removeTopic(${topic})">X</button>
						</div>
					`;
					document.querySelector(`.module_${index}`).appendChild(newTopic);
					topic++;
					return false;
    			}

    			function removeModule(index) {
    				document.querySelector(`.module_${index}`).remove();
    			}
    			function removeTopic(index) {
    				document.querySelector(`.topic_${index}`).remove();
    			}
    			document.querySelector('.saveModule').addEventListener('click', function(event) {
    				event.preventDefault();
    				let syllabus = [];
    				document.querySelectorAll('.module').forEach(module=>{
    					let moduleDict = {};
    					moduleDict['moduleName'] = module.querySelector('.moduleName').value;
    					moduleDict['isCompleted'] = 0;
    					moduleDict['topics'] = [];
    					let topicsFinal = module.querySelectorAll('.topic');
    					if(topicsFinal.length >= 1) {
    						console.log("more than 1");
    						module.querySelectorAll('.topic').forEach(topic=>{
	    						let topicDict = {};
	    						topicDict['topicName'] = topic.querySelector('.topicName').value;
	    						topicDict['isCompleted'] = 0;
	    						moduleDict['topics'].push(topicDict);
	    					})
    					} else {
    						console.log("Less than 1");	
    					}
    					syllabus.push(moduleDict);
    				})
    				syllabusFinal = syllabus;
    				$.ajax({
    					url: 'syllabusFinal.php',
    					type:'POST',
    					data: {
    						syllabus: JSON.stringify(syllabusFinal),
    						id: <?php echo $get_id ?>
    					},
    					beforeSend: function(){
    						console.log('saving');
    					},
    					success:function(response){
    						try{
    							if(JSON.parse(response).text){
    								window.location.reload();
    							} else {
    								console.log(JSON.parse(response));
    							}
    						} catch(error){
    							console.log(error);
    						}
    					}
    				})
    			})
    		</script>
    		</div>
    		<div class='moduleDisplaySidebar'> 
    			<div style="position: relative;"><div class="closeButtonSideBar">X</div></div>
				<div style='position: relative;'>
					<div class="progressModule"></div>
					<div class="moduleDetails">
					</div>
				</div>
    			<h4>Syllabus</h4>
    			<div class="resultShowed" style="margin-left: 15px;">
    			</div>
    		</div>
    <body>
		<?php include('navbar_teacher.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php include('subject_overview_link.php'); ?>
                <div class="span9" id="content">
                     <div class="row-fluid">
					  <!-- breadcrumb -->
							<?php $class_query = mysqli_query($conn,"select * from teacher_class
							LEFT JOIN class ON class.class_id = teacher_class.class_id
							LEFT JOIN subject ON subject.subject_id = teacher_class.subject_id
							where teacher_class_id = '$get_id'")or die(mysqli_error());
							$class_row = mysqli_fetch_array($class_query);
							?>
					     <ul class="breadcrumb">
							<li><a href="#"><?php echo $class_row['class_name']; ?></a> <span class="divider">/</span></li>
							<li><a href="#"><?php echo $class_row['subject_code']; ?></a> <span class="divider">/</span></li>
							<li><a href="#"><b>Subject Overview</b></a></li>
						</ul>
						 <!-- end breadcrumb -->

                        <!-- block -->
                        <div id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">
                                <div id="" class="muted pull-right">
									<?php $query = mysqli_query($conn,"select * from teacher_class
										LEFT JOIN class_subject_overview ON class_subject_overview.teacher_class_id = teacher_class.teacher_class_id
										where class_subject_overview.teacher_class_id = '$get_id'")or die(mysqli_error());
										$row = mysqli_fetch_array($query);
										$id = $row['class_subject_overview_id'];
										$count = mysqli_num_rows($query);
									if ($count > 0){
									?>
										  <a href="edit_subject_overview.php<?php echo '?id='.$get_id; ?>&<?php echo 'subject_id='.$id; ?>" style="margin-right:10px;" class="btn btn-info"><i class="icon-pencil"></i> Edit Subject Overview</a><a class="btn btn-info updateModule"><i class="icon-pencil"></i>Update Modules</a>
										  <a class="btn btn-info ShowModule"><i class="icon-pencil"></i>Show Modules</a>
									 <?php }else{ ?>
										     <a href="add_subject_overview.php<?php echo '?id='.$get_id; ?>" class="btn btn-success"><i class="icon-plus-sign"></i> Add Subject Overview</a>
									 <?php } ?>
								</div>
                            </div>  
                            <div class="block-content collapse in">
                                <div class="span12">
										<?php echo $row['content']; ?>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                </div>
            </div>
            <script> 
            	document.querySelector('.updateModule').addEventListener('click', function(event) {
            		event.preventDefault();
            		document.querySelector('.moduleFloating').classList.add('moduleIn');
            		document.querySelector('.moduleFloating').classList.remove('moduleOut');
            	})
            	function addShowModule(module) {
					let newModule = document.createElement('div');
    				newModule.innerHTML = `
					<div class='module'>
						<p style='display: inline;'>Module: </p><input disabled style='display: inline;' value=${module} class='moduleName' type="text">
						<input type='checkbox' style='margin: auto 0;'>
					</div>
    				`;
    				document.querySelector('.resultShowed').appendChild(newModule);
    				return false;
    			}
    			function addShowTopic(topic) {
					let newTopic = document.createElement('div');
					newTopic.innerHTML = `
						<div class='topic'>
							<p style='display: inline;'>Topic: </p><input disabled value=${topic} class='topicName' style='display: inline;' type="text"><input type='checkbox' style='margin: auto 0;'>
						</div>
					`;
					document.querySelector(`.resultShowed`).appendChild(newTopic);
					return false;
    			}
            	document.querySelector('.ShowModule').addEventListener('click', function(event) {
            		event.preventDefault();
            		document.querySelector(`.resultShowed`).innerHTML = '';
					document.querySelector('.progressModule').innerHTML = '';
					document.querySelector('.moduleDetails').innerHTML = '';
    				try {
    					const fetchedResult = JSON.parse('<?php echo $fetedSyllabus; ?>');

						const progressBarLength = fetchedResult.length;
						document.querySelector('.progressModule').style.gridTemplateColumns = `repeat(${progressBarLength}, 1fr)`;
						document.querySelector('.moduleDetails').innerHTML += `
    							<div></div>
							`;
						document.querySelector('.progressModule').innerHTML = '';
    					const eachProgressLength = fetchedResult.length;
    					document.querySelector('.progressModule').style.gridTemplateColumns = `repeat(${eachProgressLength}, 1fr)`;

    					fetchedResult.forEach(result=>{
    						addShowModule(result.moduleName);
    						document.querySelector('.progressModule').innerHTML += `
								<div class="moduleProgressNo" style="height: 25px; margin-right: -4px;">
									<div>
										<div class="modulePointer"></div>
									</div>
    							</div>
    						`;
    						result.topics.forEach(topic=>{
    							addShowTopic(topic.topicName);
    						})
						})
						let moduleProgressNos = document.querySelectorAll('.moduleProgressNo');
    					moduleProgressNos.forEach(progress=>{
							progress.addEventListener('mouseover', function(event) {
								progress.querySelector('.modulePointer').style.display = 'block';
								document.querySelector('.moduleDetails').style.display = 'block';
							})
							progress.addEventListener('mouseout', function (event) {
								progress.querySelector('.modulePointer').style.display = 'none';
								document.querySelector('.moduleDetails').style.display = 'none';
							})
						})



    				} catch(error) {
    					console.log(error);
    				} 
            		document.querySelector('.moduleDisplaySidebar').classList.add('moduleShowIn');
            		document.querySelector('.moduleDisplaySidebar').classList.remove('moduleShowOut');
            	})
            	document.querySelector('.closeButton').addEventListener('click', function(event) {
            		event.preventDefault();
            		document.querySelector('.moduleFloating').classList.add('moduleOut');
            		document.querySelector('.moduleFloating').classList.remove('moduleIn');

            	})
            	document.querySelector('.closeButtonSideBar').addEventListener('click', function(event) {
            		event.preventDefault();
            		document.querySelector('.moduleDisplaySidebar').classList.add('moduleShowOut');
            		document.querySelector('.moduleDisplaySidebar').classList.remove('moduleShowIn');

            	})
            </script>
		<?php include('footer.php'); ?>
        </div>
		<?php include('script.php'); ?>
    </body>
</html>