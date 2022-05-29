<?php

  /*=========================================================
  =VALIDO EL INTENTO DE ENTRAR POR URL SIN TENER EL PERMISO=
  =========================================================*/

  if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

    echo '<script>

      window.location = "home";

    </script>';

    return;

  }

?>

<!--/*=========================================================
=INICIO DE LA PAGINA USUARIOS=
=========================================================*/-->

<div class="content-wrapper">

    <section class="content-header">

        <h1>

            <strong class="title_pages">Administrar Usuarios</strong>

        </h1>

        <ol class="breadcrumb">

            <li class="breadcrumb-item active"><a href="home"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="breadcrumb-item">Administrar Usuarios</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <!--/*=========================================================
            =BOTON AGREGAR USUARIO=
            =========================================================*/-->

            <div class="box-header with-border">

                <button class='btn btn-primary btn_register_user' data-bs-toggle='modal'
                    data-bs-target='#modalAgregarUsuario'>

                    <i class="fas fa-plus-square"></i> Registro de usuario

                </button>

            </div>

            <div class="box-body">

                <!--/*=========================================================
                =TABLA DE USUARIO=
                =========================================================*/-->

                <table style='border-bottom:none !important;'
                    class='table table-bordered table-striped dt-responsive tablas'>

                    <thead>

                        <tr>

                            <th style='width:10px;border-bottom:none !important;'>#</th>
                            <th style='border-bottom:none !important;'>Nombre</th>
                            <th style='border-bottom:none !important;'>Usuario</th>
                            <th style='border-bottom:none !important;'>Foto</th>
                            <th style='border-bottom:none !important;'>Perfil</th>
                            <th style='border-bottom:none !important;'>Estado</th>
                            <th style='border-bottom:none !important;'>Último login</th>
                            <th style='border-bottom:none !important;'>Acción</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php

                            /*=============================================
                            =LLENADO DE MI TABLA CON DATOS DE MI BD=
                            =============================================*/

                            $column = null;
                            $value = null;
                          
                            $usuarios = ControllerUser::ctl_MostrarUsuarios($column, $value);

                            foreach ($usuarios as $data => $value) {

                              echo "
                              
                                  <tr>

                                    <td style='width:10px;text-align:center;'>".($data + 1)."</td>
                                    <td style='text-align:center;'>".strtoupper($value['nombre_usuario'])."</td>
                                    <td style='text-align:center;'>".$value['usuario']."</td>
                                    <td style='display:flex;justify-content:center; text-align:center;'>";

                                    if($value['foto_usuario'] !=  ""){

                                      echo '<img src="'.$value['foto_usuario'].'" class="img-thumbnail" width="40px" alt="default-img.png">';

                                    }else{

                                      echo '<img src="views/img/img_users/default/anonymous.png" class="img-thumbnail" width="40px" alt="default-img.png">';

                                    }
                                    
                                    /*=============================================
                                    =AGREGO UN COLOR PARA PERFIL Y REMARCO AL ADMIN=
                                    =============================================*/
                                    $colour = "#000000";

                                    $perfilUser = $value['perfil_usuario'];
                                    
                                    switch($perfilUser){

                                      case "Administrador";

                                        $colour = "#00a65a";
                                        $perfilTable = strtoupper($perfilUser);
                                    
                                      break;
                                      case "Especial";
                                      
                                        $colour = "#3c8dbc";
                                        $perfilTable = $perfilUser;

                                      break;
                                      case "Vendedor";

                                        $colour = "#f39c12";
                                        $perfilTable = $perfilUser;
                                      
                                      break;

                                    }
                                    
                              echo "</td>
                                    <td style='text-align:center;font-weight:bold;color:".$colour."'>".$perfilTable."</td>
                                    <td style='text-align: center;'>";
                                    
                                    if($value['estado_usuario'] != 0){

                                      echo "<button class='btn btn-success btn-xs btn_activar_user' id_value='".$value['id_usuario']."' estado_tochange='0'>Activado</button>";

                                    }else{

                                      echo "<button class='btn btn-danger btn-xs btn_activar_user' id_value='".$value['id_usuario']."' estado_tochange='1'>Desactivado</button>";

                                    }
                                    
                                    
                                    echo "</td>
                                    <td style='text-align: center;'>".$value['ultimo_login_usuario']."</td>
                                    <td>

                                      <div style='display:flex;justify-content:center; text-align:center;' class='d-grid gap-2 d-md-block'>

                                        <button type='button' class='btn btn-warning btn_editar_user' data-id-usuario='".$value['id_usuario']."' data-bs-toggle='modal' data-bs-target='#modal_edit_user'><i style='color:#E1E1E1;' class='fa fa-pencil'></i></button>
                                        <button type='button' class='btn btn-danger btn_DeleteUser' data-id-usuario='".$value['id_usuario']."' data-user='".$value['usuario']."' data-url_img='".$value['foto_usuario']."'><i class='fa fa-times'></i></button>
                                      </div>

                                    </td>

                                  </tr>";

                            }

                        ?>

                    </tbody>

                </table>

            </div>

        </div>

    </section>

