function eventHandlerRegistracija(){
    
    var nameField = document.getElementById("ime");
    var surnameField = document.getElementById("prezime");
    var usernameField = document.getElementById("korime");
    var phoneField = document.getElementById("telefon");
    var emailField = document.getElementById("email");
    var passwordField = document.getElementById("lozinka");
    var repasswordField = document.getElementById("relozinka");
    var registerForm = document.getElementsByClassName("form")[0];
    
    var error = new Array(7);
    for(let i = 0; i<error.length; i++){
        error[i] = false;
    }

    usernameField.addEventListener("keyup", function(event){
        $typed = usernameField.value;
        $.ajax({
            dataType: "json",
            url: "../fetch/dohvatiUsername.php?user="+$typed,
            type: "GET",
            success: function(data){
                if(data.length){
                    usernameField.style.borderColor = "red";
                    usernameField.nextElementSibling.nextElementSibling.style.display = "block";
                    error[2] = false;
                }
                else{
                    usernameField.style.borderColor ="";
                    usernameField.nextElementSibling.nextElementSibling.style.display = "none";
                    error[2] = true;
                }
            }
        })
    });
    emailField.addEventListener("keyup", function(event){
        var izraz = new RegExp(/\b^([a-zA-Z0-9])+(\.{1}[a-zA-Z0-9]+)*@([a-zA-Z0-9]{2,}(\.)?)+\.[a-zA-Z0-9]{2,}$\b/g);
        var rez = izraz.test(emailField.value);
        if(rez){
           emailField.nextElementSibling.nextElementSibling.style="display:none;";
           emailField.style.borderColor = "";
           error[4] = true;
        }
        else{
            emailField.nextElementSibling.nextElementSibling.style="display:block;";
            emailField.style.borderColor = "red";
            error[4] = false;
        }
    });
    repasswordField.addEventListener("keyup", function(event){
        if(passwordField.value != null){
            if(passwordField.value != repasswordField.value){
                repasswordField.nextElementSibling.nextElementSibling.style="display:block;";
                repasswordField.style.borderColor = "red";
                error[6] = false;
            }
            else{
                repasswordField.nextElementSibling.nextElementSibling.style="display:none;";
                repasswordField.style.borderColor = "";
                error[6] = true;
            }
        }
    });
    registerForm.addEventListener("submit", function(event){
        if(nameField.value != ""){
            error[0] = true;
        }
        else{
            error[0] = false;
        }
        if(surnameField.value != ""){
            error[1] = true;
        }
        else{
            error[1] = false;
        }
        if(phoneField.value != ""){
            error[3] = true;
        }
        else{
            error[3] = false;
        }        
        if(passwordField.value.length > 5){
            error[5] = true;
            passwordField.nextElementSibling.nextElementSibling.style.display="none";
        }
        else{
            passwordField.nextElementSibling.nextElementSibling.style.display="block";
            error[5] = false;
        }
        //console.log(error);
        document.getElementById("submit").previousElementSibling.style.display="none";
        var hasError = false;
        for(let i = 0; i<error.length; i++){
            if(error[i] === false){
                document.getElementById("submit").previousElementSibling.style.display="block";
                hasError = true;
                
            }
        }
        if(hasError){
            event.preventDefault();
        }
        
        
    })
    
}

function eventHandlerLogin(){
    var usernameField = document.getElementById("korime");
    var passwordField = document.getElementById("lozinka");
    var form = document.getElementById("form");
    document.getElementById("submit").nextElementSibling.style.display="block";
    


    form.addEventListener("submit", function(event){
        
        if(usernameField.value == "" || passwordField.value == ""){
            document.getElementById("submit").previousElementSibling.style.display="block";
            event.preventDefault();
        }
        else{
            document.getElementById("submit").previousElementSibling.style.display="none";
        }

    })


}
function eventHandlerForgot(){
    var emailField = document.getElementById("email");
    var form = document.getElementById("form");
    document.getElementById("submit").nextElementSibling.style.display="block";

    form.addEventListener("submit", function(event){
        if(emailField.value == ""){
            document.getElementById("submit").previousElementSibling.style.display="block";
            event.preventDefault();
        }
        else{
            document.getElementById("submit").previousElementSibling.style.display="none";
        }
    })
}
grecaptcha.ready(function() {
    grecaptcha.execute('6LdG_KYUAAAAAAgyBsDTRH53vPBgok0Q02WcGMfh', {action: 'homepage'}).then(function(token) {
       document.getElementById("g-recaptcha-response").value=token;
       console.log(token);
       $("#g-recaptcha-response").attr("style", "display:none");
    });
}); 