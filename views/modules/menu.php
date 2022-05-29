<aside class='main-sidebar'>

    <section class='sidebar'>

        <ul class='sidebar-menu tree' data-widget="tree" style='margin-top:4px;'>

            <?php

            if($_SESSION["perfil"] == "Administrador"){

                echo '<li>

                    <a href="home" style="text-decoration:none;">

                        <i class="fa fa-home"></i>
                        <span>Inicio</span>

                    </a>

                </li>

                <li>

                    <a href="usuarios" style="text-decoration:none;">

                        <i class="fa fa-user"></i>
                        <span>Usuarios</span>

                    </a>

                </li>';

            }

            if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial"){

                echo '<li>

                    <a href="category" style="text-decoration:none;">

                        <i class="fa fa-th"></i>
                        <span>Categorías</span>

                    </a>

                </li>

                <li>

                    <a href="productos" style="text-decoration:none;">

                        <i class="fa fa-product-hunt"></i>
                        <span>Productos</span>

                    </a>

                </li>';

            }

            if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor"){

                echo '<li>

                    <a href="clientes" style="text-decoration:none;">

                        <i class="fa fa-users"></i>
                        <span>Clientes</span>

                    </a>

                </li>';

            }

            if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor"){

                echo '<li class="treeview">

                    <a href="#" style="text-decoration:none;">

                        <i class="fa fa-list-ul"></i>
                        
                        <span>Ventas</span>
                        
                        <span class="pull-right-container">
                        
                            <i class="fa fa-angle-left pull-right"></i>

                        </span>

                    </a>

                    <ul class="treeview-menu">
                        
                        <li>

                            <a href="ventas" style="text-decoration:none;">
                                
                                <i class="fa fa-circle-o"></i>
                                <span>Administrar ventas</span>

                            </a>

                        </li>

                        <li>

                            <a href="crear-venta" style="text-decoration:none;">
                                
                                <i class="fa fa-circle-o"></i>
                                <span>Crear venta</span>

                            </a>

                        </li>';

                        if($_SESSION["perfil"] == "Administrador"){

                        echo '<li>

                            <a href="reportes-ventas" style="text-decoration:none;">
                                
                                <i class="fa fa-circle-o"></i>
                                <span>Reporte de ventas</span>

                            </a>

                        </li>';

                        }

                    

                    echo '</li>

                </ul>';

            }
    ?>
        </ul>

    </section>

</aside>