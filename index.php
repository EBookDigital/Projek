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