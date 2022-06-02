<?php
    include('funciones.php');
    login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Instance</title>
    <!-- Dependencias -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons|Material+Symbols+Outlined'>
    <link rel="stylesheet" href="./style.css">
    <link rel="icon" type="image/x-icon" href="./favicon.png">

    <script>
        window.onload = function() {
            document.getElementById("submit").addEventListener("click", function(event) {
                var link = document.getElementById("link").value;
                if (link.indexOf("https://github.com") == -1) {
                    /* Quitar poner display block el elemento con id "error1"  */
                    document.getElementById("error").style.display = "block";
                    event.preventDefault();
                }else{
                    /* En caso contrario, enviar el formulario */
                    document.getElementById("error").style.display = "none";
                    var x = document.getElementsByClassName("form-group");
                    var i;
                    for (i = 0; i < x.length; i++) {
                        x[i].style.display = 'none';
                    }
                    document.getElementById("loading").style.display = "block";
                    document.getElementById("new-instance").submit();
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
                <h1>New instance</h1>
            </div>
            <div class="form-content">
                <form method="POST" id="new-instance" action='./action_nueva.php'>
                    <div id="loading" style="display: none;">
                        <small>Please wait. The new container is starting.</small>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required="required" maxlength="15">
                    </div>
                    <div class="form-group">
                        <label for="link">Link</label>
                        <input type="text" id="link" name="link" required="required">
                        <small id="error" style="display: none; color: red;">The link must be a valid GitHub link</small>
                    </div>
                    <div class="form-group">
                    </div>
                    <div class="form-group">
                    </div>
                    <div class="form-group">
                        <button type="submit" id="submit" form="change-passwd">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="pen-footer"><a href="./menu.php"><i class="material-icons">arrow_backward</i>Menu</a><a href="./password.php">vpanal</a></div>    




</body>
</html>
