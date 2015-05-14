var xmlHttp

function GetXmlHttpObject() {
var xmlHttp = null;
    try {
        xmlHttp = new XMLHttpRequest();
    } catch (e) {
        try {
            xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
    }	
    return xmlHttp;
}

function ListaRut(base_url,idEntidad,name) {
    if (trim(valor) != "" || trim(valor) != 0) {
        document.getElementById("nombre").innerHTML = " Buscando...";
	regAjax = GetXmlHttpObject();
	regAjax.open("POST",base_url+"index.php/boleta_controller/EntidadxId", true);
	
	var url = "idEntidad=" + idEntidad;
        url += "&name=" + name;
	url += "&sid=" + Math.random();
	
	regAjax.onreadystatechange = function() {
	
            if (regAjax.readyState == 4) {
                document.getElementById("razon").innerHTML = "&nbsp;";
		var html = trim(regAjax.responseText);
		document.getElementById('razon').innerHTML = html;
            }
	}
	regAjax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	regAjax.send(url);
    } 
}

function ltrim(str) { 
    for(var k = 0; k < str.length && isWhitespace(str.charAt(k)); k++);
    return str.substring(k, str.length);
}
function rtrim(str) {
    for(var j=str.length-1; j>=0 && isWhitespace(str.charAt(j)) ; j--) ;
    return str.substring(0,j+1);
}
function trim(str) {
    return ltrim(rtrim(str));
}
function isWhitespace(charToCheck) {
    var whitespaceChars = " \t\n\r\f";
    return (whitespaceChars.indexOf(charToCheck) != -1);
}