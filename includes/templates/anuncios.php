<?php

use App\Propiedad;


if ($_SERVER['SCRIPT_NAME'] === '/anuncios.php') {
    $propiedades = Propiedad::all();
}else {
    $limite = 3;
    $propiedades = Propiedad::get($limite);
}

?>

<div class="contenedor-anuncios">
    <?php foreach ($propiedades as $propiedad) {?>
        
    <div class="anuncio">
        <img loading="lazy" src="/imagenes/<?php echo $propiedad->imagen ;?>" alt="anuncio">
        <div class="contenido-anuncio">
            <h3><?php echo $propiedad->titulo ;?></h3>
            <p><?php echo $propiedad->descripcion ;?></p>
            <p class="precio">$ <?php echo $propiedad->precio ;?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" src="build/img/icono_wc.svg" alt="icono wc">
                    <p><?php echo $propiedad->wc ;?></p>
                </li>
                <li>
                    <img class="icono" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?php echo $propiedad->estacionamiento ;?></p>
                </li>
                <li>
                    <img class="icono" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                    <p><?php echo $propiedad->habitaciones ;?></p>
                </li>

            </ul>

            <a href="anuncio.php?id=<?php echo $propiedad->id ?>" class="boton btn-amarillo-block">Ver propiedad</a>
        </div> <!--.contenido-anuncio-->
    </div> <!--.anuncio-->
    <?php } ?>
</div>
