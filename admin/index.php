<!DOCTYPE html>
<html lang="br">
<?php

session_start();

include 'util/conexao.php';
if (!isset($_SESSION['admin'])) {
    # code...
    header("Location:/login");

}

?>
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

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
       <?php

       include 'header.php';
       include 'menuLateral.php';

       ?>



       <!-- PAGE CONTAINER-->
       <div class="page-container">
           <?php
           include 'headerDesktop.php';
           ?>

           <div class="col-md-12">

            <?php 

            if (isset($_GET['msg'])) {

                ?>
                <center>
                    <h2 style="margin-top: 10%"><?=$_GET['msg']?></h2>
                </center>
                <?php
            }
            ?>
            <!-- DATA TABLE -->
            <h3 class="title-5 m-b-35" style="margin-top: 10%">Partidas</h3>
            <div class="table-data__tool">

                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>

                                <th>Descrição</th>
                                <th>Jogadores</th>
                                <th>Nível</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $sql = "select * from partida where id_usuario = ?";

                            $stmt = $conexao->prepare($sql);
                            $stmt->bindParam(1, $_SESSION['id']);
                            $stmt->execute();   
                            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($resultado as $linha) {

                                ?>
                                <tr class="tr-shadow">

                                    <td><?=$linha['descricao'];?></td>
                                    <td>
                                        <?php

                                        $query = "select j.* from jogador j left join partida_jogador pj on j.id = pj.id_jogador where pj.id_partida = ?";

                                        $execucao = $conexao->prepare($query);
                                        $execucao->bindParam(1, $linha['id']);
                                        $execucao->execute();   
                                        $volta = $execucao->fetchAll(PDO::FETCH_ASSOC);

                                        foreach ($volta as $row) {
                                            ?>
                                            <span class="block-email"><?=$row['nome'];?></span> <br>
                                            <?php
                                        }
                                        ?>

                                    </td>
                                    <td>
                                            
                                        <?php

                                            switch ($linha['nivel']) {
                                                case 1:
                                                    echo "Básico";
                                                    break;
                                                case 2:
                                                    echo "Médio";
                                                    break;
                                                case 3:
                                                    echo "Pesado";
                                                    break;
                                                case 4:
                                                    echo "Festinha";
                                                    break;
                                                case 5:
                                                    echo "PUTARIAAAA";
                                                    break;
                                            }

                                        ?>

                                    </td>
                                    
                                    <td>
                                        <div class="table-data-feature">
                                            
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Jogar" onclick="window.open('/jogar.php?partida=<?=$linha['id']?>')">
                                                <i class="zmdi zmdi-mail-send"></i>
                                            </button>
                                            
                                            <a href="/entraNaPartida.php?id=<?=$linha['id'];?>">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Adicionar Jogador" data-original-title="Adicionar Jogador">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                            </a>
                                            <a href="/partida/delete.php?id=<?=$linha['id'];?>">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </a>
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="More">
                                                <i class="zmdi zmdi-more"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
                <!-- END DATA TABLE -->
            </div>

            <!-- DATA TABLE -->
            <h3 class="title-5 m-b-35" style="margin-top: 10%">Jogadores</h3>
            <div class="table-data__tool">

                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $sql = "select * from jogador where id_usuario = ?";

                            $stmt = $conexao->prepare($sql);
                            $stmt->bindParam(1, $_SESSION['id']);
                            $stmt->execute();   
                            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($resultado as $linha) {

                                ?>
                                <tr class="tr-shadow">

                                    <td><?=$linha['nome'];?></td>
                                    
                                    <td>
                                        <div class="table-data-feature">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Send">
                                                <i class="zmdi zmdi-mail-send"></i>
                                            </button>
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                            <a href="/jogador/delete.php?id=<?=$linha['id'];?>">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </a>
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="More">
                                                <i class="zmdi zmdi-more"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
                <!-- END DATA TABLE -->
            </div>

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
