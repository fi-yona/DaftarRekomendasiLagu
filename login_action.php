<?php
    include_once("function.php");

    $database = dbConnect();

    if($database -> connect_errno==0){
        if(isset($_POST["loginButton"])){
            $Username = $_POST['Username'];
            $Password = $_POST['Password'];
            $sql = "SELECT Username, Password
                    FROM user
                    WHERE Username='$Username' and Password=md5('$Password')";
            $res = $database->query($sql);
            if($res){
                if($res->num_rows==1){
                    $data = $res->fetch_assoc();
                    session_start();
                    $_SESSION['Username'] = $Username;
                    $_SESSION['status'] = "login";
                    header("Location:  dashboard.php");
                }else{
                    header("Location: login.php");
                }
            }else{
                header("Location: login.php");
            }
        }
    }
?>