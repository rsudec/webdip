<link href="../css/main.css" rel="stylesheet" type="text/css">
<script src="../js/registracija.js"></script>
</head>
<body class="loginBody" onload="eventHandlerLogin()">
    <div class="goBack">
        
        <a class="nav-ul-li-a" href="../index.php"><img src="../assets/backSVG.svg"> Povratak</a></li>
    </div>
        
    <div class="main">
        <div class="screen">
            <div class="title">
                <h3>Prijava</h3>
            </div>

            <form class="form" id="form" method="POST" action="../form/prijava.php">
                <div class="group">
                    <input type="text" class="field"  placeholder="korisničko ime" name="korime" id="korime" value="{$cookieUser}">
                    <label class="login-field-icon fui-user" for="korime"></label>
                </div>
                <div class="group">
                    <input type="password" class="field" value="" placeholder="lozinka" name="lozinka" id="lozinka">
                    <label class="login-field-icon fui-lock" for="lozinka"></label>
                </div>
                <p class="registrationErr">Unesite podatke u sva polja!</p>
                <input type="submit" name="submit" value="Prijava" id="submit">
                <p class="registrationErr">{$porukaPrijava}</p>
                <a class="login-link" href="../form/zaborav.php">Zaboravili ste lozinku?</a>

            </form>
        </div>
    </div>
</body>
</html>