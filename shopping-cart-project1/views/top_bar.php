<div>
    <div class="topbar">
        <img class="logo" src="image/logo.png" />

        <div class="topnav">

        <a class="
        <?php
            if($_SESSION["page_index"] == 0) {
                echo 'active'; 
            }
        ?>" href="<?php 
            if($_SESSION["login"]) {
                echo "/product";
            } else {
                echo "/";
            }
        ?>">All Products</a>

        <a class="
        <?php
            if($_SESSION["page_index"] == 1) {
                echo 'active'; 
            }
        ?>" href="about">About Us</a>

        <?php
            if($_SESSION["login"] == true) {
                if($_SESSION["page_index"] == 2) {
                    echo "
                    <div>
                    <a href='employee' class='active'>Employee</a>
                    </div>";
                } else {
                    echo "
                    <div>
                    <a href='employee'>Employee</a>
                    </div>";
                }

            }
        ?>

        <?php
            if($_SESSION["login"] == true) {
                echo "
                    <div class='logout'>
                    <a href='logout'>Logout</a>
                    </div>";
            } else{
                echo "
                    <div class='logout'>
                    <a href='login'>Login</a>
                    </div>";
            }
        ?>

    </div>
</div>