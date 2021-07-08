<?php
    include_once("function.php");
    include_once("login_action.php");
    session_start();
    checkSession();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>KONFIRMASI HAPUS DATA PENYANYI</title>
        <style>
            .tengah{
                text-align:center;
            }.kiri{
                text-align:left;
            }
        </style>    
    <head>
    <body>
        <main>
            <div class="tengah">
                <h2>KONFIRMASI HAPUS DATA PENYANYI</h2>
                <br>
            </div>
            <?php
                if(isset($_GET["IdPenyanyi"])){
                    $database = dbConnect();
                    $IdPenyanyi = $database->escape_string($_GET["IdPenyanyi"]);
                    if($dataPenyanyi = getDataPenyanyi($IdPenyanyi)){
                        // cari data penyanyi, kalau ada simpan di dataPenyanyi
                        ?>
                            <form method="post" name="deletep" action="delete_penyanyi.php">
                            <input type="hidden" name="IdPenyanyi" value="<?php echo $dataPenyanyi["IdPenyanyi"];?>">
                                <table border=1 align="center">
                                    <tr>
                                        <th class="kiri">Id Penyanyi</th>
                                        <td><?php echo $dataPenyanyi["IdPenyanyi"];?></td>
                                    </tr>
                                    <tr>
                                        <th class="kiri">Penyanyi</th>
                                        <td><?php echo $dataPenyanyi["NamaPenyanyi"];?></td>
                                    </tr>
                                    <tr>
                                        <th class="kiri">Tahun Debut</th>
                                        <td><?php echo $dataPenyanyi["TahunDebut"];?></td>
                                    </tr>
                                    <tr>
                                        <th class="kiri">Link Instagram</th>
                                        <td><?php echo $dataPenyanyi["LinkInstagram"];?></td>
                                    </tr>
                                    <tr>
                                        <th class="kiri">Link Youtube</th>
                                        <td><?php echo $dataPenyanyi["LinkYoutube"];?></td>
                                    </tr>
                                </table>
                                <br>
                                <div class="tengah">
                                    <input type="submit" name="submit_d_p" value="Hapus">
                                </div>
                            </form>
                            <div class="tengah">
                                <a href="view_penyanyi.php"><button>Batal</button></a>
                            </div>
                        <?php
                    }else{
                        ?>
                            <div class="tengah">
                                Data gagal dihapus karena mungkin <b>Id Penyanyi</b> : <?php $IdPenyanyi ?> tidak ditemukan.<br>
                                <br>
                                <a href="view_penyanyi.php"><button>Batal</button></a>
                                <br>
                        <?php
                    }
                }else{
                    ?>
                        <div class="tengah">
                            Data gagal dihapus karena <b>Id Penyanyi</b> tidak ditemukan.<br>
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