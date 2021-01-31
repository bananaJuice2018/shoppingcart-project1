<?php
	require_once(__DIR__."/../header.php");
	
	if(!$_SESSION["login"]) {
		header( "Location: /" );
	}

	$_SESSION["page_index"] = 2;
    require_once(__DIR__."/../top_bar.php");

    $employees = $db_handle->runQuery("SELECT * FROM employee");
?>

<script src="js/employee.js"></script>

<div id="employee">
<div class="txt-heading">Employees</div>
<button id="addEmployee" class="btnAddEmployee">Add</button>
<?php
	if($employees) {
		$total_quantity = 0;
		$total_price = 0; ?>
        
		<table id="employeeList" class="table table-bordered table-striped">
			<tbody>
			<tr>
				<th style="text-align:left;">Id</th>
				<th style="text-align:left;">Name</th>
				<th style="text-align:left;" width="10%">Start Date</th>
				<th style="text-align:left;">Email</th>
				<th style="text-align:left;">Phone</th>
                <th style="text-align:center" width="5%">Update</th>
				<th style="text-align:center" width="5%">Remove</th>
			</tr>	
			<?php		
				foreach ($employees as $item) {
					?>
							<tr role="row" class="odd">
								<td><?php echo $item["Id"]; ?></td>
                                <td><?php echo $item["Name"]; ?></td>
								<td><?php echo $item["StartDate"]; ?></td>
								<td style="text-align:left;"><?php echo $item["Email"]; ?></td>
								<td style="text-align:left;"><?php echo $item["Phone"]; ?></td>
								<td style="text-align:center"><a type="button" name="update" id="<?php echo $item["Id"] ?>" class="btn-update"><i class="fa fa-pencil"></i></a></td>
								<td style="text-align:center"><a type="button" name="delete" id="<?php echo $item["Id"] ?>" class="btn-delete"><i class="fa fa-trash"></i></a></td>
                        	</tr>
							<?php
					}
					?>
			</tbody>
		</table>		
	<?php
	} else { ?>
		<div class="no-records">No employees</div>
		<?php 
	}
?>
</div>

<div id="employeeModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="employeeForm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h4 class="modal-title">Edit User</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="name" class="control-label">Name*</label>
						<input type="text" class="form-control" id="name" name="name" placeholder="Name" required>							
					</div>

					<div class="form-group">
						<label for="start" class="control-label">Start Date</label>							
						<input type="date" class="form-control" id="start" name="start" placeholder="Start Date">							
					</div>
				
					<div class="form-group">
						<label for="email" class="control-label">Email*</label>							
						<input type="text" class="form-control"  id="email" name="email" placeholder="Email" required>							
					</div>	 
					<div class="form-group">
						<label for="phone" class="control-label">Phone</label>							
						<input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">							
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="employeeid" id="employeeid" />
					<input type="hidden" name="action" id="action" value="updateUser" />
					<input type="submit" name="save" id="save" class="btnAddEmployee" value="Save" />
				</div>
			</div>
		</form>
	</div>
</div>
