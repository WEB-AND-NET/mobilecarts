<?php
$patch = $data['rootUrl'];
$login = $_SESSION['login'];
?>
<!DOCTYPE html>
<html lang="es" manifest="/msgaitan/msgaitan.appcache">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?= C_TITLE; ?></title>

    <!-- Meta -->

    <meta name="author" content="Carlos Meriño Iriarte">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link rel="stylesheet" href="<?= $patch ?>global/admin/css/bootstrap.min.css" />
    <!-- FontAwesome 4.3.0 -->
    <link rel="stylesheet" href="<?= $patch ?>global/admin/font-awesome/css/font-awesome.min.css" />
    <!-- Ionicons 2.0.0 -->
    <link rel="stylesheet" href="<?= $patch ?>global/admin/css/ionicons.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= $patch ?>global/admin/css/AdminLTE.min.css" />

    <link rel="stylesheet" href="<?= $patch ?>global/admin/skins/skin-green.min.css" />

    <!-- iCheck -->
    <link rel="stylesheet" href="<?= $patch ?>global/admin/plugins/iCheck/minimal/green.css" />

    <!-- Date Picker -->
    <link rel="stylesheet" href="<?= $patch ?>global/admin/plugins/datepicker/datepicker3.css" />
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= $patch ?>global/admin/plugins/daterangepicker/daterangepicker-bs3.css" />

    <link rel="stylesheet" href="<?= $patch ?>global/admin/plugins/select2/select2.min.css" />

    <!-- Impletacion CSS para el calendario con hora -->
    <link rel="stylesheet" media="all" href="<?= $patch ?>global/admin/css/jquery-ui-timepicker-addon.css" />

    <!-- Implementacion CSS de las mask (Mascara) -->
    <link rel="stylesheet" href="<?= $patch ?>global/admin/js/jquery-loadmask-0.4/jquery.loadmask.css" />




    <!-- Growl -->
    <link rel="stylesheet" href="<?= $patch ?>global/admin/plugins/jquery.growl/css/jquery.growl.css">

    <!-- CSS Personalizados -->
    <link rel="stylesheet" href="<?= $patch ?>global/admin/css/personalizado.css" />


    <!-- jQuery 2.1.4 -->
    <script type='text/javascript' src="<?= $patch ?>global/admin/js/jquery-2.1.4.min.js"></script>

    <!-- Impletacion JS para el calendario con hora -->
    <script type='text/javascript' src="<?= $patch ?>global/admin/js/jquery-ui/js/jquery-ui-1.9.2.custom.min.js">
    </script>

    <!-- Implementacion JS de las mask (Mascara) -->
    <script type='text/javascript' src='<?= $patch ?>global/admin/js/jquery-loadmask-0.4/jquery.loadmask.min.js'>
    </script>
    <script type='text/javascript' src='<?= $patch ?>global/js/accounting.min.js'></script>

    <!-- Bootstrap 3.3.2 JS -->
    <script type="text/javascript" src="<?= $patch ?>global/admin/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="<?= $patch ?>global/admin/plugins/select2/select2.full.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body class="skin-green sidebar-mini">
    <div class="wrapper">
        <?php $rol = $_SESSION['login']->role;
        $tipo = $_SESSION['login']->tipo; ?>
        <!-- incluyendo la pagina de Header, ubicada en la cabecera -->
        <?php include 'header.php'; ?>
        <!-- Incluyendo La pagina de Menu -->
        <?php include 'menu.php' ?>
        <!-- Contenedor de la pagina -->
        <div class="content-wrapper">
            <section id="section-content" class="content">
                <?php include $data['content']; ?>
                <audio id="player" src="<?= $patch ?>global/silbido.ogg" style="visibility: hidden;"> </audio>
                <!--<a id="button" title="button">Reproducir Sonido</a-->
            </section>
        </div><!-- /.Cierre de todo el contenedor de la pagina -->
        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Asignaci&oacute;n de Servicio</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form">
                            <div class="form-group col-lg-6">
                                <label for="asg_cliente"><span
                                        class="glyphicon glyphicon-user"></span>&nbsp;Cliente</label>
                                <input type="text" class="form-control" id="asg_cliente">
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="asg_direccion"><span
                                        class="fa fa-location-arrow"></span>&nbsp;Direcci&oacute;n </label>
                                <input type="text" class="form-control" id="asg_direccion">
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-lg-6">
                                <label for="asg_origen"><span class="fa fa-map-marker"></span>&nbsp;Origen</label>
                                <input type="text" class="form-control" id="asg_origen">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="asg_destino"><span class="fa fa-map-marker"></span>&nbsp;Destino</label>
                                <input type="text" class="form-control" id="asg_destino" name="destino">
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-lg-6">
                                <label for="asg_clase_vehiculo"><span class="fa fa-car"></span>&nbsp;Tipo
                                    vehiculo</label>
                                <input type="text" class="form-control" id="asg_clase_vehiculo" name="clase_vehiculo">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="asg_conductor"><span class="fa fa-user"></span>&nbsp;Conductores</label>
                                <br />
                                <select class="form-control select2" id="asg_id_conductor"
                                    onchange="cargarConductor(event);">
                                    <option value="">[Seleccione..]</option>
                                    <?php //foreach ($data["conductore"] as $c) { 
                                    ?>
                                    <!-- <option value="<? //= $c->id; 
                                                        ?>"><? //= $c->nombre; 
                                                                            ?></option>-->
                                    <?php //} 
                                    ?>
                                </select>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-lg-6">
                                <label for="asg_identificacion"><span
                                        class="fa fa-sort-numeric-desc"></span>&nbsp;Identificaci&oacute;n</label>
                                <input disabled="disabled" type="text" class="form-control" id="asg_identificacion">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="asg_nombre"><span class="fa fa-text-height"></span>&nbsp;Nombre</label>
                                <input disabled="disabled" type="text" class="form-control" id="asg_nombre">
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-lg-6">
                                <label for="asg_placa"><span class="fa fa-car"></span>&nbsp;Placa</label>
                                <input disabled="disabled" type="text" class="form-control" id="asg_placa">
                            </div>


                        </form>
                        <div class="clearfix"></div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" class="form-control" id="asg_id">
                        <button type="button" class="btn btn-default" data-dismiss="modal"
                            id="btn_cls_asignar_orden">Cerrar</button>
                        <button type="button" class="btn btn-success" id="btn_asignar_orden">Asignar</button>
                    </div>
                </div>

            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="myModal2" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Cancelaci&oacute;n de Servicio</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form">
                            <div class="form-group col-lg-6">
                                <label for="can_cliente"><span
                                        class="glyphicon glyphicon-user"></span>&nbsp;Cliente</label>
                                <input disabled="disabled" type="text" class="form-control" id="can_cliente">
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="can_direccion"><span
                                        class="fa fa-location-arrow"></span>&nbsp;Direcci&oacute;n </label>
                                <input disabled="disabled" type="text" class="form-control" id="can_direccion">
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-lg-6">
                                <label for="can_origen"><span class="fa fa-map-marker"></span>&nbsp;Origen</label>
                                <input disabled="disabled" type="text" class="form-control" id="can_origen">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="can_destino"><span class="fa fa-map-marker"></span>&nbsp;Destino</label>
                                <input disabled="disabled" type="text" class="form-control" id="can_destino">
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-lg-6">
                                <label for="can_clase_vehiculo"><span class="fa fa-car"></span>&nbsp;Tipo
                                    vehiculo</label>
                                <input disabled="disabled" type="text" class="form-control" id="can_clase_vehiculo">
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-lg-6">
                                <label for="can_identificacion"><span
                                        class="fa fa-sort-numeric-desc"></span>&nbsp;Identificaci&oacute;n</label>
                                <input disabled="disabled" type="text" class="form-control" id="can_identificacion">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="can_nombre"><span class="fa fa-text-height"></span>&nbsp;Nombre</label>
                                <input disabled="disabled" type="text" class="form-control" id="can_nombre">
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-lg-6">
                                <label for="can_placa"><span class="fa fa-car"></span>&nbsp;Placa</label>
                                <input disabled="disabled" type="text" class="form-control" id="can_placa">
                            </div>


                        </form>
                        <div class="clearfix"></div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" class="form-control" id="can_id">
                        <button type="button" class="btn btn-default" data-dismiss="modal"
                            id="btn_cls_cancelar_orden">Cerrar</button>
                        <button type="button" class="btn btn-success" id="btn_cancelar_orden">Cancelar</button>
                    </div>
                </div>

            </div>
        </div>
        <!-- incluyendo la pagina de footer -->
        <?php include 'footer.php' ?>
        <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

