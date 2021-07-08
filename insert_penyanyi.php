<?php
    include_once("function.php");
    include_once("login_action.php");
    session_start();
    checkSession();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>TAMBAH DATA PENYANYI</title>
        <style>
            .tengah{
                text-align:center;
            }
            .kiri{
                text-align:left;
            }
            .kanan{
                text-align: right;
            }
        </style>
    </head>
    <body>
        <header>
            <div class = "kanan">
                <?php
                    toDashboard();
                    toLogOut();
                ?>
            </div>
        </header>
        <main>
            <div class="tengah">
                <h2>TAMBAH DATA PENYANYI</h2>
                <font size=2><?php getNumPenyanyi();?></font>
                <br>
                <br>
            </div>
            <form method="post" name="insertp" action="save_penyanyi.php"">
                <table border=1 align="center">
                    <tr>
                        <th class="kiri">Id Penyanyi</th>
                        <td><input type="text" name="IdPenyanyi" id="IdPenyanyi" size="5" maxlength="5"></td>
                    </tr>
                    <tr>
                        <th class="kiri">Penyanyi</th>
                        <td><input type="text" name="NamaPenyanyi" id="NamaPenyanyi" size="30" maxlength="30"></td>
                    </tr>
                    <tr>
                        <th class="kiri">Tahun Debut</th>
                        <td><input type="text" name="TahunDebut" id="TahunDebut" size="4" maxlength=4></td>
                    </tr>
                    <tr>
                        <th class="kiri">Link Instagram</th>
                        <td><input type="text" name="LinkInstagram" size="50"></td>
                    </tr>
                    <tr>
                        <th class="kiri">Link Youtube</th>
                        <td><input type="text" name="LinkYoutube" size="50"></td>
                    </tr>
                </table>
                <br>
                <div class="tengah">
                    <input type="submit" name="submit_i_p" value="Tambah">
                </div>
            </form>
            <div class="tengah">
                <a href="view_penyanyi.php"><button>Batal</button></a>
            </div>
        </script>
        </main>
        <?php
            //footer
            useFooter();
        ?>
    </body>
</html>