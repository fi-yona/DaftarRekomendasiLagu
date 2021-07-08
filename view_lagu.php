<?php
    include_once("function.php");
    include_once("login_action.php");
    session_start();
    checkSession();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>DATA LAGU</title>
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
                <h2>DATA LAGU</h2>
                <font size=2><?php getNumLagu();?></font>
                <br>
                <br>
                <!--untuk tombol tambah data-->
                <table align="center">
                    <tr>
                        <th><a href="insert_lagu.php"><button><b>TAMBAH DATA LAGU</b></button></a></th>
                        <th><a href="search_lagu.php"><button><b>CARI DATA LAGU</b></button></a></th>
                    </tr>
                </table>
            </div>
            <br>
                <?php
                    $database = dbConnect();
                    if ($database->connect_errno == 0) {
                        $sql = "SELECT lagu.IdLagu, lagu.Judul, penyanyi.NamaPenyanyi, album.TahunRilis, album.NamaAlbum, lagu.Genre, lagu.LaguYoutube, album.IdAlbum, penyanyi.IdPenyanyi
                        FROM lagu, penyanyi, album
                        WHERE lagu.IdAlbum=album.IdAlbum AND lagu.IdPenyanyi=penyanyi.IdPenyanyi
                        ORDER BY lagu.IdLagu";
                        $res = $database->query($sql);
                        if ($res) {
                            ?>
                            <table border="1" align="center">
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