<link href="../css/main.css" rel="stylesheet" type="text/css">
<script src="https://www.google.com/recaptcha/api.js?render={$site_key}"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="  crossorigin="anonymous"></script>
<script src="../js/registracija.js"></script>
</head>
<body class="registerBody" onload="eventHandlerRegistracija()">
    <div class="goBack">
        
        <a class="nav-ul-li-a" href="../index.php"><img src="../assets/backSVG.svg"> Povratak</a></li>
    </div>
        
    <div class="main">
        <div class="screen">
            <div class="title">
                <h3>Registracija</h3>
            </div>

            <form class="form" novalidate method="POST" action="../form/registracija.php">
                <div class="group">
                    <input type="text" class="field" value="" placeholder="ime" name="ime" id="ime">
                    <label class="login-field-icon fui-user" for="im"></label>
                    
                </div>
                <div class="group">
                    <input type="text" class="field" value="" placeholder="prezime" name="prezime" id="prezime">
                    <label class="login-field-icon fui-user" for="prezime"></label>
                </div>
                <div class="group">
                    <input type="text" class="field" value="" placeholder="korisničko ime" name="korime" id="korime">
                    <label class="login-field-icon fui-user" for="korime"></label>
                    <p class="registrationErr">Korisničko ime već postoji, molimo odaberite drugo korisničko ime.</p>
                </div>
                <div class="group">
                    <input type="text" class="field" value="" placeholder="telefon" name="telefon" id="telefon">
                    <label class="login-field-icon fui-user" for="telefon"></label>
                </div>
                <div class="group">
                    <input type="text" class="field" value="" placeholder="email" name="email" id="email">
                    <label class="login-field-icon fui-user" for="email"></label>
                    <p class="registrationErr">E-mail nije ispravnog formata</p>
                    {$emailCheck}
                </div>
                <div class="group">
                    <input type="password" class="field" value="" placeholder="lozinka" name="lozinka" id="lozinka">
                    <label class="login-field-icon fui-lock" for="lozinka"></label>
                    <p class="registrationErr">Lozinka treba imati najmanje 6 znakova</p>
                </div>
                <div class="group">
                    <input type="password" class="field" value="" placeholder="potvrda lozinke" name="relozinka" id="relozinka">
                    <label class="login-field-icon fui-lock" for="relozinka"></label>
                    <p class="registrationErr">Lozinka se ne podudara</p>
                </div>
                <div class="group">
                    <input type="text" id="g-recaptcha-response" name="g-recaptcha-response">
                    <p class="registrationErr" style="display:block">{$errCaptcha}</p>
                    <div class="g-recaptcha" data-sitekey="{$site_key}"></div>
                </div>

                <p class="registrationErr">Unesite podatke u sva polja!</p>
                
                <input type="submit" name="submit" value="Registracija" id="submit">
                <a class="login-link" href="prijava.php">Imate račun? Prijavite se ovdje</a>
            </form>
        </div>
    </div>
</body>
</html>