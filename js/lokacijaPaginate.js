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
            
        }
    })
}
$(document).ready(function(){
    if(window.location.href.indexOf("id") != -1){
        return;
    }
    else{
        getData();
        $("#but_prev").click(function(){
        var rowid = Number($("#txt_rowid").val());
        var allcount = Number($("#txt_allcount").val());
        rowid -= rowperpage;
        if(rowid < 0){
            rowid = 0;
        }
        $("#txt_rowid").val(rowid);
        getData();
    });

    $("#but_next").click(function(){
        console.log("next");
        var rowid = Number($("#txt_rowid").val());
        var allcount = Number($("#txt_allcount").val());
        rowid += rowperpage;
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
        url:'../fetch/lokacijePaginate.php?rowid='+rowid+'&rowperpage='+rowperpage,
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
            "<h3>Ronilačka lokacija - "+ data[i]["naziv"] + "</h3>"+
            "<div class='info'> "+
               "<ul>"+
                    "<li> Vrijeme prijevoza: "+data[i]["vrijeme"]+" </li>"+
                    "<li> Dubina: "+data[i]["dubina"]+" </li>"+
                    "<li> Broj mjesta: "+data[i]["brojMjesta"]+" </li>"+
                    "<li> Opis: "+data[i]["opis"]+" </li>"+
                    "<li> Vrsta lokacije: "+data[i]["vrsta"]+" </li>"+
                    "<li> Ronilački centar: "+data[i]["centar"]+" </li>"+
                    "<li> Grad: "+data[i]["grad"]+" </li>"+
                "</ul>"+
            "</div>"+
            "<div class='gallery'>"+
                data[i]["slike"]+
            "</div>"+
            "</div>");
        }
        
    }
}