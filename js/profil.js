var rowperpage = 4;
var ucitanoReg = 0;
var ucitanoMod = 0;
var ucitanoAdm = 0;
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
function registriran(){
    $(".tabs-list li a").click(function(e){
        e.preventDefault();
     });
     $(".tabs-list li").click(function(){
        var tabid = $(this).find("a").attr("href");
        $(".tabs-list li,.tabs div.tab").removeClass("active");   
        $(".tab").hide();   
        $(tabid).show();    
        dohvatiReg();
        $(this).addClass("active"); 
     });
     dohvatiReg();
     
}
function moderator(){
    $("#liMod").removeClass("hidden");
    $("#mod").removeClass("hidden");
    $(".tabs-list li a").click(function(e){
        e.preventDefault();
     });
    $(".tabs-list li").click(function(){
        var tabid = $(this).find("a").attr("href");
        $(".tabs-list li,.tabs div.tab").removeClass("active");
        dohvatiReg(); 
        dohvatiMod();
        $(".tab").hide();
        $(tabid).show();   
        $(this).addClass("active"); 
     });

     dohvatiReg(); 
     dohvatiMod();


    //fillTermin();
}
function administrator(){
    $("#liMod").removeClass("hidden");
    $("#mod").removeClass("hidden");
    $("#liAdm").removeClass("hidden");
    $("#admin").removeClass("hidden");
    $(".tabs-list li a").click(function(e){
        e.preventDefault();
     });
     $(".tabs-list li").click(function(){
        var tabid = $(this).find("a").attr("href");
        $(".tabs-list li,.tabs div.tab").removeClass("active");   
        $(".tab").hide();   
        $(tabid).show();    
        $(this).addClass("active"); 
     });
     dohvatiAdm();
     dohvatiMod();
     dohvatiReg();
}
function dohvatiAdm(){
    var textPretraži = $("#searchAdmLok").val();
    getData(textPretraži);
    fillGradZaNoviCentar();
    fillCentarZaDodjelu();
    fillModeratorZaDodjelu();
    if(ucitanoAdm == 0){
        $("#dodajNoviCentar").click(dodajNoviCentar);
        $("#dodijeliModeratora").click(dodjelaModa);
        $("#dodajVrstaLokacije").click(kreirajVrstuLokacije);
        $("#searchAdmLok").keyup(function(){
            textPretraži = $(this).val();
            getData(textPretraži);
        })
        ucitanoAdm = 1;
    }
    $("#but_prevAdmLok").click(function(){
        var rowid = Number($("#txt_rowidAdmLok").val());
        var allcount = Number($("#txt_allcountAdmLok").val());
        rowid -= Number(rowperpage);
        if(rowid < 0){
            rowid = 0;
        }
        $("#txt_rowidAdmLok").val(rowid);
        getData(textPretraži);
    });
    $("#but_nextAdmLok").click(function(){
        var rowid = Number($("#txt_rowidAdmLok").val());
        var allcount = Number($("#txt_allcountAdmLok").val());
        rowid += Number(rowperpage);
        if(rowid <= allcount){
            $("#txt_rowidAdmLok").val(rowid);
            getData(textPretraži);
        }
    });
    function getData(text){
        var rowid = $("#txt_rowidAdmLok").val();
        var allcount = $("#txt_allcountAdmLok").val();
        $.ajax({
            url:'../fetch/dohvatiZahtjeveZaAdmina.php?rowid='+rowid+'&rowperpage='+rowperpage+'&text='+text,
            type:'get',
            dataType:'json',
            success:function(response){
                createTablerow(response);
            }
        });
    }
    function createTablerow(data){
        var dataLen = data.length;
        $("#tableAdmLok").empty();
        for(var i=0; i<dataLen; i++){
            if(i == 0){
                var allcount = data[i]['ukupno'];
                $("#txt_allcountAdmLok").val(allcount);
            }
            else{
                $("#tableAdmLok").append("<tr>"+
                                            "<td>"+data[i]["id"]+"</td>"+
                                            "<td>"+data[i]["naziv"]+"</td>"+
                                            "<td>"+data[i]["dubina"]+"</td>"+
                                            "<td>"+data[i]["brojMjesta"]+"</td>"+
                                            "<td>"+data[i]["opis"]+"</td>"+
                                            "<td>"+data[i]["vrstaLok"]+"</td>"+
                                            "<td>"+data[i]["centar"]+"</td>"+
                                            "<td>"+data[i]["grad"]+"</td>"+ 
                                            "<td>"+data[i]["odobri"]+"</td>" +
                                            "<td>"+data[i]["odbij"]+"</td>" +
                                        "</tr>");
            }
        }
    }
}
function dohvatiMod(){
    var textPretraži = $("#searchZahtjevMod").val();
    getData(textPretraži);
    
    fillStvoriTermin();
    fillPostaviZavrseno();
    fillCentarZaNovuLokaciju();
    fillVrstaZaNovuLokaciju();
    fillGradZaNovuLokaciju();
    if(ucitanoMod == 0){
        $("#kreirajTermin").click(kreirajTermin);
        $("#searchZahtjevMod").keyup(function(){
            textPretraži = $(this).val();
            getData(textPretraži);
        })
        $("#PostaviNaZavrseno").click(postaviNaZavrseno);
        $("#dodajNovuLokaciju").click(dodajNovuLokaciju);
        ucitanoMod = 1;
    }
    
    $("#but_prevMod").click(function(){
        console.log(rowperpage);
        var rowid = Number($("#txt_rowidMod").val());
        var allcount = Number($("#txt_allcountMod").val());
        rowid -= Number(rowperpage);
        if(rowid < 0){
            rowid = 0;
        }
        $("#txt_rowidMod").val(rowid);
        getData(textPretraži);
    });
    $("#but_nextMod").click(function(){
        var rowid = Number($("#txt_rowidMod").val());
        var allcount = Number($("#txt_allcountMod").val());
        rowid += Number(rowperpage);
        if(rowid <= allcount){
            $("#txt_rowidMod").val(rowid);
            getData(textPretraži);
        }
    });
    function getData(text){
        var rowid = $("#txt_rowidMod").val();
        var allcount = $("#txt_allcountMod").val();
        $.ajax({
            url:'../fetch/dohvatiZahtjeveZaModeratora.php?rowid='+rowid+'&rowperpage='+rowperpage+'&text='+text,
            type:'get',
            dataType:'json',
            success:function(response){
                createTablerow(response);
            }
        });
    }
    function createTablerow(data){
        var dataLen = data.length;
        $("#tableBodyMod").empty();
        for(var i=0; i<dataLen; i++){
            if(i == 0){
                var allcount = data[i]['ukupno'];
                $("#txt_allcountMod").val(allcount);
            }
            else{
                $("#tableBodyMod").append("<tr>"+
                                            "<td>"+data[i]["id_zahtjev"]+"</td>"+
                                            "<td>"+data[i]["user"]+"</td>"+
                                            "<td>"+data[i]["id_termin"]+"</td>"+
                                            "<td>"+data[i]["zavrseno"]+"</td>"+
                                            "<td>"+data[i]["broj_slobodnih_mjesta"]+"</td>"+
                                            "<td>"+data[i]["lokacija"]+"</td>"+
                                            "<td>"+data[i]["max_dubina"]+"</td>"+
                                            "<td>"+data[i]["dubina"]+"</td>"+ 
                                            "<td>"+data[i]["odobri"]+"</td>" +
                                            "<td>"+data[i]["odbij"]+"</td>" +
                                            "<td>"+data[i]["poseban"]+"</td>" +
                                        "</tr>");
            }
        }
        var posebni = $(".poseban");
        var i = 0;
        $.each(posebni, function(){
            $(".poseban").parent().parent().addClass("posebanTr");
        });
    }
}
function dohvatiReg(){
    fillCentar();
    fillUploadSlikeLokacija();
    var form = document.getElementById("formUploadSlike");
    var fileSelect = document.getElementById("file");
    var submit = document.getElementById("submit");
    if(ucitanoReg == 0){
        $("#regCboxCentar").change(fillLokacija);
        $("#regCboxLokacija").change(fillTermin);
        $("#zahtjevRezervacija").click(rezerviraj);
        $("#searchZahtjevReg").keyup(function(){
            textPretraži = $(this).val();
            getData(textPretraži);
        });
        form.onsubmit = function(event){
            event.preventDefault();
            submit.innerHTML = "uploading..";
            var files = fileSelect.files;
            var formData = new FormData();
            var id = $("#regUploadLokacija").val();
            var text = $("#opisSlike").val();
            for(var i = 0 ; i< files.length; i++){
                var file = files[i];
                
                if(!file.type.match('image.*') ){
                    continue;
                }
                //console.log("provjera slike");
                
                formData.append('photos[]', file, file.name);
                
                
                $.ajax({
                    url:'../other/uploadSlike.php?id='+id+'&opis='+text,
                    type: 'post',
                    data: formData,                
                    processData: false,
                    contentType: false,
                    success: function(data){
                        //console.log(data);
                        submit.innerHTML = "Upload";
                        if(data.includes("spj")){
    
                            $("#prijenosMessage").empty();
                            $("#prijenosMessage").append("Uspješno ste podijelili sliku");
                        }
                        else if(data.includes("velika ")){
                            $("#prijenosMessage").empty();
                            $("#prijenosMessage").append("Prevelika slika");
                        }
                        else if(data.includes("datoteka nije ")){
                            $("#prijenosMessage").empty();
                            $("#prijenosMessage").append("Nepodržan format");
                        }
                        else if(data.includes("Problem")){
                            $("#prijenosMessage").empty();
                            $("#prijenosMessage").append("Greška kod prijenosa");
                        }
                        else if(data.includes("max")){
                            $("#prijenosMessage").empty();
                            $("#prijenosMessage").append("Naziv datoteke je duži od 20 znakova");
                        }

                    }
                })
                
            }
        }
        ucitanoReg = 1;
    }
    var textPretraži = $("#searchZahtjevReg").val();
    getData(textPretraži);
    
    
    $("#but_prev").click(function(){
        //console.log(rowperpage);
        var rowid = Number($("#txt_rowid").val());
        var allcount = Number($("#txt_allcount").val());
        rowid -= Number(rowperpage);
        if(rowid < 0){
            rowid = 0;
        }
        $("#txt_rowid").val(rowid);
        getData(textPretraži);
    });
    $("#but_next").click(function(){
        //console.log(rowperpage);
        var rowid = Number($("#txt_rowid").val());
        var allcount = Number($("#txt_allcount").val());
        //console.log("rowid:"+rowid+" All: " + allcount);
        rowid += Number(rowperpage);
        if(rowid <= allcount){
            $("#txt_rowid").val(rowid);
            getData(textPretraži);
            //console.log("rowid:"+rowid+" All: " + allcount);
        }
    });
    function getData(text){
        var rowid = $("#txt_rowid").val();
        var allcount = $("#txt_allcount").val();
        $.ajax({
            url:'../fetch/dohvatiZahtjeveKorisnika.php?rowid='+rowid+'&rowperpage='+rowperpage+'&text='+text,
            type:'get',
            dataType:'json',
            success:function(response){
                createTablerow(response);
            }
        });
    }
    function createTablerow(data){
        var dataLen = data.length;
        $("#tableBodyRez").empty();
        for(var i=0; i<dataLen; i++){
            if(i == 0){
                var allcount = data[i]['ukupno'];
                $("#txt_allcount").val(allcount);
            }
            else{
                var stringHtml = "<tr>"+
                                "<td>"+data[i]["id_zahtjev"]+"</td>"+
                                "<td>"+data[i]["status"]+"</td>"+
                                "<td>"+data[i]["id_termin"]+"</td>"+
                                "<td>"+data[i]["početak"]+"</td>"+
                                "<td>"+data[i]["kraj"]+"</td>"+
                                "<td>"+data[i]["zavrseno"]+"</td>"+
                                "<td>"+data[i]["broj_slobodnih_mjesta"]+"</td>"+
                                "<td>"+data[i]["max_dubina"]+"</td>"+ 
                                "<td>"+data[i]["lokacija"]+"</td>"+ 
                                "<td>"+data[i]["datum"]+"</td>"+
                                "<td>"+data[i]["delete"]+"</td>" +
                            "</tr>";
                $("#tableBodyRez").append(stringHtml);                      
            }
        }
    }
}
function fillCentar(){
    $.ajax({
        url: "../fetch/dohvatiCentar.php",
        type: 'get',
        data: 'json',
        success: function(data){
            $.each(data, function(k,v){
                $("#regCboxCentar").append("<option value='"+v.naziv+"'>"+v.naziv+"</option>");
            })
        }
    })
}
function fillLokacija(){
    var centar = $("#regCboxCentar").val();
    centar = centar.replace(/ /g, "_");
    $.ajax({
        url: "../fetch/dohvatiLokacije.php?vrsta=&centar="+centar,
        type: 'get',
        data: 'json',
        success: function(data){
            $("#regCboxLokacija").empty();
            $.each(data, function(k,v){
                $("#regCboxLokacija").append("<option value='"+v.naziv+"'>"+v.naziv+"</option>");
            })
        }
    })
}
function fillTermin(){
    var lokacija = $("#regCboxLokacija").val();
    lokacija = lokacija.replace(/ /g, "_");
    $.ajax({
        url: "../fetch/dohvatiTermine.php?lokacija="+lokacija,
        type: 'get',
        data: 'json',
        success: function(data){
            $("#regCboxTermin").empty();
            $.each(data, function(k,v){
                $("#regCboxTermin").append("<option value='"+v.id+"'>"+v.početak+"</option>");
            })
        }
    })
}
function fillUploadSlikeLokacija(){
    $.ajax({
        url: "../fetch/dohvatiLokacijeZaCombo.php?uploadslike=true",
        type: 'get',
        data: 'json',
        success: function(data){
            $("#regUploadLokacija").empty();
            $.each(data, function(k,v){
                $("#regUploadLokacija").append("<option value='"+v.id+"'>"+v.naziv+"</option>");
            })
        }
    })
}
function rezerviraj(){
    var termin = $("#regCboxTermin").val();
    var dubina = $("#maxDubinaKorisnika").val();
    if(termin.length >0 && dubina.length >0){
        document.getElementById("greskaRezerviraj").style.display = "none";
        $.ajax({
            url: '../other/kreirajRezervaciju.php',
            data: {
                terminID: termin,
                dubina: dubina
            } ,
            type: 'post',
            success: function(data){
                console.log(data);
                if(data == 'Greška'){
                    document.getElementById("greskaRezerviraj1").style.display = "block";
                }
                dohvatiReg();
                
            }
        })
    
    }
    else{
        document.getElementById("greskaRezerviraj").style.display = "block";
    }
    
}
function removeZahtjev(id_zaht, id_term){ //reg
    $.ajax({
        url:'../delete/obrisiZahtjev.php',
        type:'post',
        data: {
            brisanjeID: id_zaht,
            terminID: id_term
        },
        dataType:'json',
        success:function(data){
            dohvatiReg();
        }
    })
    
}

