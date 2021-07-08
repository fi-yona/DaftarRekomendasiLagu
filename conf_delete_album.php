<?php
    include_once("function.php");
    include_once("login_action.php");
    session_start();
    checkSession();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>KONFIRMASI HAPUS DATA ALBUM</title>
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
                <h2>KONFIRMASI HAPUS DATA ALBUM</h2>
                <br>
            </div>
            <?php
                if(isset($_GET["IdAlbum"])){
                    $database = dbConnect();
                    $IdAlbum = $database->escape_string($_GET["IdAlbum"]);
                    if($dataAlbum = getDataAlbum($IdAlbum)){
                        // cari data penyanyi, kalau ada simpan di dataPenyanyi
                        ?>
                            <form method="post" name="deletea" action="delete_album.php">
                            <input type="hidden" name="IdAlbum" value="<?php echo $dataAlbum["IdAlbum"];?>">
                                <table border=1 align="center">
                                    <tr>
                                        <th class="kiri">Id Album</th>
                                        <td><?php echo $dataAlbum["IdAlbum"];?></td>
                                    </tr>
                                    <tr>
                                        <th class="kiri">Nama Album</th>
                                        <td><?php echo $dataAlbum["NamaAlbum"];?></td>
                                    </tr>
                                    <tr>
                                        <th class="kiri">Tahun Rilis</th>
                                        <td><?php echo $dataAlbum["TahunRilis"];?></td>
                                    </tr>
                                    <tr>
                                        <th class="kiri">Nama Penyanyi</th>
                                        <?php
                                            $database = dbConnect();
                                            $IdPenyanyi = $dataAlbum["IdPenyanyi"];
                                            $sql = "SELECT penyanyi.NamaPenyanyi
                                                    FROM penyanyi, album
                                                    WHERE album.IdPenyanyi = penyanyi.IdPenyanyi
                                                    AND album.IdPenyanyi = '$IdPenyanyi'
                                                    GROUP BY penyanyi.NamaPenyanyi";
                                            $res = $database->query($sql);
                                            if($res){
                                                $data = $res->fetch_all(MYSQLI_ASSOC);
                                                foreach ($data as $barisdata) { 
                                                    ?>
                                                    <td><?php echo $barisdata["NamaPenyanyi"];?></td>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </tr>
                                </table>
                                <br>
                                <div class="tengah">
                                    <input type="submit" name="submit_d_a" value="Hapus">
                                </div>
                            </form>
                            <div class="tengah">
                                <a href="view_album.php"><button>Batal</button></a>
                            </div>
                        <?php
                    }else{
                        ?>
                            <div class="tengah">
                                Data gagal dihapus karena mungkin <b>Id Album</b> : <?php $IdAlbum ?> tidak ditemukan.<br>
                                <br>
                                <a href="view_album.php"><button>Batal</button></a>
                                <br>
                        <?php
                    }
                }else{
                    ?>
                        <div class="tengah">
                            Data gagal dihapus karena <b>Id Album</b> tidak ditemukan.<br>
                            <br>
                            <a href="view_album.php"><button>Ulangi</button></a>
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