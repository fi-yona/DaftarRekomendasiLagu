<?php
    include_once("function.php");
    include_once("login_action.php");
    session_start();
    checkSession();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>TAMBAH DATA ALBUM</title>
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
                <h2>TAMBAH DATA ALBUM</h2>
                <font size=2><?php getNumAlbum();?></font>
                <br>
                <br>
            </div>
            <form method="post" name="inserta" action="save_album.php">
                <table border=1 align="center">
                    <tr>
                        <th class="kiri">Id Album</th>
                        <td><input type="text" name="IdAlbum" size="5" maxlength="5"></td>
                    </tr>
                    <tr>
                        <th class="kiri">Nama Album</th>
                        <td><input type="text" name="NamaAlbum" size="50" maxlength="50"></td>
                    </tr>
                    <tr>
                        <th class="kiri">Tahun Rilis</th>
                        <td><input type="text" name="TahunRilis" size="4" maxlength=4></td>
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
                    <input type="submit" name="submit_i_a" value="Tambah">
                </div>
            </form>
            <div class="tengah">
                <a href="view_album.php"><button>Batal</button></a>
            </div>
        </main>
        <?php
            //footer
            useFooter();
        ?>
    </body>
</html>