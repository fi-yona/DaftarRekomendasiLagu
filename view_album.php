<?php
    include_once("function.php");
    include_once("login_action.php");
    session_start();
    checkSession();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>DATA ALBUM</title>
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
            <?php
                useHeader();
            ?>
            <div class = "kanan">
                <?php
                    toDashboard();
                    toLogOut();
                ?>
            </div>
            <br>
            <?php
                useNavigation();
            ?>
        </header>
        <main>
            <br>
            <br>
            <div class="tengah">
                <h2>DATA ALBUM</h2>
                <font size=2><?php getNumAlbum();?></font>
                <br>
                <br>
                <!--untuk tombol tambah data-->
                <table align="center">
                    <tr>
                        <th><a href="insert_album.php"><button><b>TAMBAH DATA ALBUM</b></button></a></th>
                        <th><a href="search_album.php"><button><b>CARI DATA ALBUM</b></button></a></th>
                    </tr>
                </table>
            </div>
            <br>
                <?php
                    $database = dbConnect();
                    if ($database->connect_errno == 0) {
                        $sql = "SELECT album.IdAlbum, album.NamaAlbum, album.TahunRilis, penyanyi.NamaPenyanyi, penyanyi.IdPenyanyi
                        FROM album 
                        JOIN penyanyi ON album.IdPenyanyi = penyanyi.IdPenyanyi
                        ORDER BY album.IdAlbum";
                        $res = $database->query($sql);
                        if ($res) {
                            ?>
                            <table border="1" align="center">
                                <tr>
                                    <th>Id Album</th>
                                    <th>Nama Album</th>
                                    <th>Tahun Rilis</th>
                                    <th>Penyanyi</th>
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
                            ?>
                            </table>
                        <?php
                        $res->free();
                        } else {
                            echo "Gagal eksekusi sql<br>";
                            echo "Dengan pesan : <br>";
                            echo DEVELOPMENT ? $database->error : "";
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