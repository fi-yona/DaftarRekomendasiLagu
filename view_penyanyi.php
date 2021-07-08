<?php
    include_once("function.php");
    include_once("login_action.php");
    session_start();
    checkSession();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>DATA PENYANYI</title>
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
                <h2>DATA PENYANYI</h2>
                <font size=2><?php getNumPenyanyi();?></font>
                <br>
                <br>
                <!--untuk tombol tambah data-->
                <table align="center">
                    <tr>
                        <th><a href="insert_penyanyi.php"><button><b>TAMBAH DATA PENYANYI</b></button></a></th>
                        <th><a href="search_penyanyi.php"><button><b>CARI DATA PENYANYI</b></button></a></th>
                    </tr>
                </table>
            </div>
            <br>
                <?php
                    $database = dbConnect();
                    if ($database->connect_errno == 0) {
                        $sql = "SELECT penyanyi.IdPenyanyi, penyanyi.NamaPenyanyi, penyanyi.TahunDebut, penyanyi.LinkInstagram, penyanyi.LinkYoutube
                                FROM penyanyi
                                ORDER BY penyanyi.IdPenyanyi";
                        $res = $database->query($sql);
                        if ($res) {
                            ?>
                            <table border="1" align="center">
                                <tr>
                                    <th>Id Penyanyi</th>
                                    <th>Penyanyi</th>
                                    <th>Tahun Debut</th>
                                    <th>Sosmed</th>
                                    <th>Aksi</th>
                                </tr>
                        <?php
                        $data = $res->fetch_all(MYSQLI_ASSOC); 
                        foreach ($data as $barisdata) { 
                            ?>
                            <tr>
                                <td><?php echo $barisdata["IdPenyanyi"];?></td>
                                <td><a href="view_list_lagu_penyanyi.php?IdPenyanyi=<?php echo $barisdata["IdPenyanyi"];?>"><?php echo $barisdata["NamaPenyanyi"];?></td>
                                <td><?php echo $barisdata["TahunDebut"];?></td>
                                <td><a href="<?php echo $barisdata["LinkInstagram"];?>"><img src="icon/instagram.png" alt="instagram"></a>
                                    <a href="<?php echo $barisdata["LinkYoutube"];?>"><img src="icon/youtube.png" alt="youtube"></a></td>
                                <td><a href="edit_penyanyi.php?IdPenyanyi=<?php echo $barisdata["IdPenyanyi"];?>"><button>Edit</button></a>
                                    <a href="conf_delete_penyanyi.php?IdPenyanyi=<?php echo $barisdata["IdPenyanyi"];?>"><button>Hapus</button></a></td>
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