<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='../shared/style/site.css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>GbClickerII</title>
</head>
<body>
    <?php 
        require "../shared/header.php";
    ?>
    <main>
        <?php require "../shared/navbar.php"; ?>
        <div id="clicker-parent-div">
            <div id="left-clicker-content-side">
                <div>
                    <img src="../shared/icons/account.png">
                    <p>Bonus</p>
                    <p>59:12</p>
                </div>
            </div>
            <div id="middle-clicker-content-side">
                <ul id="clicker-infos">
                    <li>123.3B R$/Sec</li>
                    <li>Mult: 30000x</li>
                </ul>
                <img src="img/gb.png" id="clicker-img">
                <div id="level-info">Nível: 45</div>
            </div>
            <div id="right-clicker-content-side">

            </div>
        </div>
    </main>
    <script language="JavaScript" src="../shared/js/navbar.js"></script>
</body>
</html>