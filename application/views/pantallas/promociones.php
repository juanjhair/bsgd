
<div style="padding-left: 5%; padding-right: 5%;" ng-controller="campanhaController">
        <div class="row titulo">
        <p>CAMPAÑAS DE TEMPORADA</p>
    </div>
    <div class="row" ng-controller="promoController">
        <div class="col m5 l5 s12" style="margin-bottom: 15px;">
            <form>
             <fieldset style="padding: 40px 23px;height: 410px;">
              <legend>&nbsp; &nbsp; &nbsp;AÑADIR NUEVO CAMPAÑA&nbsp; &nbsp; &nbsp;</legend>
                 <div class="input-field">
                  <input id="txtNombreCampa" type="text">
                  <label for="txtNombreCampa">Nombre de campaña </label>
                </div>
               
                     <div class="input-field" style="padding-left: 0px">
                      <input id="txtPrecio" type="text" >
                      <label for="txtPrecio" style="left: 0rem;">Precio </label>
                    </div>
                   <div class=" row">
                      <div class="col s5 input-field">
                          <input id="txtPerIni" type="text" placeholder=" " class="datepicker">
                          <label for="txtPerIni" class="active">Periodo </label>
                      </div>
                      <div class="col s2 input-field" style="text-align: center;"><p>-</p></div>
                      <div class="col s5 input-field">
                           <input id="txtPerFin" type="text" class="datepicker">
                      </div>
                    </div>                 
                
                <div class="row" style="text-align: center;">
                    <a class="waves-effect waves-light btn modal-trigger" ng-click="agregarcampana()">AÑADIR CAMPAÑA</a>
                </div>
             </fieldset>
            </form>
        </div>
        <div class="col m7 l7 s12">
           <form>
                <fieldset style="height: 410px;">
                  <legend>&nbsp; &nbsp; &nbsp;MIS CAMPAÑAS&nbsp; &nbsp; &nbsp;</legend>
                     <div class="row" style="text-align: center; padding: 15px 0px">
                       <div class="col m6" style="text-align: center;padding-bottom: 15px" >
                           <a class="waves-effect waves-light btn modal-trigger">MODIFICAR CAMPAÑA</a>
                       </div>
                       <div class="col m6" style="text-align: center;">
                           <a class="waves-effect waves-light btn modal-trigger">DESHABILITAR CAMPAÑA</a>
                       </div>
                    </div>
                    <div class="tbres">
                     <table id="getcampanas" class="table table-responsive" style="width:100%">
                    <thead style="text-align:center">
                    <tr>
                        <th>N°</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Fecha_ini</th>
                        <th>Fecha_fin</th>
                    </tr>
                    </thead>
                        <tbody>
                        <?php
                            if(isset($campanas)){
                                for($i=0; $i<count($campanas); $i++)
                                {
                                    $id=$campanas[$i]['NU_SECUENCIA'];
                                    $nombre=$campanas[$i]['NO_PROMOCION'];
                                    $precio = $campanas[$i]['PR_OFERTA'];
                                    $f_inicio = $campanas[$i]['FE_INICIO']; 
                                    $f_fin = $campanas[$i]['FE_FIN'];   

                                    echo '<tr>';
                                    echo '<td class="center">'.$id.'</td>';                        
                                    echo '<td class="center">'.$nombre.'</td>';
                                    echo '<td>'.$precio.'</td>';
                                    echo '<td>'.$f_inicio.'</td>';
                                    echo '<td>'.$f_fin.'</td>';
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
</div>