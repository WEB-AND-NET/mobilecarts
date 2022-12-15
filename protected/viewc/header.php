<?php
$login = $_SESSION['login'];
?>
<header class="main-header">
    <!-- Logo -->
    <a href="<?= $patch ?>" class="logo">
        <!-- Logo para cuando la web este con tamaño pequeño-->
        <span class="logo-mini"><b><?= C_LOGO_M1; ?></b><?= C_LOGO_M2; ?></span>
        <!-- Logo para cuando este tamaño normal (Escritorio) -->
        <span class="logo-lg"><?= C_LOGO; ?></span>
    </a>
    <!-- Opciones para configuracion del usuario y avatar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-clock-o"></i>
                        <span id="push-vencidos-i" class="label label-danger"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li id="push-vencidos-h" class="header">Documentos Vencidos o por Vencer</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul id="push-vencidos" class="menu">
                                <li></li>
                            </ul>
                        </li>
                        <li id="footer-vencido" class="header">
                            <a href='<?php echo $patch ?>getdocvencidos/view'>Ver todas los documentos</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag-o"></i>
                        <span id="push-conductores-i" class="label label-danger"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul id="push-conductores" class="menu">
                                <li></li>
                            </ul>
                        </li>
                        <li id="footer-conductores" class="header">
                            Tu Bandeja esta vacia !!
                        </li>
                    </ul>
                </li>
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o" style="font-size: 20px;"></i>
                        <span id="push-ordenes-i" class="label label-warning">0</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li id="push-ordenes-h" class="header">Upps! No hay Solicitudes.</li>
                        <li>
                            <ul id="push-ordenes" class="menu">
                                <!--
                                <li><!-- start message -/->
                                    <a href="#">
                                        <div class="pull-left">
                                            <img src="<? //= $patch 
                                                        ?>global/img/users/user2-160x160.jpg" class="img-circle" alt="User Image" />
                                        </div>
                                        <h4>
                                            Cliente
                                        </h4>
                                        <p><strong>Origen: </strong> Manga &nbsp;-&nbsp;&nbsp; <strong>Destino:</strong> Bosque</p>
                                        <p>Why not buy a new awesome c?asasac asas asas asas asa eeeeee</p>
                                    </a>
                                </li>-->
                            </ul>
                        </li>
                        <li class="footer"><a href="#">Ver Todas las Solicitudes</a></li>
                    </ul>
                </li>
                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag-o"></i>
                        <span id="push-cancelados-i" class="label label-danger">0</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li id="push-cancelados-h" class="header">Se cancelo un solicitud</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul id="push-cancelados" class="menu">
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="#">Ver todas las cancelaciones</a>
                        </li>
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= $patch ?>global/img/users/<?= $login->imagen ?>" class="user-image" alt="User Image" />
                        <span class="hidden-xs"><?= $login->nombre ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= $patch ?>global/img/users/<?= $login->imagen ?>" class="img-circle" alt="User Image" />
                            <p>
                                <?= $login->nombre ?> - <?= $login->perfil ?>
                                <!--<small>Member since Nov. 2012</small>-->
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?= $patch ?>perfil" class="btn btn-default btn-flat">Mi Perfil</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?= $patch ?>logout" class="btn btn-default btn-flat">Cerrar Sesi&oacute;n</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>