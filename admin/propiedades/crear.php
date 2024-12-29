<?php 
require '../../includes/app.php';

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;

estaAutenticado();


    $propiedad = new Propiedad;

    //Consulta pra obtener vendedores
    $vendedores = Vendedor::all();

    //Arreglo con mensajes de errores
    $errores = Propiedad::getErrores();

    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        $propiedad = new Propiedad($_POST['propiedad']);

        //Generar nombre único
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

        if ($_FILES['propiedad']['tmp_name']['imagen']) {
            $manager = new Image(Driver::class);
            $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);
            $propiedad->setImagen($nombreImagen);
        }

        $errores = $propiedad->validar();

        if(empty($errores)) {
            //Subida de archivos
            if(!is_dir(CARPETA_IMAGENES)) {
                mkdir(CARPETA_IMAGENES);
            }

            //Guarda la imagen en el servidor
            $imagen->save(CARPETA_IMAGENES . $nombreImagen);

            $propiedad->guardar();
        }        
    }

    incluirTemplate('header'); 
?>
    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/admin" class="boton btn-verde">Volver</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo "<p>$error</p>"; ?>
        </div>
        <?php endforeach; ?>

        <form action="/admin/propiedades/crear.php" class="formulario" method="POST" enctype="multipart/form-data">
            
            <?php include '../../includes/templates/formulario_propiedades.php'; ?>

            <input type="submit" value="Crear Propiedad" class="boton btn-verde">
        </form>
    </main>

<?php 
    incluirTemplate('footer');
?>