<?php 
include('funciones.php');
exec("sshpass -p 12345 ssh -o 'StrictHostKeyChecking no' root@$dockersrv 'echo ola'");
exec("rm install.php");