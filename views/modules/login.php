<style>
body {
    background: linear-gradient(rgba(0, 0, 0, 1), rgba(0, 30, 50, 1));
}

@import url('https://fonts.googleapis.com/css2?family=Fredoka&display=swap');
</style>

<div class='login_img_background'></div>

<section class="vh-100">

    <div class=" container py-5 h-100">

        <div class="row d-flex justify-content-center align-items-center h-100">

            <div class="col-lg-5">

                <div class="card bg-light" style="border-radius: 1rem;">

                    <div class="row g-0">
                        <!-- 
                        <div class="col-md-6 col-lg-5 d-none d-md-block text-center">

                            <img src="views/dist/img/obrero_login_stock.png" width='200px' alt="login form"
                                class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />

                        </div> -->

                        <div class="col-md-12 col-lg-12 d-flex align-items-center">

                            <div class="card-body p-4 p-lg-5 text-black">

                                <form method="post">

                                    <div class="d-flex align-items-center mb-3 pb-1">

                                        <img src="views/dist/img/logo_empresa.png" width='100px' alt="login form"
                                            class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                                        <span class="h1 fw-bold mb-0">Sistema P.O.S</span>

                                    </div>

                                    <h5 class="fw-normal mb-3 pb-3 text-center" style="letter-spacing: 1px;">Iniciar
                                        sesión con su
                                        cuenta
                                    </h5>

                                    <div class="form-outline mb-4 input-group">

                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="fas fa-user-circle"></i></span>
                                        <input type="text" class="form-control form-control-lg" placeholder="Usuario"
                                            name='txt_user_login' required>

                                    </div>

                                    <div class="form-outline mb-4 input-group">

                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="fas fa-lock"></i></span>
                                        <input type="password" class="form-control form-control-lg"
                                            placeholder="Contraseña" name='txt_password_login' required>

                                    </div>

                                    <div class="pt-1 mb-4">

                                        <button type="submit" class="btn btn-dark btn-lg btn-block">Ingresar</button>

                                    </div>

                                </form>

                                <?php
                                  $login = new ControllerUser();
                                  $login -> ctr_IngresarUsuario();
                                ?>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>