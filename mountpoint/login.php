<?php
    session_start();
    if(isset($_SESSION['deploy_user_id'])){
        header('Location: menu.php');
    }elseif (isset($_POST['user'])&&isset($_POST['password'])&&$_POST['user']!=''&&$_POST['password']!='') {
        include('funciones.php');
        conectarse($enlace);
        $username = htmlspecialchars($_POST['user']);
        $password = $_POST['password'];
        
        $query = "SELECT id,username,passwd FROM users WHERE username='$username'";

        $result = mysqli_fetch_array(mysqli_query($enlace,$query));
        
        if ($result&&password_verify($password, $result['passwd'])) {
            $_SESSION['deploy_user_id'] = htmlspecialchars($result['username']);
            $usuario=htmlspecialchars($result['username']);
            $_SESSION['uid'] = htmlspecialchars($result['id']);
            $uid=htmlspecialchars($result['id']);
            header('Location: menu.php');
        }else{
            $_SESSION['login']=1;
            header('Location: index.php');
        }
    }else{
        $_SESSION['login']=1;
        header('Location: index.php');
    }
?>