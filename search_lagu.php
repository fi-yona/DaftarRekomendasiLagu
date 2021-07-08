<?php
    include_once("function.php");
    include_once("login_action.php");
    session_start();
    checkSession();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>CARI DI DATA LAGU</title>
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
                <font size=2><?php getNumLagu();?></font>
                <br>
                <br>
            </div>
        </header>
        <main>
            <div class = "tengah">
                <form method="post">
                    <table align="center">
                        <tr><input type="text" name="inputSearchLagu" size="50" value="<?php echo (isset($_POST["inputSearchLagu"])?$_POST["inputSearchLagu"]:"");?>"><br></tr>
                        <tr><br></tr>
                        <tr><input type="submit" name="SearchLagu" value="Cari"></tr>
                    </table>
                </form>
                <a href="view_lagu.php"><button>Kembali</button></a>
                <br>
                <br>
                <br>
            </div>
            <?php
                if(isset($_POST["SearchLagu"])){
                    $search = $_POST["inputSearchLagu"];
                    $database = dbConnect();
                    if($database->connect_errno==0){
                        //Kalau berhasil connect ke database
                        $sql = "SELECT lagu.IdLagu, lagu.Judul, penyanyi.NamaPenyanyi, album.TahunRilis, album.NamaAlbum, lagu.Genre, lagu.LaguYoutube, penyanyi.IdPenyanyi, album.IdAlbum
                                FROM lagu, penyanyi, album
                                WHERE lagu.IdPenyanyi = penyanyi.IdPenyanyi
                                AND lagu.IdAlbum = album.IdAlbum
                                AND (lagu.IdLagu
                                LIKE '%$search%'
                                OR lagu.Judul
                                LIKE '%$search%'
                                OR penyanyi.NamaPenyanyi
                                LIKE '%$search%'
                                OR album.TahunRilis
                                LIKE '%$search%'
                                OR album.NamaAlbum
                                LIKE '%$search%'
                                OR lagu.Genre
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
                                        
                                    </tr>
                                    <tr>
                                    <th>Id Lagu</th>
                                    <th>Judul Lagu</th>
                                    <th>Penyanyi</th>
                                    <th>Tahun Rilis</th>
                                    <th>Nama Album</th>
                                    <th>Genre</th>
                                    <th>Aksi</th>
                                    </tr>
                                <?php
                                $data = $res->fetch_all(MYSQLI_ASSOC); 
                                foreach ($data as $barisdata) { 
                                    ?>
                                    <tr>
                                        <td><?php echo $barisdata["IdLagu"];?></td>
                                        <td><a href="<?php echo $barisdata["LaguYoutube"];?>"><?php echo $barisdata["Judul"];?></a></td>
                                        <td><a href="view_list_lagu_penyanyi.php?IdPenyanyi=<?php echo $barisdata["IdPenyanyi"];?>"><?php echo $barisdata["NamaPenyanyi"];?></td>
                                        <td><?php echo $barisdata["TahunRilis"];?></td>
                                        <td><a href="view_list_lagu_album.php?IdAlbum=<?php echo $barisdata["IdAlbum"];?>"><?php echo $barisdata["NamaAlbum"];?></a></td>
                                        <td><?php echo $barisdata["Genre"];?></td>
                                        <td><a href="edit_lagu.php?IdLagu=<?php echo $barisdata["IdLagu"];?>"><button>Edit</button></a>
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