<?php
    if (isset($_POST['password1'])&&$_POST['password1']!=''&&isset($_POST['password2'])&&$_POST['password2']!='') {
        include('funciones.php');
        login();
        conectarse($enlace);
        $password = $_POST['password1'];
        $password1 = $_POST['password2'];
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        if($password==$password1){
            $sql = "UPDATE `users` SET `passwd`='$password_hash' WHERE `username` = '$usuario'";
            if (mysqli_query($enlace, $sql)){
                mysqli_close($enlace);
                header('Location: menu.php');
            }else{
                mysqli_close($enlace);
                $_SESSION['error']="Unspecified database error.";
                header("Location: error.php");
            }
        }else{
            mysqli_close($enlace);
            $_SESSION['error']="Passwords are not the same.";
            header('Location: error.php');
        }
    }else{
        header('Location: error.php');
    }
?>
