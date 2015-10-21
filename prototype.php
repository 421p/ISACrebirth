<?php session_start();
    if(isset($_SESSION['username']))
       { 
            //UPDATE results SET 'points' = 'points' + 1 WHERE username = '$username';
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>C++ compiler/runnner/tester</title>
    <link href="pretty/prettify.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="pretty/prettify.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <style>
    .container {
        width: 600px;
        margin: 0 auto;
    }
    .progress_outer {
        border: 1px solid #000;
    }
    .progress {
        width: 20%;
        background: #DEDEDE;
        height: 20px;  
    }
    pre{
        border: 0px!important;
    }
    #c0{
        margin-top: 5em;
    }
    </style>
</head>
<body>
    <div class='container' id="c0">
    <a href="php/logout.php">Logout</a>
    </div>
    <div class='container' id="c1">
        <p>
            Select File: <input type='file' id='_file'> <input type='button' id='_submit' value='Upload!'>
        </p>
        <p>
            Selected Task: <select id="_task">
                              <option value="0">1 (Метеориты)</option>
                              <option value="1">2 (Большие метеориты)</option>
                              <option value="2">3 (Огромные метеориты)</option>
                              <option value="3">4 (Метеоритные метеориты)</option>
                            </select>
        </p>
    </div>
    <div class='container' id="c2">
        <p id="output"></p>
    </div>
    <script src='js/upload.js'></script>
    <div id="hidden" data-username="<?php echo $_SESSION['username']; ?>"></div>
</body>
</html>

<?php
       }
       else echo "NO WORK FOR YOU TODAY";
?>