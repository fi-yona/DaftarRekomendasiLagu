<?php
    include_once("function.php");
    include_once("login_action.php");
    session_start();
    checkSession();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>EDIT DATA ALBUM</title>
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
                <h2>EDIT DATA ALBUM</h2>
                <br>
            </div>
            <?php
                if(isset($_GET["IdAlbum"])){
                    $database = dbConnect();
                    $IdAlbum = $database->escape_string($_GET["IdAlbum"]);
                    if ($dataAlbum = getDataAlbum($IdAlbum)) {
                        // cari data album, kalau ada simpan di dataAlbum
                        ?>
                            <form method="post" name="edita" action="update_album.php">
                                <table border=1 align="center">
                                    <tr>
                                        <th class="kiri">Id Album</th>
                                        <td><input type="text" name="IdAlbum" size="5" maxlength="5"
                                            value="<?php echo $dataAlbum["IdAlbum"];?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <th class="kiri">Nama Album</th>
                                        <td><input type="text" name="NamaAlbum" size="50" maxlength="50"
                                            value="<?php echo $dataAlbum["NamaAlbum"];?>"></td>
                                    </tr>
                                    <tr>
                                        <th class="kiri">Tahun Rilis</th>
                                        <td><input type="text" name="TahunRilis" size="4" maxlength=4
                                            value="<?php echo $dataAlbum["TahunRilis"];?>"></td>
                                    </tr>
                                    <tr>
                                        <th class="kiri">Nama Penyanyi<sup>*</sup></th>
                                        <td><select name="IdPenyanyi">
                                            <option>--Pilih Penyanyi--</option>
                                            <?php
                                                $dataPenyanyi = getPenyanyi();
                                                foreach ($dataPenyanyi as $data) {
                                                    echo "<option value=\"" . $data["IdPenyanyi"] . "\"";
                                                    if ($data["IdPenyanyi"] == $dataAlbum["IdPenyanyi"])
                                                        echo " selected"; // default sesuai penyanyi sebelumnya
                                                    echo ">" . $data["NamaPenyanyi"] . "</option>";
                                                }
                                            ?>
                                            </select></td>
                                    </tr>
                                </table>
                                <br>
                                <div class="tengah">
                                    <table align="center">
                                        <tr>
                                            <td>
                                                <font size="2">(*) Jika tidak menemukan penyanyi yang diinginkan, silahkan <a href="insert_penyanyi.php">isi data penyanyi</a> terlebih dahulu.</font>
                                            </td>
                                        </tr>
                                    </table>
                                    <br>
                                    <br>
                                    <input type="submit" name="submit_e_a" value="Tambah">
                                </div>
                            </form>
                            <div class="tengah">
                                <a href="view_album.php"><button>Batal</button></a>
                            </div>
                        <?php
                    }else{
                        ?>
                            <div class="tengah">
                                Data gagal diubah karena mungkin <b>Id Album</b> : <?php $IdAlbum ?> tidak ditemukan.<br>
                                <br>
                                <a href="view_album.php"><button>Batal</button></a>
                                <br>
                                <a href="javascript:history.back()"><button>Ulangi</button></a>
                                <br>
                        <?php
                    }
                }else{
                    ?>
                        <div class="tengah">
                            Data gagal diubah karena mungkin <b>Id Album</b> tidak ditemukan.<br>
                            <br>
                            <a href="view_album.php"><button>Ulangi</button></a>
                            <br>
                        </div>
                    <?php
                }
            ?>
        </main>
        <?php
            //footer
            useFooter();
        ?>
    </body>
</html>