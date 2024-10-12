<?php
    session_start();
    include("sambungan.php");

    if (isset($_POST["submit"])) {
        $userid = $_POST["userid"];
        $password = $_POST["password"];

        $jumpa = FALSE;

        if ($jumpa == FALSE) {
            $sql = "SELECT * FROM ahli";
            $result = mysqli_query($sambungan, $sql);
            while ($ahli = mysqli_fetch_array($result)) {
                if ($ahli["idahli"] == $userid && $ahli["password"] == $password) {
                    $jumpa = TRUE;
                    $_SESSION["idpengguna"] = $ahli["idahli"];
                    $_SESSION["namapengguna"] = $ahli["namaahli"];
                    $_SESSION["status"] = "ahli";
                    break;
                }
            }
        }

        if ($jumpa == FALSE) {
            $sql = "SELECT * FROM admin";
            $result = mysqli_query($sambungan, $sql);
            while ($admin = mysqli_fetch_array($result)) {
                if ($admin["idadmin"] == $userid && $admin["password"] == $password) {
                    $jumpa = TRUE;
                    $_SESSION["idpengguna"] = $admin["idadmin"];
                    $_SESSION["namapengguna"] = $admin["namaadmin"];
                    $_SESSION["status"] = "admin";
                    break;
                }
            }
        }

        if ($jumpa == TRUE) {
            if ($_SESSION["status"] == "ahli") {
                header("Location: ahli_home.php");
            } elseif ($_SESSION["status"] == "admin") {
                header("Location: admin_home.php");
            } else {
                echo "<script>window.location='index.php';</script>";
            }
        } else {
            echo "<script>alert('Kesalahan pada username atau password');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="aabutton.css">
    <link rel="stylesheet" href="aaborang.css">
    <style>
        body {
            background-image: url('imej/maktab-sultan-abu-bakar.png');
            width： 100%; 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat; 
        }
    </style>
</head>

<body>
    <center>
        <img class="tajuk" src="imej/tajuk.png" width="500">
    </center>

    <h3 class="pendek">LOG IN</h3>
    <form class="pendek" action="index.php" method="post">
        <table>
            <tr>
                <td><img src="imej/user.png"></td>
                <td><input type="text" name="userid" placeholder="idpengguna"></td>
            </tr>
            <tr>
                <td><img src="imej/lock.png"></td>
                <td><input type="password" name="password" placeholder="password"></td>
            </tr>
        </table>
        <button class="login" type="submit" name="submit">Login</button>
        <button class="signup" type="button" onclick="window.location='signup.php'">Sign Up</button>
    </form>
</body>

</html>