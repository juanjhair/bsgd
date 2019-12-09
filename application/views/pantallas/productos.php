<div style="padding-left: 5%; padding-right: 5%;" ng-controller="productoController">
        <div class="row titulo">
        <p>ADMINISTRACION DE MI SEDE</p>
    </div>
    <div class="row" ng-controller="promoController">
        <div class="col m5 l5 s12" style="margin-bottom: 15px;">
            <form>
             <fieldset style="padding: 70px 23px;height: 411px;">
              <legend>&nbsp; &nbsp; &nbsp;AÑADIR NUEVO PRODUCTO&nbsp; &nbsp; &nbsp;</legend>
                 <div class="input-field">
                  <input id="txtNombreProduct" type="text">
                  <label for="txtNombreProduct">Nombre de producto </label>
                </div>
                <div>
                     <div class="col m6 input-field" style="padding-left: 0px">
                      <input id="txtPrecio" type="text" >
                      <label for="txtPrecio" style="left: 0rem;">Precio </label>
                    </div>
                    <div class="col m6 input-field">
                      <input id="numCantidad" type="number">
                      <label for="numCantidad">Cantidad </label>
                    </div>                    
                </div>
                <div class="row" style="text-align: center;padding-top: 15px">
                    <a class="waves-effect waves-light btn modal-trigger" ng-click="agregarproducto()">AÑADIR PRODUCTO</a>
                </div>
             </fieldset>
            </form>
        </div>
        <div class="col m7 l7 s12">
           <form>
                <fieldset style="height: 411px;">
                  <legend>&nbsp; &nbsp; &nbsp;MIS PRODUCTOS&nbsp; &nbsp; &nbsp;</legend>
                     <div class="row" style="text-align: center; padding: 15px 0px">
                       <div class="col m6" style="text-align: center;padding-bottom: 15px" >
                           <a class="waves-effect waves-light btn modal-trigger">MODIFICAR PRODUCTO</a>
                       </div>
                       <div class="col m6" style="text-align: center;">
                           <a class="waves-effect waves-light btn modal-trigger">DESHABILITAR PRODUCTO</a>
                       </div>
                    </div>
                    <div class="tbres">
                     <table id="getproductos" class="table table-responsive" style="width:100%">
                    <thead style="text-align:center">
                    <tr>
                        <th>N°</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($productos)){
                                for($i=0; $i<count($productos); $i++)
                                {
                                    $id=$productos[$i]['ID_PRODUCTO'];
                                    $nombre=$productos[$i]['NO_PRODUCTO'];
                                    $precio = $productos[$i]['PR_PRODUCTO'];
                                    $stock = $productos[$i]['STOCK']; 

                                    echo '<tr>';
                                    echo '<td class="center">'.$id.'</td>';                        
                                    echo '<td class="center">'.$nombre.'</td>';
                                    echo '<td>'.$precio.'</td>';
                                    echo '<td>'.$stock.'</td>';
                                }
                            }
                            ?>
                    </tbody></table>                        
                    </div>
                </fieldset>               
           </form>
        </div>        
    </div>
    <div class="row" >
        <div style="text-align: right;">
            <a class="waves-effect waves-light btn modal-trigger" ng-click="irServicios()">IR A SERVICIOS</a>
        </div>
    </div> 
   

</div>
