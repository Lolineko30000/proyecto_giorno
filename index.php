<?php
//C:\xampp\mysql\bin
//mysql.exe -u root -p


include('Clases/DB.php');

if (isset($_POST['create'])) {


  #Dedinicion de las variables que se introducen en
  #el formulario por medio del parametro name
  $nombre_usuario = $_POST['username'];
  $contrasenia = $_POST['password'];
  $correo = $_POST['correo'];


  #Comprobacion que el usuario ya exista
  if (DB::query('SELECT nombre_usuario FROM usuario WHERE nombre_usuario = :nombre_usuario', array(':nombre_usuario' => $nombre_usuario))) {
    header("Location: index.php");
  }
  #Comprobacion del correo electronico
  elseif (DB::query('SELECT correo FROM usuario WHERE correo = :correo', array(':correo' => $correo))) {
    header("Location: index.php");
  }
  #Tamanio de la contrasena y el nombre de usuario
  elseif ((strlen($nombre_usuario) < 3 || strlen($nombre_usuario) > 40) && !(preg_match('/[a-zA-Z0-9_]+/', $nombre_usuario))) {
    header("Location: index.php");
  } elseif (strlen($contrasenia) < 6 || strlen($contrasenia) > 40) {
    header("Location: index.php");
  } else {

    #Encriptacion de la contasenioa pk alch estoy aburrido xd
    $contrasenia = password_hash($contrasenia, PASSWORD_BCRYPT);
    $pk_usuario = 1 + DB::query('SELECT MAX(id_usuario) AS pkt FROM usuario', array())[0]['pkt'];

    $token = bin2hex(openssl_random_pseudo_bytes(100, $aux_token));
    #setcookie("SNID",$token, time() + 2592000, '/', NULL, NULL,TRUE);

    DB::query(
      'INSERT INTO usuario  VALUES (:id_usuario, :nombre_usuario, :correo  ,:contrasenia, :token)',
      array(':id_usuario' => $pk_usuario, 'nombre_usuario' => $nombre_usuario, ':correo' => $correo, ':contrasenia' => $contrasenia, ':token' => $token)
    );


    header("Location: index.php");
  }
}


if (isset($_POST['logn'])) {

  $contrasenia = $_POST['password'];
  $correo = $_POST['correo'];

  if (DB::query('SELECT correo FROM usuario WHERE correo = :correo', array(':correo' => $correo))) {
    $aux = DB::query('SELECT contrasenia FROM usuario WHERE correo = :correo', array(':correo' => $correo))[0]['contrasenia'];
    if (password_verify($contrasenia, $aux)) {

      $token = DB::query('SELECT token FROM usuario WHERE correo = :correo', array(':correo' => $correo))[0]['token'];
      setcookie("SNID", $token, time() + 2592000, '/', NULL, NULL, TRUE);
      header("Location: index.php?TOKEN=" . $token . "");

    } else {
      echo '<script language="javascript">alert("Contraseña incorrecta");</script>';
    }

  } else {
    echo '<script language="javascript">alert("Correo no registrado");</script>';
  }
}




?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <title>Login Giorno</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel='stylesheet' href='./css/style.css'>
  <link rel='stylesheet' href='./css/navigation.css'>


  <link rel="stylesheet" href="./css/nicepage.css" media="screen">
  <link rel="stylesheet" href="./css/Page-10.css" media="screen">
  <link rel="stylesheet" href="./css/Vuelos.css" media="screen">

  <link rel="stylesheet" href="./css/Destinos.css" media="screen">

  <script class="u-script" type="text/javascript" src="jquery-1.9.1.min.js" defer=""></script>
  <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
  <meta name="generator" content="Nicepage 5.7.12, nicepage.com">
  <meta name="referrer" content="origin">
  <link id="u-theme-google-font" rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">




  <script type="application/ld+json">{
    "@context": "http://schema.org",
    "@type": "Organization",
    "name": "",
    "logo": "images/default-logo.png"
}</script>
  <meta name="theme-color" content="#478ac9">
  <meta property="og:title" content="Destinos">
  <meta property="og:type" content="website">
  <meta data-intl-tel-input-cdn-path="intlTelInput/">

</head>

