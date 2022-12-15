<?php
$vt = 0;
if (count($data['items']) > 0) {
    $index = 1;    
    foreach ($data['items'] as $e) {
        ?>
        <tr class="row<?= $index ?>">
            <td><?= $e["nombre"]; ?></td>
            <td><?= $e["valor"]; ?></td>
            <td style="text-align: center;">
                <a href="#items2" onClick="delItem2('<?= $index ?>');">
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
        <?php    
        $vt += $e["valor"];
        $index++;
    }
} else {
    ?>
    <tr><td colspan="2">No hay paradas</td></tr>
<?php
}
?>
<script type="text/javascript">
    //var sobre_tasa_edit = parseFloat($("#sobre_tasa_edit").val());
    //var paradas = parseFloat('<?= $vt ?>');
    //$("#sobre_tasa").val( sobre_tasa_edit + paradas );
    //calcularTotal();
   $("#sobre_tasa_edit").val('<?= $vt ?>');
</script>
