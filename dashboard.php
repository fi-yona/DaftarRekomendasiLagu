<?php
    include_once("function.php");
    session_start();
    checkSession();
?>
<DOCTYPE! html>
<html>
    <head>
        <title>
            DASHBOARD
        </title>
        <style>
            .tengah{
                text-align:center;
            }
            .kanan{
                text-align:right;
            }
        </style>
    </head>
    <body>
        <header>
            <?php
                useHeader();
            ?>
            <div class = "kanan">
                <a href="create_user.php"><button><font size="4"><b>Tambah User</b></font></button></a>
                <?php
                    toLogOut();
                ?>
            </div>
            <br>
            <?php
                useNavigation();
            ?>
        </header>
        <main>
            <div class="tengah">
                <br>
                <br>
                Dibuat untuk memenuhi tugas mata kuliah APLIKASI TEKNOLOGI ONLINE<br>
                Dengan Dosen Pengampu : Andri Heryandi, M.T<br>
            </div>
            <br>
            <br>
            <div class="tengah">
                OLEH
            </div>
            <table align="center">
                <tr>
                    <td>NIM</td>
                    <td>:</td>
                    <td>10119013</td>
                </tr>
                <tr>
                    <td>NAMA</td>
                    <td>:</td>
                    <td>Fiona Avila Putri</td>
                </tr>
                <tr>
                    <td>KELAS</td>
                    <td>:</td>
                    <td>IF1</td>
                </tr>
            </table>
        </main>
        <?php
            //footer
            useFooter();
        ?>
    </body>
</html>