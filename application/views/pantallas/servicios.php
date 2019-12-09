<div style="padding-left: 5%; padding-right: 5%;" ng-controller="productoController">
        <div class="row titulo">
        <p>ADMINISTRACION DE MI SEDE</p>
    </div>
    <div class="row" ng-controller="promoController">
        <div class="col m5 l5 s12" style="margin-bottom: 15px;">
            <form>
             <fieldset style="padding: 70px 23px;height: 411px;">
              <legend>&nbsp; &nbsp; &nbsp;AÑADIR NUEVO SERVICIO&nbsp; &nbsp; &nbsp;</legend>
                 <div class="input-field">
                  <input id="txtNombreServicio" type="text">
                  <label for="txtNombreServicio">Nombre del servicio </label>
                </div>
                <div class="input-field" style="width: 50%">
                      <input id="txtPrecio" type="text" >
                      <label for="txtPrecio" style="left: 0rem;">Precio </label>
                </div>
                <div class="row" style="text-align: center;padding-top: 15px">
                    <a class="waves-effect waves-light btn modal-trigger" ng-click="agregarservicio()">AÑADIR SERVICIO</a>
                </div>
             </fieldset>
            </form>
        </div>
        <div class="col m7 l7 s12">
           <form>
                <fieldset style="height: 411px;">
                  <legend>&nbsp; &nbsp; &nbsp;MIS SERVICIOS&nbsp; &nbsp; &nbsp;</legend>
                     <div class="row" style="text-align: center; padding: 15px 0px">
                       <div class="col m6" style="text-align: center;padding-bottom: 15px" >
                           <a class="waves-effect waves-light btn modal-trigger">MODIFICAR SERVICIO</a>
                       </div>
                       <div class="col m6" style="text-align: center;">
                           <a class="waves-effect waves-light btn modal-trigger">DESHABILITAR SERVICIO</a>
                       </div>
                    </div>
                    <div class="tbres">
                     <table id="getproductos" class="table table-responsive" style="width:100%">
                    <thead style="text-align:center">
                    <tr>
                        <th>N°</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        if(isset($servicios)){
                            for($i=0; $i<count($servicios); $i++)
                            {
                                $id=$servicios[$i]['ID_SERVICIO'];
                                $nombre=$servicios[$i]['NO_SERVICIO'];
                                $precio = $servicios[$i]['PR_SERVICIO'];  

                                echo '<tr>';
                                echo '<td class="center">'.$id.'</td>';                        
                                echo '<td class="center">'.$nombre.'</td>';
                                echo '<td>'.$precio.'</td>';
                            }
                        }
                        ?>
                    </tbody>
                </table>                        
                    </div>
                </fieldset>               
           </form>
        </div>        
    </div>
    <div class="row" >
        <div style="text-align: right;">
            <a class="waves-effect waves-light btn modal-trigger" ng-click="irProductos()">IR A PRODUCTOS</a>
        </div>
    </div> 
   

</div>
