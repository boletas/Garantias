function ValidNum() {
    if (event.keyCode < 46 || event.keyCode > 57 ) {
        event.returnValue = false;
    }
}