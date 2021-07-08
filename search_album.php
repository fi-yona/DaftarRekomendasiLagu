<?php
    include_once("function.php");
    include_once("login_action.php");
    session_start();
    checkSession();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>CARI DI DATA ALBUM</title>
        <style>
            .tengah{
                text-align:center;
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
            <?php
                useNavigation();
            ?>
            <div class="tengah">
                <h2>CARI DATA</h2>
                <font size=2><?php getNumAlbum();?></font>
                <br>
                <br>
            </div>
        </header>
        <main>
            <div class = "tengah">
                <form method="post">
                    <table align="center">
                        <tr><input type="text" name="inputSearchAlbum" size="50" value="<?php echo (isset($_POST["inputSearchAlbum"])?$_POST["inputSearchAlbum"]:"");?>"><br></tr>
                        <tr><br></tr>
                        <tr><input type="submit" name="SearchAlbum" value="Cari"></tr>
                    </table>
                </form>
                <a href="view_album.php"><button>Kembali</button></a>
                <br>
                <br>
                <br>
            </div>
            <?php
                if(isset($_POST["SearchAlbum"])){
                    $search = $_POST["inputSearchAlbum"];
                    $database = dbConnect();
                    if($database->connect_errno==0){
                        //Kalau berhasil connect ke database
                        $sql = "SELECT album.IdAlbum, album.NamaAlbum, album.TahunRilis, penyanyi.NamaPenyanyi
                                FROM album, penyanyi
                                WHERE album.IdPenyanyi = penyanyi.IdPenyanyi
                                AND (album.IdAlbum
                                LIKE '%$search%'
                                OR album.NamaAlbum
                                LIKE '%$search%'
                                OR album.TahunRilis
                                LIKE '%$search%'
                                OR penyanyi.NamaPenyanyi
                                LIKE '%$search%')";
                        $res = $database->query($sql);
                        if($res){
                            //Kalau berhasil eksekusi sql
                            if($res->num_rows>0){
                                //Kalau data ditemukan
                                ?>
                                <div class = "tengah">
                                    <font size=2>Ditemukan <?php echo $res->num_rows ;?> hasil pencarian<br></font>
                                    <br>
                                </div>
                                <table border="1" align="center">
                                    <tr>
                                        <th>Id Album</th>
                                        <th>Nama Album</th>
                                        <th>Tahun Rilis</th>
                                        <th>Nama Penyanyi</th>
                                        <th>Aksi</th>
                                    </tr>
                                <?php
                                $data = $res->fetch_all(MYSQLI_ASSOC); 
                                foreach ($data as $barisdata) { 
                                    ?>
                                    <tr>
                                <td><?php echo $barisdata["IdAlbum"];?></td>
                                <td><a href="view_list_lagu_album.php?IdAlbum=<?php echo $barisdata["IdAlbum"];?>"><?php echo $barisdata["NamaAlbum"];?></a></td>
                                <td><?php echo $barisdata["TahunRilis"];?></td>
                                <td><a href="view_list_lagu_penyanyi.php?IdPenyanyi=<?php echo $barisdata["IdPenyanyi"];?>"><?php echo $barisdata["NamaPenyanyi"];?></td>
                                <td><a href="edit_album.php?IdAlbum=<?php echo $barisdata["IdAlbum"];?>"><button>Edit</button></a>
                                    <a href="conf_delete_album.php?IdAlbum=<?php echo $barisdata["IdAlbum"];?>"><button>Hapus</button></a></td>
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
                        //Kalau gagal connect ke database
                        echo "Gagal koneksi dengan database<br>";
                        echo "Dengan pesan : <br>";
                        echo DEVELOPMENT ? ":".$database->connect_error : "";
                    }
                }
            ?>
        </main>
    </body>
    <?php
        //footer
        useFooter();
    ?>
</html>