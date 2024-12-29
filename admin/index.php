<?php
    require '../includes/app.php';
    estaAutenticado();

    //Importar las clases
    use App\Propiedad;
    use App\Vendedor;

    //Implementar método para obtener las propiedades
    $propiedades = Propiedad::all();
    $vendedores = Vendedor::all();

    //Muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null;

    //Eliminar propiedad
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        //Validar ID
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id) {
            $tipo = $_POST['tipo'];

            if (validarTipoContenido($tipo)){
                if ($tipo === 'vendedor') {
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }else if ($tipo === 'propiedad') {
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }

    //Incluir template
    
    incluirTemplate('header'); 
?>
    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        <?php
            $mensaje = mostrarNotificaciones(intval($resultado));
            if($mensaje) { ?>
                <p class="alerta exito"><?php echo sanitize($mensaje); ?></p>
            <?php }?>

        <a href="/admin/propiedades/crear.php" class="boton btn-verde">Nueva Propiedad</a>
        <a href="/admin/vendedores/crear.php" class="boton btn-verde">Nuevo(a) Vendedor</a>

        <h2>Propiedades</h2>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody> <!-- Mostrar los resultados -->
                <?php foreach($propiedades as $propiedad) {?>
                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td><img src="../imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla"></td>
                    <td>$ <?php echo $propiedad->precio; ?></td>
                    <td>
                        <form action="" method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="btn-rojo-block" value="eliminar"></input>
                        </form>
                        <a class="btn-amarillo-block" href="admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>">Actualizar</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <h2>Vendedores</h2>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody> <!-- Mostrar los resultados -->
                <?php foreach($vendedores as $vendedor) {?>
                <tr>
                    <td><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->nombre . " ". $vendedor->apellido ; ?></td>
                    <td><?php echo $vendedor->telefono; ?></td>
                    <td>
                        <form action="" method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" class="btn-rojo-block" value="eliminar"></input>
                        </form>
                        <a class="btn-amarillo-block" href="admin/vendedores/actualizar.php?id=<?php echo $vendedor->id; ?>">Actualizar</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>

<?php 

    //Cerrar la conexión
    mysqli_close($db);
    incluirTemplate('footer');
?>