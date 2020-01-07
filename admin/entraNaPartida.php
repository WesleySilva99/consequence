<!DOCTYPE html>
<html lang="br">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <script type="text/javascript">

        function valida(){
            var nivel = document.getElementById('SelectLm');
            var desc = document.getElementById('email2');

            if (nivel.value.trim() == '') {
                alert('Selecione um nível!');
                return false;
            }
            if (desc.value.trim() == '') {
                alert('Descreva sua partida');
                return false;
            }
            return true;
        }

    </script>

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">
    <?php

    session_start();
    
    include 'util/conexao.php';
    if (!isset($_SESSION['admin'])) {
    # code...
        header("Location:/login");
        
    }

    ?>
</head>

<body class="animsition">
    <div class="page-wrapper">
       <?php

       include 'header.php';
       include 'menuLateral.php';

       ?>


       <?php
       include 'headerDesktop.php';
       ?>

       <!-- PAGE CONTAINER-->
       <div class="page-container" style="margin-top: 10%">

        <?php
        if (isset($_GET['msg'])) {
            ?>
            <center>
                <h2 style="margin-top: 10%"><?=$_GET['msg']?></h2>
            </center>
            <?php
        }
        ?>

        <center>
            <fieldset>
                <legend>Jogadores Cadastrados</legend>
                <table>
                    <tr>
                        <th colspan="2">Nome</th>
                    </tr>
                    <?php

                    $sql = "select * from jogador where id_usuario = ?";

                    $stmt = $conexao->prepare($sql);
                    $stmt->bindParam(1, $_SESSION['id']);
                    $stmt->execute();   
                    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($resultado as $linha) {

                        ?>
                        <tr>
                            <td><?=$linha['nome'];?></td>
                            <td>
                                <a href="/jogador/entrou.php?jogador=<?=$linha['id'];?>&partida=<?=$_GET['id'];?>">
                                    <button class="btn-sm btn-success">Adicionar</button>
                                </a>
                            </td>
                        </tr>
                        <?php
                    } 
                    ?>
                </table>
            </fieldset>
            <fieldset>
                <legend>Jogadores na partida</legend>
                <table>
                    <tr>
                        <th>Nome</th>
                    </tr>
                    <?php

                    $sql = "select j.* from jogador j left join partida_jogador pj on j.id = pj.id_jogador where pj.id_partida = ?";

                    $stmt = $conexao->prepare($sql);
                    $stmt->bindParam(1, $_GET['id']);
                    $stmt->execute();
                    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($resultado as $linha) {

                        ?>
                        <tr>
                            <td><?=$linha['nome'];?></td>
                            <td>
                                <a href="/jogador/saiu.php?jogador=<?=$linha['id'];?>&partida=<?=$_GET['id'];?>">
                                    <button class="btn-sm btn-danger">Remover</button>
                                </a>
                            </td>
                        </tr>
                        <?php
                    } 
                    ?>
                </table>
            </fieldset>
        </center>


        <div class="row">
            <div class="col-md-12">
                <div class="copyright">
                    <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->
</div>

</div>

<!-- Jquery JS-->
<script src="vendor/jquery-3.2.1.min.js"></script>
<!-- Bootstrap JS-->
<script src="vendor/bootstrap-4.1/popper.min.js"></script>
<script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
<!-- Vendor JS       -->
<script src="vendor/slick/slick.min.js">
</script>
<script src="vendor/wow/wow.min.js"></script>
<script src="vendor/animsition/animsition.min.js"></script>
<script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
</script>
<script src="vendor/counter-up/jquery.waypoints.min.js"></script>
<script src="vendor/counter-up/jquery.counterup.min.js">
</script>
<script src="vendor/circle-progress/circle-progress.min.js"></script>
<script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="vendor/chartjs/Chart.bundle.min.js"></script>
<script src="vendor/select2/select2.min.js">
</script>

<!-- Main JS-->
<script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
