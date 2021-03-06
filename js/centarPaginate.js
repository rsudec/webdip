var rowperpage = 3;
readCSV();
function readCSV(){
    $.ajax({
        type: 'get',
        url: '../config/config.csv',
        dataType: 'text',
        success: function(data){
            var csv = $.csv.toArrays(data);
            rowperpage = csv[3][0].split(";")[1];
            console.log(rowperpage);
        }
    })
}
$(document).ready(function(){
    console.log(window.location.href);
    console.log(window.location.href.indexOf("id"));
    if(window.location.href.indexOf("id") != -1){
        console.log("id");
        return;
    }
    else{
        getData();
    $("#but_prev").click(function(){
        var rowid = Number($("#txt_rowid").val());
        var allcount = Number($("#txt_allcount").val());
        rowid -= Number(rowperpage);
        if(rowid < 0){
            rowid = 0;
        }
        $("#txt_rowid").val(rowid);
        getData();
    });

    $("#but_next").click(function(){
        var rowid = Number($("#txt_rowid").val());
        var allcount = Number($("#txt_allcount").val());
        rowid += Number(rowperpage);
        if(rowid <= allcount){
            $("#txt_rowid").val(rowid);
            getData();
        }

    });
    }
    
});
/* requesting data */
function getData(){
    var rowid = $("#txt_rowid").val();
    var allcount = $("#txt_allcount").val();
    $.ajax({
        url:'../fetch/centarPaginate.php?rowid='+rowid+'&rowperpage='+rowperpage,
        type:'get',
        
        dataType:'json',
        success:function(response){
            createTablerow(response);
        }
    });

}
/* Create Table */
function createTablerow(data){

    var dataLen = data.length;
    $(".mainDiv").empty();
    for(var i=0; i<dataLen; i++){
        if(i == 0){
            var allcount = data[i]['ukupno'];
            $("#txt_allcount").val(allcount);
        }
        else{
            $(".mainDiv").append("<div class='centarMain'>" +
            "<h3>Ronilačka centar - "+ data[i]["naziv"] + "</h3>"+
            "<div class='info'> "+
               "<ul>"+
                    "<li> OIB: "+data[i]["oib"]+" </li>"+
                    "<li> Telefon: "+data[i]["telefon"]+" </li>"+
                    "<li> Datum osnivanja: "+data[i]["datum"]+" </li>"+
                    "<li> Ulica: "+data[i]["ulica"]+" </li>"+
                    "<li> Grad: "+data[i]["grad"]+", "+ data[i]["postanski"]+ " </li>"+
                "</ul>"+
            "</div>"+
            "<div class='logo'>"+
                "<img src='../assets/"+data[i]["logo"]+"'></img>"+
            "</div>"+
            "</div>");
        }
        
    }
}