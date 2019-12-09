<div ng-controller="comparadorController" style="padding-left: 5%; padding-right: 5%;">
    <div class="row titulo">
        <p>COMPARADOR DE PRECIOS</p>
    </div>
    <div class="row">
        <div class="col m7 offset-m1 l7 offset-l1 s12">
            <form action="compararProductos" method="POST">
             <fieldset>
               <div class="col m7 l7 s12">
                   <div class="input-field">
                      <input id="txtOpcProducto" name="txtOpcProducto" ng-model="txtOpcProducto" type="text">
                    <label for="txtOpcProducto">Producto: </label>
                    </div>
               </div>
               <div class="col m5 l5 s12" style="text-align: center; vertical-align: middle;padding-top:15px;">
                    <a class="waves-effect waves-light btn modal-trigger" data-target="modalFiltroComp" ng-click="mostrarModalFiltroComp()"><i class="fas fa-plus"></i> Filtros</a>
               </div>
             </fieldset>
            </form>
        </div>
        <div class="col m3 l3 s12" style="padding-top: 20px;text-align: center;">
            <a class="waves-effect waves-light btn modal-trigger" data-target="modalMapComp" ng-click="mostrarModalMapComp()">Ver Mapa</a>
        </div>
    </div>
    <div class="row tbres">
        <table id="getproductoprecio" class="table table-responsive" style="width:100%">
            <thead style="text-align:center">
            <tr>
                <th>N°</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Veterinaria</th>
                <th>Sede</th>
                <th>Dirección</th>
            </tr>
            </thead>
            <tbody>
            <?php
                if(isset($productos)){
                    for($i=0; $i<count($productos); $i++)
                    {
                        $id=$i+1;
                        $nom_prod=$productos[$i]['NO_PRODUCTO'];
                        $precio = $productos[$i]['PR_PRODUCTO'];
                        $nom_vet = $productos[$i]['NOM_VET']; 
                        $direccion = $productos[$i]['DIRECCION'];   
                        $sede = $productos[$i]['NOM_SEDE'];   

                        echo '<tr>';
                        echo '<td class="center">'.$id.'</td>';                        
                        echo '<td class="center">'.$nom_prod.'</td>';
                        echo '<td>'.$precio.'</td>';
                        echo '<td>'.$nom_vet.'</td>';
                        echo '<td>'.$sede.'</td>';
                        echo '<td>'.$direccion.'</td>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- modal ver mapa - Campañas de esterilización -->
    <div id="modalMapComp" class="modal">
        <div class="modal-content sinPadding">
           <!-- Barra de titulo -->
            <div class="row" style="margin-top:5px; margin-bottom: 5px;">
                <div class="col s10">
                    <div class="titulo"><p class="sinMargin">Comparador de Precios</p><a ng-click="mapaOtrosLugares()" class="waves-effect waves-light btn">Otros lugares</a></div>
                    <div class="col s12">
                        <input  id="txtDireccionBusqueda" type="text" placeholder="Ingrese Dirección" style="display:none" ng-keypress='EnterBuscador($event)'>
                    </div> 
                    <div class="divider"></div>
                </div>
                <div class="col s2" style="text-align: right;">
                      <a class="btn-floating btn-mini waves-effect waves-light red modal-close"><i class="material-icons cerrar">close</i></a>                
                </div>
            </div>
            <!-- <div class="row">
                <div class="col s6 offset-s3">
                    <input id="txtFiltroComp" type="text" disabled="" ng-model="txtFiltroComp">
                </div>
            </div> -->
            <div class="row" style="margin-bottom: 0px; width:100%;">
                <div id="map_canvas" style=" height:320px; width:100%; ">

                </div>
            </div>
        </div>
    </div>
<!-- modal filtros - Campañas de esterilización -->
<div id="modalFiltroComp" class="modal">
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
                            <option value="1">Ubicacion actual</option>
                            <option value="2">Ubicacion 2</option>
                            <option value="3">Ubicacion 3</option>
                            <option value="4">Ubicacion 4</option>
                            <option value="5">Ubicacion 5</option>
                        </select>
                      <label for="cmbDistrito" class="active">Mis ubicacion: </label>
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
</div>