</body>

</html>


<script>
$(function() {
    $("select.select2:not(#pasajeros)").select2();
});
</script>

<!-- Bootstrap WYSIHTML5 -->
<script type="text/javascript"
    src="<?= $patch ?>global/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<!-- FastClick -->
<script type="text/javascript" src="<?= $patch ?>global/admin/plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= $patch ?>global/admin/js/app.min.js" type="text/javascript"></script>
<!-- Growl -->
<script type="text/javascript" src="<?= $patch ?>global/admin/plugins/jquery.growl/js/jquery.growl.js"></script>

<?php if ($rol == "1" || $tipo == "A") { ?>

<script src="https://www.gstatic.com/firebasejs/5.9.4/firebase.js"></script>
<script>
// Initialize Firebase
var config = {
    apiKey: "AIzaSyAopH5rVL-qVAOyVsLfklXqD8fLo5xQ6TA",
    authDomain: "mobilecar.firebaseapp.com",
    databaseURL: "https://mobilecar.firebaseio.com",
    projectId: "mobilecar",
    storageBucket: "mobilecar.appspot.com",
    messagingSenderId: "117306635516"
};
firebase.initializeApp(config);
</script>
<script type="text/javascript">
$(document).ready(function() {
    loadnotify();
})


function loadnotify() {
    var url = "<?= $patch ?>getdocvencidos";
    $.post(url, function(res) {
        var data = jQuery.parseJSON(res)
        //console.log(data.vencidos)
        dathtml = ""
        dathtml1 = ""

        for (var i = 0; i < data.vencidos.length; i++) {


            dathtml += `<li id="${data.vencidos[i].id}">
                        <a href="<?php echo $patch ?>conductores/documents/${data.vencidos[i].id_conductor}">   
                                   
                            <h4>Conductor: ${data.vencidos[i].conductor}</h4>
                              
                            <p>Documento: ${data.vencidos[i].documento}</p>
                            <p><small><i class="fa fa-clock-o"></i> ${data.vencidos[i].fecha_vencimiento}</small>  </p>
                        </a>
                    </li>`
        }
        if (data.vencidos.length > 0) {
            $("#footer-vencido").html(
                "<a href='<?php echo $patch ?>getdocvencidos/view'>Ver todos los documentos vencidos</a>")
        }

        for (var i = 0; i < data.vehiculos.length; i++) {
            dathtml += `<li id="${data.vehiculos[i].id}">
                        <a href="<?php echo $patch ?>vehiculos/documents/${data.vehiculos[i].id_vehiculo}">   
                                   
                            <h4><b>Vehículo:</b> ${data.vehiculos[i].vehiculo}</h4>                              
                            <p><b>Documento: </b>${data.vehiculos[i].documento}</p>                            
                            <p <b>Propietario:</b>${data.vehiculos[i].nombre_prop}</p>
                            <p><small><i class="fa fa-clock-o"></i> ${data.vehiculos[i].fecha_vencimiento}</small>  </p>
                        </a>
                    </li>`
        }

        for (var i = 0; i < data.nuevoc.length; i++) {

            dathtml1 += "<li><a href='<?php echo $patch ?>conductoresp/openotify/" + data.nuevoc[i].id +
                "' style='cursor:pointer; white-space: normal' id=" + data.nuevoc[i].id + ">" + data.nuevoc[i]
                .mensaje + "<br><p style='width:80%; display:block; text-align:right'>" + data.nuevoc[i].fecha +
                "</p></a></li>";
        }
        if (data.nuevoc.length > 0) {
            $("#footer-conductores").html(
                "<a href='<?php echo $patch ?>conductoresp'>Ver todos los Conductores Inactivos</a>")
        }





        $("#push-conductores-i").html(data.nuevoc.length);
        $("#push-conductores").html(dathtml1);

        $("#push-vencidos-i").html(data.vencidos.length + data.vehiculos.length);
        $("#push-vencidos").html(dathtml);



    });
}


function cargar_asignar(id_orden) {
    console.log(id_orden);
    $.post('<?= $patch ?>ordenes_servicios/cargar_asignar', {
        id_orden: id_orden
    }, function(data) {
        console.log(id_orden);
        console.log(data);
        var o = data.orden;
        $('#asg_cliente').val(o.cliente);
        $('#asg_direccion').val(o.direccion);
        $('#asg_origen').val(o.b_origen);
        $('#asg_destino').val(o.b_destino);
        $('#asg_clase_vehiculo').val(o.clase);
        $('#asg_id_conductor').empty();

        $('#asg_id_conductor').append($('<option>', {
            value: '',
            text: '[Seleccione..]'
        }));
        $.each(data.conductores, function(i, item) {
            $('#asg_id_conductor').append($('<option>', {
                value: item.id,
                text: item.placa + ' - ' + item.nombre,
                data_idv: item.id_v
            }));
        });

    }, 'json');
}

function myFunction(id) {
    $('#asg_id').val(id);
    $('#myModal').modal(null);
    cargar_asignar(id);
}

function cargarConductor(event) {
    $.post('<?= $patch ?>ordenes_servicios/cargar_conductor', {
        id_con: event.target.value,
        id_veh: $("#" + event.target.id + " option:selected").attr("data_idv")
    }, function(data) {
        var c = data.conductor;
        $('#asg_identificacion').val(c.identificacion);
        $('#asg_nombre').val(c.nombre);
        $('#asg_placa').val(c.placa);
    }, 'json');
}

function cleanModal() {
    $('#asg_id').val('');
    $('#asg_cliente').val('');
    $('#asg_direccion').val('');
    $('#asg_origen').val('');
    $('#asg_destino').val('');
    $('#asg_clase_vehiculo').val('');
    $('#asg_id_conductor').empty();
    $('#select2-asg_id_conductor-container').html('');
    $('#asg_identificacion').val('');
    $('#asg_nombre').val('');
    $('#asg_placa').val('');
}

$(function() {

    var count = 0;
    var countCh = 0;
    var countMt = 0;
    var date = null;

    function initializeNotificationsMantenimiento() {
        $.getJSON("<?= $patch ?>mantenimientos/vencimientos", function(data) {

            $("#push-mantenimientos-i").html(data.length);
            if (data.length > 0) {
                countMt = data.length;
                $("#push-mantenimientos-h").html("Mantenimientos vencidos o por vencer: " + data
                .length);

                window.document.title = "<?= C_TITLE; ?> (" + countMt + ")";
            } else
                $("#push-mantenimientos-h").html("Ningun mantenimiento vencido o por vencer");
            var item = '';
            $.each(data, function(key, val) {
                item += `<li>
                        <a href="<?php echo $patch ?>mantenimientos">   
                                   
                            <h4>Vencimiento tipo: ${val.tipo}</h4>
                              
                            <p>Vehicullo: ${val.placa}</p>
                            <p><small><i class="fa fa-clock-o"></i> ${val.proximo}${val.info} </small>  </p>
                            <p><small>${val.descripcion}</small></p>
                        </a>
                        
                    </li>
                    </a>
                    </li>`;



            });
            $("#push-mantenimientos").html(item);
        }).always(function() {
            var intervalNotifications = window.setInterval(updateNotificationsMantenimiento, 100000000);
        });;
    }

    // se inicializa la funcion de la notificacion del checklist
    initializeNotificationsMantenimiento();

    //se crea la funcion para la actualizacion automatica del push de checklist
    function updateNotificationsMantenimiento() {
        var url = "<?= $patch ?>mantenimientos/vencimientos";

        $.getJSON(url, function(data) {
            if (data.length > countMt) {
                countMt = data.length;
                $("#push-mantenimientos-i").html((data.length));
                $("#push-mantenimientos-h").html("Checklist con observaciones: " + data.length);
                $.growl.notice({
                    title: '<?= $login->nombre ?>',
                    message: "Nueva detección de mantenimientos proximos a vencer.",
                    location: "tr"
                });

                window.document.title = "<?= C_TITLE; ?> (" + countMt + ")";

                var item = '';
                $.each(data, function(key, val) {
                    item += `<li id="${val.id}">
                        <a href="<?php echo $patch ?>mantenimientos">   
                                   
                            <h4>Vencimiento tipo: ${val.tipo}</h4>
                            <p>Vehicullo: ${val.placa}</p>
                            <p><small><i class="fa fa-clock-o"></i> ${val.proximo}${val.info} </small>  </p>
                            <p><small>${val.descripcion}</small></p>
                        </a>
                        
                        </li>
                        </a>
                        </li>`;


                });
                $("#push-mantenimientos").html(item);

                document.getElementById('player').play();
            }
        });
    }

    function initializeNotificationsChecklist() {
        $.getJSON("<?= $patch ?>checklist/pendientes", function(data) {

            $("#push-checklist-i").html(data.length);
            if (data.length > 0) {
                countCh = data.length;
                $("#push-checklist-h").html("Checklist con observaciones: " + data.length);

                window.document.title = "<?= C_TITLE; ?> (" + countCh + ")";
            } else
                $("#push-checklist-h").html("Checklist con observaciones: 0");
            var item = '';
            $.each(data, function(key, val) {
                item += `<li id="${val.id}">
                        <a href="<?php echo $patch ?>checklist/openNotify/${val.id}">   
                                   
                            <h4>Conductor: ${val.conductor}</h4>
                              
                            <p>Vehicullo: ${val.placa}</p>
                            <p><small><i class="fa fa-clock-o"></i> ${val.fecha}</small>  </p>
                            <p><small>${val.observaciones}</small></p>
                        </a>
                        
                    </li>
                    </a>
                    </li>`;



            });
            $("#push-checklist").html(item);
        }).always(function() {
            var intervalNotifications = window.setInterval(updateNotificationsCheck, 10000);
        });;
    }

    // se inicializa la funcion de la notificacion del checklist
    initializeNotificationsChecklist();

    //se crea la funcion para la actualizacion automatica del push de checklist
    function updateNotificationsCheck() {
        var url = "<?= $patch ?>checklist/pendientes";

        $.getJSON(url, function(data) {
            if (data.length > countCh) {
                countCh = data.length;
                $("#push-checklist-i").html((data.length));
                $("#push-checklist-h").html("Checklist con observaciones: " + data.length);
                $.growl.notice({
                    title: '<?= $login->nombre ?>',
                    message: "Tienes Checklist con (es) nueva(s).",
                    location: "tr"
                });

                window.document.title = "<?= C_TITLE; ?> (" + countCh + ")";

                var item = '';
                $.each(data, function(key, val) {
                    item += `<li id="${val.id}">
                        <a href="<?php echo $patch ?>checklist/openNotify/${val.id}">   
                                   
                            <h4>Conductor: ${val.conductor}</h4>
                              
                            <p>Vehicullo: ${val.placa}</p>
                            <p><small><i class="fa fa-clock-o"></i> ${val.fecha}</small>  </p>
                            <p><small>${val.observaciones}</small></p>
                        </a>
                        
                        </li>
                        </a>
                        </li>`;


                });
                $("#push-checklist").html(item);

                document.getElementById('player').play();
            }
        });
    }

    function initializeNotifications() {
        $.getJSON("<?= $patch ?>ordenes/pendientes", function(data) {
            $("#push-ordenes-i").html(data.ordenes.length);
            if (data.ordenes.length > 0) {
                count = data.ordenes.length;
                date = data.fecha;
                $("#push-ordenes-h").html("Tienes " + data.ordenes.length + " solicitudes pendientes.");
                //$.growl.notice({title: '<? //= $login->nombre?>', message: text_dia + ", Tienes " + data.ordenes.length + " solicitudes pendientes.", location: "tr"});
                window.document.title = "<?= C_TITLE; ?> (" + count + ")";
            } else
                $("#push-ordenes-h").html("Upps! No hay notificaciones.");
            var item = '';
            $.each(data.ordenes, function(key, val) {
                item += '<li id="lipush' + val.id + '">' +
                    '<a onclick="myFunction(' + val.id + ')" id=' + val.id +
                    ' href="javascript:void(0)">' +
                    '<div class="pull-left">' +
                    '<img src="<?= $patch ?>global/img/users/<?= $login->imagen ?>" class="img-circle" alt="User Image" />' +
                    '</div>' +
                    '<h4>' +
                    val.cliente +
                    '</h4>';

                switch (val.tipo) {
                    case 'T':
                        item += '<p><strong>Origen: </strong> ' + val.barrio_o +
                            ' &nbsp;-&nbsp;&nbsp; <strong>Destino:</strong> ' + val.barrio_d +
                            '</p>';
                        break;
                    case 'D':
                        item += '<p><strong>Horas: </strong> ' + val.nhora + '</p>';
                        break;
                }

                item += '<p>' + val.origen + '</p>' +
                    '</a>' +
                    '</li>';
            });
            $("#push-ordenes").html(item);
        }).always(function() {
            var intervalNotifications = window.setInterval(updateNotifications, 10000);
        });;
    }

    initializeNotifications();

    function updateNotifications() {
        var url = "<?= $patch ?>ordenes/pendientes";
        if (date !== null)
            url += "?time=" + date;

        $.getJSON(url, function(data) {
            if (data.ordenes.length > 0) {
                $("#push-ordenes-i").html((data.ordenes.length + count));
                $("#push-ordenes-h").html("Tienes " + (data.ordenes.length + count) +
                    " solicitudes pendientes.");
                $.growl.notice({
                    title: '<?= $login->nombre ?>',
                    message: "Tienes " + (data.ordenes.length) + " solicitud(es) nueva(s).",
                    location: "tr"
                });
                count += data.ordenes.length;
                window.document.title = "<?= C_TITLE; ?> (" + count + ")";

                var item = '';
                $.each(data.ordenes, function(key, val) {
                    item += '<li id="lipush' + val.id + '">' +
                        '<a onclick="myFunction(' + val.id + ')" id=' + val.id +
                        ' href="javascript:void(0)">' +
                        '<div class="pull-left">' +
                        '<img src="<?= $patch ?>global/img/users/<?= $login->imagen ?>" class="img-circle" alt="User Image" />' +
                        '</div>' +
                        '<h4>' +
                        val.cliente +
                        '</h4>';

                    switch (val.tipo) {
                        case 'T':
                            item += '<p><strong>Origen: </strong> ' + val.barrio_o +
                                ' &nbsp;-&nbsp;&nbsp; <strong>Destino:</strong> ' + val
                                .barrio_d + '</p>';
                            break;
                        case 'D':
                            item += '<p><strong>Horas: </strong> ' + val.nhora + '</p>';
                            break;
                    }

                    item += '<p>' + val.origen + '</p>' +
                        '</a>' +
                        '</li>';
                });
                if (count > 0) {
                    $("#push-ordenes").html(item + $("#push-ordenes").html());
                    document.getElementById('player').play();
                } else
                    $("#push-ordenes").html(item);

                date = data.fecha;
            }
        });
    }

    function asignar_orden() {
        if ($('#asg_id').val() !== "" && $('#asg_id_conductor option:selected').val() !== "") {
            var send = {
                id_ord: $('#asg_id').val(),
                id_con: $('#asg_id_conductor option:selected').val(),
                id_veh: $('#asg_id_conductor option:selected').attr('data_idv')
            };
            console.log(send);
            $.post('<?= $patch ?>ordenes_servicios/save_asignar', send, function(data) {
                console.log(data);
                $('#lipush' + $('#asg_id').val()).remove();
                cleanModal();
                $('#myModal').modal('hide');
                count--;
                $("#push-ordenes-i").html((count));
                $("#push-ordenes-h").html("Tienes " + (count) + " solicitudes pendientes.");
                window.document.title = "<?= C_TITLE; ?> (" + count + ")";;
            });
        } else {
            alert("Conductor es requerido.");
        }
    }

    $('#btn_asignar_orden').click(asignar_orden);

    $('#btn_cls_asignar_orden').click(cleanModal);

});
</script>
<script type="text/javascript">
function cargar_cancelar(id_orden) {
    $.post('<?= $patch ?>ordenes_servicios/cargar_cancelar', {
        id_orden: id_orden
    }, function(data) {
        console.log(data);
        var o = data.orden;
        $('#can_cliente').val(o.cliente);
        $('#can_direccion').val(o.direccion);
        $('#can_origen').val(o.b_origen);
        $('#can_destino').val(o.b_destino);
        $('#can_clase_vehiculo').val(o.clase);
        $('#can_identificacion').val(o.d_identificacion);
        $('#can_nombre').val(o.d_nombre);
        $('#can_placa').val(o.placa);
    }, 'json');
}

function myFunction2(id) {
    $('#can_id').val(id);
    $('#myModal2').modal(null);
    cargar_cancelar(id);
}

function cleanModal2() {
    $('#can_id').val('');
    $('#can_cliente').val('');
    $('#can_direccion').val('');
    $('#can_origen').val('');
    $('#can_destino').val('');
    $('#can_clase_vehiculo').val('');
    $('#can_identificacion').val('');
    $('#can_nombre').val('');
    $('#can_placa').val('');
}

$(function() {

    var count2 = 0;
    var date2 = null;

    function initializeNotifications2() {
        $.getJSON("<?= $patch ?>ordenes/cancelados", function(data) {
            $("#push-cancelados-i").html(data.ordenes.length);
            if (data.ordenes.length > 0) {
                count2 = data.ordenes.length;
                date2 = data.fecha;
                $("#push-cancelados-h").html("Tienes " + data.ordenes.length +
                    " solicitudes canceladas.");
            } else
                $("#push-cancelados-h").html("Upps! No hay Cancelaciones.");
            var item = '';
            $.each(data.ordenes, function(key, val) {
                item += '<li id="lipush' + val.id + '">' +
                    '<a onclick="myFunction2(' + val.id + ')" id=' + val.id +
                    ' href="javascript:void(0)">' +
                    '<div class="pull-left">' +
                    '<img src="<?= $patch ?>global/img/users/<?= $login->imagen ?>" class="img-circle" alt="User Image" />' +
                    '</div>' +
                    '<h4>' +
                    val.cliente +
                    '</h4>';

                switch (val.tipo) {
                    case 'T':
                        item += '<p><strong>Origen: </strong> ' + val.barrio_o +
                            ' &nbsp;-&nbsp;&nbsp; <strong>Destino:</strong> ' + val.barrio_d +
                            '</p>';
                        break;
                    case 'D':
                        item += '<p><strong>Horas: </strong> ' + val.nhora + '</p>';
                        break;
                }

                item += '<p>' + val.origen + '</p>' +
                    '</a>' +
                    '</li>';
            });
            $("#push-cancelados").html(item);
        }).always(function() {
            var intervalNotifications2 = window.setInterval(updateNotifications2, 10000);
        });;
    }

    initializeNotifications2();

    function updateNotifications2() {
        var url = "<?= $patch ?>ordenes/cancelados";
        if (date2 !== null)
            url += "?time=" + date2;

        $.getJSON(url, function(data) {
            if (data.ordenes.length > 0) {
                $("#push-cancelados-i").html((data.ordenes.length + count2));
                $("#push-cancelados-h").html("Tienes " + (data.ordenes.length + count2) +
                    " solicitudes canceladas.");
                $.growl.notice({
                    title: '<?= $login->nombre ?>',
                    message: "Tienes " + (data.ordenes.length) + " solicitud(es) cancelada(s).",
                    location: "tr"
                });
                count2 += data.ordenes.length;

                var item = '';
                $.each(data.ordenes, function(key, val) {
                    item += '<li id="lipush' + val.id + '">' +
                        '<a onclick="myFunction2(' + val.id + ')" id=' + val.id +
                        ' href="javascript:void(0)">' +
                        '<div class="pull-left">' +
                        '<img src="<?= $patch ?>global/img/users/<?= $login->imagen ?>" class="img-circle" alt="User Image" />' +
                        '</div>' +
                        '<h4>' +
                        val.cliente +
                        '</h4>';

                    switch (val.tipo) {
                        case 'T':
                            item += '<p><strong>Origen: </strong> ' + val.barrio_o +
                                ' &nbsp;-&nbsp;&nbsp; <strong>Destino:</strong> ' + val
                                .barrio_d + '</p>';
                            break;
                        case 'D':
                            item += '<p><strong>Horas: </strong> ' + val.nhora + '</p>';
                            break;
                    }

                    item += '<p>' + val.origen + '</p>' +
                        '</a>' +
                        '</li>';
                });
                if (count2 > 0) {
                    $("#push-cancelados").html(item + $("#push-cancelados").html());
                    document.getElementById('player').play();
                } else
                    $("#push-cancelados").html(item);

                date2 = data.fecha;
            }
        });
    }

    function cancelar_orden() {
        var send = {
            id_ord: $('#can_id').val()
        };
        console.log(send);
        $.post('<?= $patch ?>ordenes_servicios/save_cancelar', send, function(data) {
            console.log(data);
            $('#lipush' + $('#can_id').val()).remove();
            cleanModal2();
            $('#myModal2').modal('hide');
            count2--;
            $("#push-cancelados-i").html((count2));
            $("#push-cancelados-h").html("Tienes " + (count2) + " solicitudes canceladas.");
        });
    }

    $('#btn_cancelar_orden').click(cancelar_orden);

    $('#btn_cls_cancelar_orden').click(cleanModal2);

});
</script>
<?php } ?>