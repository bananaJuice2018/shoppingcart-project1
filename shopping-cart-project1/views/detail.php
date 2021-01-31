<?php 
    require("header.php");
    require("top_bar.php");

    if(!empty($_GET["id"])) {
        $productId = $_GET["id"];
        $productById = $db_handle->runQuery("SELECT * FROM product WHERE id='$productId'")[0];
    } else {
        header('Location: '.'/shopping/');
    }
?>

<div style="display: flex; margin-right: 40px;">
    <div class="image-view">
        <img src="<?php echo $productById["Image"] ?>" style="width: 100%;"/>
    </div>

    <div class="info-view">
        <div class="txt-big"><?php echo $productById["Name"] ?></div>
        <div class="txt-medium" style="margin-top: 16px;"><?php echo $productById["Description"] ?></div>
        <form class="info-subview" method="post" action="services?action=add&id=<?php echo $productById["id"]; ?>">
            <div class="txt-big"><?php echo '$'.$productById["Price"] ?></div>
            <div style="display: flex; margin-top: 16px;">
                <div style="position: relative;">
                    <div class="txt-medium-center">    
                        Qty:
                    </div>
                </div>
                <input class="input-qty" name="quantity" type="text" style="margin-left: 42px;">
                <input type="submit" value="Add to Cart" class="btnAddAction" style="margin-left: 32px;"/>
                
            </div>
            <div class="txt-medium" style="margin-top: 16px;">    
                Code: <?php echo $productById["Code"] ?>
            </div>

        </form>
    </div>
</div>