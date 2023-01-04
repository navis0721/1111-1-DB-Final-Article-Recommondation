<?php
    require_once 'Connect.php';
?>

<?php 
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (empty($username)) {
        echo "<script>alert('請輸入帳號'); location.href = 'login2.html';</script>";
        exit();
    }else if(empty($password)){
        echo "<script>alert('請輸入密碼'); location.href = 'login2.html';</script>";
        exit();
    }else{
        $sql = "SELECT * FROM TestForLogin WHERE username='$username' AND password='$password'";
        $result = mysqli_query($dbConnection, $sql);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            session_start(); 
            $_SESSION['username'] = $row['username'];
            $_SESSION['password'] = $row['password'];
            // header('Location: Novel.php');
            echo "<script>alert('Logged in!'); location.href = 'Novel.php';</script>";
            exit();
        }else{
            echo "<script>alert('無此帳號'); location.href = 'login2.html';</script>";
            exit();
        }
    }

?>