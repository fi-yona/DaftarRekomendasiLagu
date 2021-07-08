<?php
    include_once("function.php");
    include_once("login_action.php");
    session_start();
    checkSession();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>LIHAT DAFTAR LAGU</title>
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
                <h2>LIHAT DAFTAR LAGU</h2>
                <br>
            </div>
            <?php
                if(isset($_GET["IdAlbum"])){
                    $database = dbConnect();
                    $IdAlbum = $database->escape_string($_GET["IdAlbum"]);
                    if($database->connect_errno==0){
                        //Kalau berhasil connect ke database
                        $sql = "SELECT album.IdAlbum, lagu.IdLagu, lagu.Judul, penyanyi.NamaPenyanyi, lagu.Genre, penyanyi.IdPenyanyi
                                FROM lagu, penyanyi, album
                                WHERE lagu.IdAlbum = album.IdAlbum 
                                AND lagu.IdPenyanyi = penyanyi.IdPenyanyi 
                                AND album.IdAlbum = '$IdAlbum' 
                                ORDER BY lagu.IdLagu";
                        $res = $database->query($sql);
                        if($res){
                            //Kalau berhasil eksekusi sql
                            if($res->num_rows>0){
                                //Kalau data ditemukan
                                $data = $res->fetch_all(MYSQLI_ASSOC); 
                                ?>
                                    <div class = "tengah">
                                        <h3>Daftar lagu pada Album dengan Id Album <?php echo $IdAlbum;?><br></h3>
                                        <br>
                                        <font size=2>Ditemukan <?php echo $res->num_rows ;?> data<br></font>
                                        <br>
                                    </div>
                                <table border="1" align="center">
                                    <tr>
                                    <th>Id Lagu</th>
                                    <th>Judul Lagu</th>
                                    <th>Genre Lagu</th>
                                    <th>Penyanyi</th>
                                    <th>Aksi</th>
                                </tr>
                                <?php
                                foreach ($data as $barisdata) { 
                                    ?>
                                        <tr>
                                            <td><?php echo $barisdata["IdLagu"];?></td>
                                            <td><a href="<?php echo $barisdata["LaguYoutube"];?>"><?php echo $barisdata["Judul"];?></a></td>
                                            <td><?php echo $barisdata["Genre"];?></td>
                                            <td><a href="view_list_lagu_penyanyi.php?IdPenyanyi=<?php echo $barisdata["IdPenyanyi"];?>"><?php echo $barisdata["NamaPenyanyi"];?></td>
                                            <td><a href="edit_lagu.php?IdLagu=<?php echo $barisdata["IdLagu"];?>"><button   >Edit</button></a>
                                                <a href="conf_delete_lagu.php?IdLagu=<?php echo $barisdata["IdLagu"];?>"><button>Hapus</button></a></td>
                                        </tr>
                                <?php
                                }
                            }else{
                                //Kalau data kosong
                                ?>
                                <div class = "tengah">
                                    <font size=4>Tidak ditemukan data yang sesuai</font><br>
                                </div>
                                <?php
                            }
                            ?>
                            </table>
                            <br>
                            <div class="tengah">
                                <a href="javascript:history.back()"><button>Kembali</button></a>
                            </div>
                        <?php
                        $res->free();
                        }else{
                            //Kalau gagal eksekusi sql
                            ?>
                            <div class="tengah">
                            Gagal mencari data
                            </div>
                            <?php
                        }
                    }else{
                        ?>
                            <div class="tengah">
                                Data gagal diubah karena mungkin <b>Id Lagu</b> tidak ditemukan.<br>
                                <br>
                                <a href="javascript:history.back()"><button>Ulangi</button></a>
                                <br>
                            </div>
                        <?php
                    }
                }else{
                    echo "Gagal koneksi dengan database<br>";
                    echo "Dengan pesan : <br>";
                    echo DEVELOPMENT ? " : ".$database->connect_error : "";
                }    
            ?>
        </main>
        <?php
            //footer
            useFooter();
        ?>
    </body>
</html>