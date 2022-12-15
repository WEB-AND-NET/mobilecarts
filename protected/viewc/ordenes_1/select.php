<select class="form-control select2"  id="id_vehiculo" name="id_vehiculo">
    <option value="0">[Seleccione..]</option>
    <?php foreach ($data["vehiculos"] as $vhc) { ?>
    	<option value="<?= $vhc['id'] ?>" <?= $data["selected"] == $vhc['id'] ? 'selected="selected"' : '' ?> ><?= $vhc['placa'] ?></option>
    <?php } ?>
</select>