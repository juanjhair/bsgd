var bar=app.controller('promoController', function($scope){
  angular.element(document).ready(function () {
		$('.datepicker').datepicker({
                firstDay: true, 
                format: 'dd/mm/yyyy',
                i18n: {
                    cancel: 'Cancelar',
                    done: 'Ok',
                    months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                    monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Set", "Oct", "Nov", "Dic"],
                    weekdays: ["Domingo","Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
                    weekdaysShort: ["Dom","Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
                    weekdaysAbbrev: ["D","L", "M", "M", "J", "V", "S"]
                }
            });
      
        
    }); 
});

var bar=app.controller('productoController', function($scope){
    $scope.agregarproducto=function(){

        var txtNombreProduct=document.getElementById("txtNombreProduct").value;
        var txtPrecio=document.getElementById("txtPrecio").value;
        var numCantidad=document.getElementById("numCantidad").value;
       //ENVIANDO AL CONTROLADOR VETERINARIA PARA REGISTRAR
        $.ajax({
            type: 'POST',
            url: 'registrarProducto',
            data: {
                txtNombreProduct: txtNombreProduct,
                txtPrecio:txtPrecio,
                numCantidad:numCantidad
            },
            dataType : 'json',
            async:true,
            success: function(response) {
                document.getElementById("txtNombreProduct").value="";
                document.getElementById("txtPrecio").value="";
                document.getElementById("numCantidad").value="";
                if(response="registrado correctamente"){
                    swal("Buen trabajo!", "Registrado Correctament!", "success");
                }
               
            }
        });

    }
    $scope.agregarservicio=function(){

        var txtNombreServicio=document.getElementById("txtNombreServicio").value;
        var txtPrecio=document.getElementById("txtPrecio").value;
       //ENVIANDO AL CONTROLADOR VETERINARIA PARA REGISTRAR
        $.ajax({
            type: 'POST',
            url: 'registrarServicio',
            data: {
                txtNombreServicio: txtNombreServicio,
                txtPrecio:txtPrecio
            },
            dataType : 'json',
            async:true,
            success: function(response) {
                document.getElementById("txtPrecio").value="";
                document.getElementById("txtNombreServicio").value="";
                if(response="registrado correctamente"){
                    swal("Buen trabajo!", "Registrado Correctament!", "success");
                }
               
            }
        });

    }
});

var bar=app.controller('barraController', function($scope){
   angular.element(document).ready(function () {
        $('.sidenav').sidenav();
    });
});
var bar=app.controller('comparadorController', function($scope){
   angular.element(document).ready(function () {
       var table = $('#getproductoprecio');
       $scope.infowindow = new google.maps.InfoWindow({});

       $scope.EnterBuscador = function(keyEvent) {
           if (keyEvent.which === 13){
               var direccion=document.getElementById("txtDireccionBusqueda").value;
               document.getElementById("txtDireccionBusqueda").style.display = "none";
               $scope.localizar(direccion);
           }
       }
       
       $scope.localizar=function(direccion) {
           var geocoder = new google.maps.Geocoder();
           $scope.indice=$scope.arr_point.length; //EMPIEZA EN INDICE 1 
           geocoder.geocode({'address': direccion}, function(results, status) {
               if (status === 'OK') {
                   var resultados = results[0].geometry.location,
                       resultados_lat = resultados.lat(),
                       resultados_long = resultados.lng();
                  
                   $scope.map.setCenter(results[0].geometry.location);
                   var marker = new google.maps.Marker({
                       map: $scope.map,
                       position: results[0].geometry.location
                   });
                   if($scope.arr_point.length>0){
                       $scope.arr_point[$scope.indice]=new google.maps.LatLng(resultados.lat(),resultados.lng());// CREACION GEOCERCA DE LA DIRECCION INSERTADA
                       $scope.indice++;
                       $scope.geocerca();
                       $scope.PonerTodos();
                   }
               } else {
                   var mensajeError = "";
                   if (status === "ZERO_RESULTS") {
                       mensajeError = "No hubo resultados para la dirección ingresada.";
                   } else if (status === "OVER_QUERY_LIMIT" || status === "REQUEST_DENIED" || status === "UNKNOWN_ERROR") {
                       mensajeError = "Error general del mapa.";
                   } else if (status === "INVALID_REQUEST") {
                       mensajeError = "Error de la web. Contacte con Name Agency.";
                   }
                   alert(mensajeError);
               }
           });
       }
    $scope.mostrarModalMapComp=function(){
        $('#modalMapComp').modal();
        $scope.mapEst();
        $scope.primero=false; // Para saber si es la primera vez que entra
        $scope.coords=null; //Coordenadas actuales
        $scope.arr_point=[]; // Punto de la cordenada actual
        $scope.arr_point_radios=[]; // Radio de la geocerca
        $scope.global_cityCircle=[]; //Arreglo de geocercas 
        $scope.global_markers=[];
        document.getElementById("txtDireccionBusqueda").style.display = "none";
    }
    $scope.mostrarModalFiltroComp=function(){
        $('#modalFiltroComp').modal();
    }
    $scope.mapaOtrosLugares=function(){
        //$scope.mapEst();
        document.getElementById("txtDireccionBusqueda").style.display = "block";
    }
    // ---------------------------------- MAPA -----------------------------------
    

    $scope.mapEst=function(){ // MAPA CAMPAÑAS ESTERILIZACION
        $scope.posicion();
    }
    $scope.posicion=function(){ //POSICION DE GEOCERCA ACTUAL
        navigator.geolocation.getCurrentPosition(position => {
            $scope.coords = {
                lng: position.coords.longitude,
                lat: position.coords.latitude
                };
                if(!$scope.primero){
                    $scope.initialize(position.coords.latitude,position.coords.longitude);
                }else{
                     $scope.geocerca();
                     $scope.PonerTodos(); 
                }
            
        });
    }
    $scope.initialize=function(lat,lng){
            $scope.primero=true;
            geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(lat,lng);
            var myOptions = {
                center: new google.maps.LatLng(lat,lng),
                zoom: 17,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                streetViewControl: false,
                disableDefaultUI:true
            }
            $scope.map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
            $scope.geocerca();
            $scope.PonerTodos(); 
            
    }
    $scope.geocerca=function(){
        $scope.clearOverlaysGeocerca();
        $scope.arr_point[0]=new google.maps.LatLng($scope.coords.lat,$scope.coords.lng);//POSICION ACTUAL
        var myLatlng = new google.maps.LatLng($scope.coords.lat, $scope.coords.lng);
        iconoposicion = "persona.png";
        imageposicion = {
            url: "assets2/recursos/img/"+iconoposicion,
            scale : 1,
        };
        var marker = new google.maps.Marker({
            map: $scope.map,
            position: myLatlng,
            icon: imageposicion,
        });
        for(var i = 0; i <  $scope.arr_point.length; i++){
            $scope.arr_point_radios[i]=200; //RADIO
            cityCircle = new google.maps.Circle({
                strokeColor: '#FEC584',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: '#FC861E',
                fillOpacity: 0.35,
                map: $scope.map,
                center:  $scope.arr_point[i],
                radius:  $scope.arr_point_radios[i]
            });
            $scope.global_cityCircle[i]=cityCircle;
        }
    }
    $scope.PonerTodos=function(){
        $scope.clearOverlays();
        var todo = new Array(); 
       

        ;
        $.ajax({
            type: 'GET',
            url: 'mostrarProductosAll',
            data:{
                OpcProducto: document.getElementById("txtOpcProducto").value
            },
            dataType : 'json',
            async:true,
            success: function(response) {
                for (var i = 0; i < response.length; i++ ) {
                    var nombre_vet = response[i]["NOM_VET"];
                    var nombre_prod = response[i]["NO_PRODUCTO"];
                    var Latitud = response[i]["LATITUD"] ;
                    var Longitud = response[i]["LONGITUD"];
                    var precio = response[i]["PR_PRODUCTO"];
                    todo[i] = new Array((Latitud), (Longitud),nombre_vet,nombre_prod,precio); 
            
                }
                console.log("todo");
                console.log(todo);
                $scope.addMarker(todo);
            }
        });



    }
    $scope.addMarker=function(markers){
        
            $scope.clearOverlays();
            
            var limites = new google.maps.LatLngBounds();
            var iconoposicion = "";
            var imageposicion;
            var array_markers=[];
            var markers_data=[];
            var myLatlngTEMP;
            var index;
            var array_dentro=[];
            var array_dentro_all=[];
        
            for (var i = 0; i < markers.length; i++) {
                markers_data[i]={
                    lat: parseFloat(markers[i][0]),
                    lng: parseFloat(markers[i][1]),
                    nombre_vet: markers[i][2],
                    nombre_prod: markers[i][3],
                    precio: markers[i][4],
                }
                myLatlngTEMP = new google.maps.LatLng(markers_data[i].lat,markers_data[i].lng);
                array_markers[i]=myLatlngTEMP;
            }
        
            
            for(var i = 0; i < $scope.arr_point.length; i++){
                for(var j = 0; j < array_markers.length; j++){
                    if(google.maps.geometry.spherical.computeDistanceBetween(array_markers[j],$scope.arr_point[i]) <=$scope.arr_point_radios[i]){
                        if(array_dentro.length==0){
                            array_dentro.push(markers_data[j]);
                          
                        }else{
                            index=array_dentro.indexOf(markers_data[j]);
                            if(index==-1){
                                array_dentro.push(markers_data[j]);
                            }
                        }
                    }
                }
            } 
            
            for(var i = 0; i < array_dentro.length; i++){
                iconoposicion = "marcador.png";
                imageposicion = {
                    url: "assets2/recursos/img/"+iconoposicion,
                    scale : 1,
                };
                var myLatlng = new google.maps.LatLng(array_dentro[i].lat, array_dentro[i].lng);
            
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    map: $scope.map,
                    icon: imageposicion,
                    zIndex: (i+1)
                });
                
                var contentString = "<html><body><div><strong>Nombre: </strong>" + array_dentro[i].nombre_vet + "<br><strong>Producto: </strong>" + array_dentro[i].nombre_prod + "<br><strong>Precio: </strong>" + array_dentro[i].precio + "</div></body></html>";;
                marker['infowindow'] = contentString;
                
                limites.extend(marker.position);
                
                $scope.global_markers[i] = marker;
                
                google.maps.event.addListener($scope.global_markers[i], 'click', function() {
                    $scope.infowindow.setContent(this['infowindow']);
                    $scope.infowindow.open($scope.map, this);
                });  
            } 
            for(var i = 0; i < array_dentro.length; i++){
                array_dentro_all.push(array_dentro[i]);
            }
            //map.fitBounds(limites);	 // CENTRAR AUTOMATICAMENTE SEGUN MARCAS
            
    }
   
    $scope.clearOverlays=function(){
        for (var i = 0; i < $scope.global_markers.length; i++ ) {
            $scope.global_markers[i].setMap(null);
        }
        $scope.global_markers.length = 0;
    }
    $scope.clearOverlaysGeocerca=function(){
        for (var i = 0; i < $scope.global_cityCircle.length; i++ ) {
            $scope.global_cityCircle[i].setMap(null);
        }
        $scope.global_cityCircle.length = 0;
    }
    setInterval(function(){
        $scope.geocerca(); 
        $scope.PonerTodos();
            $scope.global_markers=[];
           array_dentro=[];
           array_dentro_all=[];
       
       }, 10000);
    //---------------------------------------------------------------------------------------


       $('.modal').modal({
                dismissible: false, // Modal can be dismissed by clicking outside of the modal
                opacity: .7, // Opacity of modal background
                inDuration: 300, // Transition in duration
      
             outDuration: 200, // Transition out duration
                startingTop: '4%', // Starting top style attribute
                endingTop: '10%', // Ending top style attribute
                preventScrolling: true,
                ready: function (modal, trigger) { // Callback for Modal open. Modal and trigger parameters available.
                    // alert("Ready");
                    //console.log(modal, trigger);
                },
                complete: function () { /*alert('Closed');*/ } // Callback for Modal close
            });
    });
    $scope.fu_obtieneFiltro = function(){
        $scope.txtFiltroComp = $scope.txtOpcProducto;
    }
});
var bar=app.controller('sedeController', function($scope,$http){
   angular.element(document).ready(function () {
        $('.timepicker').timepicker();
        $('.modal').modal({
                dismissible: false, // Modal can be dismissed by clicking outside of the modal
                opacity: .7, // Opacity of modal background
                inDuration: 300, // Transition in duration
                outDuration: 200, // Transition out duration
                startingTop: '4%', // Starting top style attribute
                endingTop: '10%', // Ending top style attribute
                complete: function () { /*alert('Closed');*/ } // Callback for Modal close
            });
    });

    $scope.infowindow = new google.maps.InfoWindow({});

    $scope.EnterBuscador = function(keyEvent) {
        if (keyEvent.which === 13){
            
            var direccion=document.getElementById("txtDireccionBusqueda").value;
            document.getElementById("txtDireccionBusqueda").style.display = "none";
            $scope.localizar(direccion);
            document.getElementById("txtDireccionBusqueda").value="";
            
        }
    }
    $scope.anadirDireccion=function(){
        document.getElementById("txtUbicacion").value = document.getElementById("txtDireccionBusqueda").value;
        document.getElementById("txtDireccionlat").value =$scope.latitud;
        document.getElementById("txtDireccionlng").value = $scope.longitud;
    }
    $scope.localizar=function(direccion) {
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({'address': direccion}, function(results, status) {
            if (status === 'OK') {
                var resultados = results[0].geometry.location,
                    resultados_lat = resultados.lat(),
                    resultados_long = resultados.lng();
               
                $scope.map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: $scope.map,
                    position: results[0].geometry.location
                });
                $scope.Textdireccion(resultados.lat(),resultados.lng());

            } else {
                var mensajeError = "";
                if (status === "ZERO_RESULTS") {
                    mensajeError = "No hubo resultados para la dirección ingresada.";
                } else if (status === "OVER_QUERY_LIMIT" || status === "REQUEST_DENIED" || status === "UNKNOWN_ERROR") {
                    mensajeError = "Error general del mapa.";
                } else if (status === "INVALID_REQUEST") {
                    mensajeError = "Error de la web. Contacte con Name Agency.";
                }
                alert(mensajeError);
            }
        });
    }

    $scope.mostrarModalMapSede=function(){
        $('#modalMapSede').modal();
        $scope.mapSede();
        $scope.primero=false; // Para saber si es la primera vez que entra
        $scope.coords=null; //Coordenadas actuales
    }
    
    $scope.Textdireccion=function(lat,lng){
        var geocoder = new google.maps.Geocoder();
            myLatLng = new google.maps.LatLng({lat: lat, lng: lng}); 
            geocoder.geocode({'latLng': myLatLng}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                var address=results[0]['formatted_address'];
                    document.getElementById("txtDireccionBusqueda").value = address;
                    $scope.latitud=lat;
                    $scope.longitud=lng;
                }
            });
    }
    $scope.mapSede=function(){ // MAPA SEDES
        $scope.posicion();
    }
    $scope.posicion=function(){ //POSICION DE GEOCERCA ACTUAL
        navigator.geolocation.getCurrentPosition(position => {
            $scope.coords = {
                lng: position.coords.longitude,
                lat: position.coords.latitude
                };
            if(!$scope.primero){
                $scope.initialize(position.coords.latitude,position.coords.longitude);
            }else{
                    $scope.geocerca();
            }
            $scope.Textdireccion($scope.coords.lat,$scope.coords.lng);
        });
        
    }
    $scope.initialize=function(lat,lng){
            $scope.primero=true;
            geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(lat,lng);
            var myOptions = {
                center: new google.maps.LatLng(lat,lng),
                zoom: 17,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                streetViewControl: false,
                disableDefaultUI:true
            }
            $scope.map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
            $scope.geocerca();
            
    }
    $scope.geocerca=function(){
        
        var myLatlng = new google.maps.LatLng($scope.coords.lat, $scope.coords.lng);
        iconoposicion = "persona.png";
        imageposicion = {
            url: "assets2/recursos/img/"+iconoposicion,
            scale : 1,
        };
        var marker = new google.maps.Marker({
            map: $scope.map,
            position: myLatlng,
            icon: imageposicion,
        });
        
    }

    $scope.guardarSede=function(){
        var txtVeterinaria=document.getElementById("txtVeterinaria").value;
        var txtSede=document.getElementById("txtSede").value;
        var txtUbicacion=document.getElementById("txtUbicacion").value;
        var txtDireccionlat=document.getElementById("txtDireccionlat").value;
        var txtDireccionlng=document.getElementById("txtDireccionlng").value;
        var cmbHoraIni=document.getElementById("cmbHoraIni").value;
        var cmbHoraFin=document.getElementById("cmbHoraFin").value;txtTelefono
        var txtTelefono=document.getElementById("txtTelefono").value;
       //ENVIANDO AL CONTROLADOR VETERINARIA PARA REGISTRAR
        $.ajax({
            type: 'POST',
            url: 'registrarSede',
            data: {
                txtVeterinaria: txtVeterinaria,
                txtSede:txtSede,
                txtUbicacion:txtUbicacion,
                txtDireccionlat:txtDireccionlat,
                txtDireccionlng:txtDireccionlng,
                cmbHoraIni:cmbHoraIni,
                cmbHoraFin:cmbHoraFin,
                txtTelefono:txtTelefono
            },
            dataType : 'json',
            async:true,
            success: function(response) {
                document.getElementById("txtVeterinaria").value="";
                document.getElementById("txtSede").value="";
                document.getElementById("txtUbicacion").value="";
                document.getElementById("txtDireccionlat").value="";
                document.getElementById("txtDireccionlng").value="";
                document.getElementById("cmbHoraIni").value="";
                document.getElementById("cmbHoraFin").value="";
                document.getElementById("txtTelefono").value="";
                if(response="registrado correctamente"){
                    swal("Buen trabajo!", "Registrado Correctament!", "success");
                }
            }
        });
       
    }



    
});

