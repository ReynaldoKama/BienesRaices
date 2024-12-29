<?php 
include 'includes/app.php';
use App\Propiedad;

    $id = $_GET['id'];
    if(!filter_var($id, FILTER_VALIDATE_INT)) {
        header('Location: /');
    }

    $propiedad = Propiedad::find($id);

    incluirTemplate('header'); 
?>

    <main class="contenedor contenido-centrado">
        <h1><?php echo $propiedad->titulo; ?></h1>
        <div class="imagen-anuncio">
            <img loading="lazy" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="anuncio">
        </div>
        <div class="resumen-propiedad">
            <p class="precio">$ <?php echo $propiedad->precio; ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" src="build/img/icono_wc.svg" alt="icono wc">
                    <p><?php echo $propiedad->wc; ?></p>
                </li>
                <li>
                    <img class="icono" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?php echo $propiedad->estacionamiento; ?></p>
                </li>
                <li>
                    <img class="icono" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                    <p><?php echo $propiedad->habitaciones; ?></p>
                </li>
            </ul>
            <p>Integer ullamcorper egestas sollicitudin. Fusce libero urna, elementum ut mattis ut, vehicula vel arcu. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum mollis, urna ut elementum laoreet, nunc neque cursus augue, a vehicula neque nisi ac tortor. Aenean tempus fringilla maximus. Suspendisse potenti. Pellentesque tincidunt orci a vestibulum pretium. Vivamus pretium aliquet scelerisque. Pellentesque finibus ipsum non sem tristique, quis dignissim est venenatis. Sed et libero pharetra ante vehicula aliquet.
            </p>
            <p>Sed quis tempus augue. Aenean vitae libero suscipit, volutpat tellus in, varius turpis. Duis quis sem turpis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam a nisi aliquet, consequat odio sit amet, iaculis felis. Aliquam lacinia varius metus, nec iaculis turpis aliquam ac. Vivamus nunc lectus, eleifend at accumsan eget, hendrerit a urna. Fusce laoreet eleifend sem, hendrerit pellentesque lacus vehicula quis. </p>
        </div> <!--.contenido-anuncio-->
        
        
    </main>
<?php 

    incluirTemplate('footer');  
?>