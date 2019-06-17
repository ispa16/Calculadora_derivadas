var elementos_x = [];
var elementos_x = [7];
var elementos_y = [];
var elementos_y = [7];
var bandera = true;
var i = 0 ;
while (bandera == true){
    elementos_x [i] = prompt('Ingrese el elemento en x','');
    elementos_y [i] = (elementos_x[i]*1.0)+5;


    i=i+1;
    var decision = prompt('desea ingresar otro elemento?','')
    if (decision == 'no'){
        bandera = false;
    }
}
//cal
document.write('     x    ',' ------------> ','    f(x)    <br>')
for (i=0;i<elementos_x.length;i++){
    document.write(elementos_x[i],' ------------> ',elementos_y[i],'<br>')
}










