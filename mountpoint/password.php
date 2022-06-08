<?php
    include('funciones.php');
    login();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password</title>
    <!-- Dependencias -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons'>
    <link rel="stylesheet" href="./style.css">
    <link rel="icon" type="image/x-icon" href="./favicon.png">

        <script>
            window.onload = function() {
                document.getElementById("passwd-submit").addEventListener("click", function(e) {
                    e.preventDefault();
                    var password1 = document.getElementById("password1").value;
                    var password2 = document.getElementById("password2").value;
                    if (password1 != password2) {
                        document.getElementById("error").style.visibility = "visible";
                    } else {
                        if (password1 == '' || password2 == '') {
                        document.getElementById("error").style.visibility = "visible";
                        }else{
                            document.getElementById("error").style.display = "hidden";
                            document.getElementById("change-passwd").submit();
                        }  
                    }
                });
            }
        </script>




</head>

<body>
    <!-- partial:index.partial.html -->
    <!-- Form-->
    <div class="form">
        <div class="form-toggle"></div>
        <div class="form-panel one">
            <div class="form-header">
                <h1>Change Password</h1>
            </div>
            <div class="form-content">
                <form method="POST" id="change-passwd" action="./action_password.php">
                    <div class="form-group">
                        <label for="password1">New Password</label>
                        <input type="password" id="password1" name="password1" required="required" />
                    </div>
                    <div class="form-group">
                        <label for="password2">Confirm Password</label>
                        <input type="password" id="password2" name="password2" required="required" />
                    </div>
                    <div id="error" class="form-group">
                        <p>Passwords don't match</p>
                    </div>
                    <div class="form-group">
                    </div>
                    <div class="form-group">
                        <button type="submit" id="passwd-submit" form="change-passwd">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="pen-footer"><a href="./menu.php"><i class="material-icons">arrow_backward</i>Menu</a></div>

</body>

</html>
