//Se crean directivas del modulo angular asignado a la variable js (app)
//Estas directivas, en este caso son para reemplazar determinadas etiquetas de html con el archivo html de las pantallas
app.directive('barraPrincipal',function () { //Si se crea la directiva con el nombre 'barraPrincipal', entonces la etiqueta html que se usará será
                                            // <barra-principal> que será colocada en el index.html
    return{
        restrict:'E',
        templateUrl:'barraPrincipal'
    }
    //esta restricción indica que son templates creo xddd
    //se ingresa la ubicación del archivo html que será reemplazado en la etiqueta html de arriba
});

app.directive('barraPrincipal2',function () { //Si se crea la directiva con el nombre 'barraPrincipal', entonces la etiqueta html que se usará será
                                            // <barra-principal> que será colocada en el index.html
    return{
        restrict:'E',
        templateUrl:'barraPrincipal2'
    }
    //esta restricción indica que son templates creo xddd
    //se ingresa la ubicación del archivo html que será reemplazado en la etiqueta html de arriba
});

app.directive('datosSede',function () { 
    return{
        restrict:'E',
        templateUrl:'datosSede'
    }
});

app.directive('promociones',function () {
    return{
        restrict:'E',
        templateUrl:'promociones'
    }
});

app.directive('campanaEsteril',function () {
    return{
        restrict:'E',
        templateUrl:'campanaEsteril'
    }
});

app.directive('productos',function () {
    return{
        restrict:'E',
        templateUrl:'productos'
    }
});

app.directive('servicios',function () {
    return{
        restrict:'E',
        templateUrl:'servicios'
    }
});


app.directive('comparadorPrecio',function () {
    return{
        restrict:'E',
        templateUrl:'comparadorPrecio'
    }
});

