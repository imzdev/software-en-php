<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="css/login.css" />
    <title>Iniciar Sesion</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
            <!--En action agregamos el rediccionamiento "login.php"-->
          <form action="login.php" method="post" class="sign-in-form">
            <h2 class="title">Iniciar Sesion</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <!--En name agregamos el parametro "bindParam($nick)"-->
              <input type="text" name="usuario" required="true" placeholder="Usuario" pattern="[a-zA-Z0-9]{3,35}" maxlength="35"/>
            </div>
            <div class="input-field"> 
              <i class="fas fa-lock"></i>
              <!--En password agregamos el parametro "bindParam($password)"-->
              <input type="password" name="contraseña" required="true" placeholder="Contraseña" pattern="[a-zA-Z0-9$@.-]{7,30}" maxlength="30"/>
            </div>
            <input type="submit" value="Ingresar" class="btn solid" />
            <?php
            if(isset($_GET['error_msg'])) 
            {
            $error_msg = htmlspecialchars($_GET['error_msg']);
            echo "<div class='error-message'>$error_msg</div>";
            }
            ?>
            <p class="social-text">Buscanos en nuestras redes sociales</p>
            <div class="social-media">
              <a href="https://www.facebook.com/profile.php?id=100065282782308" target="_blank" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="https://www.instagram.com/panaderiacope_/" target="_blank" class="social-icon">
                <i class="fab fa-instagram"></i>
              </a>
            </div>
        </div>
      </div>

    <script src="app.js"></script>
  </body>
</html>