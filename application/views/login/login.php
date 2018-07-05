<body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate fadeInLeft login_form">
          <section class="login_content">
           <?$correcto =$this->session->flashdata('alerta');?> 
     <?php if ($correcto): ?>
     <div class="animated bounceInDown">
       <div class="alert alert-danger alert-dismissible">             
       <?= $correcto?>
        <br>
      </div>
    </div> <?php endif ?>
            <form class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>login/iniciar_sesion" method="POST"  enctype="multipart/form-data">
              <h1>Iniciar Sesion</h1>
              <div>

                <input type="text" class="form-control"  name="txt_nombre_ususario" placeholder="Nombre de Usuario" required="" />
              </div>
              <div>
                <input type="password" class="form-control" name="txt_pass" placeholder="Contraseña" required="" />
              </div>
              <div>
                <button type="submit" class="btn btn-primary submit">Iniciar Sesion</button>           
              </div>

              <div class="clearfix"></div>

              <div class="separator">
              

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-money"></i></h1>
                  <p>©2016 Todos los Derechos Reservados  a valguscash.com</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>