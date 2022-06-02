<?php 
//Datos base de datos
include_once('srv.php');
$enlace = mysqli_connect($serverdb, $userdb, $passdb, $namedb, $dbport);
//$usersdb = mysqli_connect($sqlsrv, $sqlsrvusr, $sqlsrvpass, $sqlsrvdb);
//Funciones
  //Conexion a base de datos
    function conectarse ($enlace) {
      if (!$enlace) {
          session_start();
          $_SESSION['error']="Unspecified database error.";
          header("Location: error.php");
      }
    }
  //Inicio de sesion
    function login(){
        session_start();
        if(!isset($_SESSION['deploy_user_id'])){
          header('Location: index.php');
        }else{
          global $usuario;
          global $uid;
          global $domain;
          $domain='elc.ddnsfree.com';
          $usuario=$_SESSION['deploy_user_id'];
          $uid=$_SESSION['uid'];
        }
        
    }
?>