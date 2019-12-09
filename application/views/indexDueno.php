<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="assets2/recursos/materialize/css/materialize.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="assets2/recursos/css/style.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="assets2/recursos/fontawesome/css/all.css"  media="screen,projection"/>
      
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Dueño</title>
</head>
<body ng-app="aplicacion">

  <div ng-controller="MyController2">
      <barra-principal2 ng-if="mostrarBarraDueno"></barra-principal2>
      <campana-esteril ng-if="mostrarCampanaEsteril"></campana-esteril>
      <comparador-precio ng-if="mostrarComparadorPrecio"></comparador-precio>
  </div>
  
  <!--JavaScript at end of body for optimized loading-->
     <!-- Si no funcionan los js de aca, ponerlos en el head xdxdd -->
      <script type="text/javascript" src="assets2/recursos/jquery/jquery-3.4.1.js"></script>
      <script type="text/javascript" src="assets2/recursos/angularJS/angular-v1.7.8.js"></script>
      <script type="text/javascript" src="assets2/recursos/materialize/js/materialize.min.js"></script>
      <script src="assets2/js/app.js" ></script>
      <script src="assets2/js/directive.js" ></script>
      <script src="assets2/js/controller.js" ></script>
      <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8wLGS5CZVS0QpvEY3PuWPkOFDxC0rvno&libraries=geometry">
</script>
      
      
</body>
</html>