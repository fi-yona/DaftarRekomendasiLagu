<?php
    include_once("function.php");
    include_once("login_action.php");
    session_start();
    checkSession();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>KETERANGAN PENYIMPANAN DATA ALBUM</title> 
        <style>
            .tengah{
                text-align:center;
            }
        </style>
    </head>
    <body>
        <main>
            <div class="tengah">
                <h2><b>KETERANGAN PENYIMPANAN DATA</b></h2>
                <br>
                <?php
                    if(isset($_POST["submit_i_a"])){
                        $database = dbConnect();
                        if($database->connect_errno==0){
                            //kalau berhasil connect ke database
                            //clear data
                            $IdAlbum = $database->escape_string($_POST["IdAlbum"]);
                            $NamaAlbum = $database->escape_string($_POST["NamaAlbum"]);
                            $TahunRilis = $database->escape_string($_POST["TahunRilis"]);
                            $IdPenyanyi = $database->escape_string($_POST["IdPenyanyi"]);
                            //sql query insert
                            $sql = "INSERT INTO album(IdAlbum,NamaAlbum,TahunRilis,IdPenyanyi)
                                    VALUES('$IdAlbum','$NamaAlbum','$TahunRilis','$IdPenyanyi')";
                            //eksekusi sql query insert
                            $res = $database->query($sql);
                            if($res){
                                //kalau berhasil eksekusi sql
                                if($database->affected_rows>0){
                                    //Jika terjadi penambahan data
                                    ?>
                                        <div class="tengah">
                                            Data berhasil disimpan<br>
                                            <br>
                                            <a href="view_album.php"><button>Lihat Data</button></a>
                                            <br>
                                            <a href="insert_album.php"><button>Tambah Data Lain</button></a>
                                            <br>
                                        </div>
                                    <?php
                                }
                            }else{
                                //kalau gagal eksekusi sql
                                ?>
                                    <div class="tengah">
                                            Data gagal disimpan karena mungkin <b>Id Album</b> yang didaftarkan sudah digunakan untuk penyanyi lain<br>
                                            <br>
                                            <a href="view_album.php"><button>Batal</button></a>
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