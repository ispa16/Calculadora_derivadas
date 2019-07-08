function funcion() { //inicio del
    var elementos_x = [];
    var elementos_x = [7]; //arreglo de datos para los elementos en x
    var elementos_y = [];
    var elementos_y = [7]; //arreglo de datos para los elementos en y
    //var bandera = true; ya no se necesita :v
    var i = 0;
    //extraer elementos del html
    //n0
    elementos_x[0] = Number(document.getElementById('n0',i ).value) ;//obtener elementos
    elementos_y[0] = (elementos_x[0] * 1.0) + 5;//formula de la funcion cambiar no se debe alterar nada dentro del parentesis
    //para que de esa forma calcule decimales, se debe cambiar la formula tambien en los demas  elementos en y  :v
    //n1
    elementos_x[1] = Number(document.getElementById('n1',i ).value) ;//obtener elementos
    elementos_y[1] = (elementos_x[1] * 1.0) + 5;
    //n2
    elementos_x[2] = Number(document.getElementById('n2',i ).value) ;//obtener elementos
    elementos_y[2] = (elementos_x[2] * 1.0) + 5;
    //n3
    elementos_x[3] = 0;
    elementos_y[3] = (elementos_x[3] * 1.0) + 5; //para calcular con 0, esto ya esta preestrablecido 
    //n4
    elementos_x[4] = Number(document.getElementById('n3',i ).value) ;//obtener elementos
    elementos_y[4] = (elementos_x[4] * 1.0) + 5;
    //n5
    elementos_x[5] = Number(document.getElementById('n4',i ).value) ;//obtener elementos
    elementos_y[5] = (elementos_x[5] * 1.0) + 5;
    //n6
    elementos_x[6] = Number(document.getElementById('n5',i ).value) ;//obtener elementos
    elementos_y[6] = (elementos_x[6] * 1.0) + 5;
    
    //imprimir resultados
    document.write('     x    ', ' ------------> ', '    f(x)    <br>');
    for (i = 0; i < elementos_x.length; i++) {
        document.write(elementos_x[i], ' ------------> ', elementos_y[i], '<br>');
    }








}