<?php

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;

    require '../../includes/app.php';
    estaAutenticado();

    //id válido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header('Location: /admin');
    }

    //consulta para obtener los datos de la propiedad
    
    $propiedad = Propiedad::find($id);


    //Consulta para obtener vendedores
    $vendedores = Vendedor::all();

    //Arreglo con mensajes de errores
    $errores = Propiedad::getErrores();


    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        //Asignar los atributos
        $args = $_POST['propiedad'];

        $propiedad->sincronizar($args);

        //Validación
        $errores = $propiedad->validar();

        //Generar nombre único
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

        //Subida de archivos

        if ($_FILES['propiedad']['tmp_name']['imagen']) {
            $manager = new Image(Driver::class);
            $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);
            $propiedad->setImagen($nombreImagen);
        }
        // $imagen = $_FILES['imagen'];

        if(empty($errores)) {
            //Almacenar la imagen
            if ($_FILES['propiedad']['tmp_name']['imagen']){
                $imagen->save(CARPETA_IMAGENES . $nombreImagen);
            }
            $propiedad->guardar();
        }

        
    }


    incluirTemplate('header'); 
?>
    <main class="contenedor seccion">
        <h1>Actualizar propiedad</h1>

        <a href="/admin" class="boton btn-verde">Volver</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo "<p>$error</p>"; ?>
        </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" enctype="multipart/form-data">

            <?php include '../../includes/templates/formulario_propiedades.php'; ?>

            <input type="submit" value="Actualizar Propiedad" class="boton btn-verde">
        </form>
    </main>

<?php 
    incluirTemplate('footer');
?>