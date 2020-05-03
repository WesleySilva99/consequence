<script type="text/javascript">
    
    jogar(id){

        window.open('/jogar/index.php?partida='+id)

    }

</script>

<!-- MENU SIDEBAR-->
<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="/">
            <img src="/login/images/logo.jpeg" alt="Consequence" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="active has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-tachometer-alt"></i>Partida</a>
                        <ul class="list-unstyled navbar__sub-list js-sub-list">

                            <?php

                            $sql = 'select * from partida where id_usuario = ?';

                            $stmt = $conexao->prepare($sql);
                            $stmt->bindParam(1, $_SESSION['id']);
                            $stmt->execute();   
                            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($resultado as $linha) {
                                ?>

                                <li>
                                    <a href="#" onclick="window.open('/jogar/jogar.php?partida=<?=$linha['id']?>')" style='color: black'>
                                        <?=$linha['descricao']?>
                                    </a>
                                </li>
                                <?php 
                            }
                            ?>
                            <li>
                                <a href="/criarPartida.php">Criar uma nova partida</a>
                            </li>
                        </ul>
                    </li>
                    <li class="active has-sub">
                        <a class="js-arrow" href="#">
                            <i class="fas fa-chart-bar"></i>Jogadores</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="/cadastrarJogador.php">Adicionar jogadores a conta</a>
                                </li>
                            </ul>
                        </li>
                        <?php

                        if ($_SESSION['admin'] == 1) {

                            ?>
                            <li class="active has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="fas fa-chart-bar"></i>Perguntas</a>
                                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                                        <li>
                                            <a href="/criarPergunta.php">Adicionar pergunta</a>
                                        </li>
                                        <li>
                                            <a href="/pergntas.php">Listar Perguntas</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="active has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="fas fa-chart-bar"></i>Consequências</a>
                                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                                        <li>
                                            <a href="/cadastraConsequencia.php">Adicionar Consequência</a>
                                        </li>
                                        <li>
                                            <a href="/pergntas.php">Listar Perguntas</a>
                                        </li>
                                    </ul>
                                </li>
                                <?php

                            }

                            ?>
                            <!-- 
                            <li>
                                <a href="chart.html">
                                    <i class="fas fa-chart-bar"></i>Charts</a>
                                </li>
                                <li>
                                    <a href="table.html">
                                        <i class="fas fa-table"></i>Tables</a>
                                    </li>
                                    <li>
                                        <a href="form.html">
                                            <i class="far fa-check-square"></i>Forms</a>
                                        </li>
                                        <li>
                                            <a href="calendar.html">
                                                <i class="fas fa-calendar-alt"></i>Calendar</a>
                                            </li>
                                            <li>
                                                <a href="map.html">
                                                    <i class="fas fa-map-marker-alt"></i>Maps</a>
                                                </li>
                                                <li class="has-sub">
                                                    <a class="js-arrow" href="#">
                                                        <i class="fas fa-copy"></i>Pages</a>
                                                        <ul class="list-unstyled navbar__sub-list js-sub-list">
                                                            <li>
                                                                <a href="login.html">Login</a>
                                                            </li>
                                                            <li>
                                                                <a href="register.html">Register</a>
                                                            </li>
                                                            <li>
                                                                <a href="forget-pass.html">Forget Password</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="has-sub">
                                                        <a class="js-arrow" href="#">
                                                            <i class="fas fa-desktop"></i>UI Elements</a>
                                                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                                                <li>
                                                                    <a href="button.html">Button</a>
                                                                </li>
                                                                <li>
                                                                    <a href="badge.html">Badges</a>
                                                                </li>
                                                                <li>
                                                                    <a href="tab.html">Tabs</a>
                                                                </li>
                                                                <li>
                                                                    <a href="card.html">Cards</a>
                                                                </li>
                                                                <li>
                                                                    <a href="alert.html">Alerts</a>
                                                                </li>
                                                                <li>
                                                                    <a href="progress-bar.html">Progress Bars</a>
                                                                </li>
                                                                <li>
                                                                    <a href="modal.html">Modals</a>
                                                                </li>
                                                                <li>
                                                                    <a href="switch.html">Switchs</a>
                                                                </li>
                                                                <li>
                                                                    <a href="grid.html">Grids</a>
                                                                </li>
                                                                <li>
                                                                    <a href="fontawesome.html">Fontawesome Icon</a>
                                                                </li>
                                                                <li>
                                                                    <a href="typo.html">Typography</a>
                                                                </li>
                                                            </ul>
                                                        </li>
-->
                                                    </ul>
                                                </nav>
                                            </div>
                                        </aside>

        <!-- END MENU SIDEBAR-->