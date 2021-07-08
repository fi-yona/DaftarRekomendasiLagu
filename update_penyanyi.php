<?php
    include_once("function.php");
    include_once("login_action.php");
    session_start();
    checkSession();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>KETERANGAN PENYIMPANAN EDIT DATA PENYANYI</title> 
        <style>
            .tengah{
                text-align:center;
            }
        </style>
    </head>
    <body>
        <main>
            <div class="tengah">
                <h2><b>KETERANGAN PENYIMPANAN DATA EDIT</b></h2>
                <br>
                <?php
                    if(isset($_POST["submit_e_p"])){
                        $database = dbConnect();
                        if($database->connect_errno==0){
                            //kalau berhasil connect ke database
                            //clear data
                            $IdPenyanyi = $database->escape_string($_POST["IdPenyanyi"]);
                            $NamaPenyanyi = $database->escape_string($_POST["NamaPenyanyi"]);
                            $TahunDebut = $database->escape_string($_POST["TahunDebut"]);
                            $LinkInstagram = $database->escape_string($_POST["LinkInstagram"]);
                            $LinkYoutube = $database->escape_string($_POST["LinkYoutube"]);
                            //sql query insert
                            $sql = "UPDATE penyanyi
                                    SET NamaPenyanyi='$NamaPenyanyi',TahunDebut='$TahunDebut',LinkInstagram='$LinkInstagram',LinkYoutube='$LinkYoutube'
                                    WHERE IdPenyanyi='$IdPenyanyi'";
                            //eksekusi sql query insert
                            $res = $database->query($sql);
                            if($res){
                                //kalau berhasil eksekusi sql
                                if($database->affected_rows>0){
                                    //Jika terjadi penambahan data
                                    ?>
                                        <div class="tengah">
                                            Data berhasil diedit<br>
                                            <br>
                                            <a href="view_penyanyi.php"><button>Lihat Data</button></a>
                                            <br>
                                            <a href="javascript:history.back()"><button>Ulangi</button></a>
                                            <br>
                                        </div>
                                    <?php
                                }
                            }else{
                                //kalau gagal eksekusi sql
                                ?>
                                    <div class="tengah">
                                            Data gagal diedit<br>
                                            <br>
                                            <a href="view_penyanyi.php"><button>Batal</button></a>
                                            <br>
                                            <a href="javascript:history.back()"><button>Ulangi</button></a>
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
            </div>
        </main>
        <?php
            //footer
            useFooter();
        ?>
    </body>
</html>