	<?php include('dbcon.php'); ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

	<style> 
	.addinternalpopup{
		position: fixed;
		width: 20vw;
		height: 20vh;
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
		.internalIn {
			transform: scale(1);
			transition: 0.2s;
		}
		.internalOut {
			transform: scale(0);
			transition: 0.2s;
		}
</style>
	<div class="addinternalpopup"> 
		<button  class="btn btn-danger closeinternalpopup">X</button>
		<div class="form-group modules">
					<div class='module_0 module'>
						<p style='display: inline;'>Internal: </p><input style='display: inline;' class='internalName' placeholder="Internal-Name" type="text"><input style='display: inline; width:80px;' class='internalName1' placeholder="Max Marks" type="text"><br><button class="btn btn-success addinternalsubmit" style=margin-right; >Submit</button></br>
						
					</div>
					</div>

	</div>
	<form action="delete_student.php" method="post">
	<table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
	<a data-toggle="x" href="#student_delete" id="delete"  class="btn btn-danger" name=""><i class="icon-trash icon-large"></i></a>

	
	<div class="pull-right">

		<input class='topic' style='display: none;' placeholder="Internal Name" type="text"><button class="btn btn-danger" onclick="" style='display: none;'>X</button>

			    <a class="btn btn-info addinternal"><i class="icon-pencil"></i>Add Internal</a>
			    <a class="btn btn-info "><i class="icon-save icon-large"></i> Save</a>
			    <a onclick="window.open('print_internal.php<?php echo '?id='.$get_id; ?>')"  class="btn btn-success"><i class="icon-list"></i> Report</a>
	</div>
	<script>
	       $(document).ready(function(){
	       			$(".addinternalsubmit").click(function(){
	       				var internname = $(".internalName").val();
	       				$(".finaltext").html(internname);
	       				//alert(internname)
	       				document.getElementById("internname").innerHTML = internname;
	       			})

	       })  
	</script>
    
	<script>
	//popup menu 
			 document.querySelector('.addinternal').addEventListener('click',function(event){
			 	event.preventDefault();
			 	document.querySelector('.addinternalpopup').classList.add('internalIn');
			 	document.querySelector('.addinternalpopup').classList.remove('internalOut');
			 })
			 document.querySelector('.closeinternalpopup').addEventListener('click',function(event){
			 	event.preventDefault();
			 	document.querySelector('.addinternalpopup').classList.add('internalOut');
			 	document.querySelector('.addinternalpopup').classList.remove('internalIn');
			 	
			 })

	</script>

	<?php include('modal_delete.php'); ?>

		<thead>
		<tr >
					<th></th>
				
					<th>Name</th>
					<th>ID Number</th>
			
					<th>Class</th>
					<th>Total</th>
					<th id="internname"></th>
		</tr>
		</thead>
		<tbody>
			
		<?php
		$my_student = mysqli_query($conn,"SELECT * FROM teacher_class_student
		LEFT JOIN student ON student.student_id = teacher_class_student.student_id 
		INNER JOIN class ON class.class_id = student.class_id where teacher_class_id = '$get_id' order by lastname ")or die(mysqli_error());
		while($row = mysqli_fetch_array($my_student)){
			$id = $row['teacher_class_student_id'];
		?> 


	
		<tr class="">
		<td width="30">
		<input id="optionsCheckbox" class="uniform_on" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
		</td>
	
		<td><?php echo $row['firstname'] . " " . $row['lastname']; ?></td> 
		<td><?php echo $row['username']; ?></td>
		
	
		<td width="100"><?php echo $row['class_name']; ?></td>
		<td width="100"><?php echo $row['class_name']; ?></td>
		<td id='internname'></td>
		
		



			
	
	
		</tr>
	<?php } ?>    

		
	
		</tbody>
	</table>
	</form>