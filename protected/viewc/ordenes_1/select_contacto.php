<select class="form-control select2"  id="id_contacto" name="id_contacto" >
    <option value="0">[Seleccione..]</option>
    <?php
    if (isset($data["contacto"])) {
        foreach ($data["contacto"] as $c) {
            ?>
            <option value="<?= $c['id'] ?>" <?= $data["c_selected"] == $c['id'] ? 'selected="selected"' : '' ?>><?= $c['nombre'] ?></option>
    <?php }
} ?>
</select>