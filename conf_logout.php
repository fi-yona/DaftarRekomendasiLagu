<?php
    include_once("function.php");
    include_once("login_action.php");
    session_start();
    checkSession();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>KONFIRMASI LOGOUT</title>
        <style>
            .tengah{
                text-align:center;
            }
        </style>    
    <head>
    <body>
        <main>
            <div class="tengah">
                <h2>KONFIRMASI LOGOUT</h2>
                <br>
                Yakin anda ingin keluar?<br>
                <br>
                <a href="logout_action.php"><button><b>Sangat Yakin</b></button></a>
                <a href="javascript:history.back()"><button><b>Tunggu Dulu</b></button></a>
            </div>
        </main>
        <?php
            //footer
            useFooter();
        ?>
    </body>
</html>