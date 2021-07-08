<?php
    include_once("function.php");
    include_once("login_action.php");
    session_start();
    checkSession();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>TAMBAH DATA LAGU</title>
        <style>
            .tengah{
                text-align:center;
            }
            .kiri{
                text-align:left;
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
        </header>
        <main>
            <div class="tengah">
                <h2>TAMBAH DATA LAGU</h2>
                <font size=2><?php getNumLagu();?></font>
                <br>
                <br>
            </div>
            <form method="post" name="insertl" action="save_lagu.php">
                <table border=1 align="center">
                    <tr>
                        <th class="kiri">Id Lagu</th>
                        <td><input type="text" name="IdLagu" size="5" maxlength="5"></td>
                    </tr>
                    <tr>
                        <th class="kiri">Judul Lagu</th>
                        <td><input type="text" name="Judul" size="50" maxlength="50"></td>
                    </tr>
                    <tr>
                        <th class="kiri">Nama Penyanyi<sup>*</sup></th>
                        <td><select name="IdPenyanyi">
                            <option>--Pilih Penyanyi--</option>
                            <?php
                                $dataPenyanyi = getPenyanyi(); //ambil data penyanyi dari function
                                foreach($dataPenyanyi as $data){
                                    echo "<option value=\"" . $data["IdPenyanyi"] . "\">" . $data["NamaPenyanyi"] . "</option>";
                                }
                            ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="kiri">Link Lagu</th>
                        <td><input type="text" name="LaguYoutube" size="50"></td>
                    </tr>
                    <tr>
                        <th class="kiri">Genre Lagu</th>
                        <td><input type="text" name="Genre" size="30" maxlength="30"></td>
                    </tr>
                    <tr>
                        <th class="kiri">Nama Album<sup>**</sup></th>
                        <td><select name="IdAlbum">
                            <option>--Pilih Album--</option>
                            <?php
                                $dataAlbum = getAlbum(); //ambil data penyanyi dari function
                                foreach($dataAlbum as $data){
                                    echo "<option value=\"" . $data["IdAlbum"] . "\">" . $data["NamaAlbum"] . "</option>";
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
                    <input type="submit" name="submit_i_l" value="Tambah">
                </div>
            </form>
            <div class="tengah">
                <a href="view_lagu.php"><button>Batal</button></a>
            </div>
        </main>
        <?php
            //footer
            useFooter();
        ?>
    </body>
</html>