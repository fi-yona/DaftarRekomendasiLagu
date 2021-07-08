<?php
    include_once("function.php");
    include_once("login_action.php");
    session_start();
    checkSession();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>KONFIRMASI HAPUS DATA LAGU</title>
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
                <h2>KONFIRMASI HAPUS DATA LAGU</h2>
                <br>
            </div>
            <?php
                if(isset($_GET["IdLagu"])){
                    $database = dbConnect();
                    $IdLagu = $database->escape_string($_GET["IdLagu"]);
                    if($dataLagu = getDataLagu($IdLagu)){
                        // cari data penyanyi, kalau ada simpan di dataPenyanyi
                        ?>
                            <form method="post" name="deletel" action="delete_lagu.php">
                            <input type="hidden" name="IdLagu" value="<?php echo $dataLagu["IdLagu"];?>">
                                <table border=1 align="center">
                                    <tr>
                                        <th class="kiri">Id Lagu</th>
                                        <td><?php echo $dataLagu["IdLagu"];?></td>
                                    </tr>
                                    <tr>
                                        <th class="kiri">Judul Lagu</th>
                                        <td><?php echo $dataLagu["Judul"];?></td>
                                    </tr>
                                    <tr>
                                        <th class="kiri">Nama Penyanyi</th>
                                        <?php
                                            $database = dbConnect();
                                            $IdPenyanyi = $dataLagu["IdPenyanyi"];
                                            $sql = "SELECT penyanyi.NamaPenyanyi
                                                    FROM lagu, penyanyi
                                                    WHERE lagu.IdPenyanyi = penyanyi.IdPenyanyi
                                                    AND lagu.IdPenyanyi = '$IdPenyanyi'
                                                    GROUP BY penyanyi.NamaPenyanyi";
                                            $res = $database->query($sql);
                                            if($res){
                                                while($data = $res->fetch_assoc()) { 
                                                    ?>
                                                    <td><?php echo $data["NamaPenyanyi"];?></td>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </tr>
                                    <tr>
                                        <th class="kiri">Nama Album</th>
                                        <?php
                                            $database = dbConnect();
                                            $IdAlbum = $dataLagu["IdAlbum"];
                                            $sql = "SELECT album.NamaAlbum
                                                    FROM lagu, album
                                                    WHERE lagu.IdAlbum = album.IdAlbum
                                                    AND lagu.IdAlbum = '$IdAlbum'
                                                    GROUP BY album.NamaAlbum";
                                            $res = $database->query($sql);
                                            if($res){
                                                $data = $res->fetch_assoc();
                                                foreach ($data as $barisdata) { 
                                                    ?>
                                                    <td><?php echo $data["NamaAlbum"];?></td>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </tr>
                                    <tr>
                                        <th class="kiri">Genre Lagu</th>
                                        <td><?php echo $dataLagu["Genre"];?></td>
                                    </tr>
                                    <tr>
                                        <th class="kiri">Link Lagu</th>
                                        <td><?php echo $dataLagu["LaguYoutube"];?></td>
                                    </tr>
                                </table>
                                <br>
                                <div class="tengah">
                                    <input type="submit" name="submit_d_l" value="Hapus">
                                </div>
                            </form>
                            <div class="tengah">
                                <a href="view_lagu.php"><button>Batal</button></a>
                            </div>
                        <?php
                    }else{
                        ?>
                            <div class="tengah">
                                Data gagal dihapus karena mungkin <b>Id Lagu</b> : <?php $IdLagu ?> tidak ditemukan.<br>
                                <br>
                                <a href="view_lagu.php"><button>Batal</button></a>
                                <br>
                        <?php
                    }
                }else{
                    ?>
                        <div class="tengah">
                            Data gagal dihapus karena <b>Id Lagu</b> tidak ditemukan.<br>
                            <br>
                            <a href="view_lagu.php"><button>Ulangi</button></a>
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