<select class="form-control select2" id="id_vehiculo" name="id_vehiculo">
        <option value="0">[Seleccione..]</option>
        <optgroup label="Preferidos">

            <?php
            if (isset($data["vehiculos2"])) {
                foreach ($data["vehiculos2"] as $vhc) { ?>
                    <option value="<?= $vhc['id'] ?>" data_id_con="<?= $vhc['id_c'] ?>" <?= $data["selected"] == $vhc['id'] ? 'selected="selected"' : '' ?>><?= $vhc['placa'] . " - " . $vhc['nombre'] ?></option>

            <?php
                }
            }

            ?>
        </optgroup>
        <optgroup label="Todos">
            <?php
            if (isset($data["vehiculos"])) {
                if (isset($data["selected_cond"])) {
                    foreach ($data["vehiculos"] as $vhc) { ?>
                        <option dataClase="<?= $vhc['id_clase'] ?>" value="<?= $vhc['id'] ?>" data_id_con="<?= $vhc['id_c'] ?>" <?= ($data["selected"] == $vhc['id'] && $data["selected_cond"] == $vhc['id_c']) ? 'selected="selected"' : '' ?> data-valido="<?= $vhc['estado'] ?>" data-f_soat="<?= $vhc['f_soat'] ?>" data-f_tecnomecanica="<?= $vhc['f_tecnomecanica'] ?>" data-f_contra="<?= $vhc['f_contra'] ?>" data-f_extra="<?= $vhc['f_extra'] ?>" data-f_operacion="<?= $vhc['f_operacion'] ?>">
                            <?= $vhc['placa'] . " - " . $vhc['nombre'] ?>
                        </option>
                    <?php
                    }
                } else {
                    foreach ($data["vehiculos"] as $vhc) { ?>
                        <option dataClase="<?= $vhc['id_clase'] ?>" value="<?= $vhc['id'] ?>" data_id_con="<?= $vhc['id_c'] ?>" <?= $data["selected"] == $vhc['id'] ? 'selected="selected"' : '' ?> data-valido="<?= $vhc['estado'] ?>" data-f_soat="<?= $vhc['f_soat'] ?>" data-f_tecnomecanica="<?= $vhc['f_tecnomecanica'] ?>" data-f_contra="<?= $vhc['f_contra'] ?>" data-f_extra="<?= $vhc['f_extra'] ?>" data-f_operacion="<?= $vhc['f_operacion'] ?>">
                            <?= $vhc['placa'] . " - " . $vhc['nombre'] ?>
                        </option>
            <?php
                    }
                }
            }
            ?>
        </optgroup>

    </select>
