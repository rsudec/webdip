
function eventHandlerPretraga(){ //event Pretraga
    dohvatiLokacijePretraga();
    popuniComboVrsta();
    popuniComboCentar();

    var btnFilter = document.getElementsByClassName("btnFilter")[0];
    var btnPonisti = document.getElementsByClassName("btnFilter")[1];

    btnFilter.addEventListener("click", function(event){
        var selectedVrsta = $('#vrsta').val();
        var selectedCentar = $('#centar').val();

        var Vrsta = selectedVrsta.replace(/ /g, '_');
        var Centar = selectedCentar.replace(/ /g, '_');
        $.ajax({

        dataType: "json",
        url: "../fetch/dohvatiLokacije.php?vrsta="+Vrsta+"&centar="+Centar,
        type: "GET",
        success: function(data){
           var centar="";
           $.each(data, function(k,v){
               var inner = "<div class='element'>";
               inner+="<a href='../pages/lokacija.php?id="+v.id+"'><h3>"+v.naziv+"</h3></a>";
               inner+="<p>" + v.opis + "</p>";
               inner+="<a href='../pages/centar.php?id="+v.idCentar+"'>"+v.centar + "</div>";
               centar+=inner;
           })
           console.log(centar);
           $(".prikazLokacija").empty();
           $(".prikazLokacija")[0].innerHTML += "<h3>Prikaz lokacija</h3>" + centar;
        }
    })
    });
    btnPonisti.addEventListener("click", dohvatiLokacijePretraga);
}
function popuniComboVrsta(){ //combobox Pretraga
    $.ajax({
        dataType: "json",
        url: "../fetch/dohvatiVrste.php",
        type: "GET",
        success: function(data){
           var centar="<select id='vrsta'><option value=''>-</option>";
           $.each(data, function(k,v){
               centar+="<option value='"+v.vrsta+"'>"+v.vrsta+"</option>";
           })
           $(".filterVrsta")[0].innerHTML += centar;
        }
    })
}
function popuniComboCentar(){ //combobox Pretraga
    $.ajax({
        dataType: "json",
        url: "../fetch/dohvatiCentar.php",
        type: "GET",
        success: function(data){
           var centar="<select id='centar'><option value=''>-</option>";
           $.each(data, function(k,v){
               centar+="<option value='"+v.naziv+"'>"+v.naziv+"</option>";
           })
           $(".filterCentar")[0].innerHTML += centar;
        }
    })
}
function dohvatiLokacijePretraga(){ 
    //početno Pretraga
    $.ajax({
        dataType: "json",
        url: "../fetch/dohvatiLokacije.php",
        type: "GET",
        success: function(data){
           var centar="";
           $.each(data, function(k,v){
               var inner = "<div class='element'>";
               inner+="<a href='../pages/lokacija.php?id="+v.id+"'><h3>"+v.naziv+"</h3></a>";
               inner+="<p>" + v.opis + "</p>";
               inner+="<a href='../pages/centar.php?id="+v.idCentar+"'>"+v.centar + "</a></div>";
               centar+=inner;
           })
           $(".prikazLokacija")[0].innerHTML += centar;
           
        }
    })
}


    