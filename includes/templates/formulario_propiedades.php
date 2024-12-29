

<fieldset>
    <legend>Información general</legend>

    <label for="titulo">Título:</label>
    <input type="text" id="titulo" placeholder="Título Propiedad" name="propiedad[titulo]" value="<?php echo sanitize($propiedad->titulo); ?>">

    <label for="precio">Precio:</label>
    <input type="number" id="precio" placeholder="Precio Propiedad" name="propiedad[precio]" value="<?php echo sanitize($propiedad->precio); ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]">
    <?php if($propiedad->imagen) {?>
        <img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-small">
    <?php }?>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="propiedad[descripcion]"><?php echo sanitize($propiedad->descripcion); ?></textarea>
</fieldset>

<fieldset>
    <legend>Información de la propiedad</legend>

    <label for="habitaciones">Habitaciones:</label>
    <input type="number" id="habitaciones" placeholder="Ej. 3" name="propiedad[habitaciones]" min="1" max="9" value="<?php echo sanitize($propiedad->habitaciones); ?>">

    <label for="wc">Baños:</label>
    <input type="number" id="wc" placeholder="Ej. 2" name="propiedad[wc]" min="1" max="9" value="<?php echo sanitize($propiedad->wc); ?>">

    <label for="estacionamiento">Estacionamiento:</label>
    <input type="number" id="estacionamiento" placeholder="Ej. 2" name="propiedad[estacionamiento]" min="1" max="9" value="<?php echo sanitize($propiedad->estacionamiento); ?>">
</fieldset>
<fieldset>
    <legend>Vendedor</legend>
    <label for="vendedor">Vendedor</label>
    <select name="propiedad[vendedores_id]" id="vendedor">
        <option value="">-- Seleccione --</option>
        <?php foreach($vendedores as $vendedor): ?>
            <option <?php echo $propiedad->vendedores_id === $vendedor->id ? 'selected' : ''; ?> value="<?php echo sanitize($vendedor->id); ?>"><?php echo sanitize($vendedor->nombre) . " " . sanitize($vendedor->apellido); ?></option>
        <?php endforeach; ?>
    </select>


</fieldset>