function ValidNum() {
    //alert(event.keyCode);
    if (event.keyCode < 46 || event.keyCode > 57) {
        event.returnValue = false;
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