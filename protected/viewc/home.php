<!--
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=<?= C_GOOGLE_API_KEY; ?>&callback=initMap">
</script>
-->
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">           
        <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=<?= C_GOOGLE_API_KEY; ?>&v=3.25"></script>
        <script type="text/javascript">
            var posiciones = [];
            var map = null;
            var infowindow = null;
            var numDeltas = 300;
            var delay = 10; //milliseconds

            var mapOptions = {
                zoom: 14,
                center: new google.maps.LatLng(10.406402, -75.495291),
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                panControl: false,
                zoomControl: true,
                mapTypeControl: false,
                scaleControl: false,
                streetViewControl: false,
                overviewMapControl: false,
                draggable: true
            };

            
            function initMap(){
                console.log("Created Map");
                map = new google.maps.Map(document.getElementById('mapa'), mapOptions);
                infowindow = new google.maps.InfoWindow();
            }


            $(document).ready(function(){
                initMap();
                $.post("http://3.19.1.222:8082/api/session",{email:"apps@webandnet.us",password:"c4rt4g3n4"},function(data){
                    console.log(data);
                    ajax('GET','http://3.19.1.222:8082/api/session?token=' + data.token, function(user) {
                        ajax('GET', 'http://3.19.1.222:8082/api/devices', function(devices) {
                            console.log(devices)
                            var socket = new WebSocket('ws://3.19.1.222:8082/api/socket');
                            socket.onopen = function () {
                                setInterval(function() {
                                    if (socket.bufferedAmount == 0)
                                    socket.onmessage=function(data){
                                        if(JSON.parse(data.data).positions != undefined){
                                            var device = devices.find(function (device) { return device.id === JSON.parse(data.data).positions[0].deviceId });
                                            console.log(device)
                                            val = {
                                                    id:	JSON.parse(data.data).positions[0].deviceId,
                                                    nombre:	device.name,
                                                    celular:"3008164136",
                                                    latitud :JSON.parse(data.data).positions[0].latitude,
                                                    longitud:JSON.parse(data.data).positions[0].longitude,
                                                    id_veh:75,
                                                    placa:	"TVC443",
                                                    marca:	"GREAT WALL",
                                                    modelo:"2014",
                                                    user_img:	"http://192.168.5.10:9005/msgaintan/global/img/users/default.jpg"
                                            }

                                            if(posiciones.length==0){
                                                posiciones.push(val)
                                                setPosiciones(posiciones)
                                            }else{
                                                var n = false;
                                                $.each(posiciones, function (index, item) {
                                                    if (val.id === item.id) {
                                                            n = true;
                                                            if (val.latitud !== item.latitud || val.longitud !== item.longitud) {
                                                                item.i=0;
                                                                item.deltaLat = (val.latitud- item.latitud)/numDeltas;
                                                                item.deltaLng = (val.longitud- item.longitud)/numDeltas;
                                                                moveMarker(item);
                                                        }
                                                    }
                                                });
                                                if (!n) {
                                                    //Crear nuevo marcador
                                                    val.marker = newMarker(val);
                                                    var c = posiciones.length;
                                                    posiciones.push(val);
                                                    addClickMarker(val, posiciones);
                                                    //setPosiciones(posiciones)
                                                }
                                            }
                                                    
                                        }                    
                                    }
                                }, 50);
                            };
                        });
                    });
                })
            })
            
           
            var ajax = function (method, url, callback) {
                var xhr = new XMLHttpRequest();
                xhr.withCredentials = true;
                xhr.open(method, url, true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4) {
                        callback(JSON.parse(xhr.responseText));
                    }
                };
                if (method == 'POST') {
                    xhr.setRequestHeader('Content-type', 'application/json');
                }
                xhr.send()
            };
        
            function moveMarker(item){
                item.latitud += item.deltaLat;
                item.longitud += item.deltaLng;
               // console.log(item.nombre + " Nuevas coordenadas Lat = " + item.latitud + " Lng = " + item.longitud);
                var latlng = new google.maps.LatLng(item.latitud, item.longitud);
                item.marker.setPosition(latlng);
                if(item.i !=numDeltas){
                    item.i++;
                    setTimeout(()=>{
                        
                        moveMarker(item)
                    }, delay);
                }else if(item.i==100){
                    item.i=0;

                }
            }
            


         


     
            function setPosiciones(data) {
                posiciones = data;
                paintMarkers();
           
            }

            function getPosiciones() {
                $.post( "<?= $patch ?>conductores/posiciones", function(data) {
                    console.log( "success" );
                    initMap();                 
                },"json")
                  .done(function(data) {
                    console.log( "second success" );
                    //setTimeout(function(){console.log("espero 10 seconds");setPosiciones(data);},10000);
                    setPosiciones(data);                    
                  })
                  .fail(function() {
                    console.log( "error" );
                  })
                  .always(function() {
                    if(map === null){
                        console.log("witch finish");
                        initMap();
                    }
                    console.log( "finished" );
                });
            }

    //   $(getPosiciones());

            //
            // Marker`s
            //

            function paintMarkers() {            
                for (i = 0; i < posiciones.length; i++) {
                    posiciones[i].marker = newMarker(posiciones[i]);                    
                    addClickMarker(posiciones[i], i);
                }
                //google.maps.event.addDomListener(window, 'load', paintMarkers);
            }
            /*origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(32,65),*/
             var markerIcon = {
                url: '<?= $patch . "global/img/car.png" ?>',
                scaledSize: new google.maps.Size(30, 30),
                
                labelOrigin:  new google.maps.Point(15,-5),
              };

            function newMarker(o) {
                return new google.maps.Marker({
                    position: new google.maps.LatLng(o.latitud, o.longitud),
                    map: map,                   
                    title: o.nombre,
                    data: o,
                    icon: markerIcon,
                     animation: google.maps.Animation.DROP,
                     label: {
                        text: o.nombre,
                        color: "#e67e22",
                        fontSize: "8px",
                        border: "5px solid red",
                        fontWeight: "bold"
                        }
                });                
            }

            function addClickMarker(item, i) {
                google.maps.event.addListener(item.marker, 'click', (function (marker, i) {
                    return function () {
                        var contentString = '<div id="content">' +
                                '<div id="siteNotice">' +
                                '</div>' +
                                '<img style="margin-left:35%" class="img-circle" src="' + item.user_img + '" alt="' + item.nombre + '" height="100" width="100"> ' +
                                '<h1 id="firstHeading" style="margin-left:10%" class="firstHeading">' + item.nombre + '</h1>' +
                                '<div id="bodyContent">' +
                                '<p style="margin-left:10%" >' + '<b>Célular: </b>' + item.celular + '<b> Placa: </b>' + item.placa + ' <b>Marca: </b>' + item.marca + ' <b>Modelo: </b>' + item.modelo + '.</p>' +
                                '</div>' +
                                '</div>';

                        infowindow.setContent(contentString);
                        //infowindow.setContent("<h1>" + posiciones[i].nombre + "</h1>");
                        //infowindow.setContent('<div style="top: 9px; position: absolute; left: 15px; width: 227px;" class="gm-style-iw"><div style="display: inline-block; overflow: auto; max-height: 758px; max-width: 654px;"><div class="gm-iw gm-sm" jstcache="0" style="width: 204px;"><div jscontent="i.result.name" class="gm-title" jstcache="1">Colegio Flor del Campo</div><div class="gm-basicinfo" jstcache="0"><div jscontent="i.result.formatted_address" jsdisplay="i.result.formatted_address" class="gm-addr" jstcache="3">Cartagena, Bolívar, Colombia</div><div jsdisplay="web" class="gm-website" jstcache="4" style="display: none;"><a target="_blank" jsvalues=".href:i.result.website" jscontent="web" jstcache="10"></a></div><div jscontent="i.result.formatted_phone_number" jsdisplay="i.result.formatted_phone_number" class="gm-phone" jstcache="5" style="display: none;"></div></div><div jsdisplay="svImg" class="gm-photos" jstcache="2"><span jsvalues=".onclick:svClickFn" jsdisplay="!photoImg" class="gm-wsv" jstcache="6"><img width="204" height="50" jsvalues=".src:svImg" jstcache="11" src="http://cbk0.googleapis.com/cbk?output=thumbnail&amp;cb_client=apiv3&amp;v=4&amp;gl=US&amp;panoid=Ad_HqhWbsAp9yG1ioAzTXQ&amp;yaw=-132.8426814720641&amp;w=204&amp;h=50&amp;thumb=2"><label class="gm-sv-label" jstcache="0">Street View</label></span><span jsvalues=".onclick:svClickFn" jsdisplay="photoImg" class="gm-sv" jstcache="7" style="display: none;"><img width="100" height="50" jsvalues=".src:svImg" jstcache="11"><label class="gm-sv-label" jstcache="0">Street View</label></span><span jsdisplay="photoImg" class="gm-ph" jstcache="8" style="display: none;"><a target="_blank" jsvalues=".href:i.result.url;" jstcache="12"><img width="100" height="50" jsvalues=".src:photoImg" jstcache="14"><label class="gm-ph-label" jstcache="0">Fotos</label></a></span></div><div class="gm-rev" jstcache="0"><span jsdisplay="i.result.rating" jstcache="9"><span jscontent="numRating" class="gm-numeric-rev" jstcache="13">4.0</span><div class="gm-stars-b" jstcache="0"><div jsvalues=".style.width:(65 * i.result.rating / 5) + 'px';" class="gm-stars-f" jstcache="15" style="width: 52px;"></div></div></span><span jstcache="0"><a target="_blank" jsvalues=".href:i.result.url;" jstcache="12" href="https://www.google.com/search?q=Colegio%20Flor%20del%20Campo%20Cartagena%2C%20Bol%C3%ADvar%2C%20Colombia&amp;ludocid=15611134130893330071&amp;rlst=n&amp;client=dist-google-maps-apiv3">más información</a></span></div></div></div></div>');
                        infowindow.open(map, item.marker);
                    };
                })(item.marker, i));
            }

            function updateMarkers() {
                $.getJSON("<?= $patch ?>conductores/posiciones", function (data) {
                    $.each(data, function (key, val) {
                        var n = false;
                        $.each(posiciones, function (index, item) {
                            if (val.id === item.id) {
                                n = true;
                                if (val.latitud !== item.latitud || val.longitud !== item.longitud) {
                                    item.latitud = val.latitud;
                                    item.longitud = val.longitud;
                                    console.log(item.nombre + " Nuevas coordenadas Lat = " + item.latitud + " Lng = " + item.longitud);
                                    item.marker.setPosition(new google.maps.LatLng(item.latitud, item.longitud));  
                                }
                            }
                        });
                        if (!n) {
                            //Crear nuevo marcador
                            val.marker = newMarker(val);
                            var c = posiciones.length;
                            posiciones.push(val);
                            addClickMarker(posiciones[c], c);
                            console.log("newMarker");
                        }
                    });
                });
            }

        </script>        
    </head>
    <body>
        <div style="width : 100%; height:800px" id="mapa"></div>       
    </body>
