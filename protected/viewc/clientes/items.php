<?php
if (count($data['items']) > 0) {
    $index = 1;
    foreach ($data['items'] as $e) {
        ?>
        <tr class="row<?= $index ?>">
            <td><?= $e["nombreo"]." - ".$e["nombred"]; ?></td>
            <td><?= $e["clase"]; ?></td>
            <td><input id="valor_edit_<?= $index; ?>" value="<?= $e["valor"]; ?>" /></td>
            <td style="text-align: center;">
                <a href="javascript:void(0)" onClick="updateItem('<?= $index ?>');">
                    <i style="font-size: 150%;" class="fa fa-pencil-square-o"></i>
                </a>
            </td>
            <td style="text-align: center;">
                <a href="javascript:void(0)" onClick="delItem('<?= $index ?>');">
                    <i style="font-size: 150%;" class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
        <?php       
        $index++;
    }
} else {
    ?>
    <tr><td colspan="5">No hay tarifas personalizadas</td></tr>
<?php
} 