</div>

<!--/*=============================================
  =MODAL AGREGAR USUARIO=
=============================================-->

<div class="modal fade" id="modalAgregarUsuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content" style="border-top-left-radius: 10px;border-top-right-radius: 10px;">

            <form role='form' method='POST' enctype='multipart/form-data'>

                <!--/*=============================================
                =CABECERA DEL MODAL=
                =============================================*/-->

                <div class="modal-header" style="background-color:#367fa9">

                    <h4 class="modal-title" id="staticBackdropLabel" style="color:#f4f4f4"><i class="fas fa-user-plus"
                            tyle="margin-right:10px"></i> Registro de usuario
                    </h4>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <!--/*=============================================
                =CUERPO DEL MODAL=
                =============================================*/-->

                <div class="modal-body">

                    <div class='box-body'>

                        <!--/*=============================================
                        =ENTRADA PARA NOMBRE USUARIO=
                        =============================================*/-->

                        <div class="input-group input-group-lg mb-3">

                            <span class="input-group-text" id="inputGroup-sizing-default"><i
                                    class="fa-solid fa-image-portrait"></i></span>
                            <input type="text" class='form-control input-lg txt_resgitrar_nombre'
                                placeholder='Ingresar nombre' name='txt_register_user-nombre'
                                aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>

                        </div>

                        <!--/*=============================================
                        =ENTRADA PARA USUARIO=
                        =============================================*/-->

                        <div class='input-group input-group-lg mb-3'>

                            <span class="input-group-text" id="inputGroup-sizing-default"><i
                                    class='fa fa-user'></i></span>
                            <input type="text" class='form-control input-lg' id='txt_register_user-Usuario'
                                placeholder='Ingresar usuario' name='txt_register_user-Usuario'
                                aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>

                        </div>

                        <!--/*=============================================
                        =ENTRADA PARA NOMBRE CONTRASEÑA=
                        =============================================*/-->

                        <div class='input-group input-group-lg mb-3'>

                            <span class="input-group-text" id="inputGroup-sizing-default"><i
                                    class='fa fa-lock'></i></span>
                            <input type="password" placeholder='Ingresar contraseña'
                                class='form-control input-lg txt_register_password' name='txt_register_user-password'
                                aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>

                        </div>

                        <!--/*=============================================
                        =ENTRADA PARA NOMBRE PERFIL=
                        =============================================*/-->

                        <div class="input-group input-group-lg mb-3">

                            <label class="input-group-text" for="inputGroupSelect01"><i
                                    class='fas fa-user-cog'></i></label>
                            <select class='form-select' name="cmbx_register_user-perfil">
                                <option value="">-Seleccionar Perfil-</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Especial">Especial</option>
                                <option value="Vendedor">Vendedor</option>
                            </select>

                        </div>

                        <!--/*=============================================
                        =ENTRADA PARA NOMBRE IMAGEN=
                        =============================================*/-->

                        <div class="input-group input-group-lg mb-3">

                            <label class="input-group-text" for="inputGroupFile01"><i class="fas fa-image"></i></label>
                            <input class='form-control' type="file" id='INP-files-user-foto'
                                name="file_register_user-img" accept="image/png, .jpeg, .jpg">

                        </div>

                        <div class='col-lg-12 row'>

                            <p class='help-block'>Peso máximo de la foto 2 MB</p>

                            <div style='text-align:center;'>

                                <img src="views/img/img_users/default/anonymous.png" class='img-thumbnail prev_img'
                                    width='100px' alt="">

                            </div>

                        </div>

                    </div>

                </div>

                <!--/*=============================================
                =PIE DEL MODAL=
                =============================================*/-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-bs-dismiss="modal">Salir</button>
                    <button type='submit' class='btn btn-primary'><i class="fas fa-plus-square"></i> Agregar
                        usuario</button>

                </div>

            </form>

            <?php
    
              /*=============================================
              =OBJETO PARA REGISTRAR USUARIO=
              =============================================*/

              $save_user = new ControllerUser();
              $save_user -> ctr_createUser();

            ?>

        </div>

    </div>

