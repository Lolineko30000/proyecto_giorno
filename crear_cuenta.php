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
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!--para buscar los iconos usados en la pagina o nuevos ir al url:https://ionic.io/ionicons -->
</body>

</html>