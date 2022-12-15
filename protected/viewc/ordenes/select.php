<select class="form-control select2"  id="id_vehiculo" name="id_vehiculo">
    <option value="0">[Seleccione..]</option>
    <optgroup label="Preferidos">
      
            <?php
            if(isset($data["vehiculos2"])){
            foreach ($data["vehiculos2"] as $vhc) { ?>                
                <option value="<?= $vhc['id'] ?>" data_id_con="<?= $vhc['id_c'] ?>" <?= $data["selected"] == $vhc['id'] ? 'selected="selected"' : '' ?> ><?= $vhc['placa']." - ".$vhc['nombre'] ?></option>
                
            <?php
            }
            }
        
    ?>
    </optgroup>
    <optgroup label="Todos">
    <?php
    if(isset($data["vehiculos"])){
        if(isset($data["selected_cond"])){
            foreach ($data["vehiculos"] as $vhc) { ?>                
                <option value="<?= $vhc['id'] ?>" data_id_con="<?= $vhc['id_c'] ?>" <?= ($data["selected"] == $vhc['id'] && $data["selected_cond"] == $vhc['id_c'] ) ? 'selected="selected"' : '' ?> ><?= $vhc['placa']." - ".$vhc['nombre'] ?></option>
            <?php
            }
        }else{ 
            foreach ($data["vehiculos"] as $vhc) { ?>                
                <option value="<?= $vhc['id'] ?>" data_id_con="<?= $vhc['id_c'] ?>" <?= $data["selected"] == $vhc['id'] ? 'selected="selected"' : '' ?> ><?= $vhc['placa']." - ".$vhc['nombre'] ?></option>
            <?php
            }
        }
    }
    ?>
    </optgroup>
    
</select>