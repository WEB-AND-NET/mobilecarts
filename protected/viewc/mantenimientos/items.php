<?php
if (count($data['mttact']) > 0) {
    $index = 1;
    foreach ($data['mttact'] as $e) {
?>
        <tr class="row<?= $index ?>">
            <td><?= $e["nombre"]; ?></td>
            <td><?= $e["anotacion"]; ?></td>
            <td><?= $e["costo"]; ?></td>

            <td style="text-align: center;">
                <a href="#items" onClick="delItem('<?= $index ?>');">
                    <i class="fa fa-trash"></i>
                </a>
            </td>

        </tr>

    <?php
        $index++;
    }
} else {
    ?>
    <tr>
        <td colspan="5">No hay actividades</td>
    </tr>
<?php
}
?>