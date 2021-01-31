<?php
	require("header.php");
	$searchText = "";

	if(!empty($_GET["search"])) {
		$searchText = $_GET["search"];
	}

	if(!empty($_GET["action"])) {
		switch($_GET["action"]) {
			case "add":
				if(!empty($_POST["quantity"])) {
					$productByIds = $db_handle->runQuery("SELECT * FROM product WHERE id='" . $_GET["id"] . "'");
					$productById = $productByIds[0];
					$itemArray = array('product_'.$productById["Id"]=>array('id'=>$productById["Id"], 'name'=>$productById["Name"], 'code'=>$productById["Code"], 'quantity'=>$_POST["quantity"], 'price'=>$productById["Price"], 'image'=>$productById["Image"]));
					if(!empty($_SESSION["cart_item"])) {
						if(in_array('product_'.$productById["Id"],array_keys($_SESSION["cart_item"]))) {
							foreach($_SESSION["cart_item"] as $k => $v) {
									if('product_'.$productById["Id"] == $k) {
										if(empty($_SESSION["cart_item"][$k]["quantity"])) {
											$_SESSION["cart_item"][$k]["quantity"] = 0;
										}
										$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
									}
							}
						} else {
							$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
						}
					} else {
						$_SESSION["cart_item"] = $itemArray;
					}
				}
				break;
			case "remove":
				if(!empty($_SESSION["cart_item"])) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if('product_'.$_GET["id"] == $k)
								unset($_SESSION["cart_item"][$k]);				
							if(empty($_SESSION["cart_item"]))
								unset($_SESSION["cart_item"]);
					}
				}
				break;
			case "empty":
				unset($_SESSION["cart_item"]);
				break;		
			break;	
		}

		header('Location: services');
	}
?>
<?php 
	$_SESSION["page_index"] = 0;
	require("top_bar.php");
?>

<form method="get" action="services">
	<div class="searchbar">
		<div class="searchbox">
			<input type="text" placeholder="Search.." name="search" value=<?php echo $searchText ?>>
		</div>
			<button type="submit"><i class="fa fa-search"></i></button>
	</div>
</form>

<div id="shopping-cart">
<div class="txt-heading">Shopping Cart</div>

<a id="btnEmpty" href="services?action=empty">Empty Cart</a>
<a id="btnPurchase" href="checkout">Checkout</a>

<?php
	if(isset($_SESSION["cart_item"])) {
		$total_quantity = 0;
		$total_price = 0; ?>
		<table class="table table-bordered table-striped">
			<tbody>
			<tr>
				<th style="text-align:left;">No</th>
				<th style="text-align:left;">Name</th>
				<th style="text-align:left;">Code</th>
				<th style="text-align:right;" width="5%">Quantity</th>
				<th style="text-align:right;" width="10%">Unit Price</th>
				<th style="text-align:right;" width="10%">Price</th>
				<th style="text-align:center;" width="5%">Remove</th>
			</tr>	
			<?php		
				foreach ($_SESSION["cart_item"] as $item) {
					$item_price = $item["quantity"]*$item["price"];
					?>
							<tr role="row" class="odd">
								<td><?php echo $item["id"]; ?></td>
								<td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
								<td><?php echo $item["code"]; ?></td>
								<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
								<td style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
								<td style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
								<td style="text-align:center;"><a href="services?action=remove&id=<?php echo $item["id"]; ?>"><i class="fa fa-trash"></a></td>
							</tr>
							<?php
							$total_quantity += $item["quantity"];
							$total_price += ($item["price"]*$item["quantity"]);
					}
					?>

			<tr>
				<td></td>
				<td colspan="2" align="right">Total:</td>
				<td align="right"><?php echo $total_quantity; ?></td>
				<td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
			</tr>
			</tbody>
		</table>		
	<?php
	} else { ?>
		<div class="no-records">Your Cart is Empty</div>
		<?php 
	}
?>
</div>

<div id="product-grid">
	<div class="txt-heading">Products</div>
	<?php
	if($searchText == "") {
		$product_array = $db_handle->runQuery("SELECT * FROM product");
	} else {
		$product_array = $db_handle->runQuery("SELECT * FROM product WHERE name LIKE '%{$searchText}%'");
	}
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value) {
	?>
		<div class="product-item">
			<form method="post" action="services?action=add&id=<?php echo $product_array[$key]["Id"]; ?>">
			<div class="product-image"><img src="<?php echo $product_array[$key]["Image"]; ?>"></div>
			<div class="product-tile-footer">
			<div class="product-title"><a href="detail?id=<?php echo $product_array[$key]["Id"] ?>"> <?php echo $product_array[$key]["Name"]; ?> </a></div>
			<div class="product-price"><?php echo "$".$product_array[$key]["Price"]; ?></div>
			<div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
			</div>
			</form>
		</div>
	<?php
		}
	}
	?>
</div>