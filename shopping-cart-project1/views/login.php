<?php
    require("header.php");
    if(!empty($_POST["username"]) && !empty($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $users = $db_handle->runQuery("SELECT * FROM admin WHERE UserName='$username' AND Password=md5('$password')");

        if($users) {
            $user = $users[0];
            $_SESSION["login"] = true;
            $_SESSION["user_id"] = (int)$user['Id'];
            header('Location: product');
        } else {
            echo 'NO USER EXISTS';
        }
    }
?>

<div class="app">
    <div class="view-login">
        <form method="post" class="form-login">
            <div className="view-logo">
                <img class="img-logo" src="image/logo.png" />
            </div>

            <label class="label-login">
            User name
            <input class="input-login" type="text" name="username" placeholder="Enter user name" /> 
            </label>

            <label class="label-login">
            Password
            <input class="input-login" type="password" name="password" placeholder="Enter password" /> 
            </label>

            <button class="button-login" type="submit" >Login</button>
        </form>
    </div>
</div>