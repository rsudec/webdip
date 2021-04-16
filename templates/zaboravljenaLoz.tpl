<link href="../css/main.css" rel="stylesheet" type="text/css">
<script src="../js/registracija.js"></script>
</head>
<body class="loginBody" onload="eventHandlerForgot()">
    <div class="goBack">
        <a class="nav-ul-li-a" href="../index.php"><img src="../assets/backSVG.svg"> Povratak</a></li>
    </div>
        
    <div class="main">
        <div class="screen">
            <div class="title">
                <h3>Zaboravili ste lozinku?</h3>
            </div>

            <form class="form" id="form" method="POST" action="../form/zaborav.php">
                <div class="group">
                    <input type="text" class="field"  placeholder="email" name="email" id="email" value="">
                    <label class="login-field-icon fui-user" for="email"></label>
                </div>
                <p class="registrationErr">Unesite email</p>
                <input type="submit" name="submit" value="Zaboravio/la sam" id="submit">
                <p class="registrationErr">{$porukaForgot}</p>
            </form>
        </div>
    </div>
</body>
</html>