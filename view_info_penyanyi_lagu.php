<?php
    include_once("function.php");
    include_once("login_action.php");
    session_start();
    checkSession();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>INFO PENYANYI</title>
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
                <h2>INFO PENYANYI</h2>
                <br>
            </div>
            <?php
                if(isset($_GET["IdLagu"])){
                    $database = dbConnect();
                    $IdLagu = $database->escape_string($_GET["IdLagu"]);
                    if($database->connect_errno==0){
                        //Kalau berhasil connect ke database
                        $sql = "SELECT penyanyi.NamaPenyanyi, penyanyi.LinkInstagram, penyanyi.LinkYoutube
                                FROM lagu, penyanyi 
                                WHERE lagu.IdPenyanyi = penyanyi.IdPenyanyi 
                                AND lagu.IdLagu = '$IdLagu'";
                        $res = $database->query($sql);
                        if($res){
                            //Kalau berhasil eksekusi sql
                            if($res->num_rows>0){
                                //Kalau data ditemukan
                                $data = $res->fetch_all(MYSQLI_ASSOC); 
                                foreach ($data as $barisdata) { 
                                    ?>
                                        <table align="center">
                                            <tr>
                                                <td class="tengah">
                                                    <b>Nama Penyanyi : </b><?php echo $barisdata["NamaPenyanyi"];?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    &nbsp;
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="tengah">
                                                    <b>Social Media : </b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="tengah">
                                                    <a href="<?php echo $barisdata["LinkInstagram"];?>">Instagram<img src="icon/instagram.png" alt="instagram"></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="tengah">
                                                    <a href="<?php echo $barisdata["LinkYoutube"];?>">Youtube<img src="icon/youtube.png" alt="youtube"></a>
                                                </td>
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
                            <br>
                            <div class="tengah">
                                <a href="view_lagu.php"><button>Kembali</button></a>
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
                                <a href="view_lagu.php"><button>Ulangi</button></a>
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