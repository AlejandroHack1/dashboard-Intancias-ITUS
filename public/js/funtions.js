/**
 * Created by ECF9743A on 29/05/20.
 */


//reload toda la pagina
$(document).ready(function () {
    setTimeout(refrescar, 300000);


    $("#sRst").click(function () {
        refreshPartial("rstservice","S","sRst");

    });

    $("#sData").click(function () {
        refreshPartial("data","S","sData");
    });

    $("#xRst").click(function () {
        refreshPartial("rstservice","X","xRst");
    });

    $("#relaciones").click(function () {
        refreshPartial("messageerror","All","relaciones");
    });

    $("#desconocido").click(function () {
        refreshPartial("transactions","Upss","desconocido");
    });



});
function refrescar() {
    location.reload();
}

function refreshPartial(modelo, estado, idVisible) {
    var metodo = "";
    var metodo2 = "";
    switch(estado) {
        case "S":
            metodo='getCountData/S';
            metodo2='getFechainByStatus/S';
            break;
        case "X":
            metodo='getCountData/X';
            metodo2='getFechainByStatus/X';
            break;
        case "Upss":
            metodo='getUpss';
            metodo2='getLastByFechain';
            break;
        default:
            metodo='getCountDataAll';
            metodo2='getLastByFechain';
            break;
    }

    var url= "API/" + modelo + "/" + metodo;
    console.log(url);
    $.get( url, function( data ) {
        if(data>0){
            $( "#"+idVisible+"Table").removeClass( "hide" );
            $( "#"+idVisible+"Table").addClass( "show" );
            $( "#"+idVisible+"Table1").removeClass( "hide" );
            $( "#"+idVisible+"Table1").addClass( "show" );
            $( "#"+idVisible+"Color").css({'color':'#DF0101'});
            $( "#"+idVisible+"TableCnt").html(data);
            refreshPartialTable(modelo, metodo2, idVisible);
        }else{
            $( "#"+idVisible+"Table").removeClass( "show" );
            $( "#"+idVisible+"Table").addClass( "hide" );
            $( "#"+idVisible+"Table1").removeClass( "show" );
            $( "#"+idVisible+"Table1").addClass( "hide" );
            $( "#"+idVisible+"Color").css({'color':'#04B404'});
        }



    });

}

function refreshPartialTable(modelo, metodo2, idVisible) {
    var url= "API/" + modelo + "/" + metodo2;
    $.get( url, function( data ) {
        $( "#"+idVisible+"TableFecha").html(data.fechain.substr(0,10));
        $( "#"+idVisible+"TableHora").html(data.fechain.substr(11,15));
    });
}
