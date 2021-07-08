<?php
    include_once("function.php");
    include_once("login_action.php");
    session_start();
    checkSession();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>FORM TAMBAH USER</title>
		<style>
            .tengah{
                text-align:center;
            }
            .kiri{
                text-align:left;
            }
        </style>
	</head>
	<body>
		<main>
			<div class="tengah">
                <h2>TAMBAH DATA USER</h2>
                <font size=2><?php getNumUser();?></font>
                <br>
                <br>
            </div>
            <form method="post" name="createuser" action="save_user.php">
                <table border=1 align="center">
                    <tr>
                        <th class="kiri">Username</th>
                        <td><input type="text" name="Username" size="15" maxlength="15"></td>
                    </tr>
                    <tr>
                        <th class="kiri">Password</th>
                        <td><input type="password" name="Password" size="20" maxlength="20"></td>
                    </tr>
                </table>
                <br>
                <div class="tengah">
                    <input type="submit" name="submit_c_u" value="Tambah">
                </div>
            </form>
            <div class="tengah">
                <a href="dashboard.php"><button>Batal</button></a>
            </div>
		</main>
	</body>
	<?php
		//footer
		useFooter();
	?>
</html>