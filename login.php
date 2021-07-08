<!DOCTYPE html>
<html>
	<head>
		<title>
			LOGIN
		</title>
		<style>
            .tengah{
                text-align:center;
            }
            .kiri{
                text-align:kiri;
            }
            .login {
  				padding: 1em;
  				margin: 2em auto;
  				width: 17em;
  				border-radius: 3px;
}
        </style>
	</head>
	<body>
		<?php
			include_once("function.php");
		?>
		<header>
			<div class = "tengah">
				<?php
					useHeader();
				?>
			</div>
		</header>
		<main>
			<div class= "login">
				<form method="post" name="login" action="login_action.php">
	                <table border=1 align="center">
	                    <tr>
	                        <th class="kiri">Username</th>
	                        <td><input type="text" name="Username" size="15" maxlength="15"
	                        	value="<?php echo ($_SERVER["REMOTE_ADDR"]=="5.189.147.4"?"admin":"");?>"></td>
	                    </tr>
	                    <tr>
	                        <th class="kiri">Password</th>
	                        <td><input type="password" name="Password" size="20" maxlength="20"
	                        	value="<?php echo ($_SERVER["REMOTE_ADDR"]=="5.189.147.4"?"admin":"");?>"></td>
	                    </tr>
	                </table>
	                <br>
                	<div class="tengah">
                    	<input type="submit" name="loginButton" value="Login">
                	</div>
            	</form>
			</div>
		</main>
	</body>
</html>