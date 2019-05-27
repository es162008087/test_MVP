<!DOCTYPE html>
<html>
	<head>
		<title>User´s Tasks</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<br />
			
			<h3 align="center">User´s Tasks<br><?php echo $_GET["name"] ?></h3>
			<br />
			<div align="right" style="margin-bottom:5px;">
				<button type="button" name="add_button" id="add_button" class="btn btn-success btn-xs">Add</button>
			</div>

			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Description</th>
							<th>State</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</body>
</html>

<div id="apicrudModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" id="api_crud_form">
				<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">Add Task for <?php echo $_GET["name"] ?></h4>
		      	</div>
		      	<div class="modal-body">
		      		<div class="form-group">
			        	<label>Enter Description</label>
			        	<input type="text" name="description" id="description" class="form-control" />
			        </div>
			    </div>
			    <div class="modal-body">
		      		<div class="form-group">
			        	<label>Select State</label>
			        	<select name = "state_id">
            				<option value = "1" selected>To do</option>
            				<option value = "2">Done</option>
         				</select>
			        </div>
			    </div>
			    <div class="modal-footer">
			    	<input type="hidden" name="hidden_id" id="hidden_id" />
			    	<input type="hidden" name="user_id" id="user_id"  value="<?php echo $_GET["id"] ?>"/>
			    	<input type="hidden" name="action" id="action" value="insert" />
			    	<input type="submit" name="button_action" id="button_action" class="btn btn-info" value="Insert" />
			    	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      		</div>
			</form>
		</div>
  	</div>
</div>


<script type="text/javascript">
$(document).ready(function(){

	fetch_data();

	function fetch_data()
	{
		var user_id = <?php echo $_GET["id"] ?>;
		$.ajax({
			url:"tasks_fetch.php",
			method:"POST",
			data:{user_id:user_id},
			success:function(data)
			{
				
				$('tbody').html(data);
			}
		})
	}

	$('#add_button').click(function(){
		var user_id = <?php echo $_GET["id"] ?>;
		$('#action').val('insert');
		$('#user_id').val('<?php echo $_GET["id"] ?>');
		$('#button_action').val('Insert');
		$('.modal-title').text('Add Data for <?php echo $_GET["name"] ?>');
		$('#apicrudModal').modal('show');



	});

	$('#api_crud_form').on('submit', function(event){
		event.preventDefault();
		if($('#description').val() == '')
		{
			alert("Enter Description");
		}
		else
		{
			var form_data = $(this).serialize();
			$.ajax({
				url:"tasks_action.php",
				method:"POST",
				data:form_data,
				success:function(data)
				{
					fetch_data();
					$('#api_crud_form')[0].reset();
					$('#apicrudModal').modal('hide');
					if(data == 'insert')
					{
						alert("Data Inserted");
					}
					if(data == 'update')
					{
						alert("Data Updated");
					}
				}
			});
		}
	});

	$(document).on('click', '.edit', function(){
		var id = $(this).attr('id');
		var action = 'fetch_single';
		$.ajax({
			url:"tasks_action.php",
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data)
			{
				$('#hidden_id').val(id);
				$('#description').val(data.description);
				$('#state_id').val(data.state_id);
				$('#action').val('update');
				$('#button_action').val('Update');
				$('.modal-title').text('Edit Data');
				$('#apicrudModal').modal('show');
			}
		})
	});

	$(document).on('click', '.delete', function(){
		var id = $(this).attr("id");
		var action = 'delete';
		if(confirm("Are you sure you want to remove this data?"))
		{
			$.ajax({
				url:"tasks_action.php",
				method:"POST",
				data:{id:id, action:action},
				success:function(data)
				{
					fetch_data();
					alert("Data Deleted");
				}
			});
		}
	});

});
</script>