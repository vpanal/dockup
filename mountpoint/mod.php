<?php
    if(isset($_GET['instance'])&&isset($_GET['status'])){
        include('funciones.php');
        login();
        conectarse($enlace);
        $instance=$_GET['instance'];
        $status=$_GET['status'];

        //Quitar simbolos
        $instance=preg_replace('/[^\p{L}\p{N}\s]/u', '', $instance);
        $status=preg_replace('/[^\p{L}\p{N}\s]/u', '', $status);
        if($instance==''||$status==''){
            $_SESSION['error']="Unspecified error.";
            header("Location: error.php");
        }

        //Seleccionar el nombre y link
        $select="SELECT name, link FROM `instancia` WHERE `id`= $instance";
        if (!$rselect=mysqli_query($enlace,$select)){
            mysqli_close($enlace);
            $_SESSION['error']="Unspecified database error.";
            header("Location: error.php");
        }
        $rselect=mysqli_fetch_array($rselect);
        $name=$rselect['name'];
        $link=$rselect['link'];

        //Iniciar transactional
        mysqli_begin_transaction($enlace, MYSQLI_TRANS_START_READ_WRITE);

        //Modificar status
        if($status==1 or $status==2){
            $update="UPDATE `instance_status` SET `state` = '$status' WHERE `instance_status`.`id.instance` = $instance";
            if (!mysqli_query($enlace,$update)){
                mysqli_rollback($enlace);
                mysqli_close($enlace);
                $_SESSION['error']="Unspecified database error.";
                header("Location: error.php");
            }
        }

        //Ejecutar cambio de estado con script
        switch ($status) {
            case '1':
                exec("sshpass -p $sshpass ssh -p $sshport $sshuser@$dockersrv 'bash -s < /etc/dockup/scripts/start.sh $name $domain'",$a, $execution);
                if($execution!=0){
                    mysqli_rollback($enlace);
                    mysqli_close($enlace);
                    $_SESSION['error']="Unspecified change status error.";
                    header("Location: error.php");
                }
                break;

            case '2':
                exec("sshpass -p $sshpass ssh -p $sshport $sshuser@$dockersrv 'bash -s < /etc/dockup/scripts/stop.sh $name $domain'",$a, $execution);
                if($execution!=0){
                    mysqli_rollback($enlace);
                    mysqli_close($enlace);
                    $_SESSION['error']="Unspecified change status error.";
                    header("Location: error.php");
                }
                break;

            case 3:
                $del1="DELETE FROM `instance_status` WHERE `instance_status`.`id.instance` = $instance";
                if (!mysqli_query($enlace,$del1)){
                    mysqli_rollback($enlace);
                    mysqli_close($enlace);
                    $_SESSION['error']="Unspecified database error.";
                    header("Location: error.php");
                }
                $del2="DELETE FROM `instancia` WHERE `instancia`.`id` = $instance";
                if (!mysqli_query($enlace,$del2)){
                    mysqli_rollback($enlace);
                    mysqli_close($enlace);
                    $_SESSION['error']="Unspecified database error.";
                    header("Location: error.php");
                }
                exec("sshpass -p $sshpass ssh -p $sshport $sshuser@$dockersrv 'bash -s < /etc/dockup/scripts/delete.sh $name $domain'",$a, $execution);
                if($execution!=0){
                    mysqli_rollback($enlace);
                    mysqli_close($enlace);
                    $_SESSION['error']="Unspecified change status error.";
                    header("Location: error.php");
                }
                break;
            case '4':
                exec("sshpass -p $sshpass ssh -p $sshport $sshuser@$dockersrv 'bash -s < /etc/dockup/scripts/reload.sh $name $domain $link'",$a, $execution);
                if($execution!=0){
                    mysqli_rollback($enlace);
                    mysqli_close($enlace);
                    $_SESSION['error']="Unspecified change status error.";
                    header("Location: error.php");
                }
                break;
        }

        //Commit
        mysqli_commit($enlace);
        mysqli_close($enlace);
    }
    header('Location: menu.php');
?>