<body>
  <header>
    <h2 class="logo">Giorno</h2>
    <nav class="navigation">
      <button class="btnViajes">Viajes</button>
      <button class="btnTransport">Transporte</button>
      <button class="btnHoteles">Hoteles</button>
      <button class="btnTransport">Ofertas</button>

      <?php

      if (!(isset($_GET['TOKEN']) && DB::query('SELECT * FROM usuario WHERE token = :token', array(':token' => $_GET['TOKEN'])))) {
        echo "<button class='btnLogin-popup'>Login</button>";
      }

      ?>
    </nav>
  </header>
  <!-- fin barra de navegacion -->
  <!-- Login register -->
  <div class="wrapper">
    <span class="icon-close">
      <ion-icon name="close"></ion-icon>
    </span>
    <!-- login -->
    <div class="form-box login">
      <h2>Login</h2>
      <form action="#">
        <div class="input-box">
          <span class="icon">
            <ion-icon name="mail"></ion-icon>
          </span>
          <input type="text" required>
          <label>Correo</label>
        </div>
        <div class="input-box">
          <span class="icon">
            <ion-icon name="lock-closed"></ion-icon>
          </span>
          <input type="password" required>
          <label>Contraseña </label>
        </div>
        <div class="remeber-forgot">
          <label><input type="checkbox">Recuerdame</label>
          <a href="#">Olvidaste la contraseña?</a>
        </div>
        <button type="submit" class="btn">Inicar sesión</button>
        <div class="login-register">
          <p>No tienes una cuenta? <a href="#" class="register-link">Registrate</a></p>
        </div>
      </form>
    </div>
    <!-- fin login -->
    <!-- register -->
    <div class="form-box register">
      <h2>Registro</h2>
      <form action="#">
        <div class="input-box">
          <span class="icon">
            <ion-icon name="person"></ion-icon>
          </span>
          <input type="text" required>
          <label>Usuario</label>
        </div>
        <div class="input-box">
          <span class="icon">
            <ion-icon name="mail"></ion-icon>
          </span>
          <input type="text" required>
          <label>Correo</label>
        </div>
        <div class="input-box">
          <span class="icon">
            <ion-icon name="lock-closed"></ion-icon>
          </span>
          <input type="password" required>
          <label>Contraseña </label>
        </div>
        <div class="remeber-forgot">
          <label><input type="checkbox">Estoy de acurdo
            con los terminos</label>

        </div>
        <button type="submit" class="btn">Registrar</button>
        <div class="login-register">
          <p>Ya tengo una cuenta <a href="#" class="login-link">Iniciar sesión</a></p>
        </div>
      </form>
    </div>
    <!-- fin register -->
  </div>
  <!-- fin login register -->

  <!-- Transportes -->
  <div class="transport">
    <span class="closeT">
      <ion-icon name="close"></ion-icon>
    </span>
    <section
      class="u-clearfix u-container-align-center-lg u-container-align-center-md u-container-align-center-xl u-container-align-center-xs u-section-1"
      id="sec-f731">
      <div class="u-clearfix u-sheet u-sheet-1">
        <div class="u-expanded-width u-list u-list-1">
          <div class="u-repeater u-repeater-1">
            <!-- Autobus -->
            <div class="u-list-item u-radius-20 u-repeater-item u-shape-round u-white u-list-item-1">
              <div class="u-container-layout u-similar-container u-container-layout-1">
                <img src="./images/bus.jpg" alt="" class="u-expanded-width u-image u-image-default u-image-1"
                  data-image-width="1280" data-image-height="853" data-lang-es="">
                <h4 class="u-text u-text-default u-text-palette-4-base u-text-4" data-lang-es="$ 800">$
                  800</h4>
                <h5 class="u-text u-text-default u-text-5" data-lang-es="Surf travel">Autobus<br>
                </h5>
                </h5>
                <p class="u-text u-text-default u-text-3"
                  data-lang-es="Sample text. Click to select the text box. Click again or double click to start editing the text.">
                  Uno de nuestros autobuses de lujo lo llevara hasta su hotel con toda la comodidad de
                  no tener que
                  manejar<br>
                </p>
                <!-- boton de reserva -->
                <button type="submit" class="btn">Reservar</button>
              </div>
            </div>
            <!-- fin autobus -->
            <!-- Carro -->
            <div class="u-list-item u-radius-20 u-repeater-item u-shape-round u-white u-list-item-2">
              <div class="u-container-layout u-similar-container u-container-layout-2">
                <img src="./images/car.jpg" alt="" class="u-expanded-width u-image u-image-default u-image-2"
                  data-image-width="1280" data-image-height="852" data-lang-es="">
                <h4 class="u-text u-text-default u-text-palette-4-base u-text-4" data-lang-es="$ 800">$
                  800</h4>
                <h5 class="u-text u-text-default u-text-5" data-lang-es="Surf travel">Carrito para
                  vos<br>
                </h5>
                <p class="u-text u-text-default u-text-6"
                  data-lang-es="Sample text. Click to select the text box. Click again or double click to start editing the text.">
                  Puede rentar uno de nuestros autos por si desea conocer su lugar de hospedaje y
                  mas<br><br>
                </p>
                <!-- boton de reserva -->
                <button type="submit" class="btn">Reservar</button>
              </div>
            </div>
            <!-- fin carro -->
            <!-- bici -->
            <div class="u-list-item u-radius-20 u-repeater-item u-shape-round u-white u-list-item-3">
              <div class="u-container-layout u-similar-container u-container-layout-3">
                <img src="./images/bici.png" alt="" class="u-expanded-width u-image u-image-default u-image-3"
                  data-image-width="1280" data-image-height="901" data-lang-es="">
                <h4 class="u-text u-text-default u-text-palette-4-base u-text-7" data-lang-es="$ 700">$
                  700</h4>
                <h5 class="u-text u-text-default u-text-8" data-lang-es="Ocean travel">Por si sabe
                  andar<br>
                </h5>
                <p class="u-text u-text-default u-text-9"
                  data-lang-es="Sample text. Click to select the text box. Click again or double click to start editing the text.">
                  Rente una de nuestras bicicletas para visitar su destino pero viviendo la
                  experiencia de un pueblito
                  mágico&nbsp; <br>
                </p>
                <!-- boton de reserva -->
                <button type="submit" class="btn">Reservar</button>
              </div>
            </div>
            <!-- fin bici -->
            <!-- moto -->
            <div class="u-list-item u-radius-20 u-repeater-item u-shape-round u-white u-list-item-4">
              <div class="u-container-layout u-similar-container u-container-layout-4">
                <img src="./images/moto.png" alt="" class="u-expanded-width u-image u-image-default u-image-4"
                  data-image-width="1280" data-image-height="1153" data-lang-es="">
                <h4 class="u-text u-text-default u-text-palette-4-base u-text-10" data-lang-es="$ 700">$
                  700</h4>
                <h5 class="u-text u-text-default u-text-11" data-lang-es="Summer travel">apoco si le
                  sabe <br>
                </h5>
                <p class="u-text u-text-default u-text-12"
                  data-lang-es="Sample text. Click to select the text box. Click again or double click to start editing the text.">
                  Si se siente muy aventurero puede rentar una de nuestras motocicletas para poder
                  vivir una experiencia
                  inolvidable<br>
                </p>
                <!-- boton de reserva -->
                <button type="submit" class="btn">Reservar</button>
              </div>
            </div>
            <!-- fin moto -->
            <!-- burro -->
            <div class="u-list-item u-radius-20 u-repeater-item u-shape-round u-white u-list-item-5">
              <div class="u-container-layout u-similar-container u-container-layout-5">
                <img src="images/burro.jpg" alt="" class="u-expanded-width u-image u-image-default u-image-5"
                  data-image-width="1280" data-image-height="853" data-lang-es="">
                <h4 class="u-text u-text-default u-text-palette-4-base u-text-13" data-lang-es="$ 900">
                  Free</h4>
                <h5 class="u-text u-text-default u-text-14" data-lang-es="Photo Tour">Gratis si me
                  lleva<br>
                </h5>
                <p class="u-text u-text-default u-text-15"
                  data-lang-es="Sample text. Click to select the text box. Click again or double click to start editing the text.">
                  si su destino es un lugar rural puede pedir un burro de transporte este no se le
                  cobrar si nos da un
                  paseo en el :)<br>
                </p>
                <!-- boton de reserva -->
                <button type="submit" class="btn">Reservar</button>
              </div>
            </div>
            <!-- fin burro -->
            <!-- pata -->
            <div class="u-list-item u-radius-20 u-repeater-item u-shape-round u-white u-list-item-6">
              <div class="u-container-layout u-similar-container u-container-layout-6">
                <img src="./images/walk.jpg" alt="" class="u-expanded-width u-image u-image-default u-image-6"
                  data-image-width="1280" data-image-height="854" data-lang-es="">
                <h4 class="u-text u-text-default u-text-palette-4-base u-text-16" data-lang-es="$ 700">
                  Free</h4>
                <h5 class="u-text u-text-default u-text-17" data-lang-es="Islands">Caminele no sea
                  flojo<br>
                </h5>
                <p class="u-text u-text-default u-text-18"
                  data-lang-es="Sample text. Click to select the text box. Click again or double click to start editing the text.">
                  O puede optar por caminar siendo una opción muy económica para usted y de paso hacer
                  ejercicio<br>
                </p>
                <!-- boton de reserva -->
                <button type="submit" class="btn">Reservar</button>
              </div>
            </div>
            <!-- fin pata -->
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- fin transport -->
  <!-- Viajes -->
  <div class="viajes">
    <span class="closeV">
      <ion-icon name="close"></ion-icon>
    </span>
    <!-- plantilla aqui -->
    <section>
      <!-- intro -->
      <section class="u-align-center u-clearfix u-image u-shading u-section-1" src="" data-image-width="800"
        data-image-height="511" id="sec-253e">
        <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
          <lt-highlighter class="lt-highlighter--grid-item" style="display: none; z-index: 1 !important;">
            <lt-div spellcheck="false" class="lt-highlighter__wrapper"
              style="width: 788px; height: 106px; transform: none !important; transform-origin: 393.914px 52.7969px !important; zoom: 1 !important; margin-top: 294px; margin-left: 176px;">
              <lt-div class="lt-highlighter__scroll-element"
                style="top: 0px; left: 0px; width: 788px; height: 110px;"></lt-div>
            </lt-div>
          </lt-highlighter>
          <h1 class="u-text u-text-default u-title u-text-1">Nuestros Destinos</h1>
          <lt-highlighter class="lt-highlighter--grid-item" style="display: none; z-index: 1 !important;">
            <lt-div spellcheck="false" class="lt-highlighter__wrapper"
              style="width: 826px; height: 77px; transform: none !important; transform-origin: 413px 38.3906px !important; zoom: 1 !important; margin-top: 429px; margin-left: 157px;">
              <lt-div class="lt-highlighter__scroll-element" style="top: 0px; left: 0px; width: 826px; height: 77px;">
                <canvas class="lt-highlighter__canvas" width="79" height="34"
                  style="display: none; top: 41px; left: 352px;"></canvas>
              </lt-div>
            </lt-div>
          </lt-highlighter>
          <p class="u-large-text u-text u-text-variant u-text-2">Conoce todos los destinos que tenemos
            disponibles que
            tenemos para ti en Giorno Viajes.</p>
        </div>
      </section>
      <!-- fin intro -->
      <!-- intro 2 -->
      <section class="u-clearfix u-grey-5 u-section-2" id="sec-0cb0">
        <div class="u-clearfix u-sheet u-sheet-1">
          <div class="u-clearfix u-expanded-width u-gutter-10 u-layout-wrap u-layout-wrap-1">
            <div class="u-layout" style="">
              <div class="u-layout-row" style="">
                <div class="u-container-style u-layout-cell u-left-cell u-size-30 u-size-xs-60 u-layout-cell-1" src="">
                  <div class="u-container-layout u-container-layout-1">
                    <lt-highlighter style="display: none; z-index: 1 !important;">
                      <lt-div spellcheck="false" class="lt-highlighter__wrapper"
                        style="width: 361px; height: 106px; transform: none !important; transform-origin: 180.297px 52.7969px !important; zoom: 1 !important; margin-top: 53px; margin-left: 42px;">
                        <lt-div class="lt-highlighter__scroll-element"
                          style="top: 0px; left: 0px; width: 361px; height: 108px;"></lt-div>
                      </lt-div>
                    </lt-highlighter>
                    <h2 class="u-align-center u-text u-text-default u-text-1">Playas Mexicanas</h2>
                    <lt-highlighter style="display: none; z-index: 1 !important;">
                      <lt-div spellcheck="false" class="lt-highlighter__wrapper"
                        style="width: 445px; height: 173px; transform: none !important; transform-origin: 222.5px 86.3906px !important; zoom: 1 !important; margin-top: 34px;">
                        <lt-div class="lt-highlighter__scroll-element"
                          style="top: 0px; left: 0px; width: 445px; height: 173px;">
                          <canvas class="lt-highlighter__canvas" width="15" height="25"
                            style="display: none; top: 146px; left: 358px;"></canvas>
                        </lt-div>
                      </lt-div>
                    </lt-highlighter>
                    <p class="u-align-center u-text u-text-2"> Agua cálida, arena blanca y brisa
                      suave: hay una razón
                      por la que México es un destino de playa tan popular. Desde las exclusivas
                      bahías color turquesa
                      hasta las animadas playas de fiesta, México ofrece algo para cada tipo de
                      persona, generalmente
                      ubicado en un entorno pintoresco..</p>
                  </div>
                </div>
                <div
                  class="u-align-center u-container-style u-image u-layout-cell u-right-cell u-size-30 u-size-xs-60 u-image-1"
                  src="" data-image-width="800" data-image-height="450">
                  <div class="u-container-layout u-valign-middle u-container-layout-2" src=""></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- fin intro 2 -->



        <!-- reserva hoteles -->
        <header class="u-clearfix u-header u-header" id="sec-c0ed">
          <section class="u-align-center u-clearfix u-white u-section-2" id="sec-605b">
            <div class="u-clearfix u-sheet u-sheet-1">
              <div class="u-accordion u-spacing-2 u-accordion-1">
                <!-- opc de vuelo 1 -->
                <div class="u-accordion-item u-accordion-item-1">
                  <a class="active u-accordion-link u-border-1 u-border-active-grey-25 u-border-grey-30 u-border-hover-grey-30 u-border-no-left u-border-no-right u-border-no-top u-button-style u-text-active-black u-text-grey-50 u-text-hover-black u-accordion-link-1"
                    id="link-3a05" aria-controls="3a05" aria-selected="true">
                    <lt-highlighter class="lt-highlighter--grid-item" style="display: none;">
                      <lt-div spellcheck="false" class="lt-highlighter__wrapper"
                        style="width: 120px; height: 26px; transform: none !important; transform-origin: 60.1094px 12.7969px !important; zoom: 1 !important; margin-top: 296px; margin-left: 30px;">
                        <lt-div class="lt-highlighter__scroll-element"
                          style="top: 0px; left: 0px; width: 120px; height: 26px;">
                        </lt-div>
                      </lt-div>
                    </lt-highlighter>
                    <span class="u-accordion-link-text"><span class="u-file-icon u-icon u-icon-1"><img
                          src="images/61212.png" alt=""></span>&nbsp;​&nbsp;6:30 AM *********** 7:10
                      AM&nbsp;<br>&nbsp;
                      &nbsp; &nbsp; México&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                      &nbsp; &nbsp; &nbsp; &nbsp;
                      &nbsp; &nbsp; Acapulco&nbsp;
                    </span><span class="u-accordion-link-icon u-icon u-text-grey-40 u-icon-2"><svg class="u-svg-link"
                        preserveAspectRatio="xMidYMin slice" viewBox="0 0 16 16" style="">
                        <use xlink:href="#svg-2d49"></use>
                      </svg><svg class="u-svg-content" viewBox="0 0 16 16" x="0px" y="0px" id="svg-2d49">
                        <path d="M8,10.7L1.6,5.3c-0.4-0.4-1-0.4-1.3,0c-0.4,0.4-0.4,0.9,0,1.3l7.2,6.1c0.1,0.1,0.4,0.2,0.6,0.2s0.4-0.1,0.6-0.2l7.1-6
  c0.4-0.4,0.4-0.9,0-1.3c-0.4-0.4-1-0.4-1.3,0L8,10.7z"></path>
                      </svg></span>
                  </a>
                  <div class="u-accordion-active u-accordion-pane u-align-left u-container-style u-accordion-pane-1"
                    id="3a05" aria-labelledby="link-3a05">
                    <div class="u-container-layout u-container-layout-1">
                      <!-- <div class="u-border-3 u-border-grey-dark-1 u-line u-line-vertical u-line-1">
                      </div> -->
                      <h5 class="u-text u-text-default u-text-1">Duración 40 min</h5>
                      <h6 class="u-text u-text-2">$160 + TUA<br>MXN/&nbsp; &nbsp;&nbsp;
                      </h6><span class="u-icon u-text-black u-icon-3"><svg class="u-svg-link"
                          preserveAspectRatio="xMidYMin slice" viewBox="0 0 55 55" style="">
                          <use xlink:href="#svg-d263"></use>
                        </svg><svg class="u-svg-content" viewBox="0 0 55 55" x="0px" y="0px" id="svg-d263"
                          style="enable-background:new 0 0 55 55;">
                          <path d="M55,27.5C55,12.337,42.663,0,27.5,0S0,12.337,0,27.5c0,8.009,3.444,15.228,8.926,20.258l-0.026,0.023l0.892,0.752
  c0.058,0.049,0.121,0.089,0.179,0.137c0.474,0.393,0.965,0.766,1.465,1.127c0.162,0.117,0.324,0.234,0.489,0.348
  c0.534,0.368,1.082,0.717,1.642,1.048c0.122,0.072,0.245,0.142,0.368,0.212c0.613,0.349,1.239,0.678,1.88,0.98
  c0.047,0.022,0.095,0.042,0.142,0.064c2.089,0.971,4.319,1.684,6.651,2.105c0.061,0.011,0.122,0.022,0.184,0.033
  c0.724,0.125,1.456,0.225,2.197,0.292c0.09,0.008,0.18,0.013,0.271,0.021C25.998,54.961,26.744,55,27.5,55
  c0.749,0,1.488-0.039,2.222-0.098c0.093-0.008,0.186-0.013,0.279-0.021c0.735-0.067,1.461-0.164,2.178-0.287
  c0.062-0.011,0.125-0.022,0.187-0.034c2.297-0.412,4.495-1.109,6.557-2.055c0.076-0.035,0.153-0.068,0.229-0.104
  c0.617-0.29,1.22-0.603,1.811-0.936c0.147-0.083,0.293-0.167,0.439-0.253c0.538-0.317,1.067-0.648,1.581-1
  c0.185-0.126,0.366-0.259,0.549-0.391c0.439-0.316,0.87-0.642,1.289-0.983c0.093-0.075,0.193-0.14,0.284-0.217l0.915-0.764
  l-0.027-0.023C51.523,42.802,55,35.55,55,27.5z M2,27.5C2,13.439,13.439,2,27.5,2S53,13.439,53,27.5
  c0,7.577-3.325,14.389-8.589,19.063c-0.294-0.203-0.59-0.385-0.893-0.537l-8.467-4.233c-0.76-0.38-1.232-1.144-1.232-1.993v-2.957
  c0.196-0.242,0.403-0.516,0.617-0.817c1.096-1.548,1.975-3.27,2.616-5.123c1.267-0.602,2.085-1.864,2.085-3.289v-3.545
  c0-0.867-0.318-1.708-0.887-2.369v-4.667c0.052-0.52,0.236-3.448-1.883-5.864C34.524,9.065,31.541,8,27.5,8
  s-7.024,1.065-8.867,3.168c-2.119,2.416-1.935,5.346-1.883,5.864v4.667c-0.568,0.661-0.887,1.502-0.887,2.369v3.545
  c0,1.101,0.494,2.128,1.34,2.821c0.81,3.173,2.477,5.575,3.093,6.389v2.894c0,0.816-0.445,1.566-1.162,1.958l-7.907,4.313
  c-0.252,0.137-0.502,0.297-0.752,0.476C5.276,41.792,2,35.022,2,27.5z"></path>
                        </svg></span>
                      <p class="u-text u-text-3">6:30 AM<span style="font-weight: 700;"></span>
                      </p>
                      <p class="u-text u-text-palette-1-base u-text-4">Ciudad de México</p>
                      <p class="u-text u-text-palette-5-base u-text-5">Termilal 1</p>
                      <div class="u-palette-1-base u-preserve-proportions u-shape u-shape-circle u-shape-1">
                      </div>
                      <h4 class="u-text u-text-default u-text-6">Vuelo 1 </h4>
                      <h4 class="u-text u-text-default u-text-7">VV-1234 </h4><span
                        class="u-file-icon u-icon u-icon-4"><img src="images/4379086.png" alt=""></span>
                      <h4 class="u-text u-text-default u-text-8">Tarifa z</h4>
                      <p class="u-text u-text-9">7:10 Am</p>
                      <div class="u-palette-1-base u-preserve-proportions u-shape u-shape-circle u-shape-2">
                      </div>
                      <p class="u-text u-text-palette-1-base u-text-10">Acapulco</p>
                      <p class="u-text u-text-palette-5-base u-text-11">Terminal 1</p>
                      <!-- boton reservar vuelo -->
                      <button type="submit" class="btn">Reservar</button>
                    </div>
                  </div>
                </div>
                <!-- fin opc vuelo 1 -->
                <!-- opc vuelo 2 -->
                <div class="u-accordion-item u-accordion-item-2">
                  <a class="u-accordion-link u-border-1 u-border-active-grey-25 u-border-grey-30 u-border-hover-grey-30 u-border-no-left u-border-no-right u-border-no-top u-button-style u-text-active-black u-text-grey-50 u-text-hover-black u-accordion-link-2"
                    id="link-3a05" aria-controls="3a05" aria-selected="false">
                    <lt-highlighter class="lt-highlighter--grid-item" style="display: none;">
                      <lt-div spellcheck="false" class="lt-highlighter__wrapper"
                        style="width: 120px; height: 26px; transform: none !important; transform-origin: 60.1094px 12.7969px !important; zoom: 1 !important; margin-top: 296px; margin-left: 30px;">
                        <lt-div class="lt-highlighter__scroll-element"
                          style="top: 0px; left: 0px; width: 120px; height: 26px;">
                        </lt-div>
                      </lt-div>
                    </lt-highlighter>
                    <span class="u-accordion-link-text"><span class="u-file-icon u-icon u-icon-5"><img
                          src="images/61212.png" alt=""></span>&nbsp;​ 7:50 AM *********** 8:30
                      AM&nbsp;<br>&nbsp;
                      &nbsp;
                      &nbsp; México&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                      &nbsp; &nbsp; &nbsp; &nbsp;
                      &nbsp; Acapulco&nbsp;
                    </span><span class="u-accordion-link-icon u-icon u-text-grey-40 u-icon-6"><svg class="u-svg-link"
                        preserveAspectRatio="xMidYMin slice" viewBox="0 0 16 16" style="">
                        <use xlink:href="#svg-9a3c"></use>
                      </svg><svg class="u-svg-content" viewBox="0 0 16 16" x="0px" y="0px" id="svg-9a3c">
                        <path d="M8,10.7L1.6,5.3c-0.4-0.4-1-0.4-1.3,0c-0.4,0.4-0.4,0.9,0,1.3l7.2,6.1c0.1,0.1,0.4,0.2,0.6,0.2s0.4-0.1,0.6-0.2l7.1-6
  c0.4-0.4,0.4-0.9,0-1.3c-0.4-0.4-1-0.4-1.3,0L8,10.7z"></path>
                      </svg></span>
                  </a>
                  <div class="u-accordion-pane u-align-left u-container-style u-accordion-pane-2" id="3a05"
                    aria-labelledby="link-3a05">
                    <div class="u-container-layout u-container-layout-2">
                      <!-- <div class="u-border-3 u-border-grey-dark-1 u-line u-line-vertical u-line-2">
                      </div> -->
                      <h5 class="u-text u-text-default u-text-12">Duración 40 min</h5>
                      <h6 class="u-text u-text-13">$160 + TUA<br>MXN/&nbsp; &nbsp;&nbsp;
                      </h6><span class="u-icon u-text-black u-icon-7"><svg class="u-svg-link"
                          preserveAspectRatio="xMidYMin slice" viewBox="0 0 55 55" style="">
                          <use xlink:href="#svg-f443"></use>
                        </svg><svg class="u-svg-content" viewBox="0 0 55 55" x="0px" y="0px" id="svg-f443"
                          style="enable-background:new 0 0 55 55;">
                          <path d="M55,27.5C55,12.337,42.663,0,27.5,0S0,12.337,0,27.5c0,8.009,3.444,15.228,8.926,20.258l-0.026,0.023l0.892,0.752
  c0.058,0.049,0.121,0.089,0.179,0.137c0.474,0.393,0.965,0.766,1.465,1.127c0.162,0.117,0.324,0.234,0.489,0.348
  c0.534,0.368,1.082,0.717,1.642,1.048c0.122,0.072,0.245,0.142,0.368,0.212c0.613,0.349,1.239,0.678,1.88,0.98
  c0.047,0.022,0.095,0.042,0.142,0.064c2.089,0.971,4.319,1.684,6.651,2.105c0.061,0.011,0.122,0.022,0.184,0.033
  c0.724,0.125,1.456,0.225,2.197,0.292c0.09,0.008,0.18,0.013,0.271,0.021C25.998,54.961,26.744,55,27.5,55
  c0.749,0,1.488-0.039,2.222-0.098c0.093-0.008,0.186-0.013,0.279-0.021c0.735-0.067,1.461-0.164,2.178-0.287
  c0.062-0.011,0.125-0.022,0.187-0.034c2.297-0.412,4.495-1.109,6.557-2.055c0.076-0.035,0.153-0.068,0.229-0.104
  c0.617-0.29,1.22-0.603,1.811-0.936c0.147-0.083,0.293-0.167,0.439-0.253c0.538-0.317,1.067-0.648,1.581-1
  c0.185-0.126,0.366-0.259,0.549-0.391c0.439-0.316,0.87-0.642,1.289-0.983c0.093-0.075,0.193-0.14,0.284-0.217l0.915-0.764
  l-0.027-0.023C51.523,42.802,55,35.55,55,27.5z M2,27.5C2,13.439,13.439,2,27.5,2S53,13.439,53,27.5
  c0,7.577-3.325,14.389-8.589,19.063c-0.294-0.203-0.59-0.385-0.893-0.537l-8.467-4.233c-0.76-0.38-1.232-1.144-1.232-1.993v-2.957
  c0.196-0.242,0.403-0.516,0.617-0.817c1.096-1.548,1.975-3.27,2.616-5.123c1.267-0.602,2.085-1.864,2.085-3.289v-3.545
  c0-0.867-0.318-1.708-0.887-2.369v-4.667c0.052-0.52,0.236-3.448-1.883-5.864C34.524,9.065,31.541,8,27.5,8
  s-7.024,1.065-8.867,3.168c-2.119,2.416-1.935,5.346-1.883,5.864v4.667c-0.568,0.661-0.887,1.502-0.887,2.369v3.545
  c0,1.101,0.494,2.128,1.34,2.821c0.81,3.173,2.477,5.575,3.093,6.389v2.894c0,0.816-0.445,1.566-1.162,1.958l-7.907,4.313
  c-0.252,0.137-0.502,0.297-0.752,0.476C5.276,41.792,2,35.022,2,27.5z"></path>
                        </svg></span>
                      <lt-highlighter style="display: none; z-index: 1 !important;">
                        <lt-div spellcheck="false" class="lt-highlighter__wrapper"
                          style="width: 118px; height: 32px; transform: none !important; transform-origin: 58.8984px 16px !important; zoom: 1 !important; margin-top: 16px; margin-left: 637px;">
                          <lt-div class="lt-highlighter__scroll-element"
                            style="top: 0px; left: 0px; width: 118px; height: 32px;">
                          </lt-div>
                        </lt-div>
                      </lt-highlighter>
                      <p class="u-text u-text-14">7:50 AM<span style="font-weight: 700;"></span>
                      </p>
                      <p class="u-text u-text-palette-1-base u-text-15">Ciudad de México</p>
                      <p class="u-text u-text-palette-5-base u-text-16">Termilal 1</p>
                      <div class="u-palette-1-base u-preserve-proportions u-shape u-shape-circle u-shape-3">
                      </div>
                      <h4 class="u-text u-text-default u-text-17">Vuelo 1 </h4>
                      <lt-highlighter style="display: none; z-index: 1 !important;">
                        <lt-div spellcheck="false" class="lt-highlighter__wrapper"
                          style="width: 91px; height: 29px; transform: none !important; transform-origin: 45.3203px 14.3984px !important; zoom: 1 !important; margin-top: 8px; margin-left: 109px;">
                          <lt-div class="lt-highlighter__scroll-element"
                            style="top: 0px; left: 0px; width: 91px; height: 29px;">
                          </lt-div>
                        </lt-div>
                      </lt-highlighter>
                      <h4 class="u-text u-text-default u-text-18">VV-5678 </h4><span
                        class="u-file-icon u-icon u-icon-8"><img src="images/4379086.png" alt=""></span>
                      <h4 class="u-text u-text-default u-text-19">Tarifa z</h4>
                      <p class="u-text u-text-20">8:30 AM</p>
                      <div class="u-palette-1-base u-preserve-proportions u-shape u-shape-circle u-shape-4">
                      </div>
                      <p class="u-text u-text-palette-1-base u-text-21">Acapulco</p>
                      <p class="u-text u-text-palette-5-base u-text-22">Terminal 1</p>
                      <!-- boton reservar vuelo -->
                      <button type="submit" class="btn">Reservar</button>
                    </div>
                  </div>
                </div>
                <!-- fin opc vuelo 2 -->
                <!-- vuelo 3 -->
                <div class="u-accordion-item u-accordion-item-3">
                  <a class="u-accordion-link u-border-1 u-border-active-grey-25 u-border-grey-30 u-border-hover-grey-30 u-border-no-left u-border-no-right u-border-no-top u-button-style u-text-active-black u-text-grey-50 u-text-hover-black u-accordion-link-3"
                    id="link-3a05" aria-controls="3a05" aria-selected="false">
                    <lt-highlighter class="lt-highlighter--grid-item" style="display: none;">
                      <lt-div spellcheck="false" class="lt-highlighter__wrapper"
                        style="width: 120px; height: 26px; transform: none !important; transform-origin: 60.1094px 12.7969px !important; zoom: 1 !important; margin-top: 296px; margin-left: 30px;">
                        <lt-div class="lt-highlighter__scroll-element"
                          style="top: 0px; left: 0px; width: 120px; height: 26px;">
                        </lt-div>
                      </lt-div>
                    </lt-highlighter>
                    <span class="u-accordion-link-text"><span class="u-file-icon u-icon u-icon-9"><img
                          src="images/61212.png" alt=""></span>&nbsp;​ 9:30 AM ***********
                      10:30AM&nbsp;<br>&nbsp;
                      &nbsp;
                      &nbsp; México&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                      &nbsp; &nbsp; &nbsp; &nbsp;
                      &nbsp; Acapulco&nbsp;
                    </span><span class="u-accordion-link-icon u-icon u-text-grey-40 u-icon-10"><svg class="u-svg-link"
                        preserveAspectRatio="xMidYMin slice" viewBox="0 0 16 16" style="">
                        <use xlink:href="#svg-093f"></use>
                      </svg><svg class="u-svg-content" viewBox="0 0 16 16" x="0px" y="0px" id="svg-093f">
                        <path d="M8,10.7L1.6,5.3c-0.4-0.4-1-0.4-1.3,0c-0.4,0.4-0.4,0.9,0,1.3l7.2,6.1c0.1,0.1,0.4,0.2,0.6,0.2s0.4-0.1,0.6-0.2l7.1-6
  c0.4-0.4,0.4-0.9,0-1.3c-0.4-0.4-1-0.4-1.3,0L8,10.7z"></path>
                      </svg></span>
                  </a>
                  <div class="u-accordion-pane u-align-left u-container-style u-accordion-pane-3" id="3a05"
                    aria-labelledby="link-3a05">
                    <div class="u-container-layout u-container-layout-3">
                      <!-- <div class="u-border-3 u-border-grey-dark-1 u-line u-line-vertical u-line-3">
                      </div> -->
                      <h5 class="u-text u-text-default u-text-23">Duración 40 min</h5>
                      <h6 class="u-text u-text-24">$160 + TUA<br>MXN/&nbsp; &nbsp;&nbsp;
                      </h6><span class="u-icon u-text-black u-icon-11"><svg class="u-svg-link"
                          preserveAspectRatio="xMidYMin slice" viewBox="0 0 55 55" style="">
                          <use xlink:href="#svg-6670"></use>
                        </svg><svg class="u-svg-content" viewBox="0 0 55 55" x="0px" y="0px" id="svg-6670"
                          style="enable-background:new 0 0 55 55;">
                          <path d="M55,27.5C55,12.337,42.663,0,27.5,0S0,12.337,0,27.5c0,8.009,3.444,15.228,8.926,20.258l-0.026,0.023l0.892,0.752
  c0.058,0.049,0.121,0.089,0.179,0.137c0.474,0.393,0.965,0.766,1.465,1.127c0.162,0.117,0.324,0.234,0.489,0.348
  c0.534,0.368,1.082,0.717,1.642,1.048c0.122,0.072,0.245,0.142,0.368,0.212c0.613,0.349,1.239,0.678,1.88,0.98
  c0.047,0.022,0.095,0.042,0.142,0.064c2.089,0.971,4.319,1.684,6.651,2.105c0.061,0.011,0.122,0.022,0.184,0.033
  c0.724,0.125,1.456,0.225,2.197,0.292c0.09,0.008,0.18,0.013,0.271,0.021C25.998,54.961,26.744,55,27.5,55
  c0.749,0,1.488-0.039,2.222-0.098c0.093-0.008,0.186-0.013,0.279-0.021c0.735-0.067,1.461-0.164,2.178-0.287
  c0.062-0.011,0.125-0.022,0.187-0.034c2.297-0.412,4.495-1.109,6.557-2.055c0.076-0.035,0.153-0.068,0.229-0.104
  c0.617-0.29,1.22-0.603,1.811-0.936c0.147-0.083,0.293-0.167,0.439-0.253c0.538-0.317,1.067-0.648,1.581-1
  c0.185-0.126,0.366-0.259,0.549-0.391c0.439-0.316,0.87-0.642,1.289-0.983c0.093-0.075,0.193-0.14,0.284-0.217l0.915-0.764
  l-0.027-0.023C51.523,42.802,55,35.55,55,27.5z M2,27.5C2,13.439,13.439,2,27.5,2S53,13.439,53,27.5
  c0,7.577-3.325,14.389-8.589,19.063c-0.294-0.203-0.59-0.385-0.893-0.537l-8.467-4.233c-0.76-0.38-1.232-1.144-1.232-1.993v-2.957
  c0.196-0.242,0.403-0.516,0.617-0.817c1.096-1.548,1.975-3.27,2.616-5.123c1.267-0.602,2.085-1.864,2.085-3.289v-3.545
  c0-0.867-0.318-1.708-0.887-2.369v-4.667c0.052-0.52,0.236-3.448-1.883-5.864C34.524,9.065,31.541,8,27.5,8
  s-7.024,1.065-8.867,3.168c-2.119,2.416-1.935,5.346-1.883,5.864v4.667c-0.568,0.661-0.887,1.502-0.887,2.369v3.545
  c0,1.101,0.494,2.128,1.34,2.821c0.81,3.173,2.477,5.575,3.093,6.389v2.894c0,0.816-0.445,1.566-1.162,1.958l-7.907,4.313
  c-0.252,0.137-0.502,0.297-0.752,0.476C5.276,41.792,2,35.022,2,27.5z"></path>
                        </svg></span>
                      <lt-highlighter style="display: none; z-index: 1 !important;">
                        <lt-div spellcheck="false" class="lt-highlighter__wrapper"
                          style="width: 118px; height: 32px; transform: none !important; transform-origin: 58.8984px 16px !important; zoom: 1 !important; margin-top: 16px; margin-left: 637px;">
                          <lt-div class="lt-highlighter__scroll-element"
                            style="top: 0px; left: 0px; width: 118px; height: 32px;">
                          </lt-div>
                        </lt-div>
                      </lt-highlighter>
                      <p class="u-text u-text-25">8:30 AM<span style="font-weight: 700;"></span>
                      </p>
                      <p class="u-text u-text-palette-1-base u-text-26">Ciudad de México</p>
                      <p class="u-text u-text-palette-5-base u-text-27">Termilal 1</p>
                      <div class="u-palette-1-base u-preserve-proportions u-shape u-shape-circle u-shape-5">
                      </div>
                      <h4 class="u-text u-text-default u-text-28">Vuelo 1 </h4>
                      <lt-highlighter style="display: none; z-index: 1 !important;">
                        <lt-div spellcheck="false" class="lt-highlighter__wrapper"
                          style="width: 91px; height: 29px; transform: none !important; transform-origin: 45.3203px 14.3984px !important; zoom: 1 !important; margin-top: 8px; margin-left: 109px;">
                          <lt-div class="lt-highlighter__scroll-element"
                            style="top: 0px; left: 0px; width: 91px; height: 29px;">
                          </lt-div>
                        </lt-div>
                      </lt-highlighter>
                      <h4 class="u-text u-text-default u-text-29">VV-1489 </h4><span
                        class="u-file-icon u-icon u-icon-12"><img src="images/4379086.png" alt=""></span>
                      <h4 class="u-text u-text-default u-text-30">Tarifa z</h4>
                      <lt-highlighter style="display: none; z-index: 1 !important;">
                        <lt-div spellcheck="false" class="lt-highlighter__wrapper"
                          style="width: 118px; height: 32px; transform: none !important; transform-origin: 58.8984px 16px !important; zoom: 1 !important; margin-top: 10px; margin-left: 637px;">
                          <lt-div class="lt-highlighter__scroll-element"
                            style="top: 0px; left: 0px; width: 118px; height: 32px;">
                          </lt-div>
                        </lt-div>
                      </lt-highlighter>
                      <p class="u-text u-text-31">10:30 AM</p>
                      <div class="u-palette-1-base u-preserve-proportions u-shape u-shape-circle u-shape-6">
                      </div>
                      <p class="u-text u-text-palette-1-base u-text-32">Acapulco</p>
                      <p class="u-text u-text-palette-5-base u-text-33">Terminal 1</p>
                      <!-- boton reservar vuelo -->
                      <button type="submit" class="btn">Reservar</button>
                    </div>
                  </div>
                </div>
                <!-- fin opc vuelo 3 -->
              </div>
            </div>
          </section>

  </div>

  <!-- fin Viajes -->
  <!-- hoteles -->
  <div class="hotel">
    <span class="closeH">
      <ion-icon name="close"></ion-icon>
    </span>
    <!-- plantilla aqui -->
  </div>
  <script src='./js/scripts.js'></script>
  <script src='./js/navigation.js'></script>
  <script src='./js/jquery-1.9.1.min.js'></script>
  <script src='./js/nicepage.js'></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <!--para buscar los iconos usados en la pagina o nuevos ir al url:https://ionic.io/ionicons -->
</body>

</html>