</div>

<!--/*=============================================
  =MODAL EDITAR USUARIO=
*============================================-->

<div class="modal fade" id="modal_edit_user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content" style="border-top-left-radius: 10px;border-top-right-radius: 10px;">

            <form role='form' method='POST' enctype='multipart/form-data'>

                <!--/*=============================================
                =CABECERA DEL MODAL=
                =============================================*/-->

                <div class="modal-header" style="background-color:#e08e0b">

                    <h4 class="modal-title" id="staticBackdropLabel" style="color:#f4f4f4"><i
                            class="fas fa-user-edit"></i> Editar usuario
                    </h4>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <!--/*=============================================
                =CUERPO DEL MODAL=
                =============================================*/-->

                <div class="modal-body">

                    <!--/*=============================================
                  =ENTRADA PARA NOMBRE USUARIO=
                  =============================================*/-->

                    <div class="input-group input-group-lg mb-3">

                        <span class='input-group-text' id="inputGroup-sizing-default"><i
                                class="fa-solid fa-image-portrait"></i></span>
                        <input type="text" class='form-control input-lg' id='txt_edit_user-name'
                            placeholder='Ingresar nombre' value='' name='txt_editar_user-nombre'
                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>

                    </div>

                    <!--/*=============================================
                  =ENTRADA PARA USUARIO=
                  =============================================*/-->

                    <div class="input-group input-group-lg mb-3">

                        <span class='input-group-text' id="inputGroup-sizing-default"><i class='fa fa-user'></i></span>
                        <input type="text" class='form-control input-lg' id='txt_edit_user-usuario'
                            placeholder='Ingresar usuario' value='' name='txt_editar_user-Usuario'
                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" readonly>

                    </div>

                    <!--/*=============================================
                  =ENTRADA PARA CONTRASEÑA=
                  =============================================*/-->

                    <div class="input-group input-group-lg mb-3">

                        <span class='input-group-text' id="inputGroup-sizing-default"><i class='fa fa-lock'></i></span>

                        <input type="password" placeholder='Nueva contraseña' id='txt_edit_user-password' value=''
                            class='form-control input-lg' name='txt_editar_user-password'
                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">

                        <input type="hidden" name="txt_edit_user_passwordActual" id="txt_hidden_password_actual">

                    </div>

                    <!--/*=============================================
                  =ENTRADA PARA PERFIL=
                  =============================================*/-->

                    <div class="input-group input-group-lg mb-3">

                        <span class='input-group-text' id="inputGroup-sizing-default"><i
                                class="fas fa-user-cog"></i></span>
                        <select class='form-select' id='cmbx_editar_user-perfil' name="cmbx_editar_user-perfil">

                            <option value="">--NULL--</option>

                        </select>

                    </div>

                    <!--/*=============================================
                  =ENTRADA PARA IMAGEN=
                  =============================================*/-->

                    <div class="input-group input-group-lg mb-3">

                        <label class="input-group-text" for="inputGroupFile01"><i class="fas fa-image"></i></label>
                        <input class='form-control' type="file" id='INP-files-user-foto' name="file_editar_user-img"
                            accept="image/png, .jpeg, .jpg">

                    </div>

                    <div class='col-lg-12 row'>

                        <p class='help-block'>Peso máximo de la foto 2 MB</p>

                        <div style='text-align:center;'>

                            <img src="views/img/img_users/default/anonymous.png" class='img-thumbnail prev_img'
                                width='100px' alt="">
                            <input type="hidden" name="txt_url_foto_actual" id="inp-foto_actual">

                        </div>

                    </div>

                </div>

                <!--/*=============================================
                =PIE DEL MODAL=
                =============================================*/-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-bs-dismiss="modal">Salir</button>
                    <button type='submit' class='btn btn-warning' style="color:#f4f4f4"><i class="fas fa-check"></i>
                        Guardar Cambios</button>

                </div>

            </form>

            <?php
        
                /*=============================================
                =OBJETO PARA ENLACE A EDITAR USUARIO=
                =============================================*/
                
                $editar_user = new ControllerUser();
                $editar_user -> ctl_EditUser();

            ?>

        </div>

    </div>

</div>


<?php

    /*=============================================
    =OBJETO NECESARIO PARA ENLACE A ELIMINAR USUARIO=
    =============================================*/

    $editar_user = new ControllerUser();
    $editar_user -> clt_DeleteUser();

?>