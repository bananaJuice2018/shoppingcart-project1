<?php
	  require("header.php");
    if(!isset($_SESSION["cart_item"])) {
      header('Location: services'); // redirect to index.php
    }
?>

<HTML>
<HEAD>
<link href="style.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</HEAD>
<BODY>

<div class="app">
  <div class="view-login">
    <form action="checkout_action" class="form-login">
        <div class="checkout-title">
          <h4>Billing Address</h4>
        </div>

        <label class="label-login" for="fname"><i class="fa fa-user"></i> Full Name</label>
        <input class="input-login" type="text" id="fullname" name="fullname" placeholder="John M. Doe" required>

        <label class="label-login" for="email"><i class="fa fa-envelope"></i> Email</label>
        <input class="input-login" type="text" id="email" name="email" placeholder="john@example.com" required>

        <label class="label-login" for="adr"><i class="fa fa-address-card-o"></i> Address</label>
        <input class="input-login" type="text" id="adr" name="address" placeholder="542 W. 15th Street" required>

        <label class="label-login" for="city"><i class="fa fa-institution"></i> City</label>
        <input class="input-login" type="text" id="city" name="city" placeholder="New York" required>

        <div>
          <div>
            <label class="label-login" for="state">State</label>
            <input class="input-login" type="text" id="state" name="state" placeholder="NY" required>
          </div>
          <div>
            <label class="label-login" for="zip">Zip</label>
            <input class="input-login" type="text" id="zip" name="zip" placeholder="10001" required>
          </div>
        </div>

      <input type="submit" class="btn" value="Continue to checkout">
    </form>
    <a href="services"> <button class="btn1">Return to cart</button> </a>
    <div>

    </div>
  </div>


</BODY>
</HTML>