<?php
    if(isset($_POST['name'])&&isset($_POST['link'])&&$_POST['name']!=''&&$_POST['link']!=''){
        include('funciones.php');
        login();
        if(strlen($_POST['name'])>15){
            $_SESSION['error']="Number of leters exceeded.";
            header("Location: error.php");
        }
        if(substr($_POST['link'],0, 18) !== 'https://github.com'){
            $_SESSION['error']="URL of git not valid.";
            header("Location: error.php");
        }
        conectarse($enlace);
        //Maximo 8 instancias por usuario
        $consulta="SELECT count(id) as num from `instancia` where `user` = $uid;";
        $count=mysqli_fetch_array(mysqli_query($enlace,$consulta));
        $count=$count['num'];
        if($count<8){
            //Eliminacion de simbolos
            $name=$_POST['name'];
            $name=preg_replace('/[^\p{L}\p{N}\s]/u', '', $name);
            //El nombre se queda vacio
            if (strlen($name)==0){
                $_SESSION['error']="Invalid name.";
                header("Location: error.php");
                exit;
            }
            //Inicio de transaccion
            mysqli_begin_transaction($enlace, MYSQLI_TRANS_START_READ_WRITE);

            //Modificacion para que el virtualhost y enlace sea valido
            $name=htmlspecialchars($name);
            $name=str_replace(' ', '_', $name);
            $link=htmlspecialchars($_POST['link']);
            
            //Insert en instancia
            $sql="INSERT INTO `instancia` (`id`, `name`, `user`, `link`) VALUES (NULL, LOWER('$name'), $uid, '$link');";
            if (!mysqli_query($enlace,$sql)){
                mysqli_rollback($enlace);
                $_SESSION['error']="Unspecified database error.";
                header("Location: error.php");
            }

            //Seleccionar la ID del registro creado
            $consulta="SELECT id from `instancia` where `name` = LOWER('$name') and `user` = $uid and `link` = '$link' ORDER BY `id` DESC LIMIT 1";
            if (!$id=mysqli_fetch_array(mysqli_query($enlace,$consulta))){
                mysqli_rollback($enlace);
                $_SESSION['error']="Unspecified database error.";
                header("Location: error.php");
            }
            $id=$id['id'];

            //Insertar el estado de instancia
            $sql2="INSERT INTO `instance_status` (`id`, `id.instance`, `state`) VALUES (NULL, $id, 1);";
            if (!mysqli_query($enlace,$sql2)){;
                mysqli_rollback($enlace);
                $_SESSION['error']="Unspecified database error1.";
                header("Location: error.php");
            }

            //Ejecutar el script de cracion
            exec("sshpass -p $sshpass ssh -p $sshport $sshuser@10.20.10.103 'bash -s < /etc/dockup/scripts/create.sh ".strtolower($name)." $domain $link'",$a, $execution);
            if($execution!=0){
                mysqli_rollback($enlace);
                mysqli_close($enlace);
                exec("sshpass -p $sshpass ssh -p $sshport $sshuser@$dockersrv 'bash -s < /etc/dockup/scripts/delete.sh ".strtolower($name)." $domain $link'");
                $_SESSION['error']="Error in container creation.";
                header("Location: error.php");
            }

            //commit
            mysqli_commit($enlace);

            mysqli_close($enlace);
            header('Location: menu.php');
        }else{
            $_SESSION['error']="Number of instances exceeded.";
            header("Location: error.php");
        }
    }
?>