<?php
//C:\xampp\mysql\bin
include('Clases/DB.php');

if (isset($_POST['create'])) {

    #Dedinicion de las variables que se introducen en
    #el formulario por medio del parametro name
    $nombre = $_POST['name'];
    $apellido = $_POST['surname'];
    $nombre_usuario = $_POST['username'];
    $contrasenia = $_POST['password'];
    $correo = $_POST['correo'];


    #Comprobacion que el usuario ya exista
    if (DB::query('SELECT nombre_usuario FROM usuario WHERE nombre_usuario = :nombre_usuario', array(':nombre_usuario' => $nombre_usuario))) {
        header("Location: index.html");
    }
    #Comprobacion del correo electronico
    elseif (DB::query('SELECT correo FROM usuario WHERE correo = :correo', array(':correo' => $correo))) {
        header("Location: index.html");
    }
    #Tamanio de la contrasena y el nombre de usuario
    elseif ((strlen($nombre_usuario) < 3 || strlen($nombre_usuario) > 40) && !(preg_match('/[a-zA-Z0-9_]+/', $nombre_usuario))) {
        header("Location: index.html");
    } elseif (strlen($contrasenia) < 6 || strlen($contrasenia) > 40) {
        header("Location: index.html");
    } else {

        #Encriptacion de la contasenioa pk alch estoy aburrido xd
        $contrasenia = password_hash($contrasenia, PASSWORD_BCRYPT);
        $pk_usuario = 1 + DB::query('SELECT MAX(id_usuario) AS pkt FROM usuario', array())[0]['pkt'];


        DB::query(
            'INSERT INTO usuario  VALUES (:id_usuario, :nombre , :apellido , :correo , :nombre_usuario ,:contrasenia)',
            array(':id_usuario' => $pk_usuario, ':nombre' => $nombre, ':apellido' => $apellido, ':correo' => $correo, 'nombre_usuario' => $nombre_usuario, ':contrasenia' => $contrasenia)
        );

        header("Location: index.html");
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

    <link rel="stylesheet" href="./css/Destinos.css" media="screen">

    <script class="u-script" type="text/javascript" src="jquery-1.9.1.min.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 5.7.12, nicepage.com">
    <meta name="referrer" content="origin">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    
    
    
    
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
            <button class="btnLogin-popup">Login</button>

        </nav>
    </header>
<!-- Login register -->
    <div class="wrapper">
        <span class="icon-close">
            <ion-icon name="close"></ion-icon>
        </span>

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
    </div>
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
                        <div class="u-list-item u-radius-20 u-repeater-item u-shape-round u-white u-list-item-1">
                            <div class="u-container-layout u-similar-container u-container-layout-1">
                                <img src="./images/bus.jpg" alt=""
                                    class="u-expanded-width u-image u-image-default u-image-1" data-image-width="1280"
                                    data-image-height="853" data-lang-es="">
                                <h4 class="u-text u-text-default u-text-palette-4-base u-text-1" data-lang-es="$ 600">$
                                    600</h4>
                                <h5 class="u-text u-text-default u-text-2" data-lang-es="Mountains travel&amp;nbsp;">
                                    Autobus para todos
                                    <br>
                                </h5>
                                <p class="u-text u-text-default u-text-3"
                                    data-lang-es="Sample text. Click to select the text box. Click again or double click to start editing the text.">
                                    Uno de nuestros autobuses de lujo lo llevara hasta su hotel con toda la comodidad de
                                    no tener que
                                    manejar<br>
                                </p>
                                <button type="submit" class="btn">Reservar</button>
                            </div>
                        </div>
                        <div class="u-list-item u-radius-20 u-repeater-item u-shape-round u-white u-list-item-2">
                            <div class="u-container-layout u-similar-container u-container-layout-2">
                                <img src="./images/car.jpg" alt=""
                                    class="u-expanded-width u-image u-image-default u-image-2" data-image-width="1280"
                                    data-image-height="852" data-lang-es="">
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
                                <button type="submit" class="btn">Reservar</button>
                            </div>
                        </div>
                        <div class="u-list-item u-radius-20 u-repeater-item u-shape-round u-white u-list-item-3">
                            <div class="u-container-layout u-similar-container u-container-layout-3">
                                <img src="./images/bici.png" alt=""
                                    class="u-expanded-width u-image u-image-default u-image-3" data-image-width="1280"
                                    data-image-height="901" data-lang-es="">
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
                                <button type="submit" class="btn">Reservar</button>
                            </div>
                        </div>
                        <div class="u-list-item u-radius-20 u-repeater-item u-shape-round u-white u-list-item-4">
                            <div class="u-container-layout u-similar-container u-container-layout-4">
                                <img src="./images/moto.png" alt=""
                                    class="u-expanded-width u-image u-image-default u-image-4" data-image-width="1280"
                                    data-image-height="1153" data-lang-es="">
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
                                <button type="submit" class="btn">Reservar</button>
                            </div>
                        </div>
                        <div class="u-list-item u-radius-20 u-repeater-item u-shape-round u-white u-list-item-5">
                            <div class="u-container-layout u-similar-container u-container-layout-5">
                                <img src="images/burro.jpg" alt=""
                                    class="u-expanded-width u-image u-image-default u-image-5" data-image-width="1280"
                                    data-image-height="853" data-lang-es="">
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
                                <button type="submit" class="btn">Reservar</button>
                            </div>
                        </div>
                        <div class="u-list-item u-radius-20 u-repeater-item u-shape-round u-white u-list-item-6">
                            <div class="u-container-layout u-similar-container u-container-layout-6">
                                <img src="./images/walk.jpg" alt=""
                                    class="u-expanded-width u-image u-image-default u-image-6" data-image-width="1280"
                                    data-image-height="854" data-lang-es="">
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
                                <button type="submit" class="btn">Reservar</button>
                            </div>
                        </div>
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
    <section class="u-align-center u-clearfix u-image u-shading u-section-1" src="" data-image-width="800" data-image-height="511" id="sec-253e">
      <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <lt-highlighter class="lt-highlighter--grid-item" style="display: none; z-index: 1 !important;">
          <lt-div spellcheck="false" class="lt-highlighter__wrapper" style="width: 788px; height: 106px; transform: none !important; transform-origin: 393.914px 52.7969px !important; zoom: 1 !important; margin-top: 294px; margin-left: 176px;">
            <lt-div class="lt-highlighter__scroll-element" style="top: 0px; left: 0px; width: 788px; height: 110px;"></lt-div>
          </lt-div>
        </lt-highlighter>
        <h1 class="u-text u-text-default u-title u-text-1">Nuestros Destinos</h1>
        <lt-highlighter class="lt-highlighter--grid-item" style="display: none; z-index: 1 !important;">
          <lt-div spellcheck="false" class="lt-highlighter__wrapper" style="width: 826px; height: 77px; transform: none !important; transform-origin: 413px 38.3906px !important; zoom: 1 !important; margin-top: 429px; margin-left: 157px;">
            <lt-div class="lt-highlighter__scroll-element" style="top: 0px; left: 0px; width: 826px; height: 77px;">
              <canvas class="lt-highlighter__canvas" width="79" height="34" style="display: none; top: 41px; left: 352px;"></canvas>
            </lt-div>
          </lt-div>
        </lt-highlighter>
        <p class="u-large-text u-text u-text-variant u-text-2">Conoce todos los destinos que tenemos disponibles que tenemos para ti en Giorno Viajes.</p>
      </div>
    </section>
    <section class="u-clearfix u-grey-5 u-section-2" id="sec-0cb0">
      <div class="u-clearfix u-sheet u-sheet-1">
        <div class="u-clearfix u-expanded-width u-gutter-10 u-layout-wrap u-layout-wrap-1">
          <div class="u-layout" style="">
            <div class="u-layout-row" style="">
              <div class="u-container-style u-layout-cell u-left-cell u-size-30 u-size-xs-60 u-layout-cell-1" src="">
                <div class="u-container-layout u-container-layout-1">
                  <lt-highlighter style="display: none; z-index: 1 !important;">
                    <lt-div spellcheck="false" class="lt-highlighter__wrapper" style="width: 361px; height: 106px; transform: none !important; transform-origin: 180.297px 52.7969px !important; zoom: 1 !important; margin-top: 53px; margin-left: 42px;">
                      <lt-div class="lt-highlighter__scroll-element" style="top: 0px; left: 0px; width: 361px; height: 108px;"></lt-div>
                    </lt-div>
                  </lt-highlighter>
                  <h2 class="u-align-center u-text u-text-default u-text-1">Playas Mexicanas</h2>
                  <lt-highlighter style="display: none; z-index: 1 !important;">
                    <lt-div spellcheck="false" class="lt-highlighter__wrapper" style="width: 445px; height: 173px; transform: none !important; transform-origin: 222.5px 86.3906px !important; zoom: 1 !important; margin-top: 34px;">
                      <lt-div class="lt-highlighter__scroll-element" style="top: 0px; left: 0px; width: 445px; height: 173px;">
                        <canvas class="lt-highlighter__canvas" width="15" height="25" style="display: none; top: 146px; left: 358px;"></canvas>
                      </lt-div>
                    </lt-div>
                  </lt-highlighter>
                  <p class="u-align-center u-text u-text-2"> Agua cálida, arena blanca y brisa suave: hay una razón por la que México es un destino de playa tan popular. Desde las exclusivas bahías color turquesa hasta las animadas playas de fiesta, México ofrece algo para cada tipo de persona, generalmente ubicado en un entorno pintoresco..</p>
                </div>
              </div>
              <div class="u-align-center u-container-style u-image u-layout-cell u-right-cell u-size-30 u-size-xs-60 u-image-1" src="" data-image-width="800" data-image-height="450">
                <div class="u-container-layout u-valign-middle u-container-layout-2" src=""></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="u-clearfix u-section-3" id="sec-43fe">
      <div class="u-clearfix u-sheet u-sheet-1">
        <div class="u-accordion u-spacing-2 u-accordion-1">
          <div class="u-accordion-item u-accordion-item-1">
            <a class="active u-accordion-link u-border-1 u-border-active-grey-25 u-border-grey-30 u-border-hover-grey-30 u-border-no-left u-border-no-right u-border-no-top u-button-style u-text-active-black u-text-grey-50 u-text-hover-black u-accordion-link-1" id="link-311f" aria-controls="311f" aria-selected="true">
              <lt-highlighter class="lt-highlighter--grid-item" style="display: none;">
                <lt-div spellcheck="false" class="lt-highlighter__wrapper" style="width: 120px; height: 26px; transform: none !important; transform-origin: 60.1094px 12.7969px !important; zoom: 1 !important; margin-top: 465px; margin-left: 30px;">
                  <lt-div class="lt-highlighter__scroll-element" style="top: 0px; left: 0px; width: 120px; height: 26px;"></lt-div>
                </lt-div>
              </lt-highlighter>
              <span class="u-accordion-link-text">Puerto Vallarta</span><span class="u-accordion-link-icon u-icon u-text-grey-40 u-icon-1"><svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 16 16" style=""><use xlink:href="#svg-568d"></use></svg><svg class="u-svg-content" viewBox="0 0 16 16" x="0px" y="0px" id="svg-568d"><path d="M8,10.7L1.6,5.3c-0.4-0.4-1-0.4-1.3,0c-0.4,0.4-0.4,0.9,0,1.3l7.2,6.1c0.1,0.1,0.4,0.2,0.6,0.2s0.4-0.1,0.6-0.2l7.1-6
	c0.4-0.4,0.4-0.9,0-1.3c-0.4-0.4-1-0.4-1.3,0L8,10.7z"></path></svg></span>
            </a>
            <div class="u-accordion-active u-accordion-pane u-align-left u-container-style u-accordion-pane-1" id="311f" aria-labelledby="link-311f">
              <div class="u-container-layout u-container-layout-1">
                <p class="u-text u-text-1">Si algo define a&nbsp;Puerto Vallarta&nbsp;es el encanto natural de sus playas abrazadas por la Sierra Madre; la esencia de su&nbsp;cultura, su&nbsp;gastronomía&nbsp;y&nbsp;tradiciones; y la calidez de su&nbsp;hospitalidad&nbsp;como quien da la bienvenida a casa a un amigo. Este mágico destino guarda un auténtico espíritu mexicano</p>
                <h3 class="u-text u-text-2">Puerto Vallarta<br>
                  <br>Jalisco<br>México
                </h3>
                <div class="u-carousel u-gallery u-layout-thumbnails u-lightbox u-no-transition u-show-text-always u-gallery-1" data-interval="5000" data-u-ride="carousel" id="carousel-5b77">
                  <div class="u-carousel-inner u-gallery-inner" role="listbox">
                    <div class="u-active u-carousel-item u-gallery-item u-carousel-item-1">
                      <div class="u-back-slide" data-image-width="1920" data-image-height="650">
                        <img class="u-back-image u-expanded" src="https://visitapuertovallarta.com.mx/uploads/305/principales-atracciones-en-puerto-vallarta.jpg">
                      </div>
                      <div class="u-over-slide u-over-slide-1">
                        <h3 class="u-gallery-heading">Título de ejemplo</h3>
                        <p class="u-gallery-text">Texto de ejemplo</p>
                      </div>
                    </div>
                    <div class="u-carousel-item u-gallery-item u-carousel-item-2">
                      <div class="u-back-slide" data-image-width="1920" data-image-height="650">
                        <img class="u-back-image u-expanded" src="https://visitapuertovallarta.com.mx/uploads/static/mexico-puerto-vallarta.jpg">
                      </div>
                      <div class="u-over-slide u-over-slide-2">
                        <h3 class="u-gallery-heading">Título de ejemplo</h3>
                        <p class="u-gallery-text">Texto de ejemplo</p>
                      </div>
                    </div>
                    <div class="u-carousel-item u-gallery-item u-carousel-item-3" data-image-width="800" data-image-height="1000">
                      <div class="u-back-slide">
                        <img class="u-back-image u-expanded" src="https://visitapuertovallarta.com.mx/uploads/127/marina-vallarta-movil.jpg">
                      </div>
                      <div class="u-over-slide u-over-slide-3">
                        <h3 class="u-gallery-heading"></h3>
                        <p class="u-gallery-text"></p>
                      </div>
                      <style data-mode="XL"></style>
                      <style data-mode="LG"></style>
                      <style data-mode="MD"></style>
                      <style data-mode="SM"></style>
                      <style data-mode="XS"></style>
                    </div>
                  </div>
                  <a class="u-carousel-control u-carousel-control-prev u-grey-70 u-icon-circle u-opacity u-opacity-70 u-spacing-10 u-text-white u-carousel-control-1" href="#carousel-5b77" role="button" data-u-slide="prev">
                    <span aria-hidden="true">
                      <svg viewBox="0 0 451.847 451.847"><path d="M97.141,225.92c0-8.095,3.091-16.192,9.259-22.366L300.689,9.27c12.359-12.359,32.397-12.359,44.751,0
c12.354,12.354,12.354,32.388,0,44.748L173.525,225.92l171.903,171.909c12.354,12.354,12.354,32.391,0,44.744
c-12.354,12.365-32.386,12.365-44.745,0l-194.29-194.281C100.226,242.115,97.141,234.018,97.141,225.92z"></path></svg>
                    </span>
                    <span class="sr-only">
                      <svg viewBox="0 0 451.847 451.847"><path d="M97.141,225.92c0-8.095,3.091-16.192,9.259-22.366L300.689,9.27c12.359-12.359,32.397-12.359,44.751,0
c12.354,12.354,12.354,32.388,0,44.748L173.525,225.92l171.903,171.909c12.354,12.354,12.354,32.391,0,44.744
c-12.354,12.365-32.386,12.365-44.745,0l-194.29-194.281C100.226,242.115,97.141,234.018,97.141,225.92z"></path></svg>
                    </span>
                  </a>
                  <a class="u-carousel-control u-carousel-control-next u-grey-70 u-icon-circle u-opacity u-opacity-70 u-spacing-10 u-text-white u-carousel-control-2" href="#carousel-5b77" role="button" data-u-slide="next">
                    <span aria-hidden="true">
                      <svg viewBox="0 0 451.846 451.847"><path d="M345.441,248.292L151.154,442.573c-12.359,12.365-32.397,12.365-44.75,0c-12.354-12.354-12.354-32.391,0-44.744
L278.318,225.92L106.409,54.017c-12.354-12.359-12.354-32.394,0-44.748c12.354-12.359,32.391-12.359,44.75,0l194.287,194.284
c6.177,6.18,9.262,14.271,9.262,22.366C354.708,234.018,351.617,242.115,345.441,248.292z"></path></svg>
                    </span>
                    <span class="sr-only">
                      <svg viewBox="0 0 451.846 451.847"><path d="M345.441,248.292L151.154,442.573c-12.359,12.365-32.397,12.365-44.75,0c-12.354-12.354-12.354-32.391,0-44.744
L278.318,225.92L106.409,54.017c-12.354-12.359-12.354-32.394,0-44.748c12.354-12.359,32.391-12.359,44.75,0l194.287,194.284
c6.177,6.18,9.262,14.271,9.262,22.366C354.708,234.018,351.617,242.115,345.441,248.292z"></path></svg>
                    </span>
                  </a>
                  <ol class="u-carousel-thumbnails u-spacing-10 u-carousel-thumbnails-1">
                    <li class="u-active u-carousel-thumbnail u-carousel-thumbnail-1" data-u-target="#carousel-5b77" data-u-slide-to="0">
                      <img class="u-carousel-thumbnail-image u-image" src="https://visitapuertovallarta.com.mx/uploads/305/principales-atracciones-en-puerto-vallarta.jpg">
                    </li>
                    <li class="u-carousel-thumbnail u-carousel-thumbnail-2" data-u-target="#carousel-5b77" data-u-slide-to="1">
                      <img class="u-carousel-thumbnail-image u-image" src="https://visitapuertovallarta.com.mx/uploads/static/mexico-puerto-vallarta.jpg">
                    </li>
                    <li class="u-carousel-thumbnail u-carousel-thumbnail-3" data-u-target="#carousel-5b77" data-u-slide-to="2">
                      <img class="u-carousel-thumbnail-image u-image" src="https://visitapuertovallarta.com.mx/uploads/127/marina-vallarta-movil.jpg">
                    </li>
                  </ol>
                </div>
                <div class="u-grey-light-2 u-map u-map-1">
                  <div class="embed-responsive">
                    <iframe class="embed-responsive-item" src="https://maps.google.com/maps?output=embed&amp;q=puerto%20vallarta%2C%20mexico&amp;t=m" data-map="JTdCJTIycG9zaXRpb25UeXBlJTIyJTNBJTIybWFwLWFkZHJlc3MlMjIlMkMlMjJhZGRyZXNzJTIyJTNBJTIycHVlcnRvJTIwdmFsbGFydGElMkMlMjBtZXhpY28lMjIlMkMlMjJ6b29tJTIyJTNBbnVsbCUyQyUyMnR5cGVJZCUyMiUzQSUyMnJvYWQlMjIlMkMlMjJsYW5nJTIyJTNBbnVsbCUyQyUyMmFwaUtleSUyMiUzQW51bGwlMkMlMjJtYXJrZXJzJTIyJTNBJTVCJTVEJTdE"></iframe>
                  </div>
                </div>
                <div class="u-form u-form-1">
                  <form action="https://forms.nicepagesrv.com/v2/form/process" class="u-clearfix u-form-spacing-10 u-form-vertical u-inner-form" source="email" name="form-1" style="padding: 10px;" redirect="true" redirect-address="/Los-Cabos.html">
                    <div class="u-form-group u-form-name u-form-partition-factor-2">
                      <label for="name-4939" class="u-label">Nombres</label>
                      <input type="text" placeholder="Introduzca su nombre" id="name-4939" name="name" class="u-input u-input-rectangle" required="">
                    </div>
                    <div class="u-form-group u-form-name u-form-partition-factor-2 u-form-group-2">
                      <label for="name-bc33" class="u-label">Apellidos</label>
                      <input type="text" placeholder="Introduzca sus Apellidos" id="name-bc33" name="name-2" class="u-input u-input-rectangle" required="">
                    </div>
                    <div class="u-form-email u-form-group u-form-partition-factor-2">
                      <label for="email-4939" class="u-label">Email</label>
                      <input type="email" placeholder="Introduzca una dirección de correo electrónico válida" id="email-4939" name="email" class="u-input u-input-rectangle" required="">
                    </div>
                    <div class="u-form-group u-form-partition-factor-2 u-form-phone u-form-group-4">
                      <label for="phone-cabc" class="u-label">Teléfono</label>
                      <lt-highlighter style="display: none;">
                        <lt-div spellcheck="false" class="lt-highlighter__wrapper" style="width: 268px; height: 46px; transform: none !important; transform-origin: 135px 23.7969px !important; zoom: 1 !important; margin-top: 32px; margin-left: 1px;">
                          <lt-div class="lt-highlighter__scroll-element" style="top: 0px; left: 0px; width: 268px; height: 46px;"></lt-div>
                        </lt-div>
                      </lt-highlighter>
                      <input type="tel" pattern="\+?\d{0,3}[\s\(\-]?([0-9]{2,3})[\s\)\-]?([\s\-]?)([0-9]{3})[\s\-]?([0-9]{2})[\s\-]?([0-9]{2})" placeholder="Ingrese su teléfono (por ejemplo, +14155552675)" id="phone-cabc" name="celular" class="u-input u-input-rectangle" required="">
                    </div>
                    <div class="u-form-date u-form-group u-form-partition-factor-2 u-form-group-5">
                      <label for="date-2633" class="u-label">Llegada</label>
                      <input type="text" readonly="readonly" placeholder="MM/DD/AAAA" id="date-2633" name="date" class="u-input u-input-rectangle" required="" data-date-format="mm/dd/yyyy">
                    </div>
                    <div class="u-form-date u-form-group u-form-partition-factor-2 u-form-group-6">
                      <label for="date-1a54" class="u-label">Salida</label>
                      <input type="text" readonly="readonly" placeholder="MM/DD/AAAA" id="date-1a54" name="date-1" class="u-input u-input-rectangle" required="" data-date-format="mm/dd/yyyy">
                    </div>
                    <div class="u-form-group u-form-number u-form-number-layout-number u-form-partition-factor-4 u-form-group-7">
                      <label for="number-2037" class="u-label">Adultos</label>
                      <div class="u-input-row" data-value="0">
                        <input value="0" min="0" max="100" step="1" type="number" placeholder="" id="number-2037" name="number-1" class="u-input u-input-rectangle">
                      </div>
                    </div>
                    <div class="u-form-group u-form-number u-form-number-layout-number u-form-partition-factor-4 u-form-group-8">
                      <label for="number-bc0d" class="u-label">Niños</label>
                      <div class="u-input-row" data-value="0">
                        <input value="0" min="0" max="100" step="1" type="number" placeholder="" id="number-bc0d" name="number" class="u-input u-input-rectangle">
                      </div>
                    </div>
                    <div class="u-form-group u-form-number u-form-number-layout-number u-form-partition-factor-4 u-form-group-9">
                      <label for="number-6055" class="u-label">Tercera edad</label>
                      <div class="u-input-row" data-value="0">
                        <input value="0" min="0" max="100" step="1" type="number" placeholder="" id="number-6055" name="number-2" class="u-input u-input-rectangle">
                      </div>
                    </div>
                    <div class="u-form-group u-form-partition-factor-4 u-form-select u-form-group-10">
                      <label for="select-ffbf" class="u-label">Desplegable</label>
                      <div class="u-form-select-wrapper">
                        <select id="select-ffbf" name="select" class="u-input u-input-rectangle">
                          <option value="si" data-calc="">si</option>
                          <option value="No" data-calc="">No</option>
                        </select>
                        <svg class="u-caret u-caret-svg" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16" style="fill:currentColor;" xml:space="preserve"><polygon class="st0" points="8,12 2,4 14,4 "></polygon></svg>
                      </div>
                    </div>
                    <div class="u-form-checkbox-group u-form-group u-form-group-11">
                      <label class="u-label">Quiero Buscar</label>
                      <div class="u-form-checkbox-group-wrapper">
                        <div class="u-input-row">
                          <input id="field-945f" type="checkbox" name="checkbox[]" value="Hoteles" class="u-field-input" checked="checked" data-calc="">
                          <label class="u-field-label" for="field-945f">Hoteles</label>
                        </div>
                        <div class="u-input-row">
                          <input id="field-ce80" type="checkbox" name="checkbox[]" value="Vuelos" class="u-field-input" data-calc="">
                          <label class="u-field-label" for="field-ce80">Vuelos</label>
                        </div>
                        <div class="u-input-row">
                          <input id="field-b073" type="checkbox" name="checkbox[]" value="Transporte" class="u-field-input" data-calc="">
                          <label class="u-field-label" for="field-b073">Transporte</label>
                        </div>
                      </div>
                    </div>
                    <div class="u-form-agree u-form-group u-form-group-12">
                      <label class="u-field-label" style=""></label>
                      <input type="checkbox" id="agree-4021" name="agree" class="u-agree-checkbox u-field-input" required="">
                      <label for="agree-4021" class="u-agree-label u-field-label">Yo acepto los <a class="u-active-none u-border-none u-btn u-button-link u-button-style u-hover-none u-none u-text-palette-1-base u-btn-1" href="#">Términos de servicio</a>
                      </label>
                    </div>
                    <div class="u-align-left u-form-group u-form-submit">
                      <a href="#" class="u-btn u-btn-submit u-button-style u-hover-palette-1-dark-1 u-palette-1-base u-btn-2">Buscar</a>
                      <input type="submit" value="submit" class="u-form-control-hidden">
                    </div>
                    <div class="u-form-send-message u-form-send-success"> Gracias! Tu mensaje ha sido enviado. </div>
                    <div class="u-form-send-error u-form-send-message"> No se puede enviar su mensaje. Por favor, corrija los errores y vuelva a intentarlo. </div>
                    <input type="hidden" value="" name="recaptchaResponse">
                    <input type="hidden" name="formServices" value="d3bf3c355c7c8d62bd5e883f282b693b">
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="u-accordion-item u-accordion-item-2">
            <a class="u-accordion-link u-border-1 u-border-active-grey-25 u-border-grey-30 u-border-hover-grey-30 u-border-no-left u-border-no-right u-border-no-top u-button-style u-text-active-black u-text-grey-50 u-text-hover-black u-accordion-link-2" id="link-311f" aria-controls="311f" aria-selected="false">
              <lt-highlighter class="lt-highlighter--grid-item" style="display: none;">
                <lt-div spellcheck="false" class="lt-highlighter__wrapper" style="width: 120px; height: 26px; transform: none !important; transform-origin: 60.1094px 12.7969px !important; zoom: 1 !important; margin-top: 465px; margin-left: 30px;">
                  <lt-div class="lt-highlighter__scroll-element" style="top: 0px; left: 0px; width: 120px; height: 26px;"></lt-div>
                </lt-div>
              </lt-highlighter>
              <span class="u-accordion-link-text">Cancún</span><span class="u-accordion-link-icon u-icon u-text-grey-40 u-icon-2"><svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 16 16" style=""><use xlink:href="#svg-73b8"></use></svg><svg class="u-svg-content" viewBox="0 0 16 16" x="0px" y="0px" id="svg-73b8"><path d="M8,10.7L1.6,5.3c-0.4-0.4-1-0.4-1.3,0c-0.4,0.4-0.4,0.9,0,1.3l7.2,6.1c0.1,0.1,0.4,0.2,0.6,0.2s0.4-0.1,0.6-0.2l7.1-6
	c0.4-0.4,0.4-0.9,0-1.3c-0.4-0.4-1-0.4-1.3,0L8,10.7z"></path></svg></span>
            </a>
            <div class="u-accordion-pane u-align-left u-container-style u-accordion-pane-2" id="311f" aria-labelledby="link-311f">
              <div class="u-container-layout u-container-layout-2">
                <div class="u-carousel u-gallery u-layout-thumbnails u-lightbox u-no-transition u-show-text-always u-gallery-2" data-interval="5000" data-u-ride="carousel" id="carousel-5b77">
                  <div class="u-carousel-inner u-gallery-inner" role="listbox">
                    <div class="u-active u-carousel-item u-gallery-item u-carousel-item-4">
                      <div class="u-back-slide" data-image-width="1047" data-image-height="1309">
                        <img class="u-back-image u-expanded" src="https://s3.amazonaws.com/crowdriff-media/full/8c59601f61e6d14a7b98a8b4ea56b2e6be3c1bd1b9f3f67d49bac27885123320.jpg">
                      </div>
                      <div class="u-over-slide u-over-slide-4">
                        <h3 class="u-gallery-heading">Título de ejemplo</h3>
                        <p class="u-gallery-text">Texto de ejemplo</p>
                      </div>
                    </div>
                    <div class="u-carousel-item u-gallery-item u-carousel-item-5">
                      <div class="u-back-slide" data-image-width="1200" data-image-height="700">
                        <img class="u-back-image u-expanded" src="https://assets.simpleviewinc.com/simpleview/image/upload/c_fill,h_700,q_75,w_1200/v1/clients/quintanaroo/ISLAMUJERES_MUSA_c0e20c91-6044-4eb9-abb7-169c4bc5d76b.jpg">
                      </div>
                      <div class="u-over-slide u-over-slide-5">
                        <h3 class="u-gallery-heading">Título de ejemplo</h3>
                        <p class="u-gallery-text">Texto de ejemplo</p>
                      </div>
                    </div>
                    <div class="u-carousel-item u-gallery-item u-carousel-item-6" data-image-width="1080" data-image-height="1350">
                      <div class="u-back-slide">
                        <img class="u-back-image u-expanded" src="https://s3.amazonaws.com/crowdriff-media/full/f3666cfd394d57ea6f84dd67e39846558df1ce1d97ba27df7ac9d3c98fba6324.jpg">
                      </div>
                      <div class="u-over-slide u-over-slide-6">
                        <h3 class="u-gallery-heading"></h3>
                        <p class="u-gallery-text"></p>
                      </div>
                      <style data-mode="XL"></style>
                      <style data-mode="LG"></style>
                      <style data-mode="MD"></style>
                      <style data-mode="SM"></style>
                      <style data-mode="XS"></style>
                    </div>
                  </div>
                  <a class="u-carousel-control u-carousel-control-prev u-grey-70 u-icon-circle u-opacity u-opacity-70 u-spacing-10 u-text-white u-carousel-control-3" href="#carousel-5b77" role="button" data-u-slide="prev">
                    <span aria-hidden="true">
                      <svg viewBox="0 0 451.847 451.847"><path d="M97.141,225.92c0-8.095,3.091-16.192,9.259-22.366L300.689,9.27c12.359-12.359,32.397-12.359,44.751,0
c12.354,12.354,12.354,32.388,0,44.748L173.525,225.92l171.903,171.909c12.354,12.354,12.354,32.391,0,44.744
c-12.354,12.365-32.386,12.365-44.745,0l-194.29-194.281C100.226,242.115,97.141,234.018,97.141,225.92z"></path></svg>
                    </span>
                    <span class="sr-only">
                      <svg viewBox="0 0 451.847 451.847"><path d="M97.141,225.92c0-8.095,3.091-16.192,9.259-22.366L300.689,9.27c12.359-12.359,32.397-12.359,44.751,0
c12.354,12.354,12.354,32.388,0,44.748L173.525,225.92l171.903,171.909c12.354,12.354,12.354,32.391,0,44.744
c-12.354,12.365-32.386,12.365-44.745,0l-194.29-194.281C100.226,242.115,97.141,234.018,97.141,225.92z"></path></svg>
                    </span>
                  </a>
                  <a class="u-carousel-control u-carousel-control-next u-grey-70 u-icon-circle u-opacity u-opacity-70 u-spacing-10 u-text-white u-carousel-control-4" href="#carousel-5b77" role="button" data-u-slide="next">
                    <span aria-hidden="true">
                      <svg viewBox="0 0 451.846 451.847"><path d="M345.441,248.292L151.154,442.573c-12.359,12.365-32.397,12.365-44.75,0c-12.354-12.354-12.354-32.391,0-44.744
L278.318,225.92L106.409,54.017c-12.354-12.359-12.354-32.394,0-44.748c12.354-12.359,32.391-12.359,44.75,0l194.287,194.284
c6.177,6.18,9.262,14.271,9.262,22.366C354.708,234.018,351.617,242.115,345.441,248.292z"></path></svg>
                    </span>
                    <span class="sr-only">
                      <svg viewBox="0 0 451.846 451.847"><path d="M345.441,248.292L151.154,442.573c-12.359,12.365-32.397,12.365-44.75,0c-12.354-12.354-12.354-32.391,0-44.744
L278.318,225.92L106.409,54.017c-12.354-12.359-12.354-32.394,0-44.748c12.354-12.359,32.391-12.359,44.75,0l194.287,194.284
c6.177,6.18,9.262,14.271,9.262,22.366C354.708,234.018,351.617,242.115,345.441,248.292z"></path></svg>
                    </span>
                  </a>
                  <ol class="u-carousel-thumbnails u-spacing-10 u-carousel-thumbnails-2">
                    <li class="u-active u-carousel-thumbnail u-carousel-thumbnail-4" data-u-target="#carousel-5b77" data-u-slide-to="0">
                      <img class="u-carousel-thumbnail-image u-image" src="https://s3.amazonaws.com/crowdriff-media/full/8c59601f61e6d14a7b98a8b4ea56b2e6be3c1bd1b9f3f67d49bac27885123320.jpg">
                    </li>
                    <li class="u-carousel-thumbnail u-carousel-thumbnail-5" data-u-target="#carousel-5b77" data-u-slide-to="1">
                      <img class="u-carousel-thumbnail-image u-image" src="https://assets.simpleviewinc.com/simpleview/image/upload/c_fill,h_700,q_75,w_1200/v1/clients/quintanaroo/ISLAMUJERES_MUSA_c0e20c91-6044-4eb9-abb7-169c4bc5d76b.jpg">
                    </li>
                    <li class="u-carousel-thumbnail u-carousel-thumbnail-6" data-u-target="#carousel-5b77" data-u-slide-to="2">
                      <img class="u-carousel-thumbnail-image u-image" src="https://s3.amazonaws.com/crowdriff-media/full/f3666cfd394d57ea6f84dd67e39846558df1ce1d97ba27df7ac9d3c98fba6324.jpg">
                    </li>
                  </ol>
                </div>
                <p class="u-text u-text-3">Cancún es una ciudad de México ubicada en la península de Yucatán que limita con el mar Caribe y que es conocida por sus playas, los numerosos centros turísticos y la vida nocturna.</p>
                <h3 class="u-text u-text-4">Cancún<br>
                  <br>Quintana Roo<br>México
                </h3>
                <div class="u-form u-form-2">
                  <form action="https://forms.nicepagesrv.com/v2/form/process" class="u-clearfix u-form-spacing-10 u-form-vertical u-inner-form" source="email" name="form-1" style="padding: 10px;" redirect="true" redirect-address="/Los-Cabos.html">
                    <div class="u-form-group u-form-name u-form-partition-factor-2">
                      <label for="name-4939" class="u-label">Nombres</label>
                      <input type="text" placeholder="Introduzca su nombre" id="name-4939" name="name" class="u-input u-input-rectangle" required="">
                    </div>
                    <div class="u-form-group u-form-name u-form-partition-factor-2 u-form-group-15">
                      <label for="name-bc33" class="u-label">Apellidos</label>
                      <input type="text" placeholder="Introduzca sus Apellidos" id="name-bc33" name="name-2" class="u-input u-input-rectangle" required="">
                    </div>
                    <div class="u-form-email u-form-group u-form-partition-factor-2">
                      <label for="email-4939" class="u-label">Email</label>
                      <input type="email" placeholder="Introduzca una dirección de correo electrónico válida" id="email-4939" name="email" class="u-input u-input-rectangle" required="">
                    </div>
                    <div class="u-form-group u-form-partition-factor-2 u-form-phone u-form-group-17">
                      <label for="phone-cabc" class="u-label">Teléfono</label>
                      <lt-highlighter style="display: none;">
                        <lt-div spellcheck="false" class="lt-highlighter__wrapper" style="width: 268px; height: 46px; transform: none !important; transform-origin: 135px 23.7969px !important; zoom: 1 !important; margin-top: 32px; margin-left: 1px;">
                          <lt-div class="lt-highlighter__scroll-element" style="top: 0px; left: 0px; width: 268px; height: 46px;"></lt-div>
                        </lt-div>
                      </lt-highlighter>
                      <input type="tel" pattern="\+?\d{0,3}[\s\(\-]?([0-9]{2,3})[\s\)\-]?([\s\-]?)([0-9]{3})[\s\-]?([0-9]{2})[\s\-]?([0-9]{2})" placeholder="Ingrese su teléfono (por ejemplo, +14155552675)" id="phone-cabc" name="celular" class="u-input u-input-rectangle" required="">
                    </div>
                    <div class="u-form-date u-form-group u-form-partition-factor-2 u-form-group-18">
                      <label for="date-2633" class="u-label">Llegada</label>
                      <input type="text" readonly="readonly" placeholder="MM/DD/AAAA" id="date-2633" name="date" class="u-input u-input-rectangle" required="" data-date-format="mm/dd/yyyy">
                    </div>
                    <div class="u-form-date u-form-group u-form-partition-factor-2 u-form-group-19">
                      <label for="date-1a54" class="u-label">Salida</label>
                      <input type="text" readonly="readonly" placeholder="MM/DD/AAAA" id="date-1a54" name="date-1" class="u-input u-input-rectangle" required="" data-date-format="mm/dd/yyyy">
                    </div>
                    <div class="u-form-group u-form-number u-form-number-layout-number u-form-partition-factor-4 u-form-group-20">
                      <label for="number-2037" class="u-label">Adultos</label>
                      <div class="u-input-row" data-value="0">
                        <input value="0" min="0" max="100" step="1" type="number" placeholder="" id="number-2037" name="number-1" class="u-input u-input-rectangle">
                      </div>
                    </div>
                    <div class="u-form-group u-form-number u-form-number-layout-number u-form-partition-factor-4 u-form-group-21">
                      <label for="number-bc0d" class="u-label">Niños</label>
                      <div class="u-input-row" data-value="0">
                        <input value="0" min="0" max="100" step="1" type="number" placeholder="" id="number-bc0d" name="number" class="u-input u-input-rectangle">
                      </div>
                    </div>
                    <div class="u-form-group u-form-number u-form-number-layout-number u-form-partition-factor-4 u-form-group-22">
                      <label for="number-6055" class="u-label">Tercera edad</label>
                      <div class="u-input-row" data-value="0">
                        <input value="0" min="0" max="100" step="1" type="number" placeholder="" id="number-6055" name="number-2" class="u-input u-input-rectangle">
                      </div>
                    </div>
                    <div class="u-form-group u-form-partition-factor-4 u-form-select u-form-group-23">
                      <label for="select-ffbf" class="u-label">Desplegable</label>
                      <div class="u-form-select-wrapper">
                        <select id="select-ffbf" name="select" class="u-input u-input-rectangle">
                          <option value="si" data-calc="">si</option>
                          <option value="No" data-calc="">No</option>
                        </select>
                        <svg class="u-caret u-caret-svg" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16" style="fill:currentColor;" xml:space="preserve"><polygon class="st0" points="8,12 2,4 14,4 "></polygon></svg>
                      </div>
                    </div>
                    <div class="u-form-checkbox-group u-form-group u-form-group-24">
                      <label class="u-label">Quiero Buscar</label>
                      <div class="u-form-checkbox-group-wrapper">
                        <div class="u-input-row">
                          <input id="field-945f" type="checkbox" name="checkbox[]" value="Hoteles" class="u-field-input" checked="checked" data-calc="">
                          <label class="u-field-label" for="field-945f">Hoteles</label>
                        </div>
                        <div class="u-input-row">
                          <input id="field-ce80" type="checkbox" name="checkbox[]" value="Vuelos" class="u-field-input" data-calc="">
                          <label class="u-field-label" for="field-ce80">Vuelos</label>
                        </div>
                        <div class="u-input-row">
                          <input id="field-b073" type="checkbox" name="checkbox[]" value="Transporte" class="u-field-input" data-calc="">
                          <label class="u-field-label" for="field-b073">Transporte</label>
                        </div>
                      </div>
                    </div>
                    <div class="u-form-agree u-form-group u-form-group-25">
                      <label class="u-field-label" style=""></label>
                      <input type="checkbox" id="agree-4021" name="agree" class="u-agree-checkbox u-field-input" required="">
                      <label for="agree-4021" class="u-agree-label u-field-label">Yo acepto los <a class="u-active-none u-border-none u-btn u-button-link u-button-style u-hover-none u-none u-text-palette-1-base u-btn-3" href="#">Términos de servicio</a>
                      </label>
                    </div>
                    <div class="u-align-left u-form-group u-form-submit">
                      <a href="#" class="u-btn u-btn-submit u-button-style u-hover-palette-1-dark-1 u-palette-1-base u-btn-4">Buscar</a>
                      <input type="submit" value="submit" class="u-form-control-hidden">
                    </div>
                    <div class="u-form-send-message u-form-send-success"> Gracias! Tu mensaje ha sido enviado. </div>
                    <div class="u-form-send-error u-form-send-message"> No se puede enviar su mensaje. Por favor, corrija los errores y vuelva a intentarlo. </div>
                    <input type="hidden" value="" name="recaptchaResponse">
                    <input type="hidden" name="formServices" value="d3bf3c355c7c8d62bd5e883f282b693b">
                  </form>
                </div>
                <div class="u-grey-light-2 u-map u-map-2">
                  <div class="embed-responsive">
                    <iframe class="embed-responsive-item" src="https://maps.google.com/maps?output=embed&amp;q=canc%C3%BAn%2C%20mexico&amp;t=m" data-map="JTdCJTIycG9zaXRpb25UeXBlJTIyJTNBJTIybWFwLWFkZHJlc3MlMjIlMkMlMjJhZGRyZXNzJTIyJTNBJTIyY2FuYyVDMyVCQW4lMkMlMjBtZXhpY28lMjIlMkMlMjJ6b29tJTIyJTNBbnVsbCUyQyUyMnR5cGVJZCUyMiUzQSUyMnJvYWQlMjIlMkMlMjJsYW5nJTIyJTNBbnVsbCUyQyUyMmFwaUtleSUyMiUzQW51bGwlMkMlMjJtYXJrZXJzJTIyJTNBJTVCJTVEJTdE"></iframe>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="u-accordion-item">
            <a class="u-accordion-link u-border-1 u-border-active-grey-25 u-border-grey-30 u-border-hover-grey-30 u-border-no-left u-border-no-right u-border-no-top u-button-style u-text-active-black u-text-grey-50 u-text-hover-black u-accordion-link-3" id="link-311f" aria-controls="311f" aria-selected="false">
              <lt-highlighter class="lt-highlighter--grid-item" style="display: none;">
                <lt-div spellcheck="false" class="lt-highlighter__wrapper" style="width: 120px; height: 26px; transform: none !important; transform-origin: 60.1094px 12.7969px !important; zoom: 1 !important; margin-top: 465px; margin-left: 30px;">
                  <lt-div class="lt-highlighter__scroll-element" style="top: 0px; left: 0px; width: 120px; height: 26px;"></lt-div>
                </lt-div>
              </lt-highlighter>
              <span class="u-accordion-link-text">Acapulco</span><span class="u-accordion-link-icon u-icon u-text-grey-40 u-icon-3"><svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 16 16" style=""><use xlink:href="#svg-88d7"></use></svg><svg class="u-svg-content" viewBox="0 0 16 16" x="0px" y="0px" id="svg-88d7"><path d="M8,10.7L1.6,5.3c-0.4-0.4-1-0.4-1.3,0c-0.4,0.4-0.4,0.9,0,1.3l7.2,6.1c0.1,0.1,0.4,0.2,0.6,0.2s0.4-0.1,0.6-0.2l7.1-6
	c0.4-0.4,0.4-0.9,0-1.3c-0.4-0.4-1-0.4-1.3,0L8,10.7z"></path></svg></span>
            </a>
            <div class="u-accordion-pane u-align-left u-container-style u-accordion-pane-3" id="311f" aria-labelledby="link-311f">
              <div class="u-container-layout u-container-layout-3">
                <div class="u-carousel u-gallery u-layout-thumbnails u-lightbox u-no-transition u-show-text-always u-gallery-3" data-interval="5000" data-u-ride="carousel" id="carousel-5b77">
                  <div class="u-carousel-inner u-gallery-inner" role="listbox">
                    <div class="u-active u-carousel-item u-gallery-item u-carousel-item-7">
                      <div class="u-back-slide" data-image-width="800" data-image-height="533">
                        <img class="u-back-image u-expanded" src="https://a.cdn-hotels.com/gdcs/production124/d1362/161ed68d-9d61-4edc-b4af-7d40f9b0c465.jpg?impolicy=fcrop&amp;w=800&amp;h=533&amp;q=medium">
                      </div>
                      <div class="u-over-slide u-over-slide-7">
                        <h3 class="u-gallery-heading">Título de ejemplo</h3>
                        <p class="u-gallery-text">Texto de ejemplo</p>
                      </div>
                    </div>
                    <div class="u-carousel-item u-gallery-item u-carousel-item-8">
                      <div class="u-back-slide" data-image-width="1040" data-image-height="580">
                        <img class="u-back-image u-expanded" src="https://a.travel-assets.com/findyours-php/viewfinder/images/res70/137000/137741-Acapulco-And-Vicinity.jpg?impolicy=fcrop&amp;w=1040&amp;h=580&amp;q=mediumHigh">
                      </div>
                      <div class="u-over-slide u-over-slide-8">
                        <h3 class="u-gallery-heading">Título de ejemplo</h3>
                        <p class="u-gallery-text">Texto de ejemplo</p>
                      </div>
                    </div>
                    <div class="u-carousel-item u-gallery-item u-carousel-item-9" data-image-width="1004" data-image-height="565">
                      <div class="u-back-slide">
                        <img class="u-back-image u-expanded" src="https://mediaim.expedia.com/localexpert/437176/5510646b-6197-4514-8c8b-24179d81b08b.jpg?impolicy=resizecrop&amp;rw=1005&amp;rh=565">
                      </div>
                      <div class="u-over-slide u-over-slide-9">
                        <h3 class="u-gallery-heading"></h3>
                        <p class="u-gallery-text"></p>
                      </div>
                      <style data-mode="XL"></style>
                      <style data-mode="LG"></style>
                      <style data-mode="MD"></style>
                      <style data-mode="SM"></style>
                      <style data-mode="XS"></style>
                    </div>
                  </div>
                  <a class="u-carousel-control u-carousel-control-prev u-grey-70 u-icon-circle u-opacity u-opacity-70 u-spacing-10 u-text-white u-carousel-control-5" href="#carousel-5b77" role="button" data-u-slide="prev">
                    <span aria-hidden="true">
                      <svg viewBox="0 0 451.847 451.847"><path d="M97.141,225.92c0-8.095,3.091-16.192,9.259-22.366L300.689,9.27c12.359-12.359,32.397-12.359,44.751,0
c12.354,12.354,12.354,32.388,0,44.748L173.525,225.92l171.903,171.909c12.354,12.354,12.354,32.391,0,44.744
c-12.354,12.365-32.386,12.365-44.745,0l-194.29-194.281C100.226,242.115,97.141,234.018,97.141,225.92z"></path></svg>
                    </span>
                    <span class="sr-only">
                      <svg viewBox="0 0 451.847 451.847"><path d="M97.141,225.92c0-8.095,3.091-16.192,9.259-22.366L300.689,9.27c12.359-12.359,32.397-12.359,44.751,0
c12.354,12.354,12.354,32.388,0,44.748L173.525,225.92l171.903,171.909c12.354,12.354,12.354,32.391,0,44.744
c-12.354,12.365-32.386,12.365-44.745,0l-194.29-194.281C100.226,242.115,97.141,234.018,97.141,225.92z"></path></svg>
                    </span>
                  </a>
                  <a class="u-carousel-control u-carousel-control-next u-grey-70 u-icon-circle u-opacity u-opacity-70 u-spacing-10 u-text-white u-carousel-control-6" href="#carousel-5b77" role="button" data-u-slide="next">
                    <span aria-hidden="true">
                      <svg viewBox="0 0 451.846 451.847"><path d="M345.441,248.292L151.154,442.573c-12.359,12.365-32.397,12.365-44.75,0c-12.354-12.354-12.354-32.391,0-44.744
L278.318,225.92L106.409,54.017c-12.354-12.359-12.354-32.394,0-44.748c12.354-12.359,32.391-12.359,44.75,0l194.287,194.284
c6.177,6.18,9.262,14.271,9.262,22.366C354.708,234.018,351.617,242.115,345.441,248.292z"></path></svg>
                    </span>
                    <span class="sr-only">
                      <svg viewBox="0 0 451.846 451.847"><path d="M345.441,248.292L151.154,442.573c-12.359,12.365-32.397,12.365-44.75,0c-12.354-12.354-12.354-32.391,0-44.744
L278.318,225.92L106.409,54.017c-12.354-12.359-12.354-32.394,0-44.748c12.354-12.359,32.391-12.359,44.75,0l194.287,194.284
c6.177,6.18,9.262,14.271,9.262,22.366C354.708,234.018,351.617,242.115,345.441,248.292z"></path></svg>
                    </span>
                  </a>
                  <ol class="u-carousel-thumbnails u-spacing-10 u-carousel-thumbnails-3">
                    <li class="u-active u-carousel-thumbnail u-carousel-thumbnail-7" data-u-target="#carousel-5b77" data-u-slide-to="0">
                      <img class="u-carousel-thumbnail-image u-image" src="https://a.cdn-hotels.com/gdcs/production124/d1362/161ed68d-9d61-4edc-b4af-7d40f9b0c465.jpg?impolicy=fcrop&amp;w=800&amp;h=533&amp;q=medium">
                    </li>
                    <li class="u-carousel-thumbnail u-carousel-thumbnail-8" data-u-target="#carousel-5b77" data-u-slide-to="1">
                      <img class="u-carousel-thumbnail-image u-image" src="https://a.travel-assets.com/findyours-php/viewfinder/images/res70/137000/137741-Acapulco-And-Vicinity.jpg?impolicy=fcrop&amp;w=1040&amp;h=580&amp;q=mediumHigh">
                    </li>
                    <li class="u-carousel-thumbnail u-carousel-thumbnail-9" data-u-target="#carousel-5b77" data-u-slide-to="2">
                      <img class="u-carousel-thumbnail-image u-image" src="https://mediaim.expedia.com/localexpert/437176/5510646b-6197-4514-8c8b-24179d81b08b.jpg?impolicy=resizecrop&amp;rw=1005&amp;rh=565">
                    </li>
                  </ol>
                </div>
                <div class="u-grey-light-2 u-map u-map-3">
                  <div class="embed-responsive">
                    <iframe class="embed-responsive-item" src="https://maps.google.com/maps?output=embed&amp;q=acapulco&amp;t=m" data-map="JTdCJTIycG9zaXRpb25UeXBlJTIyJTNBJTIybWFwLWFkZHJlc3MlMjIlMkMlMjJhZGRyZXNzJTIyJTNBJTIyYWNhcHVsY28lMjIlMkMlMjJ6b29tJTIyJTNBbnVsbCUyQyUyMnR5cGVJZCUyMiUzQSUyMnJvYWQlMjIlMkMlMjJsYW5nJTIyJTNBbnVsbCUyQyUyMmFwaUtleSUyMiUzQW51bGwlMkMlMjJtYXJrZXJzJTIyJTNBJTVCJTVEJTdE"></iframe>
                  </div>
                </div>
                <h3 class="u-text u-text-5">Acapulco<br>
                  <br>Guerrero<br>México
                </h3>
                <p class="u-text u-text-6">Acapulco de Juárez Guerrero México bendecido&nbsp;por las cálidas aguas y el sol los 365 días del año, hermosas playas, un paisaje de inigualable belleza, y gente hospitalaria y amigable.</p>
                <div class="u-form u-form-3">
                  <form action="https://forms.nicepagesrv.com/v2/form/process" class="u-clearfix u-form-spacing-10 u-form-vertical u-inner-form" source="email" name="form-1" style="padding: 10px;" redirect="true" redirect-address="/Los-Cabos.html">
                    <div class="u-form-group u-form-name u-form-partition-factor-2">
                      <label for="name-4939" class="u-label">Nombres</label>
                      <input type="text" placeholder="Introduzca su nombre" id="name-4939" name="name" class="u-input u-input-rectangle" required="">
                    </div>
                    <div class="u-form-group u-form-name u-form-partition-factor-2 u-form-group-28">
                      <label for="name-bc33" class="u-label">Apellidos</label>
                      <input type="text" placeholder="Introduzca sus Apellidos" id="name-bc33" name="name-2" class="u-input u-input-rectangle" required="">
                    </div>
                    <div class="u-form-email u-form-group u-form-partition-factor-2">
                      <label for="email-4939" class="u-label">Email</label>
                      <input type="email" placeholder="Introduzca una dirección de correo electrónico válida" id="email-4939" name="email" class="u-input u-input-rectangle" required="">
                    </div>
                    <div class="u-form-group u-form-partition-factor-2 u-form-phone u-form-group-30">
                      <label for="phone-cabc" class="u-label">Teléfono</label>
                      <lt-highlighter style="display: none;">
                        <lt-div spellcheck="false" class="lt-highlighter__wrapper" style="width: 268px; height: 46px; transform: none !important; transform-origin: 135px 23.7969px !important; zoom: 1 !important; margin-top: 32px; margin-left: 1px;">
                          <lt-div class="lt-highlighter__scroll-element" style="top: 0px; left: 0px; width: 268px; height: 46px;"></lt-div>
                        </lt-div>
                      </lt-highlighter>
                      <input type="tel" pattern="\+?\d{0,3}[\s\(\-]?([0-9]{2,3})[\s\)\-]?([\s\-]?)([0-9]{3})[\s\-]?([0-9]{2})[\s\-]?([0-9]{2})" placeholder="Ingrese su teléfono (por ejemplo, +14155552675)" id="phone-cabc" name="celular" class="u-input u-input-rectangle" required="">
                    </div>
                    <div class="u-form-date u-form-group u-form-partition-factor-2 u-form-group-31">
                      <label for="date-2633" class="u-label">Llegada</label>
                      <input type="text" readonly="readonly" placeholder="MM/DD/AAAA" id="date-2633" name="date" class="u-input u-input-rectangle" required="" data-date-format="mm/dd/yyyy">
                    </div>
                    <div class="u-form-date u-form-group u-form-partition-factor-2 u-form-group-32">
                      <label for="date-1a54" class="u-label">Salida</label>
                      <input type="text" readonly="readonly" placeholder="MM/DD/AAAA" id="date-1a54" name="date-1" class="u-input u-input-rectangle" required="" data-date-format="mm/dd/yyyy">
                    </div>
                    <div class="u-form-group u-form-number u-form-number-layout-number u-form-partition-factor-4 u-form-group-33">
                      <label for="number-2037" class="u-label">Adultos</label>
                      <div class="u-input-row" data-value="0">
                        <input value="0" min="0" max="100" step="1" type="number" placeholder="" id="number-2037" name="number-1" class="u-input u-input-rectangle">
                      </div>
                    </div>
                    <div class="u-form-group u-form-number u-form-number-layout-number u-form-partition-factor-4 u-form-group-34">
                      <label for="number-bc0d" class="u-label">Niños</label>
                      <div class="u-input-row" data-value="0">
                        <input value="0" min="0" max="100" step="1" type="number" placeholder="" id="number-bc0d" name="number" class="u-input u-input-rectangle">
                      </div>
                    </div>
                    <div class="u-form-group u-form-number u-form-number-layout-number u-form-partition-factor-4 u-form-group-35">
                      <label for="number-6055" class="u-label">Tercera edad</label>
                      <div class="u-input-row" data-value="0">
                        <input value="0" min="0" max="100" step="1" type="number" placeholder="" id="number-6055" name="number-2" class="u-input u-input-rectangle">
                      </div>
                    </div>
                    <div class="u-form-group u-form-partition-factor-4 u-form-select u-form-group-36">
                      <label for="select-ffbf" class="u-label">Desplegable</label>
                      <div class="u-form-select-wrapper">
                        <select id="select-ffbf" name="select" class="u-input u-input-rectangle">
                          <option value="si" data-calc="">si</option>
                          <option value="No" data-calc="">No</option>
                        </select>
                        <svg class="u-caret u-caret-svg" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16" style="fill:currentColor;" xml:space="preserve"><polygon class="st0" points="8,12 2,4 14,4 "></polygon></svg>
                      </div>
                    </div>
                    <div class="u-form-checkbox-group u-form-group u-form-group-37">
                      <label class="u-label">Quiero Buscar</label>
                      <div class="u-form-checkbox-group-wrapper">
                        <div class="u-input-row">
                          <input id="field-945f" type="checkbox" name="checkbox[]" value="Hoteles" class="u-field-input" checked="checked" data-calc="">
                          <label class="u-field-label" for="field-945f">Hoteles</label>
                        </div>
                        <div class="u-input-row">
                          <input id="field-ce80" type="checkbox" name="checkbox[]" value="Vuelos" class="u-field-input" data-calc="">
                          <label class="u-field-label" for="field-ce80">Vuelos</label>
                        </div>
                        <div class="u-input-row">
                          <input id="field-b073" type="checkbox" name="checkbox[]" value="Transporte" class="u-field-input" data-calc="">
                          <label class="u-field-label" for="field-b073">Transporte</label>
                        </div>
                      </div>
                    </div>
                    <div class="u-form-agree u-form-group u-form-group-38">
                      <label class="u-field-label" style=""></label>
                      <input type="checkbox" id="agree-4021" name="agree" class="u-agree-checkbox u-field-input" required="">
                      <label for="agree-4021" class="u-agree-label u-field-label">Yo acepto los <a class="u-active-none u-border-none u-btn u-button-link u-button-style u-hover-none u-none u-text-palette-1-base u-btn-5" href="#">Términos de servicio</a>
                      </label>
                    </div>
                    <div class="u-align-left u-form-group u-form-submit">
                      <a href="#" class="u-btn u-btn-submit u-button-style u-hover-palette-1-dark-1 u-palette-1-base u-btn-6">Buscar</a>
                      <input type="submit" value="submit" class="u-form-control-hidden">
                    </div>
                    <div class="u-form-send-message u-form-send-success"> Gracias! Tu mensaje ha sido enviado. </div>
                    <div class="u-form-send-error u-form-send-message"> No se puede enviar su mensaje. Por favor, corrija los errores y vuelva a intentarlo. </div>
                    <input type="hidden" value="" name="recaptchaResponse">
                    <input type="hidden" name="formServices" value="d3bf3c355c7c8d62bd5e883f282b693b">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    
    <footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-063f"><div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <lt-highlighter style="display: none; z-index: 1 !important;">
          <lt-div spellcheck="false" class="lt-highlighter__wrapper" style="width: 721px; height: 58px; transform: none !important; transform-origin: 360.375px 28.7969px !important; zoom: 1 !important; margin-top: 50px; margin-left: 210px;">
            <lt-div class="lt-highlighter__scroll-element" style="top: 0px; left: 0px; width: 721px; height: 58px;">
              <canvas class="lt-highlighter__canvas" width="90" height="50" style="display: none; top: 4px; left: 20px;"></canvas>
            </lt-div>
          </lt-div>
        </lt-highlighter>
        <p class="u-small-text u-text u-text-variant u-text-1">Estas a punto de comenzar un gran viaje</p>
      </div></footer>
   
  
        </section>>


    </div>
    <!-- fin Viajes -->
    <!-- hoteles -->
    <div class="hotel">
        <span class="closeH">
            <ion-icon name="close"></ion-icon>
        </span>
        <!-- plantilla aqui -->



    </div>
    <!-- fin hotel -->
    <!--
    <h1>Registro</h1>
    <form action="crear_cuenta.php" method="post">

        <input type="text" name="name" value="" placeholder="Nombre(s)..."></p>

        <input type="text" name="surname" value="" placeholder="Apellidos..."></p>

        <input type="text" name="username" value="" placeholder="Nombre de usuario..."></p>

        <input type="password" name="password" value="" placeholder="contrasenia..."></p>

        <input type="email" name="correo" value="" placeholder="Email..."></p>

        <input type="submit" name="create" value="Crear cuenta"></p>

    </form>
    -->
    <script src='./js/scripts.js'></script>
    <script src='./js/navigation.js'></script>
    <script src='./js/jquery-1.9.1.min.js'></script>
    <script src='./js/nicepage.js'></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!--para buscar los iconos usados en la pagina o nuevos ir al url:https://ionic.io/ionicons -->
</body>

</html>