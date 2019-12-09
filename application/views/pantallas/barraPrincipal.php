    <div ng-controller="barraController">
     <nav>
      <div class="nav-wrapper">
        <ul class="left">
            <li><a href="#" data-target="mobile-demo" class="sidenav-trigger" style="display:block;margin: 0;"><i class="material-icons">menu</i></a></li>
        </ul>
        <ul class="right "> <!-- hide-on-med-and-down -->
          <li><a class="navbar-brand" href="#">
                <img src="assets2/recursos/img/bootstrap-solid.svg" width="40" height="40" class="d-inline-block align-top" alt="" style="vertical-align: middle;">
          </a></li>
        </ul>
      </div>
    </nav>
  

  <ul class="sidenav" id="mobile-demo" ng-model="barraLado">
    <li><a href="#" ng-click="irDatosSede()">Datos de la Sede</a></li>
    <li><a href="#" ng-click="irPromociones()">Mis Campañas</a></li>
    <li><a href="#" ng-click="irProductos()">Administrar sede</a></li>
  </ul>
</div>

  
     