function odbijZahtjev(id_zaht){
    //console.log("odbijam");
    $.ajax({
        url: '../moderator/odbijZahtjevKorisnika.php',
        type: 'post',
        data: {
            odbijID: id_zaht
        },
        dataType :'json',
        success: function(data){
            console.log(data);
        },
        error :function(data){
            console.log(data)
        }
    });
    dohvatiMod();
    //console.log("odbio");

}
function odobriZahtjev(id_zaht){
    $.ajax({
        url: '../moderator/odobriZahtjevKorisnika.php',
        type: 'post',
        data: {
            odobriID: id_zaht
        },
        dataType :'json',
        success: function(data){
            
        }
    });
    dohvatiMod();
}
function fillStvoriTermin(){
    $.ajax({
        url: "../fetch/dohvatiLokacijeZaCombo.php?novitermin=true",
        type: 'get',
        data: 'json',
        success: function(data){
            $("#lokacijeZaNoviTermin").empty();
            $("#lokacijeZaNoviTermin").append("<option value=''>Odaberi...</option>");
            $.each(data, function(k,v){
                $("#lokacijeZaNoviTermin").append("<option value='"+v.id+"'>"+v.naziv+"</option>");
            })
        }
    })
}
function kreirajTermin(){
    var idLokacija = $("#lokacijeZaNoviTermin").val();
    var datumPoč= $("#datumPoc").val();
    var timePoc= $("#timePoc").val();
    var datumKraj = $("#datumKraj").val();
    var timeKraj = $("#timeKraj").val();
    
    var datetimePoč= datumPoč + " " + timePoc;
    var datetimeKraj = datumKraj + " " + timeKraj;
    if(idLokacija == "" || datumPoč.length<1 || datumKraj.length<1 || timePoc.length<1 ||timeKraj.length<1){
        document.getElementById("greskaKreiranjeTermina").style.display ="block";
    }
    else{
        document.getElementById("greskaKreiranjeTermina").style.display ="none";
        document.getElementById("uspjehKreiranjeTermina").style.display ="block";
        $.ajax({
            url: '../other/kreirajTermin.php',
            type: 'post',
            data: {
                idLok : idLokacija,
                početak : datetimePoč,
                kraj : datetimeKraj
            },
            success: function(){
                console.log("kreirano")
            }
        })
    }
    

}
function fillPostaviZavrseno(){
    $.ajax({
        url: "../fetch/dohvatiTermine.php",
        type: 'post',
        data:{
            terminZavrseno : 'true'
        },
        dataType: 'json',
        success: function(data){
            $("#postaviNaZavrsenoCombo").empty();
            $("#postaviNaZavrsenoCombo").append("<option value=''>Odaberi...</option>");
            $.each(data, function(k,v){
                $("#postaviNaZavrsenoCombo").append("<option value='"+v.id+"'>Završio:"+v.zavrseno+ " Lokacija: "+v.nazivLokacija+"</option>");
            })
        }
    })
}
function postaviNaZavrseno(){
    var id = $("#postaviNaZavrsenoCombo").val();
    $.ajax({
        url: "../other/postaviTerminNaZavrseno.php",
        type: 'post',
        data:{
            terminID : id
        },
        dataType: 'json',
        success: function(data){
            if(data == 'Uspjeh'){
                dohvatiMod();
            }
        }
    })
}
function fillCentarZaNovuLokaciju(){
    $.ajax({
        url: "../fetch/dohvatiCentar.php",
        type: 'post',
        data:{
            novalokacija : 'true'
        },
        dataType: 'json',
        success: function(data){
            //console.log(data);
            $("#centarZaNovuLokaciju").empty();
            $("#centarZaNovuLokaciju").append("<option value=''>Odaberi...</option>");
            $.each(data, function(k,v){
                $("#centarZaNovuLokaciju").append("<option value='"+v.id+"'>"+v.naziv+"</option>");
            })
        }
    })
}
function fillVrstaZaNovuLokaciju(){
    $.ajax({
        url: "../fetch/dohvatiVrste.php",
        type: 'post',
        data:{
            novalokacija : 'true'
        },
        dataType: 'json',
        success: function(data){
            //console.log(data);
            $("#vrstaZaNovuLokaciju").empty();
            $("#vrstaZaNovuLokaciju").append("<option value=''>Odaberi...</option>");
            $.each(data, function(k,v){
                $("#vrstaZaNovuLokaciju").append("<option value='"+v.id+"'>"+v.vrsta+"</option>");
            })
        }
    })
}
function fillGradZaNovuLokaciju(){
    $.ajax({
        url: "../fetch/dohvatiGradove.php",
        type: 'post',
        data:{
            novalokacija : 'true'
        },
        dataType: 'json',
        success: function(data){
            $("#gradZaNovuLokaciju").empty();
            $("#gradZaNovuLokaciju").append("<option value=''>Odaberi...</option>");
            $.each(data, function(k,v){
                $("#gradZaNovuLokaciju").append("<option value='"+v.id+"'>"+v.naziv+"</option>");
            })
        }
    })
}
function dodajNovuLokaciju(){
    var idCentar = $("#centarZaNovuLokaciju").val();
    var idVrsta = $("#vrstaZaNovuLokaciju").val();
    var idGrad = $("#gradZaNovuLokaciju").val();
    var nazivLokacija = $("#textNovaLokacija").val();
    var timeLokacija = $("#timeNovaLokacija").val();
    var dubina = $("#dubinaNovaLokacija").val();
    var brojMjesta = $("#mjestaNovaLokacija").val();
    var opis = $("#opisNovaLokacija").val();
    if(idCentar.length < 1,
        idVrsta.length<1,
        idGrad.length<1,
        nazivLokacija.length<1,
        timeLokacija.length<1,
        dubina.length<1,
        brojMjesta.length<1,
        opis.length<1){
            document.getElementById("greskaDodajLokaciju").style.display = "block";
        }
        else{
            document.getElementById("greskaDodajLokaciju").style.display = "none";
            document.getElementById("uspjehDodajLokaciju").style.display = "block";
            $.ajax({
                url: "../other/kreirajLokaciju.php",
                type: 'post',
                data:{
                    idCentar : idCentar,
                    idVrsta: idVrsta,
                    idGrad: idGrad,
                    nazivLokacija : nazivLokacija,
                    timeLokacija: timeLokacija,
                    dubina : dubina,
                    brojMjesta : brojMjesta,
                    opis : opis
                },
                dataType: 'json',
                success: function(data){
                    console.log(data);
                    if(data == 'Uspjeh'){
                        dohvatiMod();
                    }
                }
            })
        }   
    
}
function fillGradZaNoviCentar(){
    $.ajax({
        url: "../fetch/dohvatiGradove.php",
        type: 'post',
        data:{
            novalokacija : 'true'
        },
        dataType: 'json',
        success: function(data){
            $("#gradNoviCentar").empty();
            $("#gradNoviCentar").append("<option value=''>Odaberi...</option>");
            $.each(data, function(k,v){
                $("#gradNoviCentar").append("<option value='"+v.id+"'>"+v.naziv+"</option>");
            })
        }
    })
}
function dodajNoviCentar(){
    var naziv = $("#textNoviCentar").val();
    var oib = $("#oibNoviCentar").val();
    var tel = $("#telNoviCentar").val();
    var date = $("#dateNoviCentar").val();
    var addr = $("#addrNoviCentar").val();
    var grad = $("#gradNoviCentar").val();
    
    if(naziv.length < 1,
        oib.length<1,
        tel.length<1,
        date.length<1,
        addr.length<1,
        grad.length<1
        ){
            document.getElementById("greskaDodajCentar").style.display = "block";
        }
        else{
            document.getElementById("greskaDodajCentar").style.display = "none";
            document.getElementById("uspjehDodajCentar").style.display = "block";
            $.ajax({
                url: "../other/kreirajCentar.php",
                type: 'post',
                data:{
                    nazivCentar : naziv,
                    oibCentar: oib,
                    telCentar: tel,
                    dateCentar : date,
                    adrCentar: addr,
                    gradCentar : grad,
                },
                dataType: 'text',
                success: function(data){
                    console.log(data + "succ");
                    if(data == 'Uspjeh'){
                        dohvatiAdm();
                    }
                },
                error: function(data){
                    console.log(data + "err");
                }
            })
        }   
    
}
function fillCentarZaDodjelu(){

    $.ajax({
        url: '../fetch/dohvatiCentar.php',
        type: 'post',
        data:{
            dodjela: 'true'
        },
        dataType: 'json',
        success: function(data){
            $("#dodijeliModaCentar").empty();
            $("#dodijeliModaCentar").append("<option value=''>Odaberi...</option>");
            $.each(data, function(k,v){
                $("#dodijeliModaCentar").append("<option value='"+v.id+"'>"+v.naziv+"</option>");
            })
        },
        error: function(data){
            console.log(data);
        }
    })
}
function fillModeratorZaDodjelu(){
    $.ajax({
        url: '../fetch/dohvatiUsername.php',
        type: 'post',
        data:{
            dodjela: 'true'
        },
        dataType: 'json',
        success: function(data){
            $("#dodijeliModaMod").empty();
            $("#dodijeliModaMod").append("<option value=''>Odaberi...</option>");
            $.each(data, function(k,v){
                $("#dodijeliModaMod").append("<option value='"+v.id+"'>"+v.korime+"</option>");
            })
        },
        error: function(data){
            console.log(data);
        }
    })
}
function dodjelaModa(){
    var idCentar= $("#dodijeliModaCentar").val();
    var idMod = $("#dodijeliModaMod").val();
    if(idCentar.length<1 || idMod.length<1){
        document.getElementById("greskaDodjelaModa").style.display="block";
    }
    else{
        document.getElementById("greskaDodjelaModa").style.display="none";
        document.getElementById("uspjehDodjelaModa").style.display="block";
    }
    $.ajax({
        url: '../other/dodjelaModa.php',
        type: 'post',
        data:{
            dodjela: 'true',
            centar: idCentar,
            user: idMod
        },
        dataType: 'json',
        success: function(data){
            console.log(data);
        },
        error: function(data){
            console.log(data);
        }
    })
}
function kreirajVrstuLokacije(){
    var vrstaLok = $("#textNovaVrsta").val();
    var opisLok = $("#opisNovaVrsta").val();
    if(vrstaLok.length<1 ||opisLok.length<1){
        document.getElementById("greskaDodajVrstu").style.display ="block";
        document.getElementById("uspjehDodajVrstu").style.display ="none";

    }
    else{
        document.getElementById("greskaDodajVrstu").style.display ="none";
        document.getElementById("uspjehDodajVrstu").style.display ="block";
        $.ajax({
            url: '../other/kreirajVrstu.php',
            type: 'post',
            data: {
                create : 'true',
                vrsta: vrstaLok,
                opis: opisLok
            },
            success: function(data){
                console.log(data+" succ");
            },
            error: function(data){
                console.log(data+" err");
            }
        })
    }
}
function odbijLokaciju(id_zaht){
    $.ajax({
        url: '../admin/odbijLokaciju.php',
        type: 'post',
        data: {
            odbijID: id_zaht
        },
        dataType :'json'
    });
    dohvatiAdm();
    
}
function prihvatiLokaciju(id_zaht){
    $.ajax({
        url: '../admin/prihvatiLokaciju.php',
        type: 'post',
        data: {
            prihvatiID: id_zaht
        },
        dataType :'json'
    });
    dohvatiAdm();
    
}