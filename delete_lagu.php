<?php
    include_once("function.php");
    include_once("login_action.php");
    session_start();
    checkSession();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>HAPUS DATA LAGU</title>
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
        <div class = "kanan">
            <?php
                toDashboard();
                toLogOut();
            ?>
        </div>
        <main>
            <div class="tengah">
                <h2>KONFIRMASI HAPUS DATA LAGU</h2>
                <br>
            </div>
            <?php
                if(isset($_POST["submit_d_l"])){
                    $database = dbConnect();
                    if($database->connect_errno==0){
                        //Kalau berhasil connect ke database
                        $IdLagu = $database->escape_string($_POST["IdLagu"]);
                        $sql = "DELETE FROM lagu
                                WHERE IdLagu = '$IdLagu'";
                        $res = $database->query($sql);
                        if($res){
                            //Kalau berhasil eksekusi sql
                            if($database->affected_rows>0){
                                //Kalau berhasil dihapus
                                ?>
                                <div class="tengah">
                                    Data lagu berhasil dihapus.<br>
                                    <br>
                                        <a href="view_lagu.php"><button>Oke</button></a>
                                    <br>
                                </div>
                                <?php
                            }else{
                                //Jika sql sukses tapi tidak ada data yang dihapus
                                ?>
                                <div class="tengah">
                                    Data lagu gagal dihapus, karena data lagu yang akan dihapus tidak ditemukan.<br>
                                    <br>
                                        <a href="view_lagu.php"><button>Batal</button></a>
                                    <br>
                                </div>
                                <?php
                            }
                        }else{
                            //kalau gagal eksekusi sql
                            ?>
                            <div class="tengah">
                                Data gagal dihapus karena <b>Id Lagu</b> tidak ditemukan<br>
                                <br>
                                    <a href="view_lagu.php"><button>Batal</button></a>
                                <br>
                            </div>
                            <?php
                        }
                    }else{
                        //kalau gagal koneksi ke database
                        echo "Gagal koneksi dengan database<br>";
                        echo "Dengan pesan : <br>";
                        echo DEVELOPMENT ? ":".$database->connect_error : "";
                    }
                }
            ?>
        </main>
        <?php
            //footer
            useFooter();
        ?>
    </body>
</html>