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
            'INSERT INTO usuario  VALUES (:id_usuario, :correo , :nombre_usuario ,:contrasenia)',
            array(':id_usuario' => $pk_usuario,':correo' => $correo, 'nombre_usuario' => $nombre_usuario, ':contrasenia' => $contrasenia)
        );

        header("Location: index.html");
    }
}



?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Login Giorno</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href='./css/style.css'>
</head>

<body>
    <header>
        <h2 class="logo">Giorno</h2>
        <nav class="navigation">
            <a href="#">Viajes</a>
            <a href="#">Transporte</a>
            <a href="#">Hoteles</a>
            <a href="#">Ofertas</a>
            <button class="btnLogin-popup">Login</button>

        </nav>
    </header>

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
            <form action="crear_cuenta.php" method="post">
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="person"></ion-icon>
                    </span>
                    <input type="text" name="username" required>
                    <label>Usuario</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail"></ion-icon>
                    </span>
                    <input type="text" name="correo" required>
                    <label>Correo</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <input type="password" name="password" required>
                    <label>Contraseña </label>
                </div>
                <div class="remeber-forgot">
                    <label><input type="checkbox">Estoy de acurdo
                        con los terminos</label>

                </div>
                <button type="submit" class="btn" name="create">Registrar</button>
                <div class="login-register">
                    <p>Ya tengo una cuenta <a href="#" class="login-link">Iniciar sesión</a></p>
                </div>
            </form>
        </div>


    </div>
    <!-- Pagina de transporte  -->
    <!-- <div class="wrapper_trnast active-popup">
        <span class="icon-close">
            <ion-icon name="close"></ion-icon>
        </span>

        <div class="form-box login">
            <h2>Transporte</h2>
            <form action="#">
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="bus-outline"></ion-icon>
                        
                    </span>
                    
                    <input type="text" required>
                    <label>Text</label>
                </div>
                <div class="remeber-forgot">
                            <label><input type="checkbox"></label>
                </div>
                
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <input type="password" required>
                    <label>Contraseña </label>
                </div> 
                
                <button type="submit" class="btn">Reservar</button>
                <div class="login-register">
                    <p>No tienes una cuenta? <a href="#" class="register-link">Registrate</a></p> 
                </div>
            </form>
        </div>
    </div> -->

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
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!--para buscar los iconos usados en la pagina o nuevos ir al url:https://ionic.io/ionicons -->
</body>

</html>