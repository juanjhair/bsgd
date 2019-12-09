<div ng-controller="campanhaController" style="padding-left:5%; padding-right: 5%;">
    <div class="row titulo">
        <p>CAMPAÑAS DE ESTERILIZACIÓN</p>
    </div>
    <div class="row">
        <div class="col m3 l3 s12 offset-m3 offset-l3" style="text-align: center;margin-bottom: 5px;">
        <a ng-click="mostrarModalMapEst()" class="waves-effect waves-light btn modal-trigger" data-target="modalMapEst">Ver Mapa</a>
        </div>
        <div class="col m3 l3 s12" style="text-align: center;">
        <a class="waves-effect waves-light btn modal-trigger" ng-click="mostrarModalFiltroEst()" data-target="modalFiltroEst" >Filtro <i class="fas fa-filter"></i></a>
        </div>
    </div>
    <div class="row tbres">
        <table class="table table-responsive">
            <thead>
              <tr>
                  <th>N°</th>
                  <th>Campaña</th>
                  <th>Precio</th>
                  <th>Inicio</th>
                  <th>Fin</th>
                  <th>Veterinaria</th>
              </tr>
            </thead>

            <tbody>
            <?php
                if(isset($campanas)){
                    for($i=0; $i<count($campanas); $i++)
                    {
                        $id=$campanas[$i]['NU_SECUENCIA'];
                        $nombre_prom=$campanas[$i]['NO_PROMOCION'];
                        $precio = $campanas[$i]['PR_OFERTA'];
                        $f_inicio = $campanas[$i]['FE_INICIO']; 
                        $f_fin = $campanas[$i]['FE_FIN'];   
                        $nombre_vet= $campanas[$i]['NOM_VET']; 

                        echo '<tr>';
                        echo '<td class="center">'.$id.'</td>';                        
                        echo '<td class="center">'.$nombre_prom.'</td>';
                        echo '<td>'.$precio.'</td>';
                        echo '<td>'.$f_inicio.'</td>';
                        echo '<td>'.$f_fin.'</td>';
                        echo '<td>'.$nombre_vet.'</td>';
                    }
                }
                ?>
            </tbody>
      </table>
    </div>
        <!-- modal ver mapa - Campañas de esterilización -->
    <div id="modalMapEst" class="modal">
        <div class="modal-content sinPadding">
        <!-- Barra de titulo -->
            <div class="row" style="margin-top:5px; margin-bottom: 5px;">
                <div class="col s10">
                    <div class="titulo"><p class="sinMargin">Campañas de Esterilización <a ng-click="mapaOtrosLugares()" class="waves-effect waves-light btn">Otros lugares</a></p>
                     </div>
                     <div class="col s12">
                        <input  id="txtDireccionBusqueda" type="text" placeholder="Ingrese Dirección" style="display:none" ng-keypress='EnterBuscador($event)'>
                    </div> 
                    <div class="divider"></div>
                </div>
                <div class="col s2" style="text-align: right;">
                    <a class="btn-floating btn-mini waves-effect waves-light red modal-close"><i class="material-icons cerrar">close</i></a>                
                </div>
            </div>
            <div class="row" style="margin-bottom: 0px; width:100%;">
                <div id="map_canvas" style=" height:320px; width:100%; ">

                </div>
            </div>
        </div>
    </div>
</div>




<!-- modal filtros - Campañas de esterilización -->
<div id="modalFiltroEst" class="modal">
    <div class="modal-content sinPadding">
       <!-- Barra de titulo -->
        <div class="row" style="margin-top:5px; margin-bottom: 5px;">
            <div class="col s10">
                <div class="titulo"><p class="sinMargin">Filtros</p></div>
                <div class="divider"></div>
            </div>
            <div class="col s2" style="text-align: right;">
                  <a class="btn-floating btn-mini waves-effect waves-light red modal-close"><i class="material-icons cerrar">close</i></a>                
            </div>
        </div>
        <!-- fin barra titulo -->
        <div class="row rowSinEspacioAbajo">
            <!-- <div class="col m3 offset-m3 l3 offset-l3 s10 offset-s1"><p>Distrito: </p></div> -->
            <div class="col m6 offset-m3 l6 offset-l3 s10 offset-s1">
                <div class="input-field">
                     <select id="cmbDistrito" class="waves-effect waves-light">
                            <option value="-1">Elegir ubicacion</option>
                            <option value="1">Ubicacion Actual</option>
                            <option value="2">Ubicacion 2</option>
                            <option value="3">Ubicacion 3</option>
                            <option value="4">Ubicacion 4</option>
                            <option value="5">Ubicacion 5</option>
                        </select>
                      <label for="cmbDistrito" class="active">Mis ubicaciones: </label>
                </div>
            </div>
        </div>
       <div class="row rowSinEspacioAbajo">
            <!-- <div class="col m3 offset-m3 l3 offset-l3 s10 offset-s1"><p>Veterinaria: </p></div> -->
            <div class="col m6 offset-m3 l6 offset-l3 s10 offset-s1">
                 <div class="input-field">
                  <select id="cmbVeterinaria" class="waves-effect waves-light">
                        <option value="-1">Elegir veterinaria</option>
                        <option value="1">Veterinaria 1</option>
                        <option value="2">Veterinaria 2</option>
                        <option value="3">Veterinaria 3</option>
                        <option value="4">Veterinaria 4</option>
                        <option value="5">Veterinaria 5</option>
                    </select>
                    <label for="cmbVeterinaria" class="active">Veterinaria: </label>
                </div>
            </div>
        </div>
        <div class="row rowSinEspacioAbajo">
            <!-- <div class="col m3 offset-m3 l3 offset-l3 s10 offset-s1"><p>Precio: </p></div> -->
            <div class="col m6 offset-m3 l6 offset-l3 s10 offset-s1">
                <div class="row">
                  <div class="col s5 input-field">
                      <input  id="txtPrecioIni" type="number">
                      <label for="txtPrecioIni" class="active">Precio:  </label>
                  </div>
                  <div class="col s2 input-field" style="text-align: center;"><p>-</p></div>
                  <div class="col s5 input-field">
                       <input  id="txtPrecioFin" type="number">
                  </div>  
                </div>    
            </div>
        </div>
        <div class="row rowSinEspacioAbajo" style="text-align: center;margin-bottom: 30px;">
              <a class="waves-effect waves-light btn">Aplicar</a>
        </div>
    </div>
</div>