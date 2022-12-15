<?php
if (count($data['items']) > 0) {
    $index = 1;
    foreach ($data['items'] as $e) {
        ?>
        <tr class="row<?= $index ?>">
            <td><?= $e["placa"]; ?></td>
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
    <tr><td colspan="2">No hay vehiculos</td></tr>
<?php
} 
