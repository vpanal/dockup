<?php
    if(isset($_POST['usuario'])&&isset($_POST['rpassword'])&&$_POST['usuario']!=''&&$_POST['rpassword']!='')
    {
        include('funciones.php');
        session_start();
        conectarse($enlace);
        $nuser=htmlspecialchars($_POST['usuario']);
        $password=$_POST['rpassword'];
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        //Create transaction Users db
        mysqli_begin_transaction($enlace, MYSQLI_TRANS_START_READ_WRITE);
        
        //Insertar usuario y contraseña en pagina
        $sql = "INSERT INTO `users` (`username`, `passwd`) VALUES ('$nuser', '$password_hash');";
        if (!mysqli_query($enlace, $sql)){
            mysqli_rollback($enlace);
            mysqli_close($enlace);
            $_SESSION['error']="The requested username is already in use.";
            header('Location: error.php');  
        }

        //Creacion de usuario
        $sql="CREATE USER '$nuser'@'%' IDENTIFIED WITH mysql_native_password BY '$password'";
        if (!mysqli_query($enlace, $sql)){
            mysqli_rollback($enlace);
            mysqli_close($enlace);
            $_SESSION['error']="Undefined database error.";
            header('Location: error.php');  
        }

        //Permisos user
        $sql="GRANT USAGE ON *.* TO '$nuser'@'%';";
        if (!mysqli_query($enlace, $sql)){
            mysqli_rollback($enlace);
            mysqli_close($enlace);
            $_SESSION['error']="Undefined database error.";
            header('Location: error.php');  
        }

        //Permisos user querys
        $sql="ALTER USER '$nuser'@'%' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 100 MAX_USER_CONNECTIONS 0;";
        if (!mysqli_query($enlace, $sql)){
            mysqli_rollback($enlace);
            mysqli_close($enlace);
            $_SESSION['error']="Undefined database error.";
            header('Location: error.php');  
        }

        //Create user DB
        $sql="CREATE DATABASE IF NOT EXISTS $nuser;";
        if (!mysqli_query($enlace, $sql)){
            mysqli_rollback($enlace);
            mysqli_close($enlace);
            $_SESSION['error']="Undefined database error.";
            header('Location: error.php');  
        }

        //Permisos DB usuario
        $sql="GRANT ALL PRIVILEGES ON $nuser.* TO '$nuser'@'%';";
        if (!mysqli_query($enlace, $sql)){
            mysqli_rollback($enlace);
            mysqli_close($enlace);
            $_SESSION['error']="Undefined database error.";
            header('Location: error.php');  
        }

        mysqli_commit($enlace);
        mysqli_close($enlace);
    }
    header('Location: index.php'); 
?>