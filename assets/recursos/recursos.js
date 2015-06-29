function ValidNum() {
    if (event.keyCode < 46 || event.keyCode > 57 ) {
        event.returnValue = false;
    }
}

function ComparaFecha(fecha1, fecha2){//formato dd-mm-YYYY
    fecha1 = fecha1.split("-");
    fecha1 = fecha1[2]+fecha1[1]+fecha1[0];
    
    fecha2 = fecha2.split("-");
    fecha2 = fecha2[2]+fecha2[1]+fecha2[0];
    
    if(fecha1 > fecha2){
        return 1;
    }else if(fecha2 > fecha1){
        return 2;
    }else{
        return 0;
    }
}