<?php
    session_start();
    if(isset($_SESSION['deploy_user_id'])){
        header('Location: menu.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Dependencias -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons'>
    <link rel="stylesheet" href="./style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./login.js"></script>
    <link rel="icon" type="image/x-icon" href="./favicon.png">

</head>

<body>
    <!-- partial:index.partial.html -->
    <!-- Form-->
    <div class="form">
        <div class="form-toggle size"></div>
        <div class="form-panel one">
            <div class="form-header">
                <h1 class="size">Account Login</h1>
            </div>
            <div class="form-content">
                <form method="POST" id="log-in-form" action="./login.php">
                    <div class="form-group">
                        <label for="user">Username</label>
                        <input type="text" id="user" name="user" required="required" />
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required="required" />
                    </div>
                    <div class="form-group">
                        <?php
                        if(isset($_SESSION['login'])&&$_SESSION['login']!=0){
                        ?>
                            <small id="error" style="color: red;">The user or password are incorrect.</small>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                        if(isset($_SESSION['login'])&&$_SESSION['login']!=0){
                        ?>
                            <small style="color: red;">You don't have an account?</small><small class="ala">Click here</small>
                        <?php
                            $_SESSION['login']=0;
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <button type="submit" form="log-in-form">Log In</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="form-panel two">
            <div class="form-header">
                <h1 class="size">Register Account</h1>
            </div>
            <div class="form-content">
                <form method="post" id="register-form" action="./register.php">
                    <div class="form-group">
                        <label for="usuario">Username</label>
                        <input type="text" id="usuario" name="usuario" required="required" />
                    </div>
                    <div class="form-group">
                        <label for="rpassword">Password</label>
                        <input type="password" id="rpassword" name="rpassword" required="required" />
                    </div>
                    <div class="form-group">
                    </div>
                    <div class="form-group">
                    </div>
                    <div class="form-group">
                        <button type="submit" form="register-form">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="pen-footer"></div>    

</body>

</html>