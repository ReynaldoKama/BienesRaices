<fieldset>
    <legend>Información general</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" placeholder="Nombre vendedor(a)" name="vendedor[nombre]" value="<?php echo sanitize($vendedor->nombre); ?>">

    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" placeholder="Apellido vendedor(a)" name="vendedor[apellido]" value="<?php echo sanitize($vendedor->apellido); ?>">
</fieldset>

<fieldset>
    <legend>Información de contacto</legend>

    <label for="telefono">Teléfono:</label>
    <input type="tel" id="telefono" placeholder="Teléfono vendedor(a)" name="vendedor[telefono]" value="<?php echo sanitize($vendedor->telefono); ?>">
</fieldset>