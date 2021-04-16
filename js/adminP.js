var rowperpage = dajRow();
function adminPanel(){

    popuniBlokirane();
    popuniOtključane();
    readCSV();
    dohvatiLog();
    $("#blokirajKorisnika").click(blokirajKorisnika);
    $("#otključajKorisnika").click(otključajKorisnika);
    $("#postaviCFG").click(writeCSV);
    $("#submitPomak").click(pomak);
    
    

}
function dajRow(){
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
function readCSV(){
    $.ajax({
        type: 'get',
        url: '../config/config.csv',
        dataType: 'text',
        success: function(data){
            var csv = $.csv.toArrays(data);
            var emailAkt = csv[0][0].split(";")[1];
            var cookieLogin = csv[1][0].split(";")[1];
            var maxPrijava = csv[2][0].split(";")[1];
            var brojZapisa = csv[3][0].split(";")[1];
            $("#cfgEmailAkt").val(emailAkt);
            $("#cfgCookie").val(cookieLogin);
            $("#cfgMaxPrijava").val(maxPrijava);
            $("#cfgNumStranice").val(brojZapisa);
        }
    })
}
function popuniBlokirane(){
    $.ajax({
        url: '../panel/dohvatiKorisnike.php',
        data:{
            blokirani : 'true'
        },
        dataType: 'json',
        type: 'post',
        success:function(data){
            $("#selectBlokiraniKorisnik").empty();
            $("#selectBlokiraniKorisnik").append("<option value=''>Odaberi...</option>");
            $.each(data, function(k,v){
                $("#selectBlokiraniKorisnik").append("<option value='"+v.id+"'>"+v.korime+"</option>");
            })
        }
    })
}
function popuniOtključane(){
    $.ajax({
        url: '../panel/dohvatiKorisnike.php',
        data:{
            otključani : 'true'
        },
        dataType: 'json',
        type: 'post',
        success:function(data){
            $("#selectOtključanKorisnik").empty();
            $("#selectOtključanKorisnik").append("<option value=''>Odaberi...</option>");
            $.each(data, function(k,v){
                $("#selectOtključanKorisnik").append("<option value='"+v.id+"'>"+v.korime+"</option>");
            })
        }
    })
}
function blokirajKorisnika(){
    console.log("bllokiram--");
    var idUser = $("#selectOtključanKorisnik").val();
    console.log(idUser);
    $.ajax({
        url : '../panel/banUnban.php',
        type: 'post',
        data:{
            idBan : idUser,
            action : 'ban'
        },
        success : function(data){
            console.log(data);
            if(data.includes('Uspjeh')){
                document.getElementById("uspjehBanKorisnik").style.display="block";
            }
            popuniBlokirane();
            popuniOtključane();
        }
    })
}
function otključajKorisnika(){
    var idUser = $("#selectBlokiraniKorisnik").val();
    $.ajax({
        url : '../panel/banUnban.php',
        type: 'post',
        data:{
            idUnban : idUser,
            action : 'unban'
        },
        success : function(data){
            console.log(data);
            if(data.includes( 'Uspjeh')){
                document.getElementById("uspjehUnBanKorisnik").style.display="block";
            }
            popuniBlokirane();
            popuniOtključane();
        }
    })
}
function writeCSV(){
    var emailAkt = $("#cfgEmailAkt").val();
    var cfgCookie = $("#cfgCookie").val();
    var maxPrijava=  $("#cfgMaxPrijava").val();
    var brojZapisa = $("#cfgNumStranice").val();
    console.log(emailAkt + " " + cfgCookie+ " " + maxPrijava + " " +brojZapisa);
    $.ajax({
        url: '../panel/saveCSV.php',
        type: 'post',
        data: {
            emailTrajanje: emailAkt,
            cookieTrajanje: cfgCookie,
            brPrijava: maxPrijava,
            brZapisa: brojZapisa
        },
        
        success: function(data){
            readCSV();
            console.log(data + "succ");
        },
        error: function(data){
            console.log(data + " err");
        }

    })


}
function dohvatiLog(){
    $("#searchLogAdm").keyup(function(){
        textPretraži = $(this).val();
        getData(textPretraži);
    });
    var textPretraži = $("#searchLogAdm").val();
    getData(textPretraži);
    $("#but_prevAdm").click(function(){
        var rowid = Number($("#txt_rowidAdm").val());
        var allcount = Number($("#txt_allcountAdm").val());
        rowid -= Number(rowperpage);
        if(rowid < 0){
            rowid = 0;
        }
        $("#txt_rowidAdm").val(rowid);
        getData(textPretraži);
    });
    $("#but_nextAdm").click(function(){
        //console.log(rowperpage);
        var rowid = Number($("#txt_rowidAdm").val());
        var allcount = Number($("#txt_allcountAdm").val());
        //console.log("rowid:"+rowid+" All: " + allcount);
        rowid += Number(rowperpage);
        if(rowid <= allcount){
            $("#txt_rowidAdm").val(rowid);
            getData(textPretraži);
            //console.log("rowid:"+rowid+" All: " + allcount);
        }
    });
    function getData(text){
        var rowid = $("#txt_rowidAdm").val();
        var allcount = $("#txt_allcountAdm").val();
        $.ajax({
            url:'../panel/dohvatiLogove.php?rowid='+rowid+'&rowperpage='+rowperpage+'&text='+text,
            type:'get',
            dataType:'json',
            success:function(response){
                createTablerow(response);
            }
        });
    }
    function createTablerow(data){
        var dataLen = data.length;
        $("#tableBodyLog").empty();
        for(var i=0; i<dataLen; i++){
            if(i == 0){
                var allcount = data[i]['ukupno'];
                $("#txt_allcountAdm").val(allcount);
            }
            else{
                var stringHtml = "<tr>"+
                                "<td>"+data[i]["id"]+"</td>"+
                                "<td>"+data[i]["vrijednost"]+"</td>"+
                                "<td>"+data[i]["vrijeme"]+"</td>"+
                                "<td>"+data[i]["korisnik"]+"</td>"+
                                "<td>"+data[i]["tip"]+"</td>"+
                            "</tr>";
                $("#tableBodyLog").append(stringHtml);                      
            }
        }
    }
}
function pomak(){
    var pomakNovi = $("#pomak").val();
    console.log(pomakNovi);
    if(pomakNovi.length <1){
        document.getElementById("greskaPomak").style.display ="block";
        document.getElementById("uspjehPomak").style.display="none";
    }
    else{
        document.getElementById("uspjehPomak").style.display="block";
        document.getElementById("greskaPomak").style.display ="none";
        $.ajax({
            url: 'http://barka.foi.hr/WebDiP/pomak_vremena/vrijeme.php',
            type: 'post',
            data:{
                submit: 'Dodaj',
                pomak: pomakNovi
            },
            success: function(){
                console.log("succ");
            }
            
        })
    }

}