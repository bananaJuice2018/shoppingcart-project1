$(document).ready(function(){
	//=====Delete Product
	$(document).on('click', '.btn-delete', function(){
		var productid = $(this).attr("id");	
		console.log("DELETE PRODUCT", productid);	
		var action = "productDelete";
		if(confirm("Are you sure you want to delete this product?")) {
			$.ajax({
				url:"api",
				method:"POST",
				data:{productid:productid, action:action},
				success:function(data) {					
					window.location.reload();
				}
			})
		} else {
			return false;
		}
	});	

	//=====Add Product Dialog
	$('#addProduct').click(function(){
		console.log("ADD PRODUCT");
		$('#productModal').modal('show');
		$('#productForm')[0].reset();
		$('#passwordSection').show();
		$('.modal-title').html("Add Product");
		$('#action').val('addProduct');
		$('#save').val('Add Product');
	});	

	//=====Update Product Dialog
	$(document).on('click', '.btn-update', function(){
		var productid = $(this).attr("id");
		console.log("UPDATE PRODUCT", productid);
		var action = 'getProduct';
		$.ajax({
			url:'api',
			method:"POST",
			data:{productid:productid, action:action},
			dataType:"json",
			success:function(data){
				$('#productModal').modal('show');
				$('#productid').val(data.Id);
				$('#name').val(data.Name);
                $('#code').val(data.Code);
                $('#price').val(data.Price);
                $('#description').val(data.Description);
				$('.modal-title').html("Edit Product");
				$('#action').val('updateProduct');
				$('#save').val('Save');
			}
		})
    });
    
	//=====Add/Update Product
	$(document).on('submit','#productForm', function(event){
		event.preventDefault();
        $('#save').attr('disabled','disabled');

        //var data = $(this).serialize();
        var formData = new FormData($('#productForm')[0]);
        var files = $('#file')[0].files;
        if(files.length > 0 ){
            console.log("File", files);
            formData.append('file',files[0]);
        }

		console.log("Add/Update Product", formData);
		$.ajax({
			url:"api",
			method:"POST",
            data:formData,
            contentType: false,
            processData: false,
			success:function(data){
                console.log("ADD/UPDATE RESPONSE", data);
				$('#productForm')[0].reset();
				$('#productModal').modal('hide');				
				$('#save').attr('disabled', false);
				window.location.reload();
			}
		})
	});	
});