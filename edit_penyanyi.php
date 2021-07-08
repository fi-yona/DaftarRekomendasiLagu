<?php
    include_once("function.php");
    include_once("login_action.php");
    session_start();
    checkSession();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>EDIT DATA PENYANYI</title>
        <style>
            .tengah{
                text-align:center;
            }.kiri{
                text-align:left;
            }
            .kanan{
                text-align: right;
            }
        </style>    
    <head>
    <body>
       	<div class = "kanan">
            <?php
                toDashboard();
                toLogOut();
            ?>
        </div>
        <main>
            <div class="tengah">
                <h2>EDIT DATA PENYANYI</h2>
                <br>
            </div>
            <?php
                if(isset($_GET["IdPenyanyi"])){
                    $database = dbConnect();
                    $IdPenyanyi = $database->escape_string($_GET["IdPenyanyi"]);
                    if($dataPenyanyi = getDataPenyanyi($IdPenyanyi)){
                        // cari data penyanyi, kalau ada simpan di dataPenyanyi
                        ?>
                            <form method="post" name="editp" action="update_penyanyi.php">
                                <table border=1 align="center">
                                    <tr>
                                        <th class="kiri">Id Penyanyi</th>
                                        <td><input type="text" name="IdPenyanyi" size="5" maxlength="5"
                                            value="<?php echo $dataPenyanyi["IdPenyanyi"];?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <th class="kiri">Penyanyi</th>
                                        <td><input type="text" name="NamaPenyanyi" size="30" maxlength="30"
                                            value="<?php echo $dataPenyanyi["NamaPenyanyi"];?>"></td>
                                    </tr>
                                    <tr>
                                        <th class="kiri">Tahun Debut</th>
                                        <td><input type="text" name="TahunDebut" size="4" maxlength=4
                                            value="<?php echo $dataPenyanyi["TahunDebut"];?>"></td>
                                    </tr>
                                    <tr>
                                        <th class="kiri">Link Instagram</th>
                                        <td><input type="text" name="LinkInstagram" size="50"
                                            value="<?php echo $dataPenyanyi["LinkInstagram"];?>"></td>
                                    </tr>
                                    <tr>
                                        <th class="kiri">Link Youtube</th>
                                        <td><input type="text" name="LinkYoutube" size="50"
                                            value="<?php echo $dataPenyanyi["LinkYoutube"];?>"></td>
                                    </tr>
                                </table>
                                <br>
                                <div class="tengah">
                                    <input type="submit" name="submit_e_p" value="Edit">
                                </div>
                            </form>
                            <div class="tengah">
                                <a href="view_penyanyi.php"><button>Batal</button></a>
                            </div>
                        <?php
                    }else{
                        ?>
                            <div class="tengah">
                                Data gagal diubah karena mungkin <b>Id Penyanyi</b> : <?php $IdPenyanyi ?> tidak ditemukan.<br>
                                <br>
                                <a href="view_penyanyi.php"><button>Batal</button></a>
                                <br>
                                <a href="javascript:history.back()"><button>Ulangi</button></a>
                                <br>
                        <?php
                    }
                }else{
                    ?>
                        <div class="tengah">
                            Data gagal diubah karena mungkin <b>Id Penyanyi</b> tidak ditemukan.<br>
                            <br>
                            <a href="view_penyanyi.php"><button>Ulangi</button></a>
                            <br>
                        </div>
                    <?php
                }
            ?>
        </main>
        <?php
            //footer
            useFooter();
        ?>
    </body>
</html>