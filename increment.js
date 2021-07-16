
var i = 0;
    function buttonClick() {
        var x = parseInt(document.getElementById('inc').value);
        var i = x;
        document.getElementById('inc').value = ++i;
    }



    function autoDecrement(){
        var x = parseInt(document.getElementById('inc').value);
        var m = x;
        document.getElementById('inc').value = --m;
    }