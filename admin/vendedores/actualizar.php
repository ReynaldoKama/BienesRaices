<?php

require '../../includes/app.php';
use App\Vendedor;
estaAutenticado();

//Validar id válido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id) {
    header('Location: /admin');
}

//Obtener el arreglo desde la bd
$vendedor = Vendedor::find($id);

//Arreglo con mensajes de errores
$errores = Vendedor::getErrores();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Asignar valores
    $args = $_POST['vendedor'];

    //Sincronizar objeto en memoria con lo que el usuario escribió
    $vendedor->sincronizar($args);

    //Validar que no haya campos vacios
    $errores = $vendedor->validar();

    if(empty($errores)) {
        $vendedor->guardar();
    }
}

incluirTemplate('header'); 

?>

<main class="contenedor seccion">
        <h1>Actualizar Vendedor(a)</h1>

        <a href="/admin" class="boton btn-verde">Volver</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo "<p>$error</p>"; ?>
        </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST"> <!--Con o sin method se envia a si misma-->
            
            <?php include '../../includes/templates/formulario_vendedores.php'; ?>

            <input type="submit" value="Guardar cambios" class="boton btn-verde">
        </form>
    </main>

<?php 
    incluirTemplate('footer');
?>