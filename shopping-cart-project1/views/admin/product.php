<?php
    require_once(__DIR__."/../header.php");
    
    $_SESSION["page_index"] = 0;
    require_once(__DIR__."/../top_bar.php");
    $products = $db_handle->runQuery("SELECT * FROM product");
    $curTime = date('Y-m-d H:i:s');
?>

<script src="js/product.js"></script>

<div id="shopping-cart">
<div class="txt-heading">Products</div>
<button id="addProduct" class="btnAddEmployee" href="checkout">Add</button>

<?php
	if($products) {
		$total_quantity = 0;
		$total_price = 0; ?>
		<table class="table table-bordered table-striped">
			<tbody>
			<tr>
				<th style="text-align:left;">No</th>
				<th style="text-align:left;">Name</th>
				<th style="text-align:left;">Code</th>
				<th style="text-align:right;" width="10%">Price</th>
                <th style="text-align:center;" width="5%">Update</th>
				<th style="text-align:center;" width="5%">Remove</th>
			</tr>	
			<?php		
				foreach ($products as $item) {
					?>
							<tr role="row" class="odd">
								<td><?php echo $item["Id"]; ?></td>
								<td><img src="<?php echo $item["Image"]; ?>" class="cart-item-image" /><?php echo $item["Name"]; ?></td>
								<td><?php echo $item["Code"]; ?></td>
								<td style="text-align:right;"><?php echo "$ ".$item["Price"]; ?></td>
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
		<div class="no-records">Your Cart is Empty</div>
		<?php 
	}
?>
</div>

<div id="productModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="productForm" enctype="multipart/form-data">
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
						<label for="code" class="control-label">Code</label>							
						<input type="text" class="form-control"  id="code" name="code" placeholder="Code">							
                    </div>	 
                    
					<div class="form-group">
						<label for="price" class="control-label">Price*</label>							
						<input type="number" class="form-control" id="price" name="price" placeholder="Price" required>							
                    </div>
                    
                    <div class="form-group">
						<label for="description" class="control-label">Description</label>							
						<textarea type="text" class="form-control" id="description" name="description" placeholder="Description" style="resize: none"></textarea>							
					</div>

					<div class="form-group">
                        <label for="price" class="control-label">Image*</label>					
                        <input type="file" id="file" name="file" />		
					</div>

				</div>
				<div class="modal-footer">
					<input type="hidden" name="productid" id="productid" />
					<input type="hidden" name="action" id="action" value="updateUser" />
					<input type="submit" name="save" id="save" class="btnAddEmployee" value="Save" />
				</div>
			</div>
		</form>
	</div>
</div>
