<?php
    include('funciones.php');
    login();
    conectarse($enlace);
    $sql="SELECT `instancia`.`id` as `id`,`name`,`link`,`status` FROM `instancia` join `instance_status` on `instancia`.`id`=`instance_status`.`id.instance` JOIN `users` ON `users`.`id`=`instancia`.`user` JOIN `status` ON `status`.`id`=`instance_status`.`state` WHERE `users`.`username`='$usuario';";
    if($rsql=mysqli_query($enlace,$sql)){
        mysqli_close($enlace);
    }else{
        mysqli_close($enlace);
        $_SESSION['error']="Unspecified database error.";
        header("Location: error.php");
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
    <div class="form"  style="height: 470px;">
        <div class="form-toggle"></div>
        <div class="form-panel one" id="menu">
            <div class="form-header">
                <h1>Instances<a href="./nueva.php" class="right"><i class="material-symbols-outlined">add_circle</i></a><a href="http://<?php echo "$phpmyadm:$phpmyadmport/$phpmyadmsite" ?>" target="_blank" class="right" id="db"><i class="material-symbols-outlined">database</i></a></h1>
            </div>
            <div class="form-content">
                <div class="form-group">
                    <table id="table">
                        <tr>
                            <th>Name</th>
                            <th>Git</th>
                            <th>Link</th>
                            <th>State</th>
                            <th class="action">Action</th>
                        </tr>
                        <?php 
                            while ($result=mysqli_fetch_array($rsql)) {
                                $id=$result['id'];
                        ?>
                            <tr>
                                <td><?php echo $result['name'] ?></td>
                                <td><a href="<?php echo $result['link'] ?>" target="_blank"><i class="fa fa-github" style="font-size:24px"></i></a></td>
                                <td><a href="http://<?php echo $result['name'].".".$domain.":".$webport ?>" target="_blank" ><i class="material-symbols-outlined">language</i></a></td>
                                <td><?php echo $result['status'] ?></td>
                                <td>
                                    <a href="mod.php?instance=<?php echo $id;?>&status=4"><i class="material-symbols-outlined">change_circle</i></a> 
                                    <a href="mod.php?instance=<?php echo $id;?>&status=1"><i class="material-symbols-outlined">play_circle</i></a> 
                                    <a href="mod.php?instance=<?php echo $id;?>&status=2"><i class="material-symbols-outlined">stop_circle</i></a> 
                                    <a href="mod.php?instance=<?php echo $id;?>&status=3"><i class="material-symbols-outlined">delete</i></a>
                                </td>
                            </tr>
                        <?php
                            }
                        ?>
                    </table>
                </div>
                
                <div class="form-group">
                </div>
                <div class="form-group">
                </div>
            </div>
        </div>
    </div>
    <div class="pen-footer"><a href="./logout.php"><i class="material-icons">arrow_backward</i>Logout</a><a href="./password.php"><?php echo $usuario;?></a></div>    
</body>

</html>
