<div ng-controller="sedeController">
    <!-- <div class="row fondoBanner">
        <h1>DATOS DE MI SEDE</h1>
        <p>aksjd hakehda ehdkj haekdjheakj dhak ejdhaekd haekd haekjhfk eheka hfkahfka jehkj h daekh dkaehdkaehd kjaedk jhaekjdh aekj dhkjaeh dad kajhekfh ae khfb gkahfah k</p>
    </div> -->
    <div class="row titulo">
        <p>DATOS DE MI SEDE</p>
    </div>
    <div class="row">
        <div class="col m7 l7 offset-l2 offset-m2 s8 offset-s2">
            <div class="row">
                <div class="col m4 l4 s12"><p class="">VETERINARIA:</p> </div>
                <div class="col m6 l6 s12">
                    <input id="txtVeterinaria" type="text" placeholder="Ingrese Veterinaria"  ng-model="txtVeterinariaIni">
                </div>
            </div>
            <div class="row">
                <div class="col m4 l4 etiqueta s12"><p class="">NOMBRE DE LA SEDE:</p> </div>
                <div class="col m6 l6 s12">
                    <input id="txtSede" type="text" placeholder="Ingrese Sede" ng-model="txtSedeIni">
                </div>
            </div>
            <div class="row">
                <div class="col m4 l4 etiqueta s12"><p class="">TELEFONO:</p> </div>
                <div class="col m6 l6 s12">
                    <input id="txtTelefono" type="text" placeholder="Ingrese Teléfono" ng-model="txtTelefono">
                </div>
            </div>
            <div class="row">
                <div class="col m4 l4 etiqueta s12"><p class="">UBICACIÓN:</p> </div>
                <div class="col m6 l6 s10">
                    <input id="txtUbicacion" type="text" placeholder="Ingrese ubicación de la sede" class="validate">
                    <input  id="txtDireccionlat" type="text" style="display:none">
                    <input  id="txtDireccionlng" type="text" style="display:none">
                </div>
                <div class="col m2 l2 s2"><a class="waves-effect waves-light btn-large btnUbi modal-trigger" data-target="modalMapSede" ng-click="mostrarModalMapSede()"><i class="material-icons">location_on</i></a></div>
            </div>
            <div class="row">
                <div class="col m4 l4 etiqueta s12"><p class="">HORARIO DE ATENCIÓN:</p> </div>
                <div class="col m6 l6 s12">
                    <div class="col s5">
                        <input  id="cmbHoraIni" type="text" class="timepicker">
                    </div>
                    <div class="col s2" style="text-align: center;"><p> - </p></div>
                    <div class="col s5">
                        <input  id="cmbHoraFin" type="text" class="timepicker">
                    </div>
                </div>
            </div>
        </div>
        <div class="col m2 l2 s8 offset-s2" style="text-align: center; padding-top:20px;">
            <a class="waves-effect waves-light btn-large amber darken-1 btnModDatos" ng-click="guardarSede()">Guardar</a>
        </div>
    </div>
    
    <!-- modal ver mapa - datos de la Sede -->
<div id="modalMapSede" class="modal">
    <div class="modal-content sinPadding">
       <!-- Barra de titulo -->
        <div class="row" style="margin-top:5px; margin-bottom: 5px;">
            <div class="col s10">
                <div class="titulo"><p class="sinMargin">Añadir ubicación <a ng-click="anadirDireccion()" class="waves-effect waves-light btn modal-close">Añadir</a></p>
                <div class="col s12">
                        <input  id="txtDireccionBusqueda" type="text" placeholder="Ingrese Dirección" ng-keypress='EnterBuscador($event)'>
                </div> 
                </div>
                <div class="divider"></div>
            </div>
            <div class="col s2" style="text-align: right;">
                  <a class="btn-floating btn-mini waves-effect waves-light red modal-close"><i class="material-icons cerrar">close</i></a>                
            </div>
        </div>
        <div class="row" style="margin-bottom: 0px; width: 100%">
        <div id="map_canvas" style=" height:320px; width:100%; ">

        </div>
        </div>
        
    </div>
</div>
    </div>
    