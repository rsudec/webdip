 <link href="../css/main.css" rel="stylesheet" type="text/css">
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-csv/0.71/jquery.csv-0.71.min.js"></script>
  
<script src="../js/centarPaginate.js"> </script>

</head>
<body>
  <nav class="nav">
    <ul class="nav-ul">
      <li class="nav-ul-li"><a class="nav-ul-li-a" href="../index.php">početna</a></li>
      <li class="nav-ul-li"><a class="nav-ul-li-a" href="pretraga.php">lokacije</a></li>
      {$role}
      {$logged}   
    </ul>
  </nav>
  <div id="div_pagination">
        <input type="hidden" id="txt_rowid" value="0">
        <input type="hidden" id="txt_allcount" value="0">
        <input type="button" class="button" value="Previous" id="but_prev" />
        <input type="button" class="button" value="Next" id="but_next" />
    </div>
  <div class="mainDiv">
  {$centri}
  </div>