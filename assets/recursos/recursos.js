function ValidNum() {
    //alert(event.keyCode);
    if (event.keyCode < 48 || (event.keyCode > 57 && event.keyCode < 65) || (event.keyCode > 90 && event.keyCode < 97) || event.keyCode > 122 ) {
        event.returnValue = false;
    }
}


function ValidNum2() {
    //alert(event.keyCode);
    if ((event.keyCode < 44 || event.keyCode > 57) && (event.keyCode < 46 || event.keyCode > 46)){
        event.returnValue = false;
    }
}

function format(input)
{
var num = input.value.replace(/\./g,'');
if(!isNaN(num)){
num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
num = num.split('').reverse().join('').replace(/^[\.]/,'');
input.value = num;
}
}


function ComparaFecha(f1, f2){//formato dd-mm-YYYY
    var fecha1 = f1.split("-");
    fecha1 = fecha1[2]+fecha1[1]+fecha1[0];
    
    var fecha2 = f2.split("-");
    fecha2 = fecha2[2]+fecha2[1]+fecha2[0];
    
    if(fecha1 > fecha2){
        return 1;
    }else if(fecha2 > fecha1){
        return 2;
    }else{
        return 0;
    }
}

function ValidaFechasBoleta(recepcion,emision,vencimiento){
    var fecha1 = recepcion;
    var fecha2 = emision;
    var fecha3 = vencimiento;    
        
    var error = 0;
    if(ComparaFecha(fecha1,fecha2) == 2){
        alert("Fecha de emisión debe ser menor a fecha de recepción");
        error = 1;
    }else if(ComparaFecha(fecha1,fecha3) == 1){
        alert("Fecha de vencimiento debe ser mayor a fecha de recepción");
        error = 1;
    }else if(ComparaFecha(fecha2,fecha3) == 1){
        alert("Fecha de vencimiento debe ser mayor a fecha de emisión");
        error = 1;
    }
    
    if(error == 0){
        if (confirm('¿Está seguro de realizar estos cambios?')){ 
            document.form1.submit();
        }else{
            return false;
        }
    }else{
        return false;
    }
}