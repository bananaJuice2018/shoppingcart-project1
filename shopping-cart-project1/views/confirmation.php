<?php
    require("header.php");

    if(!empty($_GET["userid"])) {
        $userId = $_GET["userid"];
        
        $user = $db_handle->runQuery("SELECT * FROM customer WHERE Id='$userId'");
        $address = $user[0]["Address"];      
        $city = $user[0]["City"];        
        $state = $user[0]["State"];        
        $zipCode = $user[0]["ZipCode"];        
    }

    if(!empty($_GET["action"])) {
        switch($_GET["action"]) {
            case "confirmed":
                unset($_SESSION["cart_item"]);
                header('Location: services');
            break;	
        }
    }
?>

<HTML>
<HEAD>
<TITLE>Simple PHP Shopping Cart</TITLE>
<link href="style.css" type="text/css" rel="stylesheet" />
</HEAD>
<BODY>

<div id="shopping-cart">
<div class="center">
<h2>Thank you. Your order has been received!</h2>
</div>

<div>Address: <?php echo $address;?></div>
<div style="margin-top: 4px;">City: <?php echo $city;?></div>
<div style="margin-top: 4px;">State: <?php echo $state;?></div>
<div style="margin-top: 4px;">Zip Code: <?php echo $zipCode;?></div>


<div class="txt-heading"><h3>Items Purchased</h3></div>

<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>	
<table class="table table-bordered table-striped">
<tbody>
<tr>
<th style="text-align:left;">Id</th>
<th style="text-align:left;">Name</th>
<th style="text-align:left;">Code</th>
<th style="text-align:right;" width="5%">Quantity</th>
<th style="text-align:right;" width="10%">Unit Price</th>
<th style="text-align:right;" width="10%">Price</th>
</tr>	
<?php		
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["price"];
		?>
				<tr>
				<td><?php echo $item["id"]; ?></td>
				<td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
				<td><?php echo $item["code"]; ?></td>
				<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
				</tr>
				<?php
				$total_quantity += $item["quantity"];
				$total_price += ($item["price"]*$item["quantity"]);
		}
		?>

<tr>
<td colspan="3" align="right">Total:</td>
<td align="right"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
</tr>
</tbody>
</table>		
  <?php
} else {
?>
<div class="no-records">Your Cart is Empty</div>
<?php 
}
?>


<form method="post" action="confirmation.php?action=confirmed">
    <input type="submit" value="Continue to shopping" class="btn">
</form>

</div>

<?php require("bottom_bar.php");?>

</BODY>
</HTML>