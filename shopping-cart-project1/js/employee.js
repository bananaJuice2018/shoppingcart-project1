$(document).ready(function(){
	//=====Delete Employee
	$(document).on('click', '.btn-delete', function(){
		var employeeid = $(this).attr("id");	
		console.log("DELETE EMPLOYEE", employeeid);	
		var action = "employeeDelete";
		if(confirm("Are you sure you want to delete this user?")) {
			$.ajax({
				url:"api",
				method:"POST",
				data:{employeeid:employeeid, action:action},
				success:function(data) {					
					window.location.reload();
				}
			})
		} else {
			return false;
		}
	});	

	//=====Add Employee Dialog
	$('#addEmployee').click(function(){
		console.log("ADD EMPLOYEE");
		$('#employeeModal').modal('show');
		$('#employeeForm')[0].reset();
		$('.modal-title').html("Add Employee");
		$('#action').val('addEmployee');
		$('#save').val('Add Employee');
	});	

	//=====Update Employee Dialog
	$(document).on('click', '.btn-update', function(){
		var employeeid = $(this).attr("id");
		console.log("UPDATE EMPLOYEE", employeeid);
		var action = 'getEmployee';
		$.ajax({
			url:'api',
			method:"POST",
			data:{employeeid:employeeid, action:action},
			dataType:"json",
			success:function(data){
				$('#employeeModal').modal('show');
				$('#employeeid').val(data.Id);
				$('#name').val(data.Name);
				$('#start').val(data.StartDate);
				$('#email').val(data.Email);
				$('#phone').val(data.Phone);
				$('.modal-title').html("Edit User");
				$('#action').val('updateEmployee');
				$('#save').val('Save');
			}
		})
	});	

	//=====Add/Update Employee
	$(document).on('submit','#employeeForm', function(event){
		event.preventDefault();
		$('#save').attr('disabled','disabled');
		var formData = $(this).serialize();
		console.log("Add/Update Employee", formData);
		$.ajax({
			url:"api",
			method:"POST",
			data:formData,
			success:function(data){		
				$('#employeeForm')[0].reset();
				$('#employeeModal').modal('hide');				
				$('#save').attr('disabled', false);
				window.location.reload();
			}
		})
	});	
});