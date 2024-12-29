<?php 

    require 'includes/app.php';
    $db = conectarDB();
    //Autenticar el usuario
    $errores = [];
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if(!$email) {
            $errores[] = "El email es obligatorio o no es válido";
        }
        if(!$password) {
            $errores[] = "El password es obligatorio";
        }

        if(empty($errores)){
            //Revisar si el usuario existe
            $query = "SELECT * FROM usuarios WHERE email = '$email'";
            $resultado = mysqli_query($db, $query);

            if($resultado->num_rows) {
                //Revisar si el passwor es correcto
                $usuario = mysqli_fetch_assoc($resultado);
                //Verificar si el passwor es correcto
                $auth = password_verify($password, $usuario['password']);

                if ($auth) {
                    //El usuario esta autenticado
                    session_start();

                    //Llenar el arreglo de la sesion
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;

                    header('Location: /admin');
                } else {
                    $errores[] = "El password es incorrecto";
                }
            }else {
                $errores[] = "El usuario no existe";
            }
        }

    } 

    
    // //consulta para obtener los datos de la propiedad
    // $query = "SELECT * FROM propiedades WHERE id = $id";

    // $propiedades = mysqli_query($db, $query);

    // if(!$propiedades->num_rows) {
    //     header('Location: /');
    // }
    // $propiedad = mysqli_fetch_assoc($propiedades);

    incluirTemplate('header'); 
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión</h1>
        <?php foreach($errores as $error) {?>
            <div class="alerta error">
                <p><?php echo $error; ?></p>
            </div>
        <?php } ?>
        
        <form class="formulario" method="POST">
            <fieldset>
                <legend>Email y password</legend>

                <label for="email">E-mail</label>
                <input type="email" id="email" placeholder="Tu Email" name="email">

                <label for="password">Teléfono</label>
                <input type="password" id="password" placeholder="Tu password" name="password">
            </fieldset>
            <input type="submit" value="Iniciar Sesión" class="boton btn-verde">
        </form>
        
    </main>
<?php 
    mysqli_close($db);

    incluirTemplate('footer');  
?>