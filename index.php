<?php require_once 'Traductor.php';
$t = new Traductor();
if(isset($_GET['lang']) && $_GET['lang'] == 'en' ){
    $t->setLanguage('english');
}else if(isset($_GET['lang']) && $_GET['lang'] == 'fr'){
    $t->setLanguage('french');
}
session_start();
$_SESSION['lang'] = $t->getLanguageData();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Test traductor</title>
    </head>
    <body>
       
        <?php
        echo $_SESSION['lang']['WLCM']. ' Using SESSIONS';
        ?>
        <a href="page2.php">Page 2 session testing</a><br/>
        <?php
        $t->display('BYE');echo ' Using object ';
        ?>
    </body>
</html>
