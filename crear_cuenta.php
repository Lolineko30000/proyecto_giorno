<?php
//C:\xampp\mysql\bin
include('Clases/DB.php');

if(isset($_POST['create'])){

        #Dedinicion de las variables que se introducen en 
        #el formulario por medio del parametro name
        $nombre = $_POST['name'];
        $apellido = $_POST['surname'];
        $nombre_usuario = $_POST['username'];
        $contrasenia = $_POST['password'];
        $correo = $_POST['correo'];
        

            #Comprobacion que el usuario ya exista
        if(DB::query('SELECT nombre_usuario FROM usuario WHERE nombre_usuario = :nombre_usuario', array(':nombre_usuario' => $nombre_usuario ))){
            header ("Location: index.html");
        }
        #Comprobacion del correo electronico
        elseif(DB::query('SELECT correo FROM usuario WHERE correo = :correo', array(':correo' => $correo ))){
            header ("Location: index.html");
        }
        #Tamanio de la contrasena y el nombre de usuario
        elseif ((strlen($nombre_usuario) < 3 || strlen($nombre_usuario) > 40)  && !(preg_match('/[a-zA-Z0-9_]+/', $nombre_usuario))) {
            header ("Location: index.html");
        }elseif (strlen($contrasenia) < 6 || strlen($contrasenia) > 40) {
            header("Location: index.html");
        }
        else{

            #Encriptacion de la contasenioa pk alch estoy aburrido xd
            $contrasenia = password_hash($contrasenia, PASSWORD_BCRYPT );
            $pk_usuario = 1+DB::query('SELECT MAX(id_usuario) AS pkt FROM usuario', array())[0]['pkt'];
            

            DB::query('INSERT INTO usuario  VALUES (:id_usuario, :nombre , :apellido , :correo , :nombre_usuario ,:contrasenia)',
                                            array(':id_usuario'=>$pk_usuario,':nombre'=>$nombre , ':apellido'=>$apellido, ':correo'=>$correo,'nombre_usuario'=>$nombre_usuario,':contrasenia'=>$contrasenia));
            
            header ("Location: index.html");
        }
}

                                                                                                                         
        

?>


<h1>Registro</h1>
<form action= "crear_cuenta.php" method= "post" >

<input type="text" name="name" value="" placeholder="Nombre(s)..."></p>
<input type="text" name="surname" value="" placeholder="Apellidos..."></p>

<input type="text" name="username" value="" placeholder="Nombre de usuario..."></p>

<input type="password" name="password" value="" placeholder="contrasenia..."></p>

<input type="email" name="correo" value="" placeholder="Email..."></p>

<input type="submit" name="create" value="Crear cuenta"></p>

</form>

