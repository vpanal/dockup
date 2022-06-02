<?php
    include('funciones.php');
    session_start();
    if(!isset($_SESSION['error'])||$_SESSION['error']==""){
        $_SESSION['error']="Undefined error";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>

    <!-- Dependencias -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons|Material+Symbols+Outlined'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./style.css">
    <link rel="icon" type="image/x-icon" href="./favicon.png">
 
</head>

<body>
    <!-- partial:index.partial.html -->
    <!-- Form-->
    <div class="form" style="height: 470px;">
        <div class="form-toggle"></div>
        <div class="form-panel one">
            <div class="form-header">
                <h1>Error</h1>
            </div>
            <div class="form-content">
                <form method="POST" action="./index.php">
                    <div class="form-group">

                    </div>
                    <div class="form-group">
                        <?php echo $_SESSION['error']; ?>
                    </div>
                    <div class="form-group">
                        <br><br><br><br><br><br>
                    </div>
                    <div class="form-group">
                    </div>
                    <div class="form-group">
                        <button type="submit">Return</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="pen-footer"></div>    

</body>

</html>
<?php $_SESSION['error'] = ''; ?>