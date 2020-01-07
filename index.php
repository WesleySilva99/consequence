<?php


  session_start();
    
//   include 'conexao.php';
   if (!isset($_SESSION['USUARIO_LOGADO'])) {
    # code...
    header("Location:/login");
    
  }else{
  	header("Location:/admin");
  }

?>