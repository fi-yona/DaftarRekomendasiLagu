<?php
    define("DEVELOPMENT", true);

    //function panggil database
    function dbConnect(){
        $database = new mysqli("localhost","root","","dbmusik");
        return $database;
    }
    
    //function panggil navigasi
    function useNavigation(){
        ?>
            <h2>NAVIGATION</h2>
            <ul>
                <li><a href="view_lagu.php">Data Lagu</a></li>
                <li><a href="view_album.php">Data Album</a></li>
                <li><a href="view_penyanyi.php">Data Penyanyi</a></li>
            </ul>
        <?php
    }

    //function panggil footer
    function useFooter(){
        ?>
        <footer>
            <div align="right">
            <h5>Oleh : Fiona Avila Putri - 10119013</h5>
            </div>
        </footer>
        <?php
    }

    //function panggil header
    function useHeader(){
        ?>
            <div class="tengah">
                <h1><b>DAFTAR LAGU REKOMENDASI</b></h1>
                <br>
                <br>
            </div>
        <?php
    }

    //function untuk mengambil id penyanyi
    function getPenyanyi(){
        $database = dbConnect();
        if($database->connect_errno==0){
            $sql = "SELECT * 
                    FROM penyanyi
                    ORDER BY NamaPenyanyi";
            $res = $database->query($sql);
            if($res){
                //Kalau berhasil eksekusi sql
                $data = $res->fetch_all(MYSQLI_ASSOC);
                $res->free();
                return $data;
            }else{
                //Kalau gagal eksekusi sql
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }

    //function untuk panggil id album
    function getAlbum(){
        $database = dbConnect();
        if($database->connect_errno==0){
            $sql = "SELECT album.IdAlbum, album.NamaAlbum
                    FROM album";
            $res = $database->query($sql);
            if($res){
                //Kalau berhasil eksekusi sql
                $data = $res->fetch_all(MYSQLI_ASSOC);
                $res->free();
                return $data;
            }else{
                //Kalau gagal eksekusi sql
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }

    function getDataPenyanyi($IdPenyanyi){
        $database = dbConnect();
        if($database->connect_errno==0){
            $sql = "SELECT IdPenyanyi, NamaPenyanyi, TahunDebut, LinkInstagram, LinkYoutube
                    FROM penyanyi
                    WHERE IdPenyanyi = '$IdPenyanyi'";
            $res = $database->query($sql);
            if($res){
                if($res->num_rows>0){
                    $data = $res->fetch_assoc();
                    $res -> free();
                    return $data;
                }else{
                    return FALSE;
                }
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }

    function getDataAlbum($IdAlbum){
        $database = dbConnect();
        if($database->connect_errno==0){
            $sql = "SELECT IdAlbum, NamaAlbum, TahunRilis, IdPenyanyi
                    FROM album
                    WHERE IdAlbum = '$IdAlbum'
                    AND ";
            $res = $database->query($sql);
            if($res){
                if($res->num_rows>0){
                    $data = $res->fetch_assoc();
                    $res -> free();
                    return $data;
                }else{
                    return FALSE;
                }
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }

    function getDataLagu($IdLagu){
        $database = dbConnect();
        if($database->connect_errno==0){
            $sql = "SELECT IdLagu, Judul, Genre, IdPenyanyi, IdAlbum, LaguYoutube
                    FROM lagu
                    WHERE IdLagu = '$IdLagu'";
            $res = $database->query($sql);
            if($res){
                if($res->num_rows>0){
                    $data = $res->fetch_assoc();
                    $res -> free();
                    return $data;
                }else{
                    return FALSE;
                }
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }

    //function panggil banyak data di tabel penyanyi
    function getNumPenyanyi(){
        $database = dbConnect();
        if($database->connect_errno==0){
            $sql = "SELECT *
                    FROM penyanyi";
            $res = $database->query($sql);
            if($res){
                //Kalau berhasil eksekusi sql
                echo "Total data : " . $res->num_rows . "<br>";
                $res->free();
            }else{
                //Kalau gagal eksekusi sql
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }

    //function panggil banyak data di tabel album
    function getNumAlbum(){
        $database = dbConnect();
        if($database->connect_errno==0){
            $sql = "SELECT *
                    FROM album";
            $res = $database->query($sql);
            if($res){
                //Kalau berhasil eksekusi sql
                echo "Total data : " . $res->num_rows . "<br>";
                $res->free();
            }else{
                //Kalau gagal eksekusi sql
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }

    //function panggil banyak data di tabel album
    function getNumLagu(){
        $database = dbConnect();
        if($database->connect_errno==0){
            $sql = "SELECT *
                    FROM lagu";
            $res = $database->query($sql);
            if($res){
                //Kalau berhasil eksekusi sql
                echo "Total data : " . $res->num_rows . "<br>";
                $res->free();
            }else{
                //Kalau gagal eksekusi sql
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }

    //function untuk panggil banyak user
    function getNumUser(){
        $database = dbConnect();
        if($database->connect_errno==0){
            $sql = "SELECT *
                    FROM user";
            $res = $database->query($sql);
            if($res){
                //Kalau berhasil eksekusi sql
                echo "Total data : " . $res->num_rows . "<br>";
                $res->free();
            }else{
                //Kalau gagal eksekusi sql
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }

    //function tombol logout
    function toLogOut(){
        ?>
            <a href = "conf_logout.php"><button><font size=4><b>Logout</b></font></button></a>
        <?php
    }

    //function tombol dashboard
    function toDashboard(){
        ?>
            <a href = "dashboard.php"><button><font size=4><b>Dashboard</b></font></button></a>
        <?php
    }

    //function cek session
    function checkSession(){
        if($_SESSION['status'] != "login"){
            header("Location : login.php");
        }
    }
?>