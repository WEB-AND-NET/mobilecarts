<select class="form-control select2"  id="id_contrato" name="id_contrato" class="select">
    <option value="">[Seleccione..]</option>
    <?php foreach ($data["clientes"] as $rt) { ?>
    	<option  value="<?= $rt['id_contrato'] ?>" <?= $data["selected"] == $rt['id_contrato'] ? 'selected="selected"' : '' ?> ><?= $rt['cliente'] ?></option>
    <?php } ?>
</select>