</html>
<!--
<script type="text/javascript">
    /*
     document.getElementById('mapa').style.height = $( window ).height() - 70;
     alert($( window ).height());
     */

     /*
     //Fórmula Haversine
    var rad = function(x) {
      return x * Math.PI / 180;
    };

    var getDistance = function(p1, p2) {
      var R = 6378137; // Earth's mean radius in meter
      var dLat = rad(p2.lat() - p1.lat());
      var dLong = rad(p2.lng() - p1.lng());
      var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(rad(p1.lat())) * Math.cos(rad(p2.lat())) *
        Math.sin(dLong / 2) * Math.sin(dLong / 2);
      var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
      var d = R * c;
      return d; // returns the distance in meter
    };
    */

    //Para poder ejecutar esta función también necesitaremos un “prototipo” para pasar a radianes.

    /**
    * Prototype para pasar a Radianes
    */
    if(typeof Number.prototype.toRadians === 'undefined'){
      Number.prototype.toRadians = function() {
        return this * Math.PI / 180;
      };
    }

     /**
     * Función para calcular la distancia entre dos puntos.
     *
     * @param lat1 = Latitud del punto de origen
     * @param lat2 = Latitud del punto de destino
     * @param lon1 = Longitud del punto de origen
     * @param lon2 = Longitud del punto de destino
     */
    function calcularDistancia(lat1, lat2, lon1, lon2){
        var R = 6371; // Radio del planeta tierra en km
        var phi1 = lat1.toRadians();
        var phi2 = lat2.toRadians();
        var deltaphi = (lat2-lat1).toRadians();
        var deltalambda = (lon2-lon1).toRadians();

        var a = Math.sin(deltaphi/2) * Math.sin(deltaphi/2) +
                Math.cos(phi1) * Math.cos(phi2) *
                Math.sin(deltalambda/2) * Math.sin(deltalambda/2);
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));

        var d = R * c;
        console.log(" Distance = " + d);
        return d;
    }

    calcularDistancia(10.423567,10.401822,-75.545891,-75.555007);
    calcularDistancia(10.423567,10.399796,-75.545891,-75.522048);

</script>
-->