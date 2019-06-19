function funcion() { //inicio del
    var elementos_x = [];
    var elementos_x = [6]; //arreglo de datos para los elementos en x
    var elementos_y = [];
    var elementos_y = [7]; //arreglo de datos para los elementos en y
    //var bandera = true; ya no se necesita :v
    var i = 0;
    //extraer elementos del html
    for (i=0;i<elementos_x.length;i++){
        elementos_x[i] = Number(document.getElementById('n${i}',i ).value) ;//obtener elementos
        elementos_y[i] = (elementos_x[i] * 1.0) + 5;

    }
    //imprimir resultados
    document.write('     x    ', ' ------------> ', '    f(x)    <br>')
    for (i = 0; i < elementos_x.length; i++) {
        document.write(elementos_x[i], ' ------------> ', elementos_y[i], '<br>')
    }








}