var bar=app.controller('campanhaController', function($scope){
   angular.element(document).ready(function () {
        
    });
   
        
    $scope.infowindow = new google.maps.InfoWindow({});

    $scope.EnterBuscador = function(keyEvent) {
        if (keyEvent.which === 13){
            
            var direccion=document.getElementById("txtDireccionBusqueda").value;
            document.getElementById("txtDireccionBusqueda").style.display = "none";
            $scope.localizar(direccion);
            document.getElementById("txtDireccionBusqueda").value="";
            
        }
    }

    $scope.localizar=function(direccion) {
        var geocoder = new google.maps.Geocoder();
        $scope.indice=$scope.arr_point.length; //EMPIEZA EN INDICE 1 
        geocoder.geocode({'address': direccion}, function(results, status) {
            if (status === 'OK') {
                var resultados = results[0].geometry.location,
                    resultados_lat = resultados.lat(),
                    resultados_long = resultados.lng();
               
                $scope.map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: $scope.map,
                    position: results[0].geometry.location
                });
                if($scope.arr_point.length>0){
                    $scope.arr_point[$scope.indice]=new google.maps.LatLng(resultados.lat(),resultados.lng());// CREACION GEOCERCA DE LA DIRECCION INSERTADA
                    $scope.indice++;
                    $scope.geocerca();
                    $scope.PonerTodos();
                }
            } else {
                var mensajeError = "";
                if (status === "ZERO_RESULTS") {
                    mensajeError = "No hubo resultados para la dirección ingresada.";
                } else if (status === "OVER_QUERY_LIMIT" || status === "REQUEST_DENIED" || status === "UNKNOWN_ERROR") {
                    mensajeError = "Error general del mapa.";
                } else if (status === "INVALID_REQUEST") {
                    mensajeError = "Error de la web. Contacte con Name Agency.";
                }
                alert(mensajeError);
            }
        });
    }

    $scope.mostrarModalMapEst=function(){
        $('#modalMapEst').modal();
        $scope.mapEst();
        $scope.primero=false; // Para saber si es la primera vez que entra
        $scope.coords=null; //Coordenadas actuales
        $scope.arr_point=[]; // Punto de la cordenada actual
        $scope.arr_point_radios=[]; // Radio de la geocerca
        $scope.global_cityCircle=[]; //Arreglo de geocercas 
        $scope.global_markers=[];
        document.getElementById("txtDireccionBusqueda").style.display = "none";
    }
    $scope.mostrarModalFiltroEst=function(){
        $('#modalFiltroEst').modal();
    }
    $scope.mapaOtrosLugares=function(){
        //$scope.mapEst();
        document.getElementById("txtDireccionBusqueda").style.display = "block";
    }
    // ---------------------------------- MAPA -----------------------------------
    

    $scope.mapEst=function(){ // MAPA CAMPAÑAS ESTERILIZACION
        $scope.posicion();
    }
    $scope.posicion=function(){ //POSICION DE GEOCERCA ACTUAL
        navigator.geolocation.getCurrentPosition(position => {
            $scope.coords = {
                lng: position.coords.longitude,
                lat: position.coords.latitude
                };
                if(!$scope.primero){
                    $scope.initialize(position.coords.latitude,position.coords.longitude);
                }else{
                     $scope.geocerca();
                     $scope.PonerTodos(); 
                }
            
        });
    }
    $scope.initialize=function(lat,lng){
            $scope.primero=true;
            geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(lat,lng);
            var myOptions = {
                center: new google.maps.LatLng(lat,lng),
                zoom: 17,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                streetViewControl: false,
                disableDefaultUI:true
            }
            $scope.map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
            $scope.geocerca();
            $scope.PonerTodos(); 
            
    }
    $scope.geocerca=function(){
        $scope.clearOverlaysGeocerca();
        $scope.arr_point[0]=new google.maps.LatLng($scope.coords.lat,$scope.coords.lng);//POSICION ACTUAL
        var myLatlng = new google.maps.LatLng($scope.coords.lat, $scope.coords.lng);
        iconoposicion = "persona.png";
        imageposicion = {
            url: "assets2/recursos/img/"+iconoposicion,
            scale : 1,
        };
        var marker = new google.maps.Marker({
            map: $scope.map,
            position: myLatlng,
            icon: imageposicion,
        });
        for(var i = 0; i <  $scope.arr_point.length; i++){
            $scope.arr_point_radios[i]=200; //RADIO
            cityCircle = new google.maps.Circle({
                strokeColor: '#FEC584',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: '#FC861E',
                fillOpacity: 0.35,
                map: $scope.map,
                center:  $scope.arr_point[i],
                radius:  $scope.arr_point_radios[i]
            });
            $scope.global_cityCircle[i]=cityCircle;
        }
    }
    $scope.PonerTodos=function(){
        $scope.clearOverlays();
        var todo = new Array(); 
        $.ajax({
            type: 'GET',
            url: 'camapana',
            dataType : 'json',
            async:true,
            success: function(response) {
                for (var i = 0; i < response.length; i++ ) {
                    var nombre = response[i]["NOM_VET"];
                    var Latitud = response[i]["LATITUD"] ;
                    var Longitud = response[i]["LONGITUD"];
                    var precio = response[i]["PR_OFERTA"];
                    todo[i] = new Array((Latitud), (Longitud),nombre,precio); 
            
                }
                $scope.addMarker(todo);
            }
        });


    }
    $scope.addMarker=function(markers){
        
            $scope.clearOverlays();
            
            var limites = new google.maps.LatLngBounds();
            var iconoposicion = "";
            var imageposicion;
            var array_markers=[];
            var markers_data=[];
            var myLatlngTEMP;
            var index;
            var array_dentro=[];
            var array_dentro_all=[];
        
            for (var i = 0; i < markers.length; i++) {
                markers_data[i]={
                    lat: parseFloat(markers[i][0]),
                    lng: parseFloat(markers[i][1]),
                    nombre: markers[i][2],
                    precio: markers[i][3]
                }
                myLatlngTEMP = new google.maps.LatLng(markers_data[i].lat,markers_data[i].lng);
                array_markers[i]=myLatlngTEMP;
            }
        
            
            for(var i = 0; i < $scope.arr_point.length; i++){
                for(var j = 0; j < array_markers.length; j++){
                    if(google.maps.geometry.spherical.computeDistanceBetween(array_markers[j],$scope.arr_point[i]) <=$scope.arr_point_radios[i]){
                        if(array_dentro.length==0){
                            array_dentro.push(markers_data[j]);
                          
                        }else{
                            index=array_dentro.indexOf(markers_data[j]);
                            if(index==-1){
                                array_dentro.push(markers_data[j]);
                            }
                        }
                    }
                }
            } 
            
            for(var i = 0; i < array_dentro.length; i++){
                iconoposicion = "marcador.png";
                imageposicion = {
                    url: "assets2/recursos/img/"+iconoposicion,
                    scale : 1,
                };
                var myLatlng = new google.maps.LatLng(array_dentro[i].lat, array_dentro[i].lng);
            
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    map: $scope.map,
                    icon: imageposicion,
                    zIndex: (i+1)
                });
                
                var contentString = "<html><body><div><strong>Nombre: </strong>" + array_dentro[i].nombre + "</strong><br><strong>Precio: </strong>" + array_dentro[i].precio + "</strong></div></body></html>";
                marker['infowindow'] = contentString;
                
                limites.extend(marker.position);
                
                $scope.global_markers[i] = marker;
                
                google.maps.event.addListener($scope.global_markers[i], 'click', function() {
                    $scope.infowindow.setContent(this['infowindow']);
                    $scope.infowindow.open($scope.map, this);
                });  
            } 
            for(var i = 0; i < array_dentro.length; i++){
                array_dentro_all.push(array_dentro[i]);
            }
            //map.fitBounds(limites);	 // CENTRAR AUTOMATICAMENTE SEGUN MARCAS
            
            
        
    }
    
    $scope.clearOverlays=function(){
        for (var i = 0; i < $scope.global_markers.length; i++ ) {
            $scope.global_markers[i].setMap(null);
        }
        $scope.global_markers.length = 0;
    }
    $scope.clearOverlaysGeocerca=function(){
        for (var i = 0; i < $scope.global_cityCircle.length; i++ ) {
            $scope.global_cityCircle[i].setMap(null);
        }
        $scope.global_cityCircle.length = 0;
    }
    setInterval(function(){
        $scope.geocerca(); 
        $scope.PonerTodos();
            $scope.global_markers=[];
           array_dentro=[];
           array_dentro_all=[];
       
       }, 10000);
    //---------------------------------------------------------------------------------------

    $scope.agregarcampana=function(){

        var txtNombreCampa=document.getElementById("txtNombreCampa").value;
        var txtPrecio=document.getElementById("txtPrecio").value;
        var txtPerIni=document.getElementById("txtPerIni").value;
        var txtPerFin=document.getElementById("txtPerFin").value;
       //ENVIANDO AL CONTROLADOR VETERINARIA PARA REGISTRAR
        $.ajax({
            type: 'POST',
            url: 'registrarCampana',
            data: {
                txtNombreCampa: txtNombreCampa,
                txtPrecio:txtPrecio,
                txtPerIni:txtPerIni,
                txtPerFin:txtPerFin
            },
            dataType : 'json',
            async:true,
            success: function(response) {
                document.getElementById("txtNombreCampa").value="";
                document.getElementById("txtPrecio").value="";
                document.getElementById("txtPerIni").value="";
                document.getElementById("txtPerFin").value="";
                if(response="registrado correctamente"){
                    swal("Buen trabajo!", "Registrado Correctament!", "success");
                }
               
            }
        });

    }
    
});



