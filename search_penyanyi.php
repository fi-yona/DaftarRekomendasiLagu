<?php
    include_once("function.php");
    include_once("login_action.php");
    session_start();
    checkSession();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>CARI DI DATA PENYANYI</title>
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
                <font size=2><?php getNumPenyanyi();?></font>
                <br>
                <br>
            </div>
        </header>
        <main>
            <div class = "tengah">
                <form method="post">
                    <table align="center">
                        <tr><input type="text" name="inputSearchPenyanyi" size="50" value="<?php echo (isset($_POST["inputSearchPenyanyi"])?$_POST["inputSearchPenyanyi"]:"");?>"><br></tr>
                        <tr><br></tr>
                        <tr><input type="submit" name="SearchPenyanyi" value="Cari"></tr>
                    </table>
                </form>
                <a href="view_penyanyi.php"><button>Kembali</button></a>
                <br>
                <br>
                <br>
            </div>
            <?php
                if(isset($_POST["SearchPenyanyi"])){
                    $search = $_POST["inputSearchPenyanyi"];
                    $database = dbConnect();
                    if($database->connect_errno==0){
                        //Kalau berhasil connect ke database
                        $sql = "SELECT *
                                FROM penyanyi
                                WHERE IdPenyanyi
                                LIKE '%$search%'
                                OR NamaPenyanyi
                                LIKE '%$search%'
                                OR TahunDebut
                                LIKE '%$search%'";
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
                                        <td><a href="<?php echo $barisdata["LinkInstagram"];?>"><img src="icon/instagram.png" alt="instagram" title="link instagram"></a>
                                    		<a href="<?php echo $barisdata["LinkYoutube"];?>"><img src="icon/youtube.png" alt="youtube" title="link youtube"></a></td>
                                        <td><a href="edit_penyanyi.php?IdPenyanyi=<?php echo $barisdata["IdPenyanyi"];?>"><button>Edit</button></a>
                                    <a href="conf_delete_penyanyi.php?IdPenyanyi=<?php echo $barisdata["IdPenyanyi"];?>"><button>Hapus</button></a></td>
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
                            Gagal mencari data
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