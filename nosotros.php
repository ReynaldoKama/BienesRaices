<?php 
    require 'includes/app.php';
    incluirTemplate('header'); 
?>
    <main class="contenedor section">
        <h1>Conoce Sobre Nosotros</h1>
        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros">
                </picture>
            </div>
            <div class="texto-nosotros">
                <blockquote>25 Años de Experiencia</blockquote>
                <p>Nam bibendum, metus vitae maximus maximus, eros erat convallis turpis, in feugiat sem quam vitae lorem. Maecenas quam nibh, accumsan sit amet convallis vel, euismod quis tellus. Nunc vitae lacinia erat, nec tristique sem. Etiam viverra ex at nisl vestibulum mattis. Fusce et tincidunt orci. Proin aliquet tortor nec lorem molestie, vel suscipit sem tempor. Vestibulum tempus ex at neque tempus semper. Morbi ipsum leo, fringilla non quam at, tincidunt sagittis enim. Fusce aliquet nunc ac massa consectetur pretium. Maecenas facilisis est sit amet consectetur fermentum.</p>
                <p>Maecenas quis rutrum tellus, eget elementum quam. Sed molestie eu tellus sit amet efficitur. Pellentesque blandit erat ac erat aliquam rhoncus. Pellentesque sed lorem ac nisi vestibulum rhoncus vel vel quam. Fusce pharetra urna est, eget mollis tellus semper sed. Praesent ut risus sed risus dapibus vulputate nec ac orci. Donec efficitur felis in nunc pulvinar facilisis. Nam suscipit sit amet elit sodales pretium.</p>
            </div>
        </div>
    </main>
    <section class="contenedor">
        <h1>Mas Sobre Nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Voluptas quisquam ex, libero nam eligendi dignissimos. Nemo voluptate fugit ab nostrum mollitia?</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Voluptas quisquam ex, libero nam eligendi dignissimos. Nemo voluptate fugit ab nostrum mollitia?</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono tiempo" loading="lazy">
                <h3>A Tiempo</h3>
                <p>Voluptas quisquam ex, libero nam eligendi dignissimos. Nemo voluptate fugit ab nostrum mollitia?</p>
            </div>
        </div>
    </section>
<?php 
    incluirTemplate('footer');  
?>