var controlador = app.controller('MyController',function($scope,$http){
    
    $scope.mostrarBarraVeterinaria=true;
    $scope.mostrarDatosSede=false;
    $scope.mostrarPromociones=false;
    $scope.mostrarProductos=false;
    $scope.mostrarServicios=false;
    
    
    $scope.irDatosSede = function(){
        $scope.mostrarBarraVeterinaria=true;
        $scope.mostrarDatosSede=true;
        $scope.mostrarPromociones=false;
        $scope.mostrarProductos=false;
        $scope.mostrarServicios=false;
    };
    $scope.irPromociones = function(){
        $scope.mostrarBarraVeterinaria=true;
        $scope.mostrarDatosSede=false;
        $scope.mostrarPromociones=true;
        $scope.mostrarProductos=false;
        $scope.mostrarServicios=false;
    };
    
    $scope.irProductos = function(){
        $scope.mostrarBarraVeterinaria=true;
        $scope.mostrarDatosSede=false;
        $scope.mostrarPromociones=false;
        $scope.mostrarProductos=true;
        $scope.mostrarServicios=false;
    }
    
    $scope.irServicios = function(){
        $scope.mostrarBarraVeterinaria=true;
        $scope.mostrarDatosSede=false;
        $scope.mostrarPromociones=false;
        $scope.mostrarProductos=false;
        $scope.mostrarServicios=true;
    }
});
var controlador = app.controller('MyController2',function($scope,$http){                                 
    $scope.mostrarBarraDueno=true;
    $scope.mostrarCampanaEsteril=false;     $scope.mostrarComparadorPrecio=false;
    
    $scope.irCampanaEster = function(){
        $scope.mostrarBarraDueno=true;
        $scope.mostrarCampanaEsteril=true;
        $scope.mostrarComparadorPrecio=false;
    }
    $scope.irComparadorPrecio = function(){
        $scope.mostrarBarraDueno=true;
        $scope.mostrarCampanaEsteril=false;
        $scope.mostrarComparadorPrecio=true;
    }
    
    // CONFIGURACION DE CONEXION

    $scope.config_json = {
        headers : {
            'Content-Type': 'application/json;charset=utf-8;'
        }
    };
    $scope.config_form = {
        headers : {
            'Content-Type': ' application/x-www-form-urlencoded;'
        }
    };


});

//funciones extra sacadas del gugel por si te sirven xdxd
    function soloNumeros(e){
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
            return true;
        return /\d/.test(String.fromCharCode(keynum));
    }

    function soloLetras(e){
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
            return true;
        return !/\d/.test(String.fromCharCode(keynum));
    }