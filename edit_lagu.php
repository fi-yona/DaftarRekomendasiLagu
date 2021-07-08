<?php
    include_once("function.php");
    include_once("login_action.php");
    session_start();
    checkSession();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>EDIT DATA LAGU</title>
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
                <h2>EDIT DATA LAGU</h2>
                <br>
            </div>
            <?php
                if(isset($_GET["IdLagu"])){
                    $database = dbConnect();
                    $IdLagu = $database->escape_string($_GET["IdLagu"]);
                    if ($dataLagu = getDataLagu($IdLagu)) {
                        // cari data album, kalau ada simpan di dataAlbum
                        ?>
                            <form method="post" name="editl" action="update_lagu.php">
                                <table border=1 align="center">
                                    <tr>
                                        <th class="kiri">Id Lagu</th>
                                        <td><input type="text" name="IdLagu" size="5" maxlength="5"
                                            value="<?php echo $dataLagu["IdLagu"];?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <th class="kiri">Judul Lagu</th>
                                        <td><input type="text" name="Judul" size="50" maxlength="50"
                                            value="<?php echo $dataLagu["Judul"];?>"></td>
                                    </tr>
                                    <tr>
                                        <th class="kiri">Nama Penyanyi<sup>*</sup></th>
                                        <td><select name="IdPenyanyi">
                                            <option>--Pilih Penyanyi--</option>
                                            <?php
                                                $dataPenyanyi = getPenyanyi();
                                                foreach ($dataPenyanyi as $data) {
                                                    echo "<option value=\"" . $data["IdPenyanyi"] . "\"";
                                                    if ($data["IdPenyanyi"] == $dataLagu["IdPenyanyi"])
                                                        echo " selected"; // default sesuai penyanyi sebelumnya
                                                    echo ">" . $data["NamaPenyanyi"] . "</option>";
                                                }
                                            ?>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <th class="kiri">Link Lagu</th>
                                        <td><input type="text" name="LaguYoutube" size="50"
                                            value="<?php echo $dataLagu["LaguYoutube"];?>"></td>
                                    </tr>
                                    <tr>
                                        <th class="kiri">Genre Lagu</th>
                                        <td><input type="text" name="Genre" size="30" maxlength=30
                                            value="<?php echo $dataLagu["Genre"];?>"></td>
                                    </tr>
                                    <tr>
                                        <th class="kiri">Nama Album<sup>*</sup></th>
                                        <td><select name="IdAlbum">
                                            <option>--Pilih Album--</option>
                                            <?php
                                                $dataAlbum = getAlbum();
                                                foreach ($dataAlbum as $data) {
                                                    echo "<option value=\"" . $data["IdAlbum"] . "\"";
                                                    if ($data["IdAlbum"] == $dataLagu["IdAlbum"])
                                                        echo " selected"; // default sesuai album sebelumnya
                                                    echo ">" . $data["NamaAlbum"] . "</option>";
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
                                        <tr>
                                            <td>
                                                <font size="2">(**) Jika tidak menemukan album yang diinginkan, silahkan <a href="insert_album.php">isi data album</a> terlebih dahulu.</font>
                                            </td>
                                        </tr>
                                    </table>
                                    <br>
                                    <br>
                                    <input type="submit" name="submit_e_l" value="Tambah">
                                </div>
                            </form>
                            <div class="tengah">
                                <a href="view_lagu.php"><button>Batal</button></a>
                            </div>
                        <?php
                    }else{
                        ?>
                            <div class="tengah">
                                Data gagal diubah karena mungkin <b>Id Lagu</b> : <?php $IdLagu ?> tidak ditemukan.<br>
                                <br>
                                <a href="view_lagu.php"><button>Batal</button></a>
                                <br>
                                <a href="javascript:history.back()"><button>Ulangi</button></a>
                                <br>
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
            ?>
        </main>
        <?php
            //footer
            useFooter();
        ?>
    </body>
</html>